<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class VideoGalleryCategory extends Model
{
    protected $table = 'video_gallery_categories';
    protected $guarded = [];

    public function videos(){
        return $this->hasMany('App\VideoGallery','cat_id');
    }

    protected static function boot(){
        parent::boot();
        static::saving(function($model){ //work fine
            $model->slug = Str::slug($model->name);
        });
    }


}
