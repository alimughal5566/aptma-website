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

    public function view(): View
    {
        return view('frontend.pages.Exports.ExchangeRateExport', [
            'data' => ExchangeRates::get(['country','currency','selling','buying']),
            'export'=>ExportBills::get(['currency','spot','sight_Od','first_month','second_month','third_month','fourth_Month','fifth_Month','sixth_month']),
            'cotlook'=>CotlookAIndex::get(['a_index','a_index_change']),
            'nyc'=>NycUS::get(['contract','close','changes']),
            'kca'=>KcaPakRupeesPerFourtyKg::get(['kca_grade_3_spot']),
            'china'=>ChinaZce::get('prod','last','chg','vol','open_interest')
        ]);
    }

}
