<?php 
namespace App\Http\Controllers\Fantasy;

use App\Http\Controllers\Fantasy\MenuController as MenuFunction;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

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

/**相關Models**/
/*Branch*/
use App\Http\Models\Basic\Branch\BranchOrigin;
use App\Http\Models\Basic\Branch\BranchOriginUnit;
/*Cms*/
use App\Http\Models\Basic\Cms\CmsMenu;
use App\Http\Models\Basic\Cms\CmsPermission;
use App\Http\Models\Basic\Cms\CmsRole;
use App\Http\Models\Basic\Cms\CmsChild;
use App\Http\Models\Basic\Cms\CmsParent;
use App\Http\Models\Basic\Cms\CmsChildSon;
use App\Http\Models\Basic\Cms\CmsParentSon;
/*Crs*/
use App\Http\Models\Basic\Crs\CrsPermission;
use App\Http\Models\Basic\Crs\CrsRole;
/*Auth*/
use App\Http\Models\Basic\FantasyUsers;
/*Fms*/
use App\Http\Models\Basic\Fms\FmsZero;
use App\Http\Models\Basic\Fms\FmsFirst;
use App\Http\Models\Basic\Fms\FmsSecond;
use App\Http\Models\Basic\Fms\FmsThird;
use App\Http\Models\Basic\Fms\FmsFile;
/*Option*/
use App\Http\Models\Basic\Option\OptionItem;
use App\Http\Models\Basic\Option\OptionSet;
/*Basic*/
use App\Http\Models\Basic\WebKey;
/*AMS*/
use App\Http\Models\Basic\Ams\AmsRole;

class AmsController extends BackendController 
{
	public static $fileInformationArray = [];
	public static $langArray = [];

