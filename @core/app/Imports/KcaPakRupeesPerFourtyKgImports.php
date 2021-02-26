<?php

namespace App\Imports;

use App\ExcelPublishedDate;
use App\KcaPakRupeesPerFourtyKg;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class KcaPakRupeesPerFourtyKgImports implements ToModel,WithStartRow
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

        return new KcaPakRupeesPerFourtyKg([
            'kca_grade_3_spot'=>$row[0],
            'published_at'=>$date_id,
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
