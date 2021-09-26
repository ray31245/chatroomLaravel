<?php
namespace App\Http\Controllers\Front;
/**原生函式**/
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use View;
use Config;
use Route;
use Session;
use Redirect;
use Cookie;
use App;
use DB;

/**相關Controller**/
use BaseFunction;
use ElementFunction;

/**相關Service**/

class FrontBaseController extends Controller{

	protected static $is_pre;
	protected static $subdomain;
	protected static $Seo;
	protected static $WebSet;
	
	public function __construct()
	{
        // 宣告圖片陣列(初始為空陣列)
        $front_image_id = collect();
		$branch = Route::current()->parameter('branch');
		$locale = Route::current()->parameter('locale');
		/*補上資料庫語系前綴*/
		if (isset($locale) and !empty($locale)) {
			Config::set('app.dataBasePrefix', '' . $locale . '_');
			View::share('baseLocale', $locale);
		}
		// 預覽站
		self::$is_pre = ($branch == 'preview.changei') ? 1 : 0;

		// 預覽站非會員登出
		if (!Session::has('fantasy_user') && $branch == 'preview.changei') {
			$redirectUrl = route('HomeIndex', ['branch' => 'changei', 'locale' => $locale]);
			return Redirect::to($redirectUrl)->send();
		}
		// self::$WebSet = config('models.WebsiteSet')::first();
		// View::share('webSet', self::$WebSet);
		// 宣告圖片陣列(初始為空陣列)
		$image_id = collect();
		
// dd($image_id);
			// $all_product_model = config('models.ProductModel')::isVisible(self::$is_pre)
			// ->whereExists(function ($query) {
			// 	$query->select(DB::raw('id'))
			// 		->when(self::$is_pre, function ($query)  {
			// 			return $query->where('is_preview', 1);
			// 		}, function ($query) {
			// 			return $query->where('is_visible', 1);
			// 		})
			// 		->from(Config::get('app.dataBasePrefix').config('models.ProductBrand')::$TableName)
			// 		->whereRaw(Config::get('app.dataBasePrefix').config('models.ProductModel')::$TableName.'.parent_id ='.Config::get('app.dataBasePrefix').config('models.ProductBrand')::$TableName.'.id')
			// 		->take(1)
			// 		;
			// })->doSort()->get();
			// // 把圖片ID送進圖片陣列
			// $image_id = ElementFunction::concat_collection($image_id,$all_product_model,'img');
			// dd($image_id);
        // 圖片陣列撈出來變成真實路徑
        $imageAry = BaseFunction::getFilesRouteArray($image_id);
		$imageAry = array_flip($imageAry);
		
		// view::share('all_product_model',$all_product_model);
		view::share('allImageAry',$imageAry);
		
		// App::setLocale($locale);
		
		// $Seo_Init = config('models.Seo')::where('key','all')->first();
		// $Seo_Init['BreadcrumbList'] = [['id'=>BaseFunction::b_url('/'),'name'=>$Seo_Init['web_title']]];
		// self::$Seo = $Seo_Init;
	}

	public function randomDate($begintime, $endtime = "")
	{
		$begin = strtotime($begintime);
		$end = $endtime == "" ? mktime() : strtotime($endtime);
		$timestamp = rand($begin, $end);
		
		return date("Y-m-d H:i:s", $timestamp);
	}
}