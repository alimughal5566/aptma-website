<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatisticsCategory extends Model
{
    protected $table = 'statistics_categories';
    protected $fillable = [
        'title',
        'lang',
        'status',
        'slug'
    ];
}
