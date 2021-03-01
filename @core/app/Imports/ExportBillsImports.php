<?php

namespace App\Imports;

use App\ExcelPublishedDate;
use App\ExportBills;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ExportBillsImports implements ToModel,WithStartRow
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
        return new ExportBills([
            'currency'=>$row[0],
            'spot'=>$row[1],
            'sight_od'=>$row[2],
            'first_month'=>$row[3],
            'second_month'=>$row[4],
            'third_month'=>$row[5],
            'fourth_month'=>$row[6],
            'fifth_month'=>$row[6],
            'sixth_month'=>$row[8],
            'published_at' => $date_id,
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
