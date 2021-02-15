<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoGalleryCategory extends Model
{
    protected $table = 'video_gallery_categories';
    protected $guarded = [];

    public function videos(){
        return $this->hasMany('App\VideoGallery','cat_id');
    }
}
