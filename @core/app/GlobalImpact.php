<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GlobalImpact extends Model
{
    protected $table = 'global_import';
    protected $fillable = ['country','date_range','value','zone'];
}
