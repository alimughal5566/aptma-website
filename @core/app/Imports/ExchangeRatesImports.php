<?php

namespace App\Imports;

use App\ExchangeRates;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;

class ExchangeRatesImports implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new ExchangeRates([
            'country' => $row[0],
            'currency' => $row[1],
            'selling' => $row[2],
            'Buying' => $row[3],
            'published_at' => Carbon::parse(Carbon::now()->toDate())->format('d-m-Y'),
        ]);
    }
}
