<?php

use BaseFunction as Base;
use Illuminate\Support\Facades\Request as Request;
use App\Http\Controllers\Fantasy\BackendController as BackBase;
use Socialite as Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 清理CACAHE用，有需要再打開
Route::get('cleared', 'Fantasy\FantasyController@cleared');

// 驗證碼
Route::get('captcha/{config?}', '\Mews\Captcha\CaptchaController@getCaptcha');
/*後台*/
Route::group(['prefix'=>'/auth'],function(){
	Route::get('/login','Fantasy\AuthController@getLogin');
	Route::post('/login','Fantasy\AuthController@postLogin');
	Route::get('/logout','Fantasy\AuthController@postLogout');
});

Route::group(['prefix'=>'/Fantasy','middleware'=> 'auth'],function(){

	Route::get('/','Fantasy\FantasyController@index');
	Route::get('/test_excel', 'Fantasy\ExcelController@user_list');

	Route::get('/{branch}/{locale}/Excel/{name}', 'Fantasy\ExcelController@export');

	/*Photos管理*/
	Route::group(['prefix' => '/Photos'], function () {
		Route::get('/', 'Fantasy\PhotosController@index');
	});
	/*Photos管理 END*/
	
	/*its管理*/
	Route::group(['prefix'=>'/Its'],function(){
		Route::get('/','Fantasy\ItsController@index');
		Route::get('/key','Fantasy\ItsController@key');
		Route::get('/menu','Fantasy\ItsController@menu');
		Route::get('/file','Fantasy\ItsController@file');
		Route::get('/option','Fantasy\ItsController@option');
	});
	/*its管理 END*/
	
	/*cms管理*/
	Route::group(['prefix'=>'/Cms'],function(){
		
		/*不分分館or品牌總覽基本設定*/
		Route::get('/','Fantasy\CmsController@refixBranch');
		
		/*分館+語系*/
		Route::group(['prefix'=>'/{branch}'],function(){
			Route::get('/','Fantasy\CmsController@refixLocale');
			Route::group(['prefix'=>'/{locale}'],function(){
				Route::get('/','Fantasy\CmsController@index');
				Route::get('/{parentId}/{id?}','Fantasy\CmsController@unit');
			});
		});
	});
	/*cms管理END*/

	/*Fms*/
	Route::group(['prefix'=>'/Fms'],function(){
		Route::get('/','Fantasy\FmsController@index');
	});
	/*Fms End*/

	/*AMS*/
	Route::group(['prefix'=>'/Ams'],function(){
		Route::get('/','Fantasy\AmsController@index');
		Route::get('/sidebar','Fantasy\AmsController@sidebar');//更新Ams選單用
		Route::get('/ams-manager','Fantasy\ams\AmsManagerController@index');
		Route::get('/fantasy-account','Fantasy\ams\FantasyAccountController@index');
		Route::get('/template-manager','Fantasy\ams\TemplateManagerController@index');
		Route::get('/template-setting','Fantasy\ams\TemplateSettingController@index');
		Route::get('/cms-manager','Fantasy\ams\CmsManagerController@index');
		Route::get('/crs-template','Fantasy\ams\CrsTemplateController@index');
		Route::get('/cms-overview','Fantasy\ams\CmsOverviewController@index');
		Route::get('/crs-overview','Fantasy\ams\CrsOverviewController@index');
		Route::get('/fms-folder','Fantasy\ams\FmsManagerController@index');
	});

	Route::group(['prefix'=>'/Ajax'],function(){
		Route::get('/member-list/{key}','Fantasy\AmsController@member');
		Route::get('/ams-information/{type}/{id}','Fantasy\AmsController@edit');
		Route::post('/cms-manager/{branch_unit_id}', 'Fantasy\ams\CmsManagerController@changeBranch');
		Route::group(['prefix'=>'/ams-update'],function(){
			Route::post('/ams-manager','Fantasy\ams\AmsManagerController@update');
			Route::post('/fantasy-account','Fantasy\ams\FantasyAccountController@update');
			Route::post('/template-manager','Fantasy\ams\TemplateManagerController@update');
			Route::post('/template-setting','Fantasy\ams\TemplateSettingController@update');
			Route::post('/cms-manager','Fantasy\ams\CmsManagerController@update');
			Route::post('/crs-template','Fantasy\ams\CrsTemplateController@update');
			Route::post('/cms-overview','Fantasy\ams\CmsOverviewController@update');
			Route::post('/crs-overview','Fantasy\ams\FmsController@update');
			Route::post('/fms-folder','Fantasy\ams\FmsManagerController@update');
		});

		Route::group(['prefix'=>'/ams-delete'],function(){
			Route::get('/ams-manager','Fantasy\ams\AmsManagerController@delete');
			Route::get('/fantasy-account','Fantasy\ams\FantasyAccountController@delete');
			Route::get('/template-manager','Fantasy\ams\TemplateManagerController@delete');
			Route::get('/template-setting','Fantasy\ams\TemplateSettingController@delete');
			Route::get('/cms-manager','Fantasy\ams\CmsManagerController@delete');
			Route::get('/crs-template','Fantasy\ams\CrsTemplateController@delete');
			Route::get('/cms-overview','Fantasy\ams\CmsOverviewController@delete');
			Route::get('/crs-overview','Fantasy\ams\CrsOverviewController@delete');
			Route::get('/fms-folder','Fantasy\ams\FmsManagerController@delete');
		});
		Route::group(['prefix'=>'/index-reset'],function(){
			Route::get('/ams-manager','Fantasy\ams\AmsManagerController@reset');
			Route::get('/fantasy-account','Fantasy\ams\FantasyAccountController@reset');
			Route::get('/template-manager','Fantasy\ams\TemplateManagerController@reset');
			Route::get('/template-setting','Fantasy\ams\TemplateSettingController@reset');
			Route::get('/cms-manager','Fantasy\ams\CmsManagerController@reset');
			Route::get('/crs-template','Fantasy\ams\CrsTemplateController@reset');
			Route::get('/cms-overview','Fantasy\ams\CmsOverviewController@reset');
			Route::get('/crs-overview','Fantasy\ams\CrsOverviewController@reset');
			Route::get('/fms-folder','Fantasy\ams\FmsManagerController@reset');
		});

	});
	/*AMS Fucking End*/
	/*分館+語系*/
	Route::group(['prefix'=>'/{branch}'],function(){
		Route::group(['prefix'=>'/{locale}'],function(){
			/*Ajax*/
			Route::group(['prefix'=>'/Ajax'],function(){
				/*Get*/
				Route::get('/check-auth','Fantasy\AuthController@checkAuth');
				Route::get('/data-info/{model}/{id}','Fantasy\BasicController@getInformation');
				Route::get('/edit-content/{model}/{id}','Fantasy\BasicController@getEditContent');
				Route::get('/add-new/{model}','Fantasy\BasicController@createData');
				Route::get('/delete-array/{model}','Fantasy\BasicController@deleteDataArray');
				Route::get('/clone-array/{model}','Fantasy\BasicController@cloneDataArray');
				Route::get('/radio-switch/{model}/{id}','Fantasy\BasicController@radioSwitch');
				Route::get('/relate-select/{parent_model}/{model}/{id}','Fantasy\BasicController@relateSelect');
				Route::get('/table-reset/{model}/{page}','Fantasy\BasicController@tableReset');
				Route::get('/fms-lbox/{type}/{key}/{id}','Fantasy\FmsController@f_lbox');
				Route::get('/fms-lbox-full/{type}/{key}/{id}', 'Fantasy\FmsController@f_lbox_full');
				Route::get('/file-lbox-table/{list_type}/{first}/{second}/{third}/{type}','Fantasy\FmsController@get_file_folder');
				Route::get('/file-lbox-sidebar/{first}/{second}/{third}','Fantasy\FmsController@get_fms_sidebar');
				Route::get('/file-detail/{file_id}','Fantasy\FmsController@get_file_detail');
				Route::get('/file-edit/{file_id}', 'Fantasy\FmsController@get_file_edit');	
				Route::get('/folder-detail/{folder_type}/{folder_id}','Fantasy\FmsController@get_folder_detail');
				Route::get('/folder-edit/{folder_type}/{folder_id}', 'Fantasy\FmsController@get_folder_edit');
				Route::get('/folder-add/{folder_level}/{folder_id}', 'Fantasy\FmsController@get_folder_add');	
				Route::get('/db-lbox','Fantasy\BasicController@db_lbox');
				Route::get('/by-data/{type}/{model}','Fantasy\CmsController@getBydata');
				/*Post*/
				Route::post('/update','Fantasy\BasicController@updateData');
				Route::post('/post-files-fms','Fantasy\FmsController@postFilesFms');
				Route::post('/fms-file-delete','Fantasy\FmsController@deleteFiles');
				Route::post('/post-new-folder','Fantasy\FmsController@postNewFolder');
				Route::post('/post-name-folder','Fantasy\FmsController@postNameFolder');
				Route::post('/post-delete-folder','Fantasy\FmsController@postDeleteFolder');
				Route::post('/post-delete-files','Fantasy\FmsController@postDeleteFiles');
				Route::post('/post-edit-files', 'Fantasy\FmsController@postEditFiles');
				Route::post('/post-edit-folder', 'Fantasy\FmsController@postEditFolder');
				Route::post( '/post-edit-folder-delete', 'Fantasy\FmsController@postEditDelete');
				Route::post('/post-download-files','Fantasy\FmsController@postDownloadFiles');
				Route::post('/getSontableMultiImage', 'Fantasy\FmsController@getSontableMultiImage');
			});
			/*Ajax End*/
		});
	});

});

