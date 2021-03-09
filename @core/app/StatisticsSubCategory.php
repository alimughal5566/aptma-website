<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatisticsSubCategory extends Model
{
    protected $table = 'statistics_sub_categories';
    protected $fillable = [
        'title',
        'status',
        'slug',
        'cat_id',
        'lang',
    ];
    public function category(){
        return $this->hasOne(StatisticsCategory::class,'id','cat_id');
    }
}
