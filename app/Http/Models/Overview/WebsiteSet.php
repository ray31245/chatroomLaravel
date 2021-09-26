<?php

namespace App\Http\Models\Overview;

use Config;
use BaseFunction;
use Session;
use Illuminate\Database\Eloquent\Builder AS Model_Builder;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Model2;

class WebsiteSet extends Model2
{
    const clone_relations = [];

    public function __construct()
    {
        if(!empty(Config::get('app.dataBasePrefix')) )
        {
            $this->setTable(Config::get('app.dataBasePrefix'). "website_set");
        }else{
            $this->setTable("website_set");
        }
    }

    public function EXAMPLE()
    {
        return $this->hasMany('App\Http\Models\EXAMPLE\EXAMPLE', 'EXAMPLE_ID', 'id')->where('is_visible',1)->orderBy('rank','asc');
    }

    // CMS排序
    public function scopedoCMSSort($query)
    {
        // return $query->orderby('id', 'desc')->orderby('rank', 'asc');
        return $query/*->orderby('created_at', 'desc')*/->orderby('rank', 'asc');
    }  
}