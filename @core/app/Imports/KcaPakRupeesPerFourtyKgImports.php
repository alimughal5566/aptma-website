<?php

namespace App\Imports;

use App\KcaPakRupeesPerFourtyKg;
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
        return new KcaPakRupeesPerFourtyKg([
            'kca_grade_3_spot'=>$row[0],
            'published_at'=>$row['1'],
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
