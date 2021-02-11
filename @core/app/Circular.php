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
}
