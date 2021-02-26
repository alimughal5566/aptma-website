<?php

namespace App\Imports;

use App\CotlookAIndex;
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
    {
        return new CotlookAIndex([
            'a_index'=>$row[0],
            'a_index_change'=>$row[1],
            'published_at'=>$row[2]
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
