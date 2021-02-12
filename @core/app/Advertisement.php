<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    protected $table = 'advertisement';
    protected $guarded = [];
    public function category(){
        return $this->belongsTo('App\AdvertisementCategory','cat_id');
    }
}
