<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoGallery extends Model
{
        protected $table = 'video_gallery';
    protected $guarded = [];
    public function category(){
        return $this->belongsTo('App\VideoGalleryCategory','cat_id');
    }
}
