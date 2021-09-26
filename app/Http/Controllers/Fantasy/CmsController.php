<?php 
namespace App\Http\Controllers\Fantasy;

use App\Http\Controllers\Fantasy\MenuController as MenuFunction;
use App\Http\Controllers\Fantasy\PermissionController as PermissionFunction;
use Illuminate\Http\Request;
use App\Http\Controllers\Fantasy\BasicController as BasicController;

use View;
use Redirect;
use Auth;
use Debugbar;
use Route;
use App;
use Config;
use Session;

use UnitMaker;
use TableMaker;
use BaseFunction;

class CmsController extends BackendController 
{

	public function __construct()
	{
		parent::__construct();
		View::share('unitTitle', 'Cms');
		View::share('unitSubTitle', 'Content Management System');
		View::share('FantasyUser', session('fantasy_user'));
	}
	public function refixBranch()
	{
		$isBranch = Config::get('cms.setBranchs', false);
		/*此專案是否有分館*/
		if($isBranch)
		{
			/*暫時不串權限*/
			$branch = parent::$ModelsArray['BranchOrigin']::all()->first()->toArray();
			$branchWithLocale = parent::$ModelsArray['BranchOriginUnit']::where('origin_id',$branch['id'])->first();

			if(!empty($branchWithLocale))
			{
				$locale = $branchWithLocale->locale;
			}
			else
			{

			}
			return redirect(url('Fantasy/Cms/overview/'.$locale));
		}
		else
		{
			/*暫時不串權限*/
			$branch = parent::$ModelsArray['BranchOrigin']::all()->first()->toArray();
			$branchWithLocale = parent::$ModelsArray['BranchOriginUnit']::where('origin_id',$branch['id'])->first();

			if(!empty($branchWithLocale))
			{
				$locale = $branchWithLocale->locale;
			}
			else
			{

			}

			$branch_link = BaseFunction::processTitleToUrl($branch['url_title']);

			return redirect(url('Fantasy/Cms/'.$branch_link.'/'.$locale));
		}
	}
	public function refixLocale($branch)
	{
		/*暫時不串權限*/
		$branchData = BaseFunction::getBranchByTitle($branch);
		if(empty($branchData))
		{
			return redirect(url('Fantasy/Cms'));
		}

		$branchWithLocale = parent::$ModelsArray['BranchOriginUnit']::where('origin_id',$branchData['id'])->first();

		if(!empty($branchWithLocale))
		{
			$locale = $branchWithLocale->locale;
		}
		else
		{

		}

		return redirect(url('Fantasy/Cms/'.$branch.'/'.$locale));
	}
	public function index($branch, $locale)
	{
		$isBranch = Config::get('cms.setBranchs', false);
		$branchData = BaseFunction::getBranchByTitle($branch);

		if (empty($branchData))
		{
			return redirect(url('Fantasy/Cms'));
		}

		$branchMenuList = MenuFunction::makeCmsBranchMenu($branchData['id'], $locale, $isBranch);
		$cmsMenuList = MenuFunction::makeCmsMenu($branchData['id'], $locale, 0);
		if (isset($cmsMenuList[0])) {
			$firstUrl = BaseFunction::cms_url('/');
			if (isset($cmsMenuList[0]['list']) && !empty($cmsMenuList[0]['list'])) {
				$firstUrl .= "/" . $cmsMenuList[0]['id'] . "/" . $cmsMenuList[0]['list'][array_key_first($cmsMenuList[0]['list'])]['id'];
			} else {
				$firstUrl .= "/" . $cmsMenuList[0]['id'];
			}
			return redirect($firstUrl);
		}

		return View::make(
			'Fantasy.cms.index',
			[
				'branchMenuList' => $branchMenuList,
				'cmsMenuList' => $cmsMenuList
			]
		);
	}
	public function unit($branch,$locale,$firstId,$secondId='',Request $request)
	{
		$isBranch = Config::get('cms.setBranchs', false);
		$branchData = BaseFunction::getBranchByTitle($branch);
		if(empty($branchData))		
		{
			return redirect(url('Fantasy/Cms'));
		}
		
		if(!empty($secondId))
		{
			$cmsMenuList = MenuFunction::makeCmsMenu($branchData['id'],$locale,$secondId);
			$menu_id = $secondId;
			$parentMenu = config('models.CmsMenu')::where('id', $firstId)->first();
		}
		else
		{
			$cmsMenuList = MenuFunction::makeCmsMenu($branchData['id'],$locale,$firstId);
			$menu_id = $firstId;
			$parentMenu = '';
		}

		$roles = PermissionFunction::getCmsAuthority($menu_id);
		$branchMenuList = MenuFunction::makeCmsBranchMenu($branchData['id'],$locale,$isBranch);
		
		$menuData = parent::$ModelsArray['CmsMenu']::where('id',$menu_id)->first();
		
		
		if(empty($menuData))
		{
			return redirect(url('Fantasy/Cms'));
		}
		$page = $request->input('page');
        $search = $request->input('search');

		$page = (!empty($page)) ? $page : 1;
        $search = (!empty($search)) ? $search : [];
		$data = parent::getDataNew($menuData->model, $menuData->has_auth,$page,$search, Config::get('cms.pageSize', 10), $secondId);
		$options = parent::getOption($menu_id);		
		
		return View::make('Fantasy.cms.'.$menuData->view_prefix.'.index',
		[
			'branchMenuList' => $branchMenuList,
			'cmsMenuList' => $cmsMenuList,
			'modelName' => $menuData->model,
			'isEdit' => $roles['edit'],
			'isDelete' => $roles['delete'],
			'isCreate' => $roles['create'],
			'need_Review' => $roles['need_review'],
			'can_Review' => $roles['can_review'],
			'exportName'=>$menuData->model.','.$secondId,
			'options'=>$options,
			'data'=>$data['data'],
            'count'=>$data['count'],
            'pn'=>$data['pn'],
            'viewRoute'=>'Fantasy.cms.'.$menuData->view_prefix,
            'pageKey'=>$menu_id,
            'search'=>$search,
            'page'=>$page,
            'pageTitle'=>$menuData->title,
			'isContent'=>$menuData->is_content,
			'parentMenu'=> $parentMenu,
			'nowBranchData'=> $branchData,
			'nowLocale'=> config('langs')[$locale],
			'hasAuth'=> $menuData->has_auth,
			'pageId' => $secondId
		]);
	}
	public function getBydata($branch,$locale,$type,$model,Request $request){
		//$type=='getdata' 預設
		//$type=='search' 搜尋
		//$type=='reload' 取消搜尋/重新載入
		$branchData = BaseFunction::getBranchByTitle($branch);
		$_model = app(Config::get('models.'.$model));
		$table = $_model::db_lightbox_header['table'];
		$show = $_model::db_lightbox_header['show'];
		$keyword = (!empty($request->input('keyword'))) ? $request->input('keyword'):'';
		$sel_id = (!empty($request->input('sel_id'))) ? $request->input('sel_id'):[];//搜尋前已選項目id
		$image_id = [];
		$sel_data = [];
		$chk_sel = [];
		if(!empty($_model::db_lightbox_header['relation'])){
			$re_title = $_model::db_lightbox_header['relation_title'];
			$re_db = $_model::db_lightbox_header['relation'];
			if($type=='search'){
				
				$detail = $_model::where($show, 'like', '%' . $keyword . '%')->with($re_db);
				$sel_data = $_model::whereIn('id', $sel_id)->with($re_db);
			}else{
				$detail = $_model::with($re_db);
			}		
		}else{
			if($type=='search'){
				$detail = $_model::where($show, 'like', '%' . $keyword . '%');
				$sel_data = $_model::whereIn('id', $sel_id);
			}else{
				$detail = $_model::whereIsVisible('1');
			}
		}
		if (!empty($branchData['id'])) {
			$detail = !empty($detail) ? $detail->where('branch_id', $branchData['id'])->get() : [];
			$sel_data = !empty($sel_data) ? $sel_data->where('branch_id', $branchData['id'])->get() : [];
		} else {
			$detail = !empty($detail) ? $detail->get() : [];
			$sel_data = !empty($sel_data) ? $sel_data->get() : [];
		}
		foreach($detail as $key => $value){
			foreach($table as $key1 => $value1){
				if($value1['type']=='selectMulti' && !empty($value[ $value1['value'] ])){
					$ids = json_decode($value[ $value1['value'] ]);
					$re_value = '';
					$alldata = app(Config::get('models.'.$re_db))::whereIn('id', $ids)->get();
					foreach($alldata as $key2 => $value2){
						$re_value .= ($re_value == '') ? $value2[$re_title] : '、'.$value2[$re_title];
					}
					$detail[ $key ]['re_title'] = $re_value;
				}elseif($value1['type']=='select' && !empty($value[ $re_db ][$re_title])){
					$detail[ $key ]['re_title'] = $value[ $re_db ][$re_title];
				}
			}

			if(!empty($value['image'])){
				array_push($image_id, $value['image']);
			}
			if(!empty($_model::db_lightbox_header['show_rel']) && $_model::db_lightbox_header['show_rel']==1){		
				$detail[ $key ]['show_title'] = $value[ $re_db ][$re_title].' / '.$value[ $show ];
			}else{
				$detail[ $key ]['show_title'] = $value[ $show ];
			}
			//搜尋前已選項目
			$detail[$key]['selected'] = 0;
			foreach($sel_id as $key2 => $value2){
				if($value['id']==$value2){
					$detail[$key]['selected'] = 1;
					array_push($chk_sel, $value['id']);
				}
			}
		}

		//搜尋前已選項目
		foreach($sel_data as $key => $value){
			if(in_array($value['id'],$chk_sel)){
				unset($sel_data[$key]);
			}else{
				if(!empty($_model::db_lightbox_header['show_rel']) && $_model::db_lightbox_header['show_rel']==1){		
					$sel_data[ $key ]['show_title'] = $value[ $re_db ][$re_title].' / '.$value[ $show ];
				}else{
					$sel_data[ $key ]['show_title'] = $value[ $show ];
				}
			}
			
		}
		$imageAry = BaseFunction::getFilesRouteArrayM($image_id);

		if($type=='getdata'){
			return View::make('Fantasy.cms.includes.by_data',
			[
				'detail' => $detail,
				'table' => $table,
				'model' => $model,
				'imageAry' => $imageAry
			]);
		}else{
			return View::make('Fantasy.cms.includes.by_data_search',
			[
				'detail' => $detail,
				'sel_id' => $sel_id,
				'sel_data' => $sel_data,
				'table' => $table,
				'model' => $model,
				'imageAry' => $imageAry
			]);
		}
		
	}
}