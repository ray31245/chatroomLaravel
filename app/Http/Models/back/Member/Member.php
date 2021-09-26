<?php

namespace App\Http\Models\Member;

use Config;
use BaseFunction;
use Session;
use Illuminate\Database\Eloquent\Builder AS Model_Builder;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Model2;

class Member extends Model2
{
    const clone_relations = [];
    public $export_table_name = '會員名單';
    // public $table = '產品';
	public $table_map= [
        ['layer'=>0,'table'=>'Member','column'=>'tel','title'=>'電話','rank'=>'0'],
        ['layer'=>0,'table'=>'Member','column'=>'name','title'=>'姓名','rank'=>'1'],
        ['layer'=>0,'table'=>'Member','column'=>'gender','title'=>'性別','rank'=>'2'],
        ['layer'=>0,'table'=>'Member','column'=>'area','title'=>'地區','rank'=>'3'],
        ['layer'=>0,'table'=>'Member','column'=>'address','title'=>'地址','rank'=>'4'],
        ['layer'=>0,'table'=>'Member','column'=>'birthday','title'=>'生日','rank'=>'5'],
        ['layer'=>0,'table'=>'Member','column'=>'email','title'=>'EMAIL','rank'=>'6'],
    ];   
    public $option = [
        ['table'=>'Member','name'=>'FormGender','column'=>'gender','title'=>'title'],
        ['table'=>'Member','name'=>'FormArea','column'=>'area','title'=>'title'],
    ];

    public static $TableName;

    public function __construct()
    {
        $TableName = "member";
        self::$TableName = $TableName;
		// if(!\Schema::hasTable($TableName)){if(!empty(Config::get('app.dataBasePrefix'))){$TableName = Config::get('app.dataBasePrefix').$TableName;}}
		$this->setTable($TableName);
    }

    public function EXAMPLE()
    {
        return $this->hasMany('App\Http\Models\EXAMPLE\EXAMPLE', 'EXAMPLE_ID', 'id')->where('is_visible',1)->orderBy('rank','asc');
    }
}