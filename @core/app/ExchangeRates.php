<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExchangeRates extends Model
{
    protected $table = 'exchange_rates';
    protected $guarded = [];
    public function category(){
        return $this->belongsTo(ExchangeRatesCategories::class,'cat_id');
    }
}
