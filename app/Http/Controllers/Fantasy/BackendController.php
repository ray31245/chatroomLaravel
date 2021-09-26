<?php
namespace App\Http\Controllers\Fantasy;

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

use UnitMaker;
use TableMaker;
use BaseFunction;

abstract class BackendController extends BaseController
{

	// 疑似未使用#HondaDebug
	// public static $ProjectName = '天下第一武道會';

	// 是否有分館。預計以後全部程式直接讀Config的設定，先保留這個參數避免出錯#Honda181003
	public static $setBranchs = '';
	/*語系預設變數*/
	public static $baseLocale = '';
	/*分館預設變數*/
	public static $baseBranchId = '';
	public static $baseBranchLink = '';
	public static $baseBranchTitle = '';

	// Model設定。預計以後將資料庫邏輯另外寫，先保留這個參數避免出錯#Honda181003
	protected static $ModelsArray = [];

	// 語系設定。預計以後全部程式直接讀Config的設定，先保留這個參數避免出錯#Honda181003
	protected static $langArray = [];

	function __construct()
	{

		// 取得是否有分館設定
		self::$setBranchs = Config::get('cms.setBranchs', false);

		// 取得語系設定
		self::$langArray = Config::get('langs', []);

		// 取得Model設定
		self::$ModelsArray = Config::get('models', []);

		// 取得目前querystring
		$parameters = Route::current()->parameters();
		$r = Route::current()->uri();

		/*確認路徑中分館*/
		self::checkRouteBranch($parameters);
		/*語系*/
		self::checkRouteLang($parameters);

		// View直接讀Config的設定#Honda181003
		// View::share('ProjectName', self::$ProjectName);

		// 疑似未使用#HondaDebug
		// View::share('setBranchs', Config::get('cms.setBranchs', false));
	}
	/*補語系*/
	public static function checkRouteLang($parameters)
	{

		$now_locale = array_key_exists('locale', $parameters) ? $parameters['locale'] : '';

		$site_langs = Config::get('langs');

		if (!array_key_exists($now_locale, $site_langs)) $now_locale = Config::get('app.locale');

		App::setLocale($now_locale);
		Config::set('app.dataBasePrefix', '' . $now_locale . '_');

		/*讓View與Controller都有語系變數*/
		self::$baseLocale = $now_locale;
		// View::share('baseLocale', self::$baseLocale);// 疑似未使用#HondaDebug
		/*讓View與Controller都有語系變數 -- END*/
	}
	/*補分館相關資訊*/
	public static function checkRouteBranch($parameters)
	{
		/*抓分館ID與標題*/
		if (isset($parameters['branch']) and !empty($parameters['branch'])) {
			if ($parameters['locale'] != 'branch_default_quill') {
				$getBranchUrlTitle = $parameters['branch'];

				/*分館網址標題轉換特殊字元*/
				$branchUrlTitle = BaseFunction::revertUrlToTitle($getBranchUrlTitle);
				$branchModel = self::$ModelsArray["BranchOrigin"];

				if ($branchUrlTitle == 'overview') {
					/*讓View與Controller都可以使用分館變數*/
					View::share('baseBranchId', 0);
					View::share('baseBranchLink', 'overview');
					View::share('baseBranchTitle', '品牌總覽');
					self::$baseBranchId = 0;
					self::$baseBranchLink = $branchUrlTitle;
					self::$baseBranchTitle = '品牌總覽';
				} else {
					$branch = $branchModel::where('url_title', $branchUrlTitle)->first();
					if (!empty($branch)) {
						/*讓View與Controller都可以使用分館變數*/
						View::share('baseBranchId', $branch->id);
						View::share('baseBranchLink', $branchUrlTitle);
						View::share('baseBranchTitle', $branch->title);
						self::$baseBranchId = $branch->id;
						self::$baseBranchLink = $branchUrlTitle;
						self::$baseBranchTitle = $branch->title;
						/*讓View與Controller都可以使用分館變數 -- END*/
					}
				}
			}
		}
	}
	/*串options以便使用*/
	public static function getOption($set)
	{
		$data = [];

		if ($set == 'menu') {
			/*類型select option*/
			$typeOptions =
				[
					1 => [
						'title' => '第一層(無內容)',
						'key' => '1'
					],
					2 => [
						'title' => '第一層(有內容)',
						'key' => '2'
					],
					3 => [
						'title' => '第二層(有內容)',
						'key' => '3'
					],
					4 => [
						'title' => '第二層(無內容)',
						'key' => '4'
					],
					5 => [
						'title' => '第三層',
						'key' => '5'
					]

				];
			/*資料夾類型*/
			$useOptions =
				[
					1 => [
						'title' => '品牌總覽',
						'key' => '1'
					],
					2 => [
						'title' => '分館',
						'key' => '2'
					]
				];
			$keyOptions = [];
			$menuOptions = [];
			$optionOptions = [];
			/*得網頁key值*/
			$keyData = self::$ModelsArray['WebKey']::get()->toArray();
			/*組 Web Key option*/
			foreach ($keyData as $key => $value) {
				$keyOptions[$value['id']] =
					[
						'title' => $value['title'],
						'key' => $value['id']
					];
			}
			$menuData = self::$ModelsArray['CmsMenu']::get()->toArray();
			/*組爸爸選單*/
			foreach ($menuData as $key => $value) {
				if ($value['type'] == 1) {
					$key_set = $value['id'];
					$menuOptions[$key_set]['title'] = $value['title'];
					$menuOptions[$key_set]['key'] = $value['id'];
				}
			}
			$model_temp = self::$ModelsArray['OptionSet'];
			$optionData = $model_temp::get()->toArray();
			/*組選項選單*/
			foreach ($optionData as $key => $value) {
				$key_set = $value['id'];
				$optionOptions[$key_set]['title'] = $value['title'];
				$optionOptions[$key_set]['key'] = $value['id'];
			}
			$data['typeOptions'] = $typeOptions;
			$data['keyOptions'] = $keyOptions;
			$data['menuOptions'] = $menuOptions;
			$data['optionOptions'] = $optionOptions;
			$data['useOptions'] = $useOptions;
		} else if ($set == 'file') {
			/*資料夾類型*/
			$filesOptions =
				[
					1 => [
						'title' => '共用',
						'key' => '1'
					],
					2 => [
						'title' => '品牌總覽',
						'key' => '2'
					],
					3 => [
						'title' => '分館',
						'key' => '3'
					]
				];
			$keyOptions = [];
			/*得網頁key值*/
			$model_temp = self::$ModelsArray['WebKey'];
			$keyData = $model_temp::get()->toArray();
			/*組 Web Key option*/
			foreach ($keyData as $key => $value) {
				$keyOptions[$value['id']] =
					[
						'title' => $value['title'],
						'key' => $value['id']
					];
			}
			$data['keyOptions'] = $keyOptions;
			$data['filesOptions'] = $filesOptions;
		} else if ($set == 'option') { } else if ($set == 'key') { } else {
			$model_temp = self::$ModelsArray['CmsParent'];
			/*將老爸單元當成選項*/
			$parentData = $model_temp::where('menu_id', $set)->get()->toArray();
			foreach ($parentData as $key => $value) {
				if (empty($value['with_m'])) {
					$model_temp = self::$ModelsArray[$value['parent_model']];

                    // table_name #adam
                    $string_table_name = with(new $model_temp)->getTable();
                    // has column => is_visible #adam
                    $hasVisible = DB::table($string_table_name)->getConnection()
                                                                ->getSchemaBuilder()
                                                                ->hasColumn($string_table_name, 'is_visible');

                    $tempData = $model_temp::where('branch_id', self::$baseBranchId)
                                            // ->when($hasVisible, function ($query){
                                            //     return $query->where('is_visible', 1);
                                            // })
                                            ->get()
                                            ->toArray();
					$tempOptions = [];
					foreach ($tempData as $key2 => $value2) {
						$tempOptions[$value2['id']] =
							[
								'title' => $value2[$value['parent_option']],
								'key' => $value2['id']
							];
					}
				} else {
					$model_temp = self::$ModelsArray[$value['parent_model']];
					$tempData = $model_temp::where('branch_id', self::$baseBranchId)->with($value['with_m'])->get()->toArray();
					$tempOptions = [];
					foreach ($tempData as $key2 => $value2) {
						$tempOptions[$value2['id']] =
							[
								'title' => $value2[$value['with_db']][$value['with_name']] . ' → ' . $value2[$value['parent_option']],
								'key' => $value2['id']
							];
					}
				}
				$data[$value['parent_model']] = $tempOptions;
			}
			/*get這單元用到關聯*/
			$model_temp = self::$ModelsArray['CmsMenu'];
			$menuData = $model_temp::where('id', $set)->first();
			if (isset($menuData->options_group) and !empty($menuData->options_group)) {
				$options = json_decode($menuData->options_group, true);
				foreach ($options as $key => $value) {
					$tempOptions = [];
					$model_temp = self::$ModelsArray['OptionSet'];
					$tempData = $model_temp::where('branch_id', self::$baseBranchId)->where('id', $value)->with('OptionItem')->first();
					if (!empty($tempData)) {
						$tempData = $tempData->toArray();
						foreach ($tempData['option_item'] as $key2 => $value2) {
							$tempOptions[$value2['key_value']] =
								[
									'title' => $value2['title'],
									'key' => $value2['key_value']
								];
						}
						$data[$tempData['key']] = $tempOptions;
					}
				}
			}
		}
		return $data;
	}
	/*得index用資料(頁碼、搜尋條件)*/
	public static function getData($modelName, $has_auth, $page, $search, $group, $table='')
	{
		if ($has_auth == '-1') $has_auth = (Config::get('models.CmsMenu'))::where('model', $modelName)->first()->has_auth;
		$data = self::$ModelsArray[$modelName]::where('branch_id', self::$baseBranchId);
		//dd( $has_auth );
		if (intval($has_auth) != 0) {
			$data->CheckAuth($has_auth,self::$baseBranchId);
		}

		/*===搜尋條件Start====*/
		$search = collect($search)->filter(function ($v, $k) {
			return $k && $v['value'] !== '';
		})->all(); //濾掉沒填值的項目
		
		if (count($search) > 0) {

			/*----------------------把搜尋的function寫成參數----------------------*/
			$query = function ($search_qry) use ($search) {
				$max = count($search);
				$keys = array_keys($search);
				for ($i = 0; $i < $max; $i++) {
					$key = $keys[$i];
					$type = $search[$keys[$i]]['type'];
					$value = $search[$keys[$i]]['value'];
					/*-------------------------搜尋條件-------------------------*/
					switch ($type) {
						case "text":
							$cond1 = 'IFNULL(' . $key . ', \'\') LIKE ?';
							$cond2 = '%' . $value . '%';
							if ($i == 0) $search_qry->whereRaw($cond1, $cond2);
							else $search_qry->whereRaw($cond1, $cond2);
							break;
						case "radio":
							$cond1 = 'IFNULL(' . $key . ', \'0\') = ?';
							$cond2 = $value == 't' ? 1 : 0;
							if ($i == 0) $search_qry->whereRaw($cond1, $cond2);
							else $search_qry->whereRaw($cond1, $cond2);
							break;
						case "datePicker":
							if ($i == 0) $search_qry->whereDate($key, '=', $value);
							else $search_qry->whereDate($key, '=', $value);
							break;
						case "single_select":
							if ($value != -1) {
								$cond = $key . ' = ?';
								if ($i == 0) $search_qry->whereRaw($cond, $value);
								else $search_qry->whereRaw($cond, $value);
							}
							break;
						case "dateRange":
							$date = explode(',', $value);
							if ($value != ',') {
								if ($i == 0) $search_qry->where($key, '>=', $date[0])->where($key, '<', date("Y-m-d", strtotime("+1 day", strtotime($date[1]))));
								else $search_qry->where(function ($query) use ($key, $date) {
									$query->where($key, '>=', $date[0]);
									$query->where($key, '<', date("Y-m-d", strtotime("+1 day", strtotime($date[1]))));
								});
							}

							break;
						default:
							break;
					}
					/*-------------------------搜尋條件-------------------------*/
				}
			};
			/*----------------------把搜尋的function寫成參數----------------------*/

			$data = $data->where($query);
		}
		/*===搜尋條件End====*/

		/*===取得總筆數====*/
		$info['count'] = $data->count();

		/*===取得總頁數====*/
		$info['pn'] = ceil($info['count'] / $group);
		if ($info['pn'] > 0 && $page > $info['pn']) $page = $info['pn'];

		/*===排序====*/
		if (Config::get('cms.CMSSort', false) === true && method_exists($data, 'doCMSSort')) $data->doCMSSort();

		/*===取得資料====*/
		$info['data'] = $data->skip(($page - 1) * $group)->take($group)->get()->toArray();

		return $info;
	}

