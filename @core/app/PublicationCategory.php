<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PublicationCategory extends Model
{
    protected $table = 'publication_categories';
    protected $guarded = [];

    public function publications(){
        return $this->hasMany('App\Publication','cat_id')->orderBy('id','desc');
    }
    protected static function boot(){
        parent::boot();
        static::saving(function($model){ //work fine
            $model->slug = Str::slug($model->name);
        });
    }
}
