<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TeamCategory extends Model
{
    protected $table = 'team_categories';
    protected $guarded = [];

    protected static function boot(){
        parent::boot();
        static::saving(function($model){ //work fine
            $model->slug = Str::slug($model->name);

        });
    }

    public function setSlugAttribute(){
        $this->attributes['slug'] =  str_replace(' ','-',$this->name);
    }



}
