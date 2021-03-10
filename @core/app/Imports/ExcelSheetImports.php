<?php

namespace App\Imports;

use App\ExcelSheet;
use App\StatisticsCategory;
use App\StatisticsSubCategory;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
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
//        dd($collection[1][0]);
        $slug1 = Str::slug(StatisticsCategory::find($this->category)->title);
        $slug2 = Str::slug(StatisticsSubCategory::find($this->sub_category)->title);
        $slug = Str::slug($collection[1][0]);
        ExcelSheet::create([
            'category'=>$this->category,
            'sub_category'=>$this->sub_category,
            'sheet_data'=>$collection,
            'slug'=>$slug,
            'cat_slug'=>$slug1,
            'sub_cat_slug'=>$slug2,
        ]);
    }
}
