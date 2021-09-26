<?php 
namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

use View;
use Redirect;
use Auth;
use Debugbar;
use Route;
use App;
use Config;
use Session;
use DB;
use BaseFunction;

use App\Services\Front\ProductService;

use App\Http\Models\Basic\Branch\BranchOrigin;
use App\Http\Models\Basic\Fms\FmsFile;
use App\Http\Models\Basic\Fms\FmsFirst;
use App\Http\Models\Basic\Fms\FmsSecond;
use App\Http\Models\Basic\Fms\FmsThird;
use App\Http\Models\Basic\LogData;
use App\Http\Models\Set\Seo;
use App\Http\Models\Set\BasicSetting;
use App\Http\Models\Product\ProductTheme;

class ElementFunctions extends BaseController {

	public function __construct()
	{
		parent::__construct();
	}

	/*抓網址分舘(CMS用)*/
	public static function cms_url_branch()
	{
		$parameters = Route::current()->parameters();

		if(isset($parameters['branch']) AND !empty($parameters['branch']))
		{
			$branch = $parameters['branch'];
		}
		else
		{
			$branch = 'branch_default_quill';
		}

		return ($branch);
	}

	/*抓網址語系(CMS用)*/
	public static function cms_url_local()
	{
		$parameters = Route::current()->parameters();

		if(isset($parameters['locale']) AND !empty($parameters['locale']))
		{
			$locale = $parameters['locale'];
		}
		else
		{
			$locale = 'locale_default_quill';
		}

		return ($locale);
	}

	public static function getFilesRouteByID($id = '')
	{
		$data = [];
		$file = FmsFile::where("id", $id)->first();

		if (!empty($file)) {
			$file = $file->toArray();
		}
		if($id == 0){
			$file['real_route']= "http://asianinteriorservices.com/wp-content/uploads/2018/04/noImg.png";
		}
		return $file['real_route'];
	}

	// 匯入資料夾目錄(實驗中)
	public static function inputdirlist()
	{
		$myfile = fopen("upload/list.txt", "r") or die("Unable to open file!");
        // 输出单行符直到 end-of-file
        while(!feof($myfile)) {
        dump( fgets($myfile));
        }
        fclose($myfile);
	}

	public static function chkPageSeo($globalSeo, $page_seo,$node_url=""){
		// $globalSeo['web_title'] = (!empty($page_seo['web_title'])) ? $page_seo['web_title'] : $globalSeo['web_title'];
		$globalSeo['web_title'] = self::queue([$page_seo['web_title'],$page_seo['title'],$page_seo['index_title'],$page_seo['url_title'],$globalSeo['web_title']]);
		$globalSeo['meta_keyword'] = (!empty($page_seo['meta_keyword'])) ? $page_seo['meta_keyword'] : $globalSeo['meta_keyword'];
		$globalSeo['meta_description'] = (!empty($page_seo['meta_description'])) ? $page_seo['meta_description'] : $globalSeo['meta_description'];
		$globalSeo['og_description'] = (!empty($page_seo['og_description'])) ? $page_seo['og_description'] : $globalSeo['og_description'];
		$globalSeo['og_title'] = self::queue([$page_seo['og_title'],$page_seo['web_title'],$page_seo['url_title'],$globalSeo['og_title']]);

		$globalSeo['ga_code'] = !empty($page_seo['ga_code'])?$page_seo['ga_code']:$page_seo['ga_code'];
		$globalSeo['gtm_code'] = !empty($page_seo['gtm_code'])?$page_seo['gtm_code']:$page_seo['gtm_code'];
		$globalSeo['gtag'] = !empty($page_seo['gtag'])?$page_seo['gtag']:$page_seo['gtag'];
		
		$globalSeo['schema_code'] = !empty($page_seo['schema_code'])?$globalSeo['schema_code'].$page_seo['schema_code']:$globalSeo['schema_code'];

		$globalSeo['og_image'] = (!empty($page_seo['og_image']) AND $page_seo['og_image']!=0) ? $page_seo['og_image'] : $globalSeo['og_image'];
		
		// if((!empty($page_seo['og_image']) AND $page_seo['og_image']!=0)){
		// 	$fms_file = FmsFile::find($page_seo['og_image']);
		// 	if($fms_file) $globalSeo['og_image'] = $fms_file->real_route;
		// }
		$BreadcrumbList[] =['id'=>$node_url,'name'=>$globalSeo['web_title']]; 
		// dd($node_url);
		$BreadcrumbList = $globalSeo['BreadcrumbList'];
		if (!empty($node_url)) {
			array_push($BreadcrumbList,['id'=>$node_url,'name'=>$globalSeo['web_title']]); 
		}
		$globalSeo['BreadcrumbList'] = $BreadcrumbList;

		$globalSeo['og_image'] = (!empty($page_seo['og_image']) AND $page_seo['og_image']!=0) ? $page_seo['og_image'] : $globalSeo['og_image'];
		return $globalSeo;
	}

