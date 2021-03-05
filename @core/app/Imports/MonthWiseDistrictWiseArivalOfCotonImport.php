<?php

namespace App\Imports;

use App\ExcelPublishedDate;
use App\MonthWiseDistrictWiseArivalOfCoton;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;


class MonthWiseDistrictWiseArivalOfCotonImport implements ToCollection, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function collection(Collection $rows)
    {
        $months = [];
        for ($i = 0; $i < count($rows[0]); $i++) {
            $months[$i] = $rows[0][$i];
        }
        unset($months[0]);
        unset($months[1]);
        foreach ($rows as $key=> $row) {
            if ($row[0] != 'District') {

                if ($key >1) {
                    if (!empty($row[0])){
//                        MonthWiseDistrictWiseArivalOfCoton::create([
//                            'district' => $row[0],
//                            'year' =>($row[1])?"Previous Year":"",
//                            'year_value' =>($row[1])?$row[1]:"",
//                        ]);
                        MonthWiseDistrictWiseArivalOfCoton::create([
                            'district' =>$row[0],
                            'year' =>($row[1])?"Previous Year":"",
                            'year_value' =>($row[1])?$row[1]:"",
                            'month_1'=>Date::excelToDateTimeObject(intval($months[2])),
                            'month1_value'=>$row[2],
                            'month_2'=>Date::excelToDateTimeObject(intval($months[3])),
                            'month2_value'=>$row[3],
                            'month_3'=>Date::excelToDateTimeObject(intval($months[4])),
                            'month3_value'=>$row[4],
                            'month_4'=>Date::excelToDateTimeObject(intval($months[5])),
                            'month4_value'=>$row[5],
                            'month_5'=>Date::excelToDateTimeObject(intval($months[6])),
                            'month5_value'=>$row[6],
                            'month_6'=>Date::excelToDateTimeObject(intval($months[7])),
                            'month6_value'=>$row[7],
                            'month_7'=>Date::excelToDateTimeObject(intval($months[8])),
                            'month7_value'=>$row[8],
                            'month_8'=>Date::excelToDateTimeObject(intval($months[9])),
                            'month8_value'=>$row[9],
                            'month_9'=>Date::excelToDateTimeObject(intval($months[10])),
                            'month9_value'=>$row[10],
//                            'month_10'=>Date::excelToDateTimeObject(intval($months[11])),
//                            'month10_value'=>$row[11],
//                            'month_11'=>$months[11],
//                            'month11_value'=>$row[11],
//                            'month_12'=>$months[12],
//                            'month12_value'=>$row[12],
                        ]);
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
        return 3;
    }
}
