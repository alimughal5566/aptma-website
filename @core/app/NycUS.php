<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NycUS extends Model
{
    protected $table ='nyc_us_cent_lb';
    protected $fillable = ['contract','close','changes','published_at'];
}
