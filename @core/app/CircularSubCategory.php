<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CircularSubCategory extends Model
{
    protected $table = 'circular_sub_categories';
    protected $fillable = [
      'id','category_id','name','status','lang','slug'
    ];
    public function category(){
        return $this->hasOne(CircularCategory::class,'id','category_id');
    }
}
