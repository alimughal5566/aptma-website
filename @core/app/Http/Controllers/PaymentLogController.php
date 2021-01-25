<?php

namespace App\Http\Controllers;

use App\Donation;
use App\DonationLogs;
use App\EventAttendance;
use App\EventPaymentLogs;
use App\Events;
use App\Http\Traits\PaytmTrait;
use App\Jobs;
use App\Mail\BasicMail;
use App\Mail\DonationMessage;
use App\Mail\PaymentSuccess;
use App\Mail\PlaceOrder;
use App\Order;
use App\PaymentLogs;
use App\PricePlan;
use App\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use KingFlamez\Rave\Facades\Rave;
use phpDocumentor\Reflection\Types\Self_;
use Razorpay\Api\Api;
use Stripe\Charge;
use Mollie\Laravel\Facades\Mollie;
use Stripe\Stripe;
use Unicodeveloper\Paystack\Facades\Paystack;
use function App\Http\Traits\getChecksumFromArray;

class PaymentLogController extends Controller
{
    use PaytmTrait;
    public function order_payment_form(Request $request){

        $this->validate($request,[
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'order_id' => 'required|string',
            'payment_gateway' => 'required|string',
        ]);
        $order_details = Order::find($request->order_id);
        $payment_details = PaymentLogs::where('order_id',$request->order_id)->first();
        if (empty($package_details)){
            $payment_log_id = PaymentLogs::create([
                'email' =>  $request->email,
                'name' =>  $request->name,
                'package_name' =>  $order_details->package_name,
                'package_price' =>  $order_details->package_price,
                'package_gateway' =>  $request->payment_gateway,
                'order_id' =>  $request->order_id,
                'status' =>  'pending',
                'track' =>  Str::random(10). Str::random(10),
            ])->id;
            $payment_details = PaymentLogs::find($payment_log_id);
        }


        if ($request->payment_gateway == 'paypal'){

            $payable_amount = $payment_details->package_price;
            $currency_code = get_static_option('site_global_currency');

            if (!is_paypal_supported_currency()){
                $payable_amount = get_amount_in_usd($order_details->package_price,get_static_option('site_global_currency'));
                if ($payable_amount < 1){
                    return $payable_amount.__('USD amount is not supported by paypal');
                }
                $currency_code = 'USD';
            }

            $paypal_details['business'] = get_static_option('paypal_business_email');
            $paypal_details['cbt'] = get_static_option('site_'.get_default_language().'_title');
            $paypal_details['item_name'] = 'Payment For Order Id: #'.$request->order_id.' Package Name: '.$payment_details->package_name.' Payer Name: '.$request->name.' Payer Email:'.$request->email;
            $paypal_details['custom'] = $payment_details->track;
            $paypal_details['currency_code'] = $currency_code;
            $paypal_details['amount'] = $payable_amount;
            $paypal_details['return'] = route('frontend.order.payment.success',$request->order_id);
            $paypal_details['cancel_return'] = route('frontend.order.payment.cancel',$request->order_id);
            $paypal_details['notify_url'] = route('frontend.paypal.ipn');

            return view('frontend.payment.paypal')->with(['paypal_details' => $paypal_details]);

        }elseif ($request->payment_gateway == 'paytm'){

            $payable_amount = $payment_details->package_price;
            if (!is_paytm_supported_currency() ){
                $payable_amount = get_amount_in_inr($payment_details->package_price,get_static_option('site_global_currency'));
            }
            
            $data_for_request = $this->handlePaytmRequest( $payment_details->track, $payable_amount );

            $paytm_txn_url = PAYTM_TXN_URL;
            $paramList = $data_for_request['paramList'];
            $checkSum = $data_for_request['checkSum'];

            return view('frontend.payment.paytm')->with([
                'paytm_txn_url' => $paytm_txn_url,
                'paramList' => $paramList,
                'checkSum' => $checkSum,
            ]);
        }elseif ($request->payment_gateway == 'manual_payment'){

            $order = Order::where( 'id', $request->order_id )->first();
            $order->status = 'pending';
            $order->save();
            PaymentLogs::where('order_id',$request->order_id)->update(['transaction_id' => $request->trasaction_id]);

            self::send_order_mail($order_details->id);

           return redirect()->route('frontend.order.payment.success',$request->order_id);

        }elseif ($request->payment_gateway == 'stripe'){

            $order = Order::where( 'id', $request->order_id )->first();

            $stripe_data['title'] = __('Payment of order:').' '.$order->package_name;
            $stripe_data['order_id'] = $order->id;
            $stripe_data['price'] = $order->package_price;
            $stripe_data['route'] = route('frontend.stripe.ipn');

            return view('frontend.payment.stripe')->with('stripe_data' ,$stripe_data);
        }
        elseif ($request->payment_gateway == 'razorpay'){
            
            $order = Order::where( 'id', $request->order_id )->first();
            $payable_amount = $payment_details->package_price;
            $currency_code = get_static_option('site_global_currency');

            if (!is_razorpay_supported_currency()){
                $payable_amount = get_amount_in_inr($payment_details->package_price,get_static_option('site_global_currency'));
                $currency_code = 'INR';
            }

            $razorpay_data['currency_symbol'] = $currency_code;
            $razorpay_data['currency'] = $currency_code;
            $razorpay_data['price'] = $payable_amount;
            $razorpay_data['package_name'] = $order->package_name;
            $razorpay_data['route'] = route('frontend.razorpay.ipn');
            $razorpay_data['order_id'] = $order->id;
            return view('frontend.payment.razorpay')->with('razorpay_data' ,$razorpay_data);
        }
        elseif ($request->payment_gateway == 'paystack'){
            
            $order = Order::where( 'id', $request->order_id )->first();
            $package_details = PaymentLogs::where('order_id',$order->id)->first();

            $payable_amount = $payment_details->package_price;
            $currency_code = get_static_option('site_global_currency');

            if (!is_paystack_supported_currency()){
                $payable_amount = get_amount_in_ngn($payment_details->package_price,get_static_option('site_global_currency'));
                $currency_code = 'NGN';
            }

            $paystack_data['currency'] = $currency_code;
            $paystack_data['price'] = $payable_amount;
            $paystack_data['package_name'] =  $order->package_price;
            $paystack_data['name'] = $package_details->name;
            $paystack_data['email'] = $package_details->email;
            $paystack_data['order_id'] = $order->id;
            $paystack_data['track'] = $package_details->track;
            $paystack_data['route'] = route('frontend.paystack.pay');
            $paystack_data['type'] = 'order';
            return view('frontend.payment.paystack')->with(['paystack_data' => $paystack_data]);
            
        }elseif ($request->payment_gateway == 'mollie'){

            $order = Order::where( 'id', $request->order_id )->first();
            $package_details = PaymentLogs::where('order_id',$order->id)->first();

            $currency_code = get_static_option('site_global_currency');
            $payable_amount = $payment_details->package_price;

            if (!is_mollie_supported_currency() ){
                $payable_amount = get_amount_in_usd($payment_details->package_price,get_static_option('site_global_currency'));
                $currency_code = 'USD';
            }


            $payment = Mollie::api()->payments->create([
                "amount" => [
                    "currency" => $currency_code,
                    "value" => custom_number_format($payable_amount),//"10.00" // You must send the correct number of decimals, thus we enforce the use of strings
                ],
                "description" => "Package Order Details ID #".$order->id .' Name: '.$package_details->name.' Email: '.$package_details->email,
                "redirectUrl" => route('frontend.mollie.webhook'),
                "metadata" => [
                    "order_id" => $order->id,
                    "track" => $package_details->track,
                ],
            ]);

            $payment = Mollie::api()->payments->get($payment->id);

            session()->put('mollie_payment_id',$payment->id);

            // redirect customer to Mollie checkout page
            return redirect($payment->getCheckoutUrl(), 303);
        }elseif ($request->payment_gateway == 'flutterwave'){
            
            $order = Order::where( 'id', $request->order_id )->first();
            $package_details = PaymentLogs::where('order_id',$order->id)->first();

            $payable_amount = $payment_details->package_price;
            $currency_code = get_static_option('site_global_currency');

            if (!is_flutterwave_supported_currency()){
                $payable_amount = get_amount_in_usd($payment_details->package_price,get_static_option('site_global_currency'));
                $currency_code = 'USD';
            }

            $flutterwave_data['currency'] = $currency_code;
            $flutterwave_data['name'] = $request->name;
            $flutterwave_data['form_action'] = route('frontend.flutterwave.pay');
            $flutterwave_data['amount'] = custom_number_format($payable_amount);
            $flutterwave_data['description'] = "Donation Details ID #".$order->id .' Name: '.$package_details->name;
            $flutterwave_data['email'] = $package_details->email;
            $flutterwave_data['country'] = get_visitor_country() ? get_visitor_country() : 'NG';
            $flutterwave_data['metadata'] = [
                ['metaname' => 'order_id', 'metavalue' => $order->id],
                ['metaname' => 'track', 'metavalue' => $package_details->track],
            ];
            return view('frontend.payment.flutterwave')->with('flutterwave_data' ,$flutterwave_data);
        }


        return redirect()->route('homepage');
    }

