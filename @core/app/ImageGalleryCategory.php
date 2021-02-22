<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ImageGalleryCategory extends Model
{
    protected $table = 'image_gallery_categories';
    protected $fillable = ['title','status','lang','image'];

    public function images(){
        return $this->hasMany('App\ImageGallery','cat_id')->orderBy('id','desc');
    }

    protected static function boot(){
        parent::boot();
        static::saving(function($model){ //work fine
            $model->slug = Str::slug($model->title);
        });
    }

}
