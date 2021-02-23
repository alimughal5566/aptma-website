<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TeamType extends Model
{
    protected $table = 'team_type';
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($model) { //work fine
            $model->slug = Str::slug($model->name);
        });
    }


    public function setSlugAttribute()
    {
        $this->attributes['slug'] = str_replace(' ', '-', $this->name);
    }

    public function type_members()
    {
        return $this->hasMany('App\TeamMember', 'type', 'id')->where('is_research_member', '1');
    }


}
