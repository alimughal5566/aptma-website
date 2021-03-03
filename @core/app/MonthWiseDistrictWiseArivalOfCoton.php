<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonthWiseDistrictWiseArivalOfCoton extends Model
{
    protected $table = 'month_wise_district_wise_arival_of_cotton';
    protected $fillable = ['district','previous_year_total','15_sep_18','1_oct_18','15_oct_18','1_nov_18','15_nov_18','1_dec_18','	15_dec_18','1st_jan_19','15_jan_19'];
}
