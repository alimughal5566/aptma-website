<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CircularCategory extends Model
{
    protected $table = 'circular_categories';
    protected $guarded = [];
    public function subCategory(){
        return $this->hasMany(CircularSubCategory::class,'category_id','id');
    }
}
