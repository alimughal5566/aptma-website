<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventsCategory extends Model
{
    protected $table = 'events_categories';
    protected $fillable = ['title','status','lang'];

    public function events(){
        return $this->hasMany('App\Events','category_id');
    }
}
