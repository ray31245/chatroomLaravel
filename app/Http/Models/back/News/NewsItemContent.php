<?php

namespace App\Http\Models\News;

use Config;
use BaseFunction;
use Session;
use Illuminate\Database\Eloquent\Builder AS Model_Builder;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Model2;

class NewsItemContent extends Model2
{
    const clone_relations = ['NewsItemContentImg'];

    public function __construct()
    {
        if(!empty(Config::get('app.dataBasePrefix')) )
        {
            $this->setTable(Config::get('app.dataBasePrefix'). "news_item_content");
        }else{
            $this->setTable("news_item_content");
        }
    }

    public function NewsItemContentImg()
    {
        return $this->hasMany('App\Http\Models\News\NewsItemContentImg', 'second_id', 'id')/*->where('is_visible',1)->orderBy('rank','asc')*/;
    }

    public function EXAMPLE()
    {
        return $this->hasMany('App\Http\Models\EXAMPLE\EXAMPLE', 'EXAMPLE_ID', 'id')->where('is_visible',1)->orderBy('rank','asc');
    }
}