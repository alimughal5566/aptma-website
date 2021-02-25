<?php

namespace App\Imports;

use App\NycUS;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;

class NycUSImports implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
//        dd(Carbon::parse(Carbon::now()->toDate())->format('d-m-Y'));
        return new NycUS([
            'contract'=>$row[0],
            'close'=>$row[1],
            'changes'=>$row[2],
            'published_at' => Carbon::parse(Carbon::now()->toDate())->format('d-m-Y'),
        ]);
    }
}
