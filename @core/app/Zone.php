<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    protected $table = 'zone';
    protected $fillable = ['name'];


    public function users(){
        return $this->hasMany('App\User','zone_id')->orderBy('id','desc');
    }

}
