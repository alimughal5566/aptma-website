<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ExchangeRatesCategories extends Model
{
    protected $table = 'exchange_categories';
    protected $guarded = [];
    protected $fillable = ['name','lang','status','title_description'];

    public function publications(){
        return $this->hasMany(ExchangeRatesCategories::class,'cat_id')->orderBy('id','ASC');
    }
    protected static function boot(){
        parent::boot();
        static::saving(function($model){ //work fine
            $model->slug = Str::slug($model->name);
        });
    }
}
