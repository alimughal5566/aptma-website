<?php

namespace App\Imports;

use App\ExportOfRawCotton;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ExportOfRawCottonImports implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if ($row[0]!= null){
            return new ExportOfRawCotton([
                'period'=>$row[0],
                'quantity_000kg'=>$row[1],
                'value_000usd'=>$row[2],
                'value_000rs'=>$row[3],
                'value_usd_per_kg'=>$row[4],
                'vaue_rs_per_kg'=>$row[5],
            ]);
        }

    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 6;
    }
}
