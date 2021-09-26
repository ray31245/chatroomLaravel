<?php

namespace App\Http\Models\News;

use Config;
use BaseFunction;
use Session;
use Illuminate\Database\Eloquent\Builder AS Model_Builder;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Model2;

class NewsItemContentImg extends Model2
{
    const clone_relations = [];

    public function __construct()
    {
        if(!empty(Config::get('app.dataBasePrefix')) )
        {
            $this->setTable(Config::get('app.dataBasePrefix'). "news_item_content_img");
        }else{
            $this->setTable("news_item_content_img");
        }
    }

    public function EXAMPLE()
    {
        return $this->hasMany('App\Http\Models\EXAMPLE\EXAMPLE', 'EXAMPLE_ID', 'id')->where('is_visible',1)->orderBy('rank','asc');
    }
}