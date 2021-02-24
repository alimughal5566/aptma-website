<?php

namespace App\Imports;

use App\ExchangeRates;
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
            //
        ]);
    }
}