    public function flutterwave_pay(Request $request){
        Rave::initialize(route('frontend.flutterwave.callback'));
    }

    /**
     * Obtain Rave callback information
     * @return void
     */
    public function flutterwave_callback(Request $request)
    {
        $response = json_decode(request()->resp);
        $txRef =$response->data->transactionobject->txRef;
        $data = Rave::verifyTransaction($txRef);
        $chargeResponsecode = $data->data->chargecode;
        $track = $data->data->meta[1]->metavalue;

        $payment_logs = PaymentLogs::where( 'track', $track )->first();
        if (($chargeResponsecode == "00" || $chargeResponsecode == "0")){

            $transaction_id = $txRef;
            //update database
            self::update_database($payment_logs->order_id,$transaction_id);
            //send success mail to user and admin
            self::send_order_mail($payment_logs->order_id);

            return redirect()->route('frontend.order.payment.success',$payment_logs->order_id);

        }else{
            return redirect()->route('frontend.order.payment.cancel',$payment_logs->order_id);
        }

    }

    public function mollie_webhook(){
        $payment_id = session()->get('mollie_payment_id');
        $payment = Mollie::api()->payments->get($payment_id);
        session()->forget('mollie_payment_id');

        $order_details = Order::find($payment->metadata->order_id);
         if ($payment->isPaid()){//database udpate
             self::update_database($order_details->id,$payment->id);
             //send mail to user
            self::send_order_mail($order_details->id);
            return redirect()->route('frontend.order.payment.success',$payment->metadata->order_id);
        }

       return redirect()->route('frontend.order.payment.cancel',$payment->metadata->order_id);
    }


