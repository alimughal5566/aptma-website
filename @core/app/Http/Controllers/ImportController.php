<?php

namespace App\Http\Controllers;

use App\ChinaZce;
use App\ExchangeRates;
use App\ExportBills;
use App\Imports\ChinaZceImports;
use App\Imports\ExchangeRatesImports;
use App\Imports\ExportBillsImports;
use App\Imports\NycUSImports;
use App\Language;
use App\NycUS;
use App\Publication;
use App\PublicationCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{

    public function imports(Request $request){

        $this->validate($request,[
            "file" => "required|mimes:csv,xlsx,xls",
        ]);
        $name=time();
        if ($request->file) {
            $excel_sheet =  $name. '.' . $request->file->extension();
            $file = $request->file('file');
            if ($request->category=='Export Bills'){
//                $request->file->move('assets/uploads/exportbills/excels', $excel_sheet);
                Excel::import(new ExportBillsImports, $file);
            }elseif ($request->category=='China ZCE Cotton'){
//                $request->file->move('assets/uploads/chinaZCE/excels', $excel_sheet);
                Excel::import(new ChinaZceImports, $file);
            }elseif ($request->category=='Exchange Rates'){
//                $request->file->move('assets/uploads/exchangeratess/excels', $excel_sheet);
                Excel::import(new ExchangeRatesImports, $file);
            }elseif ($request->category=='NYC US Cent/lb'){
//                $request->file->move('assets/uploads/nycUS/excels', $excel_sheet);
                Excel::import(new NycUSImports, $file);
            }else{
                return redirect()->back()->withErrors(['msg' => __('Undefined Category...'),'type' => 'danger']);
            }
            return redirect()->back()->with(['msg' => __('Import successful...'),'type' => 'success']);
        }else{
            return redirect()->back()->withErrors(['msg' => __('Please Select a Valid File...'),'type' => 'danger']);
        }
    }

    public function frontDailyDtats($slug)
    {
        $cat_id = null;
        $current_date = Carbon::parse(Carbon::now()->toDate())->format('d-m-Y');
        $exchange_rates = ExchangeRates::where('published_at', $current_date)->get();
        $nyc = NycUS::where('published_at', $current_date)->get();
        $china_zce = ChinaZce::where('published_at', $current_date)->get();
        $export = ExportBills::where('published_at', $current_date)->get();

        $default_lang = Language::where('default', 1)->first();
        $lang = !empty(session()->get('lang')) ? session()->get('lang') : $default_lang->slug;
        $user_select_lang_slug =$lang;

        $footer_widgets = null;

        return view('frontend.pages.exchangeRates.index',compact('exchange_rates', 'nyc', 'china_zce' , 'export' ,'user_select_lang_slug','footer_widgets'));
    }
}
