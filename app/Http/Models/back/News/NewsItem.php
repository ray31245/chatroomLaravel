<?php

namespace App\Http\Models\News;

use Config;
use BaseFunction;
use Session;
use Illuminate\Database\Eloquent\Builder AS Model_Builder;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Model2;

class NewsItem extends Model2
{
    const clone_relations = ['NewsItemContent','NewsItemProduct'];
    public $export_table_name = '最新消息';
    // public $table = '產品';
	public $table_map= [
        // // ['layer'=>0,'table'=>'NewsItem','column'=>'id','title'=>'主資料列序號','rank'=>'0'],
        // ['layer'=>0,'table'=>'NewsItem','column'=>'cate_id','title'=>'所屬分類','rank'=>'1'],
        // ['layer'=>0,'table'=>'NewsItem','column'=>'title','title'=>'標題','rank'=>'2'],
        // ['layer'=>0,'table'=>'NewsItem','column'=>'sub_title','title'=>'副標題','rank'=>'3'],
        // ['layer'=>0,'table'=>'NewsItem','column'=>'img','title'=>'列表圖','rank'=>'4'],
        // ['layer'=>0,'table'=>'NewsItem','column'=>'img2','title'=>'列表圖2','rank'=>'5'],
        // ['layer'=>0,'table'=>'NewsItem','column'=>'url_title','title'=>'網址標題','rank'=>'6'],
        // ['layer'=>0,'table'=>'NewsItem','column'=>'news_date','title'=>'新聞日期','rank'=>'7'],
        // ['layer'=>0,'table'=>'NewsItem','column'=>'up_date','title'=>'上架日期','rank'=>'8'],
        // ['layer'=>0,'table'=>'NewsItem','column'=>'down_date','title'=>'下架日期','rank'=>'9'],
    ];
    public $relate_model = [
        // ['name'=>'NewsItemBanner','column'=>'item_id'],
        // ['name'=>'NewsItemContent','column'=>'partner_id']
    ];   
    public $option = [
        // ['table'=>'NewsItem','name'=>'NewsCategory','column'=>'cate_id','title'=>'title'],
        // ['table'=>'NewsItem','name'=>'FmsFile','column'=>'img','title'=>'real_route'],
        // ['table'=>'NewsItem','name'=>'FmsFile','column'=>'img2','title'=>'real_route'],
    ]; 
	public static $TableName; 

    public function __construct()
    {
        $TableName = "news_item";
        self::$TableName = $TableName;
		if(!\Schema::hasTable($TableName)){if(!empty(Config::get('app.dataBasePrefix'))){$TableName = Config::get('app.dataBasePrefix').$TableName;}}
		$this->setTable($TableName);
    }

    public function NewsItemContent()
    {
        return $this->hasMany('App\Http\Models\News\NewsItemContent', 'partner_id', 'id')/*->where('is_visible',1)->orderBy('rank','asc')*/;
    }
    public function NewsItemProduct()
    {
        return $this->hasMany('App\Http\Models\News\NewsItemProduct', 'parent_id', 'id')/*->where('is_visible',1)->orderBy('rank','asc')*/;
    }
    public function NewsCategory()
    {
        return $this->hasOne('App\Http\Models\News\NewsCategory', 'id', 'cate_id')/*->where('is_visible',1)->orderBy('rank','asc')*/;
    }

    // public function NewsItemBanner()
    // {
    //     return $this->hasMany('App\Http\Models\News\NewsItemBanner', 'item_id', 'id')/*->where('is_visible',1)->orderBy('rank','asc')*/;
    // }

    // CMS排序
    // public function scopedoCMSSort($query)
    // {
    //     // return $query->orderby('id', 'desc')->orderby('rank', 'asc');
    //     return $query->orderby('news_date', 'desc')/*->orderby('rank', 'asc')*/;
    // }
    // 排序
    public function scopedoSort($query)
    {
        return $query->orderby('news_date', 'desc')->orderby('id', 'asc');
    }
    public function EXAMPLE()
    {
        return $this->hasMany('App\Http\Models\EXAMPLE\EXAMPLE', 'EXAMPLE_ID', 'id')->where('is_visible',1)->orderBy('rank','asc');
    }
}