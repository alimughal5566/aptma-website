<?php

namespace App\Imports;

use App\CotlookAIndex;
use App\ExcelPublishedDate;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class CotlookAIndexImports implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    { $current_date = Carbon::parse(Carbon::now()->toDate())->format('Y-m-d');

    $date = ExcelPublishedDate::where('date',$current_date)->first();
        if ($date){
            $date_id = $date->id;
        }else{
            $date = new ExcelPublishedDate();
            $date->date = $current_date;
            $date->save();
            $date_id = $date->id;
        }
        return new CotlookAIndex([
            'a_index'=>$row[0],
            'a_index_change'=>$row[1],
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
