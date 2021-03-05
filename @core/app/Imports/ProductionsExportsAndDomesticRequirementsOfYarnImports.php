<?php

namespace App\Imports;

use App\ProductionsExportsAndDomesticRequirementsOfYarn;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ProductionsExportsAndDomesticRequirementsOfYarnImports implements ToCollection,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    /**
     * @return int
     */
    public function startRow(): int
    {
        return 7;
    }

    /**
     * @param Collection $collection
     */
        public function collection(Collection $rows)
    {

        foreach ($rows as $row) {
            if ($row[0] != null){
                ProductionsExportsAndDomesticRequirementsOfYarn::create([
                    'peroid'=>$row[0],
                    'production'=>$row[1],
                    'consumed_in_mill_quantity'=>$row[2],
                    'consumed_in_mill_prod'=>$row[3],
                    'export_quantity'=>$row[4],
                    'export_prod'=>$row[5],
                    'available_for_local_market_quantity'=>$row[6],
                    'available_for_local_market_prod'=>$row[7],
                ]);
            }
        }

    }
}
