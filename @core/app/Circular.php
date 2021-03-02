<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Circular extends Model
{
    protected $table = 'circulars';
    protected $guarded = [];
    public function category(){
        return $this->belongsTo('App\CircularCategory','cat_id');
    }
    public function subCategory(){
        return $this->belongsTo(CircularSubCategory::class,'sub_cat_id','id');
    }
}
