<?php

namespace App\Http\Models\Product;

use Config;
use BaseFunction;
use Session;
use Illuminate\Database\Eloquent\Builder AS Model_Builder;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Model2;

class ProductItem extends Model2
{
    const clone_relations = ['ProductItemImg','ProductItemContent','ProductItemSpec','ProductItemBanner','ProductItemColor'];
    public $export_table_name = '匯出後的檔案名稱';
    // public $table = '產品';
	public $table_map= [
        ['layer'=>0,'table'=>'EXAMPLE(自己MODEL名)','column'=>'資料表上欄位','title'=>'匯出後標頭','rank'=>'排序'],
    ];   
    public $option = [
        ['table'=>'EXAMPLE(自己MODEL名)','name'=>'選項的MODEL','column'=>'資料表上欄位','title'=>'匯出後標頭'],
    ];

    public static $TableName;

    public function __construct()
    {
        $TableName = "product_item";
        self::$TableName = $TableName;
		if(!\Schema::hasTable($TableName)){if(!empty(Config::get('app.dataBasePrefix'))){$TableName = Config::get('app.dataBasePrefix').$TableName;}}
		$this->setTable($TableName);
    }
    public function ProductSubCategory()
    {
        return $this->hasOne('App\Http\Models\Product\ProductSubCategory', 'id', 'parent_id')/*->where('is_visible',1)->orderBy('rank','asc')*/;
    }
    public function ProductItemImg()
    {
        return $this->hasMany('App\Http\Models\Product\ProductItemImg', 'parent_id', 'id')/*->where('is_visible',1)->orderBy('rank','asc')*/;
    }
    public function ProductItemContent()
    {
        return $this->hasMany('App\Http\Models\Product\ProductItemContent', 'parent_id', 'id')/*->where('is_visible',1)->orderBy('rank','asc')*/;
    }
    public function ProductItemSpec()
    {
        return $this->hasMany('App\Http\Models\Product\ProductItemSpec', 'parent_id', 'id')/*->where('is_visible',1)->orderBy('rank','asc')*/;
    }
    public function ProductItemBanner()
    {
        return $this->hasMany('App\Http\Models\Product\ProductItemBanner', 'parent_id', 'id')/*->where('is_visible',1)->orderBy('rank','asc')*/;
    }
    public function ProductItemColor()
    {
        return $this->hasMany('App\Http\Models\Product\ProductItemColor', 'parent_id', 'id')/*->where('is_visible',1)->orderBy('rank','asc')*/;
    }

    public function EXAMPLE()
    {
        return $this->hasMany('App\Http\Models\EXAMPLE\EXAMPLE', 'EXAMPLE_ID', 'id')->where('is_visible',1)->orderBy('rank','asc');
    }
}