<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CotlookAIndex extends Model
{
    protected $fillable = ['a_index','a_index_change','published_at'];
    protected $table = 'cotlook_a_index';
}