/*後台END*/
Route::get('/','Fantasy\BasicController@prefixBranch');
/*有分館的情況下 */
/*品牌總覽 */
// Route::group(['prefix'=>'/{locale}'],function(){
// 	Route::get('/','Front\OverviewController@index');
// });
/*品牌總覽 END */
/*前台*/
Route::pattern('branch', '(preview.changei|changei|www.changei|interviewtest)');
$domain = function () {	//此為無分館要把分館層級移除的方法
	Route::get('/','Fantasy\BasicController@prefixLocale');
	// 測試功能用的路由群組
	Route::group(['prefix'=>'test'],function(){
		Route::get('/Socialiteindex','Front\TestController@Socialiteindex');
		Route::get('{Login}','Front\TestController@Login')->where(['Login','Login'=>'[a-zA-Z0–9]+Login']);
	});
	// 所有第三方登入的入口網址
	Route::get('{Loginact}','Front\loginController@Loginact')->where(['Loginact','Loginact'=>'[a-zA-Z0–9]+Loginact'])->middleware('chklogined');
	// 所有給第三方登入成功後導向回來的接收網址(此網址為向第三方登入系統申請的網址，不可更動)
	Route::get('{loginCallBack}','Front\loginController@loginCallBack')->where(['loginCallBack','loginCallBack'=>'loginBy+[a-zA-Z0–9]+CallBack'])->middleware('chklogined');
	// 列出所有可以第三方登入
	Route::get('loginindex','Front\loginController@loginindex')->name('loginindex')->middleware('chklogined');

	// 聊天室首頁
	Route::get('chatindex','Front\chatController@index');
	// 聊天室
	Route::get('/chatgroom/{roomsn}','Front\chatController@room')->middleware('needtologin');

	Route::group(['prefix'=>'chatgroomact'],function(){
		Route::get('createchatroom','Front\chatController@createchatroom');
	});
	Route::get('wschatcall','Front\chatController@wschatcall');

	// Route::get('websocket',function(){
	// 	return view('Front.test.websocket');
	// });

	Route::group(['prefix'=>'/{locale}'],function()
	{
		Route::get('execbackcodeui','Front\TestController@execbackcodeui');
		Route::match(['post','get'],'execbackcode','Front\TestController@execbackcode');
		// 首頁
		$home = function () {
			Route::get('/', 'Front\HomeController@index')->name('HomeIndex');			
			// Route::get('/', function(){dd('321');});			
		};
		Route::group(['prefix' => '/'], $home);
		// Route::group(['prefix' => '/Home'], $home);
		// Route::group(['prefix' => '/home'], $home);
		
		// 新聞
		$News = function () {
			Route::group(['prefix' => '/Ajax'], function () {
				Route::get('/ChangeCategory', 'Front\NewsController@ChangeCategory');
				Route::get('/LoadMore', 'Front\NewsController@LoadMore');
			});
			Route::get('/{category_url?}', 'Front\NewsController@index');
			Route::get('/{category_url?}/{title?}', 'Front\NewsController@detail');
		};
		Route::group(['prefix' => '/News'], $News);
		// Route::group(['prefix' => '/news'], $News);
		// 聯絡
		$Contact = function () {

			Route::group(['prefix' => '/Ajax'], function () {
				Route::match(['post','get'],'/sendForm', 'Front\ContactController@sendForm');
				Route::get('/successlightbox','Front\ContactController@successlightbox');
			});
			Route::get('/{tab?}', 'Front\ContactController@index');
		};
		Route::group(['prefix' => '/Contact'], $Contact);
		$Service = function () {
			Route::group(['prefix' => '/Ajax'], function () {
				Route::match(['post','get'],'/sendForm', 'Front\ServiceController@sendForm');
				Route::get('/successlightbox','Front\ServiceController@successlightbox');
				Route::get('/descriptionWarrantyNumberlightbox','Front\ServiceController@descriptionWarrantyNumberlightbox');
				Route::get('/memberlightbox','Front\ServiceController@memberlightbox');
			});
			Route::get('/{tab?}', 'Front\ServiceController@index');
		};
		Route::group(['prefix' => '/Service'], $Service);
		$Product = function() {
			Route::group(['prefix' => '/Ajax'],function(){
				Route::get('/changepage','Front\ProductsController@changepage');
				Route::get('/search','Front\ProductsController@search');
			});
			Route::get('/','Front\ProductsController@index');
			Route::match(['post','get'],'/searchresult','Front\ProductsController@searchresult');
			Route::get('/{category}','Front\ProductsController@product_series');
			Route::get('/{category}/{sub_category}','Front\ProductsController@product_list');
			Route::get('/{category}/{sub_category}/{item}','Front\ProductsController@product_detail');
		};
		Route::group(['prefix' => '/Product'],$Product);
		$Member = function()
		{
			Route::group(['prefix' => '/Ajax'],function(){
				Route::post('/signups1','Front\MemberController@signups1');
				Route::match(['get','post'],'/resendVerificationCode','Front\MemberController@resendVerificationCode');
				Route::match(['get','post'],'/chkVerificationCode','Front\MemberController@chkVerificationCode');
				Route::post('/conFirmPassword','Front\MemberController@conFirmPassword');
				Route::match(['get','post'],'/signUpSuccessLightbox','Front\MemberController@signUpSuccessLightbox');
				Route::match(['get','post'],'/forgetstep1next','Front\MemberController@forgetstep1next');
				Route::match(['get','post'],'/forgetSuccessLightbox','Front\MemberController@forgetSuccessLightbox');
				Route::match(['get','post'],'/loginact','Front\MemberController@loginact');
				Route::match(['get','post'],'/logoutact','Front\MemberController@logoutact');
				Route::match(['get','post'],'/profileact','Front\MemberController@profileact');
				Route::match(['get','post'],'/chkpassword','Front\MemberController@chkpassword');
				Route::match(['get','post'],'/changeSuccessLightbox','Front\MemberController@changeSuccessLightbox');
				Route::match(['get','post'],'/suspendedact','Front\MemberController@suspendedact');
				Route::match(['get','post'],'/chkcasesn','Front\MemberController@chkcasesn');
				Route::match(['get','post'],'/registWanaGo','Front\MemberController@registWanaGo');
			});
			Route::get('/','Front\MemberController@index')->middleware('member');
			Route::get('/login','Front\MemberController@login');
			Route::get('/SignUp','Front\MemberController@SignUp');
			Route::group(['prefix' => '/Center', 'middleware' => 'member'],function(){
				Route::get('/','Front\MemberController@Center');
				Route::get('/Profile','Front\MemberController@Profile');
				Route::get('/Account','Front\MemberController@Account');
				Route::get('/Maintenances','Front\MemberController@Maintenances');
			});
		};
		Route::group(['prefix' => '/Member'],$Member);
		$About = function()
		{
			Route::get('/','Front\AboutController@index');
		};
		Route::group(['prefix' => 'About'],$About);
		Route::get('/Privacy', 'Front\PrivacyController@index');
	});
};
Route::domain('{branch}.wdd.idv.tw')->group($domain);
Route::domain('{branch}.test')->group($domain);
Route::domain('{branch}.test.com')->group($domain);
Route::domain('{branch}.com')->group($domain);
/*前台END*/


