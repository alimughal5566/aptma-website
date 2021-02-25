<?php

namespace App\Imports;

use App\NycUS;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class NycUSImports implements ToModel,WithStartRow
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

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }
}
