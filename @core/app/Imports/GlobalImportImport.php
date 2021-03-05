<?php

namespace App\Imports;

use App\GlobalImpact;
use App\GlobalImport;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class GlobalImportImport implements ToCollection, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {
//        dd($rows);
        $date_range = [];
        for ($i = 0; $i < count($rows[0]); $i++) {
            if (!empty($rows[0][$i])) {
                $date_range[$i] = $rows[0][$i];
            }
        }
        unset($date_range[0]);
        unset($date_range[14]);
        foreach ($rows as $key => $row) {
//            dd($row);
            if ($key > 1) {
//                dd($date_range, $row);
                if (!empty($row[0])) {
                    if ($key<14){
                        for ($i=1; $i<count($date_range); $i++) {
//                        dd($date_range[$key]);
                            GlobalImpact::create([
                                'country' => $row[0],
                                'date_range' => $date_range[$i],
                                'value' => $row[$i],
                                'zone' => $row[14]
                            ]);
                        }
                    }
                }
            }
        }
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 5;
    }
}
