<?php

namespace App\Imports;

use App\ExcelPublishedDate;
use App\MonthWiseDistrictWiseArivalOfCoton;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;

class MonthWiseDistrictWiseArivalOfCotonImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
//        $current_date = Carbon::parse(Carbon::now()->toDate())->format('Y-m-d');
        return new MonthWiseDistrictWiseArivalOfCoton([
            'district'=>$row[4],
            'previous_year_total'=>$row[5],
            '15_sep_18'=>$row[6],
            '1_oct_18'=>$row[7],
            '15_oct_18'=>$row[8],
            '1_nov_18'=>$row[9],
            '15_nov_18'=>$row[10],
            '1_dec_18'=>$row[11],
            '15_dec_18'=>$row[12],
            '1st_jan_19'=>$row[13],
            '15_jan_19'=>$row[14],
        ]);
    }
}
