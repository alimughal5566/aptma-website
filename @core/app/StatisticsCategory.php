<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatisticsCategory extends Model
{
    protected $table = 'statistics_categories';
    protected $fillable = [
        'title',
        'lang',
        'status',
        'slug'
    ];
    public function subCategories(){
        return $this->hasMany(StatisticsSubCategory::class,'cat_id','id');
    }
}
