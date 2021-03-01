<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KcaPakRupeesPerFourtyKg extends Model
{
    protected $fillable =['kca_grade_3_spot','published_at'];
    protected $table = 'kca_pak_rs_muand_fourty_kg';
}