    public function paypal_ipn(Request $request)
    {

        $raw_post_data = file_get_contents('php://input');
        $raw_post_array = explode('&', $raw_post_data);
        $myPost = array();
        foreach ($raw_post_array as $keyval) {
            $keyval = explode ('=', $keyval);
            if (count($keyval) == 2)
                $myPost[$keyval[0]] = urldecode($keyval[1]);
        }

        // Read the post from PayPal system and add 'cmd'
        $req = 'cmd=_notify-validate';
        if(function_exists('get_magic_quotes_gpc')) {
            $get_magic_quotes_exists = true;
        }
        foreach ($myPost as $key => $value) {
            if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
                $value = urlencode(stripslashes($value));
            } else {
                $value = urlencode($value);
            }
            $req .= "&$key=$value";
        }

        /*
         * Post IPN data back to PayPal to validate the IPN data is genuine
         * Without this step anyone can fake IPN data
         */
         $paypalURL = get_paypal_form_url();
        $ch = curl_init($paypalURL);
        if ($ch == FALSE) {
            return FALSE;
        }
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
        curl_setopt($ch, CURLOPT_SSLVERSION, 6);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);

        // Set TCP timeout to 30 seconds
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close', 'User-Agent: company-name'));
        $res = curl_exec($ch);

        /*
         * Inspect IPN validation result and act accordingly
         * Split response headers and payload, a better way for strcmp
         */
        $tokens = explode("\r\n\r\n", trim($res));
        $res = trim(end($tokens));
        if (strcmp($res, "VERIFIED") == 0 || strcasecmp($res, "VERIFIED") == 0) {

            $receiver_email = $_POST['receiver_email'];
            $mc_currency = $_POST['mc_currency'];
            $mc_gross = $_POST['mc_gross'];
            $track = $_POST['custom'];

            //GRAB DATA FROM DATABASE!!
            $payment_logs = PaymentLogs::where('track', $track)->first();
            $paypal_business_email = get_static_option('paypal_business_email');

            if ($receiver_email == $paypal_business_email && $payment_logs->status == 'pending') {
                //send success mail to user and admin
                $payment_logs = PaymentLogs::where('track', $track)->first();
                //database update
                self::update_database($payment_logs->order_id,$_POST['txn_id']);
                //send mail
                self::send_order_mail($payment_logs->order_id);

            }
        }
        
    }

    public function paytm_ipn(Request $request){
        $order_id = $request['ORDERID'];

        if ( 'TXN_SUCCESS' === $request['STATUS'] ) {
            $transaction_id = $request['TXNID'];
            $payment_logs = PaymentLogs::where( 'track', $order_id )->first();
            //update database
            self::update_database($payment_logs->order_id, $request['TXNID']);
            //send mail
            self::send_order_mail($payment_logs->order_id);

            return redirect()->route('frontend.order.payment.success',$payment_logs->order_id);

        } else if( 'TXN_FAILURE' === $request['STATUS'] ){
            $payment_logs = PaymentLogs::where( 'track', $order_id )->first();
            return redirect()->route('frontend.order.payment.cancel',$payment_logs->order_id);
        }
    }


    public function stripe_ipn(Request $request)
    {
        // stripe customer payment token
        $stripe_token = $request->stripe_token;
        $order_details = Order::find($request->order_id);
        $payment_log_details = PaymentLogs::where('order_id',$request->order_id)->first();
        Stripe::setApiKey( get_static_option('stripe_secret_key') );

        if (!empty($stripe_token)){
            // charge customer with your amount
            $result = Charge::create(array(
                "currency" => get_static_option('site_global_currency'),
                "amount"   => $order_details->package_price * 100, // amount in cents,
                'source' => $stripe_token,
                'description' => 'Payment From '. get_static_option('site_'.get_default_language().'_title').'. Order ID '.$order_details->id .', Payer Name: '.$payment_log_details->name.', Payer Email: '.$payment_log_details->email,
            ));
        }

        if ($result->status == 'succeeded'){
            //update database
            self::update_database($request->order_id,$result->balance_transaction);
            //send mail to user
            self::send_order_mail($order_details->id);
            return redirect()->route('frontend.order.payment.success',$request->order_id);
        }
        return redirect()->route('frontend.order.payment.cancel',$request->order_id);

    }

    public function razorpay_ipn(Request $request){

        $order_details = Order::find($request->order_id);
        $payment_log_details = PaymentLogs::where('order_id',$request->order_id)->first();

        //get API Configuration
        $api = new Api(get_static_option('razorpay_key'), get_static_option('razorpay_secret'));
        //Fetch payment information by razorpay_payment_id
        $payment = $api->payment->fetch($request->razorpay_payment_id);

        if(!empty($request->razorpay_payment_id)) {
            try {
                $response = $api->payment->fetch($request->razorpay_payment_id)->capture(array('amount'=> $payment['amount']));
            } catch (\Exception $e) {
                return redirect()->route('frontend.order.payment.cancel',$request->order_id);
            }
            // Do something here for store payment details in database...
            self::update_database($request->order_id,$payment->id);
            //send mail to user
            self::send_order_mail($order_details->id);
        }

        return redirect()->route('frontend.order.payment.success',$request->order_id);

    }

    public function paystack_pay(){
        return Paystack::getAuthorizationUrl()->redirectNow();
    }

    public function paystack_callback(Request $request){
        $paymentDetails = Paystack::getPaymentData();

        if ($paymentDetails['status']){
         $meta_data = $paymentDetails['data']['metadata'];
         if ($meta_data['type'] == 'order'){
             $payment_log_details = PaymentLogs::where('track',$meta_data['track'])->first();
             $order_details = Order::find($payment_log_details->order_id);

             //update database
             $this->update_database($payment_log_details->order_id,$paymentDetails['data']['reference']);
             //send mail to user
             self::send_order_mail($order_details->id);

             return redirect()->route('frontend.order.payment.success',$payment_log_details->order_id);
         }elseif ($meta_data['type'] == 'event'){

             $payment_log_details = EventPaymentLogs::where('track',$meta_data['track'])->first();
             $order_details = EventAttendance::find($payment_log_details->attendance_id);
             //update event attendance status
             $order_details->payment_status = 'complete';
             $order_details->status = 'complete';
             $order_details->save();
             //update event payment log
             $payment_log_details->transaction_id = $paymentDetails['data']['reference'];
             $payment_log_details->status = 'complete';
             $payment_log_details->save();

             //update event available tickets
             $event_details = Events::find($order_details->event_id);
             $event_details->available_tickets = intval($event_details->available_tickets) - $order_details->quantity;
             $event_details->save();

             $event_attendance = EventAttendance::find($payment_log_details->attendance_id);

             $order_mail = get_static_option('event_attendance_receiver_mail') ? get_static_option('event_attendance_receiver_mail') : get_static_option('site_global_email');
             $event_details = Events::find($event_attendance->event_id);
             $event_payment_logs = EventPaymentLogs::where('attendance_id',$event_attendance->id)->first();

             //send mail to admin
             $subject = __('you have an event booking order');
             $message = __('you have an event booking order. attendance Id').' #'.$event_attendance->id;
             $message .= ' '.__('at').' '.date_format($event_attendance->created_at,'d F Y H:m:s');
             $message .= ' '.__('via').' '.str_replace('_',' ',$event_payment_logs->package_gateway);
             $admin_mail = !empty(get_static_option('event_attendance_receiver_mail')) ? get_static_option('event_attendance_receiver_mail') : get_static_option('site_global_email');

             Mail::to($admin_mail)->send(new \App\Mail\EventAttendance([
                 'subject' => $subject,
                 'message' => $message,
                 'event_attendance' => $event_attendance,
                 'event_details' => $event_details,
                 'event_payment_logs' => $event_payment_logs,
             ]));

             //send mail to user
             $subject = __('your event booking order has been placed');
             $message = __('your event booking order has been placed. attendance Id').' #'.$event_attendance->id;
             $message .= ' '.__('at').' '.date_format($event_attendance->created_at,'d F Y H:m:s');
             $message .= ' '.__('via').' '.str_replace('_',' ',$event_payment_logs->package_gateway);
             Mail::to($order_mail)->send(new \App\Mail\EventAttendance([
                 'subject' => $subject,
                 'message' => $message,
                 'event_attendance' => $event_attendance,
                 'event_details' => $event_details,
                 'event_payment_logs' => $event_payment_logs,
             ]));


             return redirect()->route('frontend.event.payment.success',$payment_log_details->attendance_id);

         }elseif ($meta_data['type'] == 'donation'){

             $payment_log_details = DonationLogs::where('track',$meta_data['track'])->first();
             //update event attendance status

             $payment_log_details->transaction_id = $paymentDetails['data']['reference'];
             $payment_log_details->status = 'complete';
             $payment_log_details->save();

             //update donation raised amount
             $event_details = Donation::find($payment_log_details->donation_id);
             $event_details->raised = intval($event_details->raised) + intval($payment_log_details->amount);
             $event_details->save();

             //send success mail to user and admin
             $donation_details = DonationLogs::find($payment_log_details->donation_id);
             $site_title = get_static_option('site_'.get_default_language().'_title');
             $customer_subject = __('Your donation payment success for').' '.$site_title;
             $admin_subject = __('You have a new donation payment from').' '.$site_title;
             $donation_notify_mail = get_static_option('donation_notify_mail');
             $admin_mail = !empty($donation_notify_mail) ? $donation_notify_mail : get_static_option('site_global_email');

             Mail::to($admin_mail)->send(new DonationMessage($donation_details,$admin_subject,'owner'));
             Mail::to($donation_details->email)->send(new DonationMessage($donation_details,$customer_subject,'customer'));

             return redirect()->route('frontend.donation.payment.success',$payment_log_details->id);

         }elseif ($meta_data['type'] == 'product'){

             $job_applicant_details = ProductOrder::where('track',$meta_data['track'])->first();
             $job_applicant_details->transaction_id = $paymentDetails['data']['reference'];
             $job_applicant_details->status = 'complete';
             $job_applicant_details->save();
             rest_cart_session();

             $jobs_details = Jobs::where('id',$job_applicant_details->jobs_id)->first();
             $receiver_mail_address = !empty(get_static_option('job_single_page_applicant_mail')) ? get_static_option('job_single_page_applicant_mail') : get_static_option('site_global_email');
             //send mail to admin
             $admin_message = '<p>'.__('Hello').',<br> '.__('You have a new job applicant');
             $admin_message .= ' #'.$job_applicant_details->id.' '.__('Name').' '.$job_applicant_details->name;
             $admin_message .= ' '.__('Applied to job post').' "'.$jobs_details->title.'"';
             $admin_message .= ' '.__('applied at').' '.date_format($job_applicant_details->created_at,'d M y h:i:s') ;

             //check for payment details
             if (!empty($jobs_details->application_fee_status) && $jobs_details->application_fee > 0){
                 $admin_message .= ' '.__('paid via').' '.str_replace('_',' ',$job_applicant_details->payment_gateway);
                 $admin_message .= ' '.__('Transaction Id').' '.$job_applicant_details->transaction_id;
             }

             $admin_message .= ' '.__('check admin panel for more info.') ;
             $admin_message .='</p>';


             Mail::to($receiver_mail_address)->send(new BasicMail([
                 'subject' => __('You Have A Job Applicant'),
                 'message' => $admin_message,
             ]));

             //send mail to admin
             $applicant_message = '<p>'.__('Hello').', '.$job_applicant_details->name.'<br> '.__('You job application submitted successfully.');
             $applicant_message .= ' #'.$job_applicant_details->id;
             $applicant_message .= ' '.__('Applied to job post').' "'.$jobs_details->title.'"';
             $applicant_message .= ' '.__('applied at').' '.date_format($job_applicant_details->created_at,'d M y h:i:s') ;
             //check for payment details
             if (!empty($jobs_details->application_fee_status) && $jobs_details->application_fee > 0){
                 $applicant_message .= ' '.__('paid via').' '.str_replace('_',' ',$job_applicant_details->payment_gateway);
                 $applicant_message .= ' '.__('Transaction Id').' '.$job_applicant_details->transaction_id;
             }
             $applicant_message .='</p>';
             //send mail to applicant
             Mail::to($job_applicant_details->email)->send(new BasicMail([
                 'subject' => __('Your job application submitted successfully'),
                 'message' => $applicant_message,
             ]));

             return redirect()->route('frontend.job.payment.success',$product_order_details->id);

         }elseif ($meta_data['type'] == 'job'){

             $product_order_details = ProductOrder::where('payment_track',$meta_data['track'])->first();
             $product_order_details->transaction_id = $paymentDetails['data']['reference'];
             $product_order_details->status = 'complete';
             $product_order_details->save();
             rest_cart_session();

             $site_title = get_static_option('site_'.get_default_language().'_title');
             $customer_subject = __('You order has been placed in').' '.$site_title;
             $admin_subject = __('You Have A New Product Order From').' '.$site_title;

             Mail::to(get_static_option('site_global_email'))->send(new \App\Mail\ProductOrder($product_order_details,'owner',$admin_subject));
             Mail::to($product_order_details->billing_email)->send(new \App\Mail\ProductOrder($product_order_details,'customer',$customer_subject));;

             return redirect()->route('frontend.product.payment.success',$product_order_details->id);
         }
         else{
             return redirect()->route('homepage');
         }
        }else{
            return redirect()->route('homepage');
        }
    }

    public function handlePaytmRequest( $order_id, $amount ) {
        // Load all functions of encdec_paytm.php and config-paytm.php
        $this->getAllEncdecFunc();
        $this->getConfigPaytmSettings();

        $checkSum = "";
        $paramList = array();

        // Create an array having all required parameters for creating checksum.
        $paramList["MID"] = get_static_option('paytm_merchant_mid');
        $paramList["ORDER_ID"] = $order_id;
        $paramList["CUST_ID"] = $order_id;
        $paramList["INDUSTRY_TYPE_ID"] = 'Retail';
        $paramList["CHANNEL_ID"] = 'WEB';
        $paramList["TXN_AMOUNT"] = $amount;
        $paramList["WEBSITE"] = get_static_option('paytm_merchant_website');
        $paramList["CALLBACK_URL"] = route('frontend.paytm.ipn');
        $paytm_merchant_key = get_static_option('paytm_merchant_key');

        //Here checksum string will return by getChecksumFromArray() function.
        $checkSum = getChecksumFromArray( $paramList, $paytm_merchant_key );

        return array(
            'checkSum' => $checkSum,
            'paramList' => $paramList
        );
    }

    public function update_database($order_id,$transaction_id){
        Order::find($order_id)->update(['payment_status' => 'complete']);
        PaymentLogs::where('order_id',$order_id)->update(['transaction_id' => $transaction_id,'status' => 'complete']);
    }
    public function send_order_mail($order_id){

        $order_details = Order::find($order_id);
        $package_details = PricePlan::where('id',$order_details->package_id)->first();
        $payment_details = PaymentLogs::where('order_id',$order_id)->first();
        $all_fields = unserialize($order_details->custom_fields);
        unset($all_fields['package']);

        $all_attachment = unserialize($order_details->attachment);
        $order_page_form_mail =  get_static_option('order_page_form_mail');
        $order_mail = $order_page_form_mail ? $order_page_form_mail : get_static_option('site_global_email');

        $subject = __('your have an package order');
        $message = __('your have an package order.').' #'.$order_id;
        $message .= ' '.__('at').' '.date_format($order_details->created_at,'d F Y H:m:s');
        $message .= ' '.__('via').' '.str_replace('_',' ',$payment_details->package_gateway);

        Mail::to($order_mail)->send(new PlaceOrder([
            'data' => $order_details,
            'subject' => $subject,
            'message' => $message,
            'package' => $package_details,
            'attachment_list' => $all_attachment,
            'payment_log' => $payment_details
        ]));

        $subject = __('your order has been placed');
        $message = __('your order has been placed.').' #'.$order_id;
        $message .= ' '.__('at').' '.date_format($order_details->created_at,'d F Y H:m:s');
        $message .= ' '.__('via').' '.str_replace('_',' ',$payment_details->package_gateway);
        Mail::to($payment_details->email)->send(new PlaceOrder([
            'data' => $order_details,
            'subject' => $subject,
            'message' => $message,
            'package' => $package_details,
            'attachment_list' => $all_attachment,
            'payment_log' => $payment_details
        ]));
    }

}
