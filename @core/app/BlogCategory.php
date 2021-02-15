<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    protected $table ='blog_categories';
    protected $fillable = ['name','lang','status'];

    public function blogs(){
        return $this->hasMany('App\Blog','blog_categories_id');
    }
}
