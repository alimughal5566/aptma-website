<?php

namespace App\Imports;

use App\ChinaZce;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;

class ChinaZceImports implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new ChinaZce([
            'prod'=>$row[0],
            'last'=>$row[1],
            'chg'=>$row[2],
            'vol'=>$row[3],
            'open_interest'=>$row[3],
            'published_at' => Carbon::parse(Carbon::now()->toDate())->format('d-m-Y'),
        ]);
    }
}
