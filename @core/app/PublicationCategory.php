<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PublicationCategory extends Model
{
    protected $table = 'publication_categories';
    protected $guarded = [];

    public function publications(){
        return $this->hasMany('App\Publication','cat_id')->orderBy('id','desc');
    }
}
