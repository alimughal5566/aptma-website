<?php

namespace App\Http\Controllers;

use App\ChinaZce;
use App\CotlookAIndex;
use App\ExcelPublishedDate;
use App\ExchangeRates;
use App\ExportBills;
use App\ExportOfRawCotton;
use App\GlobalImpact;
use App\Imports\ChinaZceImports;
use App\Imports\CotlookAIndexImports;
use App\Imports\ExchangeRatesImports;
use App\Imports\ExportBillsImports;
use App\Imports\ExportOfRawCottonImports;
use App\Imports\GlobalImportImport;
use App\Imports\KcaPakRupeesPerFourtyKgImports;
use App\Imports\MonthWiseDistrictWiseArivalOfCotonImport;
use App\Imports\NycUSImports;
use App\Imports\ProductionsExportsAndDomesticRequirementsOfYarnImports;
use App\Imports\UserImport;
use App\KcaPakRupeesPerFourtyKg;
use App\Language;
use App\MonthWiseDistrictWiseArivalOfCoton;
use App\NycUS;
use App\ProductionsExportsAndDomesticRequirementsOfYarn;
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
                Excel::import(new ExportBillsImports, $file);
            }elseif ($request->category=='China ZCE Cotton'){
                Excel::import(new ChinaZceImports, $file);
            }elseif ($request->category=='Exchange Rates'){
                Excel::import(new ExchangeRatesImports, $file);
            }elseif ($request->category=='NYC US Cent/lb'){
                Excel::import(new NycUSImports, $file);
            }elseif ($request->category=='Cotlook ‘A’ Index'){
                Excel::import(new CotlookAIndexImports, $file);
            }elseif ($request->category=='KCA  Pak Rs / Maund 40 Kg'){
                Excel::import(new KcaPakRupeesPerFourtyKgImports, $file);
            }elseif ($request->category=='Month Wise District Wise Arival Of Cotton'){
                Excel::import(new MonthWiseDistrictWiseArivalOfCotonImport, $file);
            }elseif ($request->category=='Productions, Exports And Domestic Requirements Of YARN'){
                Excel::import(new ProductionsExportsAndDomesticRequirementsOfYarnImports, $file);
            }elseif ($request->category=='Export Of Raw Cotton'){
                Excel::import(new ExportOfRawCottonImports, $file);
            }elseif ($request->category=='Global Impact Of Cotton'){
                Excel::import(new GlobalImportImport, $file);
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
        $data = ExcelPublishedDate::where('date', $date)->with('exchange', 'china', 'cotlook', 'export', 'kca', 'nyc')->first();
        return view('frontend.pages.exchangeRates.single-category-table',compact('data','date'));
    }


    public function frontDailyStats()
    {
        $all_dates = ExcelPublishedDate::all();
        $dates = ExcelPublishedDate::all();
        return view('frontend.pages.exchangeRates.index',compact('dates','all_dates'));
    }
    public function frontDailyStatsDate($date)
    {
        $all_dates = ExcelPublishedDate::all();
        $dates = ExcelPublishedDate::where('date',$date)->get();
        return view('frontend.pages.exchangeRates.index',compact('dates','all_dates'));
    }
    public function importUserView (){
        return redirect()->back()->with(['msg' => __('New User Created..'), 'type' => 'success']);
    }
    public function import_user(Request $request){
        $this->validate($request,[
            "file" => "required|mimes:csv,xlsx,xls",
        ]);
        $file = $request->file('file');
        Excel::import(new UserImport, $file);
        return redirect()->back()->with(['msg' => __('Import Successful'), 'type' => 'success']);
    }
    public function statistics(){
        return view('frontend.pages.statistics.index');
    }
    public function statisticsTables($type){
//        dd('adsad');
        if ($type=='month_wise_district_wise'){
        $month_wise =  MonthWiseDistrictWiseArivalOfCoton::paginate(20);
            return view('frontend.pages.statistics.table',compact('month_wise'));
        }if ($type=='export_of_raw_cotton'){
        $export_of_raw =  ExportOfRawCotton::paginate(20);
            return view('frontend.pages.statistics.table',compact('export_of_raw'));
        }if ($type=='production_export'){
        $production_export =  ProductionsExportsAndDomesticRequirementsOfYarn::paginate(20);
            return view('frontend.pages.statistics.table',compact('production_export'));
        }if ($type=='global_impact'){
        $global_impact =  GlobalImpact::paginate(20);
            return view('frontend.pages.statistics.table',compact('global_impact'));
        }
    }
}
