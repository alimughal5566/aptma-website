<?php

namespace App\Http\Controllers;

use App\Exports\ExchangeRatesExports;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;

class ExportController extends Controller
{
    public function exportExchangeRates($date)
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new ExchangeRatesExports($date), 'exchange-rates.xlsx');
    }
}
