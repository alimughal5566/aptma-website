<?php

namespace App\Exports;

use App\ChinaZce;
use App\CotlookAIndex;
use App\ExcelPublishedDate;
use App\ExchangeRates;
use App\ExportBills;
use App\KcaPakRupeesPerFourtyKg;
use App\NycUS;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class ExchangeRatesExports implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
 public $datea;
    public function __construct($date)
    {
        $this->datea=$date;
    }

    public function view(): View
    {
        $searchedResult = ExcelPublishedDate::where('date',$this->datea)->first();  
        $date = $searchedResult->id;
        return view('frontend.pages.Exports.ExchangeRateExport', [
            'data' => ExchangeRates::where('published_at',$date)->get(['country','currency','selling','buying']),
            'export'=>ExportBills::where('published_at',$date)->get(['currency','spot','sight_Od','first_month','second_month','third_month','fourth_Month','fifth_Month','sixth_month']),
            'cotlook'=>CotlookAIndex::where('published_at',$date)->get(['a_index','a_index_change']),
            'nyc'=>NycUS::where('published_at',$date)->get(['contract','close','changes']),
            'kca'=>KcaPakRupeesPerFourtyKg::where('published_at',$date)->get(['kca_grade_3_spot']),
            'china'=>ChinaZce::where('published_at',$date)->get('prod','last','chg','vol','open_interest')
        ]);
    }

}