	/********index用資料(頁碼、搜尋條件)********/
	public static function getDataNew($modelName, $has_auth, $page, $search, $group , $table='')
	{
		if ($has_auth == '-1') 
		$has_auth = (Config::get('models.CmsMenu'))::where('model', $modelName)->first()->has_auth;
        $data = self::$ModelsArray[$modelName]::where('branch_id', self::$baseBranchId);

        if($table!=""){
            $filter = config('models.CmsMenu')::where('id', $table)->first()->filter;
            if (!empty($filter)) {
                foreach (json_decode($filter, true) as $key => $value) {
                    $data->where($key, $value);
                }
            }
        }
        
		if (intval($has_auth) != 0) {
			$data->CheckAuth($has_auth, self::$baseBranchId);
		}

		/*===搜尋條件Start====*/
		$search = collect($search)->filter(function ($v, $k) {
			return $k && $v['value'] !== '';
		})->all(); //濾掉沒填值的項目
		if (count($search) > 0) {	
			$max = count($search);
			$keys = array_keys($search);
			for ($i = 0; $i < $max; $i++) {
				$key = $keys[$i];
				$type = $search[$keys[$i]]['type'];
				$value = $search[$keys[$i]]['value'];
				/*-------------------------搜尋條件-------------------------*/
				switch ($type) {
					case "text":
						if ($i == 0) $data->where($key, 'like', '%' . $value . '%');
						else $data->orwhere($key, 'like', '%' . $value . '%');
						break;
					case "qtext":
						if ($i == 0) $data->where( substr($key,3), 'like', '%' . $value . '%');
						else $data->where(substr($key,3), 'like', '%' . $value . '%');
						break;
					case "radio":
						$cond2 = $value == 't' ? 1 : 0;
						if ($i == 0) $data->where($key, $cond2);
						else $data->orwhere($key, $cond2);
						break;
					case "datePicker":
						if ($i == 0) $data->whereDate($key, '=', $value);
						else $data->orwhereDate($key, '=', $value);
						break;
					case "single_select":
						if ($value != -1) {
							if ($i == 0) $data->where($key, $value);
							else $data->orwhere($key, $value);
						}
						break;
					case "dateRange":
						$date = explode(',', $value);
						if ($value != ',') {
							if ($i == 0) $data->where($key, '>=', $date[0])->where($key, '<=', date("Y-m-d", strtotime("+1 day", strtotime($date[1]))));
							else $data->orwhere(function ($query) use ($key, $date) {
								$query->where($key, '>=', $date[0]);
								$query->where($key, '<=', date("Y-m-d", strtotime("+1 day", strtotime($date[1]))));
							});
						}
						break;
					case "sort":
						$data->orderBy($key, $value);
						break;
					default:
						break;
				}
				/*-------------------------搜尋條件-------------------------*/
			}
		}

		/*===搜尋條件End====*/
		/*===取得總筆數====*/
		$info['count'] = $data->count();

		/*===取得總頁數====*/
		$info['pn'] = ceil($info['count'] / $group);
		if ($info['pn'] > 0 && $page > $info['pn']) $page = $info['pn'];

		/*===排序====*/
		if (Config::get('cms.CMSSort', false) === true) $data->doCMSSort();

		/*===取得資料====*/
		$info['data'] = $data->skip(($page - 1) * $group)->take($group)->get();
		return $info;
	}

