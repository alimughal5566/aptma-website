<?php

namespace App\Imports;

use App\ChinaZce;
use App\ExcelPublishedDate;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ChinaZceImports implements ToModel,WithStartRow
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
        return new ChinaZce([
            'prod'=>$row[0],
            'last'=>$row[1],
            'chg'=>$row[2],
            'vol'=>$row[3],
            'open_interest'=>$row[4],
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