	public function __construct()
	{
		parent::__construct();
		// parent::checkRouteLang();
		// parent::checkRouteBranch();
        self::$langArray = Config::get('langs', []);
        
		/*======取得sidebar可用選單======*/
		$amsRole = AmsRole::where('user_id', Session::get('fantasy_user.id'))->first();
		if($amsRole) $amsRole = $amsRole->toArray();
		else $amsRole = ['is_active'=>0];
		/*======取得sidebar可用選單======*/

		/*======檢查是否有Ams及目前功能的使用權限======*/
		$now_route = explode('/', Route::current()->uri);
		$role_col = '';//此功能在basic_ams_role的對應欄位
		switch($now_route[count($now_route)-1])
		{
			default://ajax不檢查
				break;
			case 'Ams':
				$role_col = 'is_active';
				break;
			case 'ams-manager':
				$role_col = 'is_ams';
				break;
			case 'template-manager':
				$role_col = 'is_cover_page';
				break;
			case 'template-setting':
				$role_col = 'is_cms_template';
				break;
			case 'cms-manager':
				$role_col = 'is_cms_template_ma';
				break;
			case 'crs-template':
				$role_col = 'is_cms_template_setting';
				break;
			case 'cms-overview':
				$role_col = 'is_crs_role';
				break;
			case 'crs-overview':
				$role_col = 'is_overview_crs';
				break;
			case 'fantasy-account':
				$role_col = 'is_fantasy';
				break;

		}
		if($role_col!=''&&($amsRole['is_active']!='1'||$amsRole[$role_col]!='1')) return Redirect::to('/Fantasy')->send();
		/*======檢查是否有Ams及目前功能的使用權限======*/
		$configSet = Config::get('cms');

		View::share('unitTitle', 'Ams');
		View::share('unitSubTitle', 'Account Management System');
		self::$fileInformationArray = BaseFunction::getAllFilesArray();
		View::share('fileInformationArray', self::$fileInformationArray);
		View::share('langArray', self::$langArray);
		View::share('amsRoleArray', $amsRole);
		View::share( 'configSet', $configSet);
		View::share('FantasyUser', session('fantasy_user'));
	
	}
	public function index()
	{
		$configSet = Config::get('cms');
		return View::make('Fantasy.ams.index',
		[
				'configSet'=> $configSet,
		]);
		
	}
	public function sidebar()
	{
		return View::make('Fantasy.ams.includes.sidebar',
		[
		]);
		
	}
	public function edit($type,$id)
	{
		if($type == 'ams-manager')
		{
			$data = AmsRole::where('id',$id)->with('UsersData')->first();
			$data = !empty($data) ? $data->toArray() : [];
			$editView = View::make( 'Fantasy.ams.ams_manager.ajax.edit',
		    [
				'data' => $data,
				
		    ])->render();

		    $reback = 
		    [
		    	'content' => $editView
		    ];
		}
		else if($type == 'fantasy-account')
		{
			$data = FantasyUsers::where('id',$id)->first();
			$data = !empty($data) ? $data->toArray() : [];

			$user = session('fantasy_user.id');

			$editView = View::make( 'Fantasy.ams.fantasy_account.ajax.edit',
		    [
				'data' => $data,
				'editPassword' => $user == $id ? true : false
				
				
		    ])->render();

		    $reback = 
		    [
		    	'content' => $editView
		    ];
		}
		else if($type == 'template-manager')
		{
			$data = BranchOrigin::where('id',$id)->first();
			$data = !empty($data) ? $data->toArray() : [];

			$editView = View::make( 'Fantasy.ams.template_manager.ajax.edit',
		    [
		        'data' => $data
		    ])->render();

		    $reback = 
		    [
		    	'content' => $editView
		    ];
		}
		else if($type == 'template-setting')
		{
			$data = BranchOriginUnit::where('id',$id)->first();
			$data = !empty($data) ? $data->toArray() : [];

			$branch_options = [];
			$locale_options = [];
	        foreach (self::$langArray as $key => $value) 
	        {
		          $temp = 
		          [
		            'title' => $value['title'],
		            'key' => $value['abb_en_title']
		          ];
		          $locale_options[ $value['abb_en_title'] ] = $temp;
	        }
	        $branchData = BranchOrigin::where('is_active',1)->get()->toArray();
	        foreach ($branchData as $key => $value) 
	        {
	        	$temp = 
	         	[
	            	'title' => $value['title'],
	            	'key' => $value['id']
	          	];
	          	$branch_options[ $value['id'] ] = $temp;
	        }

	        if(!empty($data))
	        {
	        	$json = json_decode($data['unit_set'],true);
	        }
	        else
	        {
	        	$json = [];
	        }

	        $key_group = WebKey::where('is_setting',1)->get()->toArray();
	        foreach ($key_group as $key => $value) {
	        	$temp_overview = FmsFirst::where('type',3)->where('key_id',$value['id'])->where('is_active',1)->get()->toArray();
	        	$temp_template = CmsMenu::where('use_type',2)->where('key_id',$value['id'])->where('is_active',1)->get()->toArray();
	        	$key_group[$key]['overview_list'] = '';
	        	$key_group[$key]['template_list'] = '';
	        	foreach ($temp_overview as $key2 => $value2) 
	        	{
	        		if($key2 != 0)
	        		{
	        			$key_group[$key]['overview_list'] .= ' / ';
	        		}
	        		$key_group[$key]['overview_list'] .= $value2['title'];
	        	}
	        	foreach ($temp_template as $key2 => $value2) 
	        	{
	        		if($key2 != 0)
	        		{
	        			$key_group[$key]['template_list'] .= ' / ';
	        		}
	        		$key_group[$key]['template_list'] .= $value2['title'];
	        	}
	        }

			$editView = View::make( 'Fantasy.ams.template_setting.ajax.edit',
		    [
		        'data' => $data,
		        'branch_options' => $branch_options,
		        'locale_options' => $locale_options,
		        'json' => $json,
		        'key_group' => $key_group
		    ])->render();

		    $reback = 
		    [
		    	'content' => $editView
		    ];
		}
		else if($type == 'cms-manager')
		{
			$data = CmsRole::with('UsersData')->with('CmsDataAuth')->find($id);
			$data = !empty($data) ? $data->toArray() : [];
			$data['cms_data_auth'] = array_key_exists('cms_data_auth', $data) ? collect($data['cms_data_auth'])->keyBy('menu_id')->all() : []; 
			$branch_unit_options = BranchOriginUnit::where('is_active',1)
						->with(['BranchOrigin'=>function($query){
							$query->select('id', 'title');
						}])
						->get()
						->mapwithkeys(function($item){
							return [ $item['id'] => [
								'title' => $item->BranchOrigin->title.'-'.self::$langArray[$item['locale']]['title'],
								'key' => $item['id']
							  ] 
							];
						})
						->all();
			$jsonSup = empty($data['roles'])?[]:collect(json_decode($data['roles'],true))->mapwithkeys(function($item, $key){ return [ $key => explode(";", $item) ]; })->all();

			$key_group = WebKey::with(['CmsMenu'=>function($query){
				$query->where('use_type',2)->where('is_active',1);
			}])
			->get()
			->mapwithkeys(function($item, $key){
				return [ $key => $item->toarray() ];
			})
			->toarray();
		
			$editView = View::make( 'Fantasy.ams.cms_manager.ajax.edit',
		    [
		        'data' => $data,
		        'branch_unit_options' => $branch_unit_options,
		        'jsonSup' => $jsonSup,
		        'key_group' => $key_group
		    ])->render();

		    $reback = 
		    [
		    	'content' => $editView
		    ];
		}
		else if($type == 'cms-overview')
		{
			$data = CmsRole::where('id',$id)->with('UsersData')->first();
			$data = !empty($data) ? $data->toArray() : [];

			$branch_unit_options = [];
			$tempData = BranchOriginUnit::where('is_active',1)->with('BranchOrigin')->get()->toArray();
			foreach($tempData as $key => $value)
			{
				$temp = 
	         	[
	            	'title' => $value['branch_origin']['title'].'-'.self::$langArray[$value['locale']]['title'],
	            	'key' => $value['id']
	          	];
	          	$branch_unit_options[ $value['id'] ] = $temp;
			}
			$jsonSup = [];
			if(!empty($data))
	        {
	        	$json = json_decode($data['roles'],true);
	        }
	        else
	        {
	        	$json = [];
	        }
	        if(!empty($json))
	        {
	        	foreach($json as $key => $value) 
		        {
		        	$jsonSup[$key] = explode(";", $value);
		        }
	        }
	        $key_group = WebKey::get()->toArray();
	        foreach ($key_group as $key => $value) {
	        	$templateMenu = CmsMenu::where('use_type',1)->where('key_id',$value['id'])->where('is_active',1)->get()->toArray();
	        	$key_group[$key]['templateMenu'] = $templateMenu;
	        }

			$editView = View::make( 'Fantasy.ams.cms_overview.ajax.edit',
		    [
		        'data' => $data,
		        'branch_unit_options' => $branch_unit_options,
		        'json' => $json,
		        'jsonSup' => $jsonSup,
		        'key_group' => $key_group
		    ])->render();

		    $reback = 
		    [
		    	'content' => $editView
		    ];
		}
		else if($type == 'crs-template')
		{
			$data = CrsRole::where('id',$id)->with('UsersData')->first();
			$data = !empty($data) ? $data->toArray() : [];

			$branch_unit_options = [];
			$tempData = BranchOriginUnit::where('is_active',1)->with('BranchOrigin')->get()->toArray();
			foreach($tempData as $key => $value)
			{
				$temp = 
	         	[
	            	'title' => $value['branch_origin']['title'].'-'.self::$langArray[$value['locale']]['title'],
	            	'key' => $value['id']
	          	];
	          	$branch_unit_options[ $value['id'] ] = $temp;
			}
			$jsonSup = [];
			if(!empty($data))
	        {
	        	$json = json_decode($data['roles'],true);
	        }
	        else
	        {
	        	$json = [];
	        }
	        if(!empty($json))
	        {
	        	foreach($json as $key => $value) 
		        {
		        	$jsonSup[$key] = explode(";", $value);
		        }
	        }
	        $key_group = WebKey::get()->toArray();
	        foreach ($key_group as $key => $value) {
	        	$templateMenu = CmsMenu::where('use_type',2)->where('key_id',$value['id'])->where('is_active',1)->get()->toArray();
	        	$key_group[$key]['templateMenu'] = $templateMenu;
	        }

			$editView = View::make( 'Fantasy.ams.crs_template.ajax.edit',
		    [
		        'data' => $data,
		        'branch_unit_options' => $branch_unit_options,
		        'json' => $json,
		        'jsonSup' => $jsonSup,
		        'key_group' => $key_group
		    ])->render();

		    $reback = 
		    [
		    	'content' => $editView
		    ];
		}
		else if($type == 'crs-overview')
		{
			$data = CrsRole::where('id',$id)->with('UsersData')->first();
			$data = !empty($data) ? $data->toArray() : [];

			$branch_unit_options = [];
			$tempData = BranchOriginUnit::where('is_active',1)->with('BranchOrigin')->get()->toArray();
			foreach($tempData as $key => $value)
			{
				$temp = 
	         	[
	            	'title' => $value['branch_origin']['title'].'-'.self::$langArray[$value['locale']]['title'],
	            	'key' => $value['id']
	          	];
	          	$branch_unit_options[ $value['id'] ] = $temp;
			}
			$jsonSup = [];
			if(!empty($data))
	        {
	        	$json = json_decode($data['roles'],true);
	        }
	        else
	        {
	        	$json = [];
	        }
	        if(!empty($json))
	        {
	        	foreach($json as $key => $value) 
		        {
		        	$jsonSup[$key] = explode(";", $value);
		        }
	        }
	        $key_group = WebKey::get()->toArray();
	        foreach ($key_group as $key => $value) {
	        	$templateMenu = CmsMenu::where('use_type',1)->where('key_id',$value['id'])->where('is_active',1)->get()->toArray();
	        	$key_group[$key]['templateMenu'] = $templateMenu;
	        }

			$editView = View::make( 'Fantasy.ams.crs_overview.ajax.edit',
		    [
		        'data' => $data,
		        'branch_unit_options' => $branch_unit_options,
		        'json' => $json,
		        'jsonSup' => $jsonSup,
		        'key_group' => $key_group
		    ])->render();

		    $reback = 
		    [
		    	'content' => $editView
		    ];
		}		
		else if($type == 'fms-folder')
		{
			$data = FmsZero::where('id',$id)->first();
			$data = !empty($data) ? $data->toArray() : [];

			$editView = View::make( 'Fantasy.ams.fms_folder.ajax.edit',
		    [
		        'data' => $data
		    ])->render();

		    $reback = 
		    [
		    	'content' => $editView
		    ];
		}

		return $reback;
	}
	public function member($key_pp)
	{
		$fileInformationArray = self::$fileInformationArray;
		$data = FantasyUsers::where('is_active',1)->select('id','is_active','name','account','mail','photo_image','updated_at','created_at')->get()->toArray();
		foreach($data as $key => $value)
		{
			if(isset($fileInformationArray[$value['photo_image']]) AND !empty($fileInformationArray[$value['photo_image']]))
			{
				$data[$key]['img_route'] = $fileInformationArray[$value['photo_image']]['real_route'];
			}
			else
			{
				$data[$key]['img_route'] = '';
			}
		}
		foreach($data as $key => $value)
		{
			$data[$key]['json_data'] = json_encode($value);
		}
		return View::make('Fantasy.ams.includes.user_list',
		[
			'key_pp' => $key_pp,
			'data' => $data
		]);
	}
}