<?php

namespace App\Imports;

use App\ExcelPublishedDate;
use App\ExchangeRates;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ExchangeRatesImports implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $current_date = Carbon::parse(Carbon::now()->toDate())->format('Y-m-d');
        $date = ExcelPublishedDate::where('date',$current_date)->first();
        if ($date){
            $date_id = $date->id;
        }else{
            $date = new ExcelPublishedDate();
            $date->date = $current_date;
            $date->save();
            $date_id = $date->id;
        }
        return new ExchangeRates([
            'country' => $row[0],
            'currency' => $row[1],
            'selling' => $row[2],
            'Buying' => $row[3],
            'published_at' =>$date_id,
        ]);
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 3;
    }
}
