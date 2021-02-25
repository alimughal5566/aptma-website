<?php

namespace App\Imports;

use App\ExportBills;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;

class ExportBillsImports implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

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
            'published_at' => Carbon::parse(Carbon::now()->toDate())->format('d-m-Y'),
        ]);
    }
}
