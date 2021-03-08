<?php

namespace App\Imports;

use App\ExcelSheet;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class ExcelSheetImports implements ToCollection
{
    public $category;
    public $sub_category;
    public function __construct($category_object,$sub_category_object)
    {
        $this->category = $category_object;
        $this->sub_category = $sub_category_object;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $collection)
    {
        ExcelSheet::create([
            'category'=>$this->category,
            'sub_category'=>$this->sub_category,
            'sheet_data'=>$collection,
        ]);
    }
}
