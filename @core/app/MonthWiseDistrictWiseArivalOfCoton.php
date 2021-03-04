<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonthWiseDistrictWiseArivalOfCoton extends Model
{
    protected $table = 'month_wise_district_wise_arival_of_cotton';
    protected $fillable = ['district', 'year', 'year_value', 'month_1', 'month1_value', 'month_2', 'month2_value', 'month_3', 'month3_value', 'month_4', 'month4_value'
        , 'month_5', 'month5_value', 'month_6', 'month6_value'
        , 'month_5', 'month5_value', 'month_6', 'month6_value', 'month_7', 'month7_value', 'month_8', 'month8_value', 'month_9', 'month9_value', 'month_10', 'month10_value', 'month_11', 'month11_value', 'month_12', 'month12_value'
    ];
}
