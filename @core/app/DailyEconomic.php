<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DailyEconomic extends Model
{
    protected $table = 'daily_economics';
    protected $guarded = [];
    public function category(){
        return $this->belongsTo('App\DailyEconomicCategory','cat_id');
    }
}
