<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChinaZce extends Model
{
    protected $table = 'china_zce_cotton_no_1_rates';
    protected $fillable =['prod','last','chg','vol','open_interest','published_at'];
}
