<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExcelSheet extends Model
{
    protected $table = 'excel_sheets';
    protected $fillable = [
        'category',
        'sub_category',
        'sheet_data',
    ];
    protected $casts = ['sheet_data'=>'array'];

    public function getCategory(){
        return $this->hasOne(StatisticsCategory::class,'id','category');
    }
    public function getSubCategory(){
        return $this->hasOne(StatisticsSubCategory::class,'id','sub_category');
    }
}
