<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductionsExportsAndDomesticRequirementsOfYarn extends Model
{
    protected $table ='productions_exports_and_domestic_requirements_of_yarn';
    protected $fillable = ['peroid','production','consumed_in_mill_quantity','consumed_in_mill_prod','export_quantity','export_prod','available_for_local_market_quantity','available_for_local_market_prod'];
}
