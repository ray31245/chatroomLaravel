<?php 
namespace App\Http\Controllers\Fantasy\ams;

use App\Http\Controllers\Fantasy\AmsController as AmsPaPa;
use App\Http\Controllers\Fantasy\MenuController as MenuFunction;
use App\Http\Models\Basic\Cms\CmsPermission; 
use Illuminate\Http\Request;

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
use App\Http\Models\Basic\Cms\CmsRole;
use App\Http\Models\Basic\Branch\BranchOriginUnit;
use App\Http\Models\Basic\Cms\CmsDataAuth;

class CmsManagerController extends AmsPaPa 
{
	public static $fileInformationArray = [];

	public function __construct()
	{
		parent::__construct();
		self::$fileInformationArray = BaseFunction::getAllFilesArray();
		View::share('fileInformationArray', self::$fileInformationArray);

		$branch_unit_options = [];
		$tempData = BranchOriginUnit::where('is_active',1)->with('BranchOrigin')->get()->toArray();
		foreach($tempData as $key => $value)
		{
			$temp = 
         	[
            	'title' => $value['branch_origin']['title'].'-'.parent::$langArray[$value['locale']]['title'],
            	'key' => $value['id']
          	];
          	$branch_unit_options[ $value['id'] ] = $temp;
		}

		View::share('branch_unit_options',$branch_unit_options);
	}

	public function index()
	{
		$data = CmsRole::where('type',2)->with('UsersData')->get()->toArray();
		return View::make('Fantasy.ams.cms_manager.index',
		[
			'data' => $data
		]);
	}
	public function update(Request $request)
	{
		$data = $request->input('amsData');
		$json = $request->input('jsonData');
		$temp_json = [];
		foreach($json as $key => $value)
		{
			$temp_json[$key] = '';
			foreach($value as $key2 => $value2)
			{
				$temp_json[$key] .= ';';
				$temp_json[$key] .= $value2;
			}
		}
		if($data['id'] == 0)
		{
			$info = new CmsRole;

			foreach ($data as $key => $value) 
			{
				if($key != 'id')
				{
					$info->$key = $value;
				}
			}
			$info->roles = json_encode($temp_json);
			$info->type = 2;
			$info->save();
			$this->edit_data_auth($info->id, $request->input('authData')['auth_data'], $request->input('_lang'));
			$CmsPermission = CmsPermission::insertGetId(['is_active' => '1', 'cms_role_id' => $info['id'], 'cms_menu_id' => '2', 'is_edit' => '1', 'is_add' => '1', 'is_delete' => '1']);
			
			$reback = 
			[
				'id' => $info->id,
				'result' => true,
				'status' => 'create'
			];
		}
		else
		{
			$info = CmsRole::where('id',$data['id'])->first();
			if(!empty($info))
			{
				foreach ($data as $key => $value) 
				{
					if($key != 'id')
					{
						$info->$key = $value;
					}
				}
				$info->roles = json_encode($temp_json);
				$info->type = 2;
				$info->save();
				$this->edit_data_auth($info->id, $request->input('authData')['auth_data'], $request->input('_lang'));
				$reback = 
				[
					'id' => $data['id'],
					'result' => true,
					'status' => 'update'
				];
			}
			else
			{
				$reback = 
				[
					'result' => false
				];
			}
		}
		return $reback;
	}
	public function delete(Request $request)
	{
		$kill_id = $request->input('id');
		$info = CmsRole::where('id',$kill_id)->first();
		if(!empty($info))
		{
			$info->delete();
		}
	}
	public function reset()
	{
		$data = CmsRole::where('type',2)->with('UsersData')->get()->toArray();
		return View::make('Fantasy.ams.cms_manager.ajax.table',
		[
			'data' => $data
		]);
	}
	protected function edit_data_auth($cms_role_id, $authData, $lang)
	{

		$lang = $lang == '' ? '' : substr($lang, 0, 2);
		if (!empty($authData)) {
			foreach ($authData as $key => $row) {
				$cmscatacuth = CmsDataAuth::where('cms_role_id', $cms_role_id)->where('menu_id', $key)->first();
				if (!$cmscatacuth) {
					$cmscatacuth = new CmsDataAuth();
					$cmscatacuth->cms_role_id = $cms_role_id;
					$cmscatacuth->menu_id = $key;
					$cmscatacuth->data_id = $row == ' ' ? '' : $row;
					$cmscatacuth->lang = $lang;
				} else {
					$cmscatacuth->data_id = $row == ' ' ? '' : $row;
					$cmscatacuth->lang = $lang;
				}
				$cmscatacuth->save();
			}
		}
	}

	public function changeBranch($branch_unit_id, Request $request)
	{

		$branch_unit = BranchOriginUnit::find($branch_unit_id);

		// if (!$branch_unit) return [];

		Config::set('app.dataBasePrefix', $branch_unit->locale . '_');
		$arr_id = explode(',', $request->input('id'));
		$arr_model = explode(',', $request->input('model'));
		$max = count($arr_id);

		$select = [];

		for ($i = 0; $i < $max; $i++) {
			// $html = UnitMaker::selectMulti([
			// 	'sontable' => true,
			// 	'name' => 'authData[auth_data][' . $arr_id[$i] . '] ',
			// 	'options' => (Config::get('models.' . $arr_model[$i]))::get_cms_option(),
			// 	'value' => '',
			// ]);

			//20190530 Jax:發現大Bug，感謝Honda留給我的功課
			$html = '';
			$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
			$charactersLength = strlen($characters);
			$randomKey = '';
			$length = rand(13, 21);
			for ($i2 = 0; $i2 < $length; $i2++) {
				$randomKey .= $characters[rand(0, $charactersLength - 1)];
			}

			$html .= '<li class="inventory row_style">
						<div class="title">
							<p class="subtitle"></p>
						</div>
						<div class="inner">
							<div class="quill_select multi_select">
								<div class="select_object">
									<p class="title" data-key="' . $randomKey . '"></p>
									<span class="arrow pg-arrow_down"></span>
								</div> <input type="hidden" name="authData[auth_data][' . $arr_id[$i] . ']" value="" class="multi_select_' . $randomKey . '">
								<div class="select_wrapper">
									<ul class="select_list multi_sselect_list_' . $randomKey . '" data-key="' . $randomKey . '">';
			foreach ((Config::get('models.' . $arr_model[$i]))::get_cms_option($branch_unit_id) as $key => $row) {
				$html .= '<li class="multi_select_fantasy option " data-id="' . $key . '">
																<p>' . $row['title'] . '</p>
															</li>';
			}

			$html .= '</ul>
								</div>
							</div>
						</div>
					</li>';

			$select[$arr_id[$i]] = $html;
		}

		$result = array([
			'select' => $select,
			'locale' => $branch_unit->locale . '_'
		]);
		return $result;
	}
}