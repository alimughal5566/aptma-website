<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExcelPublishedDate extends Model
{
    protected $table = 'excel_published_date';
    protected $fillable = ['date'];

    public function exchange(){
        return $this->hasMany(ExchangeRates::class, 'published_at','id');
    }
    public function china(){
        return $this->hasMany(ChinaZce::class, 'published_at','id');
    }
    public function cotlook(){
        return $this->hasMany(CotlookAIndex::class, 'published_at','id');
    }
    public function export(){
        return $this->hasMany(ExportBills::class, 'published_at','id');
    }
    public function kca(){
        return $this->hasMany(KcaPakRupeesPerFourtyKg::class, 'published_at','id');
    }
    public function nyc(){
        return $this->hasMany(NycUS::class, 'published_at','id');
    }

}