	public static function tracktagrecord($key,$title)
	{
		$results = DB::table(Config::get('app.dataBasePrefix').'track_language')->where('key', $key)->select('key', 'title')->first();
		if(empty($results))
		{
			DB::table(Config::get('app.dataBasePrefix').'track_language')->insert(
				array('key' => $key, 'title' => $title,'language' => Config::get('app.dataBasePrefix'))
			);
		}
	}

	// 陣列中按照排序拋出第一個有值的元素
	public static function queue($arry=[])
	{
		$data = '';
		foreach ($arry as $key => $value) {
			if(!empty($value) && isset($value))
			{
				// dump($value);
				return $value;
			}
		}
		return 'none';
	}
	// 一維陣列collection丟進來做concat  main_arr<---主陣列，add_arr<---要加進去的陣列，img<---要加進去的欄位
	public static function concat_collection($main_arr,$add_arr,$img)
	{
		// 把圖片ID送進圖片陣列
        $main_arr= $main_arr->concat(
            $add_arr->map (
                function($item, $key)use($img){
                    return $item->$img;
                }
            )
		);
		return $main_arr;
	}

	public static function back_btn()
	{
		return @strpos($_SERVER['HTTP_REFERER'],$_SERVER['HTTP_HOST'])?'window.history.back()':'location.href="'.BaseFunction::b_url('/').'"';
	}

	public static function back_btn_uplayer()
	{
		$URI = isset($_SERVER['SCRIPT_URI'])?$_SERVER['SCRIPT_URI']:$_SERVER['REQUEST_URI'];
		$url_arr = explode('/',$URI);
		array_pop($url_arr);
		$url =  implode($url_arr,'/');
		return @strpos($_SERVER['HTTP_REFERER'],$_SERVER['HTTP_HOST'])?
		// 'var a = window.history.back();
		'var a = location.href="'.$url.'";
		if(a==undefined){
			//alert(a);
			//location.href="'.$url.'"
		}':'location.href="'.$url.'"';
	}

	public static function upredirect()
	{
		$url_arr = explode('/',$_SERVER['SCRIPT_URI']);
		array_pop($url_arr);
		$url = implode('/',$url_arr);
		// dd($url);
		// header("Location:".$url);
		return redirect($url);
	}

	public static function is_blank($url)
	{
		return empty($url)||preg_match("/".$_SERVER['HTTP_HOST']."/",$url)||!preg_match("/http:\/\/|https:\/\/|upload\//",$url)?'_self':'_blank';
	}

	public static function chkPageSeo_obj_V($globalSeo, $page_seo){
		// $globalSeo['web_title'] = (!empty($page_seo['web_title'])) ? $page_seo['web_title'] : $globalSeo['web_title'];
		$globalSeo['web_title'] = self::queue([$page_seo['web_title'],$page_seo['title'],$page_seo['url_title'],$globalSeo['web_title']]);
		$globalSeo['meta_keyword'] = (!empty($page_seo['meta_keyword'])) ? $page_seo['meta_keyword'] : $globalSeo['meta_keyword'];
		$globalSeo['meta_description'] = (!empty($page_seo['meta_description'])) ? $page_seo['meta_description'] : $globalSeo['meta_description'];
		$globalSeo['og_description'] = (!empty($page_seo['og_description'])) ? $page_seo['og_description'] : $globalSeo['og_description'];
		$globalSeo['og_title'] = self::queue([$page_seo['og_title'],$page_seo['web_title'],$page_seo['url_title'],$globalSeo['og_title']]);

		$globalSeo['ga_code'] = !empty($page_seo['ga_code'])?$page_seo['ga_code']:$page_seo['ga_code'];
		$globalSeo['gtm_code'] = !empty($page_seo['gtm_code'])?$page_seo['gtm_code']:$page_seo['gtm_code'];
		$globalSeo['gtag'] = !empty($page_seo['gtag'])?$page_seo['gtag']:$page_seo['gtag'];
		
		$globalSeo['schema_code'] = !empty($page_seo['schema_code'])?$globalSeo['schema_code'].$page_seo['schema_code']:$globalSeo['schema_code'];
		
		// if((!empty($page_seo['og_image']) AND $page_seo['og_image']!=0)){
		// 	$fms_file = FmsFile::find($page_seo['og_image']);
		// 	if($fms_file) $globalSeo['og_image'] = $fms_file->real_route;
		// }
		$globalSeo['og_image'] = (!empty($page_seo['og_image']) AND $page_seo['og_image']!=0) ? $page_seo['og_image'] : $globalSeo['og_image'];
		return $globalSeo;
	}

	public static function seeismodifi($data,$colum,$type='textInput'){
		return 'aimsId='.$data->id.' aimsColum='.$colum.' aimstype='.$type;
	}
}
