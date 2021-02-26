<?php

namespace App\Http\Controllers;

use App\ChinaZce;
use App\CotlookAIndex;
use App\ExcelPublishedDate;
use App\ExchangeRates;
use App\ExportBills;
use App\Imports\ChinaZceImports;
use App\Imports\CotlookAIndexImports;
use App\Imports\ExchangeRatesImports;
use App\Imports\ExportBillsImports;
use App\Imports\KcaPakRupeesPerFourtyKgImports;
use App\Imports\NycUSImports;
use App\KcaPakRupeesPerFourtyKg;
use App\Language;
use App\NycUS;
use App\Publication;
use App\PublicationCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
//            $excel_sheet =  $name. '.' . $request->file->extension();
            $file = $request->file('file');
            if ($request->category=='Export Bills'){
//                $profile_pic =  time(). '.' . $request->file->extension();
//                dd($profile_pic.$request->file);
//                $request->file->move('assets/uploads/export/', $profile_pic);
                Excel::import(new ExportBillsImports, $file);
            }elseif ($request->category=='China ZCE Cotton'){
//                $profile_pic =  time(). '.' . $request->file->extension();
//                $request->file->move('assets/uploads/china/', $profile_pic);
                Excel::import(new ChinaZceImports, $file);
            }elseif ($request->category=='Exchange Rates'){
//                $request->file->move('assets/uploads/exchangeratess/excels', $file);
                Excel::import(new ExchangeRatesImports, $file);
            }elseif ($request->category=='NYC US Cent/lb'){
//                $request->file->move('assets/uploads/nycUS/excels', $file);
                Excel::import(new NycUSImports, $file);
            }elseif ($request->category=='Cotlook ‘A’ Index'){
                Excel::import(new CotlookAIndexImports, $file);
            }elseif ($request->category=='KCA  Pak Rs / Maund 40 Kg'){
                Excel::import(new KcaPakRupeesPerFourtyKgImports, $file);
            }
            else{
                return redirect()->back()->withErrors(['msg' => __('Undefined Category...'),'type' => 'danger']);
            }
            return redirect()->back()->with(['msg' => __('Import successful...'),'type' => 'success']);
        }else{
            return redirect()->back()->withErrors(['msg' => __('Please Select a Valid File...'),'type' => 'danger']);
        }
    }


    public function remove(Request $request){
        $remove_date = Carbon::parse($request->remove_date)->format('Y-m-d');
        if ($request->category=='Export Bills'){
            $record = ExportBills::where('published_at',$remove_date)->get();
        }elseif ($request->category=='China ZCE Cotton'){
            $record = ChinaZce::where('published_at',$remove_date)->get();
        }elseif ($request->category=='Exchange Rates'){
            $record = ExchangeRates::where('published_at',$remove_date)->get();
        }elseif ($request->category=='NYC US Cent/lb'){
            $record = NycUS::where('published_at',$remove_date)->get();
        }elseif ($request->category=='Cotlook ‘A’ Index'){
            $record = CotlookAIndex::where('published_at',$remove_date)->get();
        }elseif ($request->category=='KCA  Pak Rs / Maund 40 Kg'){
            $record = KcaPakRupeesPerFourtyKg::where('published_at',$remove_date)->get();
        }
        else{
            return redirect()->back()->withErrors(['msg' => __('No data found against the provided date.'),'type' => 'danger']);
        }
        if (isset($record[0])){
            return redirect()->back()->with(['msg' => __('Record deleted successfully'),'type' => 'success']);
        }else{
            return redirect()->back()->withErrors(['msg' => __('No data found against the provided date.'),'type' => 'danger']);
        }

    }

    public function frontRableExchangeRates($date){

        $data = ExcelPublishedDate::where('date',$date)->with('exchange','china','cotlook','export','kca','nyc')->first();

        return view('frontend.pages.exchangeRates.single-category-table',compact('data'));
    }


    public function frontDailyDtats()
    {
        $dates = ExcelPublishedDate::all();
//        $default_lang = Language::where('default', 1)->first();
//        $lang = !empty(session()->get('lang')) ? session()->get('lang') : $default_lang->slug;
//        $user_select_lang_slug =$lang;
//
//        $footer_widgets = null;
//        ,'user_select_lang_slug','footer_widgets'

        return view('frontend.pages.exchangeRates.index',compact('dates'));
    }
}
