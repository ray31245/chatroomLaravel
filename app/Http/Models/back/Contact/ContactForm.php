<?php

namespace App\Http\Models\Contact;

use Config;
use BaseFunction;
use Session;
use Illuminate\Database\Eloquent\Builder AS Model_Builder;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Model2;

class ContactForm extends Model2
{
    const clone_relations = [];
    public $export_table_name = '連絡表單';
    // public $table = '產品';
	public $table_map= [
        ['layer'=>0,'table'=>'ContactForm','column'=>'tel','title'=>'電話號碼','rank'=>'0'],
        ['layer'=>0,'table'=>'ContactForm','column'=>'name','title'=>'姓名','rank'=>'1'],
        ['layer'=>0,'table'=>'ContactForm','column'=>'gender','title'=>'性別','rank'=>'2'],
        ['layer'=>0,'table'=>'ContactForm','column'=>'email','title'=>'信箱','rank'=>'3'],
        ['layer'=>0,'table'=>'ContactForm','column'=>'area','title'=>'地區','rank'=>'4'],
        ['layer'=>0,'table'=>'ContactForm','column'=>'address','title'=>'地址','rank'=>'5'],
        ['layer'=>0,'table'=>'ContactForm','column'=>'subject_id','title'=>'詢問事宜','rank'=>'6'],
        ['layer'=>0,'table'=>'ContactForm','column'=>'message','title'=>'內容','rank'=>'7'],
        // ['layer'=>0,'table'=>'ContactForm','column'=>'資料表上欄位','title'=>'匯出後標頭','rank'=>'排序'],
    ];   
    public $option = [
        ['table'=>'ContactForm','name'=>'FormArea','column'=>'area','title'=>'title'],
        ['table'=>'ContactForm','name'=>'ContactFormSubject','column'=>'subject_id','title'=>'title'],
        // ['table'=>'ContactForm','name'=>'選項的MODEL','column'=>'資料表上欄位','title'=>'匯出後標頭'],
    ];

    public static $TableName;

    public function __construct()
    {
        $TableName = "contact_form";
        self::$TableName = $TableName;
		if(!\Schema::hasTable($TableName)){if(!empty(Config::get('app.dataBasePrefix'))){$TableName = Config::get('app.dataBasePrefix').$TableName;}}
		$this->setTable($TableName);
    }

    public function EXAMPLE()
    {
        return $this->hasMany('App\Http\Models\EXAMPLE\EXAMPLE', 'EXAMPLE_ID', 'id')->where('is_visible',1)->orderBy('rank','asc');
    }
}