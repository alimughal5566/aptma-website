<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    protected $table = 'publications';
    protected $guarded = [];
    public function category(){
        return $this->belongsTo('App\PublicationCategory','cat_id');
    }
}