	public static function getAssociationData($set, $id)
	{
		$data = [];
		if ($set == 'menu') {
            $data['son']['CmsChild']=[];
            $data['son']['CmsParent']=[];
            if(!empty($id)){
                $data['son']['CmsChild'] = self::$ModelsArray['CmsChild']::where('menu_id', $id)->get()->toArray();
                $data['son']['CmsParent'] = self::$ModelsArray['CmsParent']::where('menu_id', $id)->get()->toArray();
            }

		} else if ($set == 'option') {

			$model_temp = self::$ModelsArray['OptionItem'];
			$data['son']['OptionItem'] = $model_temp::where('option_set_id', $id)->get()->toArray();

		} else if ($set == 'file') { 

		} else if ($set == 'key') { 

		} else {

			$model_temp = self::$ModelsArray['CmsChild'];
			$sonData = $model_temp::where('menu_id', $set)->get()->toArray();
			// $model_temp = self::$ModelsArray['CmsParent'];
			// $parentData = $model_temp::where('menu_id',$set)->get()->toArray();
			/*得子關聯資料*/
			if(!empty($id)){
				foreach ($sonData as $key => $value) {
					$model_temp = self::$ModelsArray[$value['child_model']];
					if ($value['is_rank'] == 1) {
						$data['son'][$value['child_model']] = $model_temp::where($value['child_key'], $id)->orderBy('rank', 'asc')->get()->toArray();
					} else {
						$data['son'][$value['child_model']] = $model_temp::where($value['child_key'], $id)->get()->toArray();
					}
					$model_ass_son = self::$ModelsArray['CmsChildSon'];
					$son_son_Data = $model_ass_son::where('child_id', $value['id'])->get()->toArray();
					foreach ($son_son_Data as $key22 => $value22) {
						$model_son_son = self::$ModelsArray[$value22['model_name']];
						foreach ($data['son'][$value['child_model']] as $key33 => $value33) {
							$data['son'][$value['child_model']][$key33]['son'][$value22['model_name']] = $model_son_son::where($value22['child_key'], $value33['id'])->orderBy('rank', 'asc')->get()->toArray();
						}
					}
				}
			}
		}

		return $data;
	}
	public static function getJsonArray($set)
	{
		$data = [];

		if ($set == 'menu') { } else if ($set == 'option') { } else if ($set == 'file') { } else if ($set == 'key') { } else if ($set == 'option') { } else {

			$menuData = self::$ModelsArray['CmsMenu']::where('id', $set)->first();

			$data = json_decode($menuData->json_group, true);
		}


		return $data;
	}
}
