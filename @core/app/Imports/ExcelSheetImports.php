<?php

namespace App\Imports;

use App\ExcelSheet;
use Maatwebsite\Excel\Concerns\ToModel;

class ExcelSheetImports implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new ExcelSheet([

        ]);
    }
}
