<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExportOfRawCotton extends Model
{
    protected $table ='export_raw_of_cotton';
    protected $fillable = ['period','quantity_000kg','value_000usd','value_000rs','value_usd_per_kg','vaue_rs_per_kg'];
}
