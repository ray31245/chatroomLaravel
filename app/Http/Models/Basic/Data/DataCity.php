<?php

namespace App\Http\Models\Basic\Data;

use Config;

use Illuminate\Database\Eloquent\Model;

class DataCity extends Model
{
    const parent_key = [ 'DataGeoArea' => 'geo_id' ];

    public function __construct()
    {
        $this->setTable("basic_data_city");
    }

    public function DataGeoArea()
    {
        return $this->belongsto('App\Http\Models\Basic\Data\DataGeoArea',$this::parent_key['DataGeoArea'],'id');
    }

    public function DataCityRegion()
    {
        return $this->hasmany('App\Http\Models\Basic\Data\DataCityRegion','city_id','id');
    }
}