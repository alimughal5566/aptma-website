<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExportBills extends Model
{
    protected $table = 'export_bills';

    protected $fillable = ['currency','spot','sight_od','first_month','second_month','third_month','fourth_month','fifth_month','sixth_month','published_at'];

}
