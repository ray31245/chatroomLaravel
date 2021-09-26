<?php 
namespace App\Http\Controllers\Fantasy;

use Illuminate\Http\Request;

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

class BasicController extends BackendController 
{

	public function __construct()
	{
		parent::__construct();
    }
    
	/*根據model name 跟 id 得該筆資料*/
	public function getInformation($branch,$locale,$model,$id)
	{
		$data = Config::get('models')[$model]::find($id);

		if(!isset($data->title)){
			$data->title = '';
		}

		$message['info'] = $data;

		return $data;
    }
    
	/*得編輯區塊*/
	public function getEditContent($branch,$locale,$model,$id,Request $request)
	{
		if ($id == 'only') {
			$data = parent::$ModelsArray[$model]::first();
		} else {
			$data = parent::$ModelsArray[$model]::where('id', $id)->first();
			$data = (!empty($data)) ? $data->toArray() : [];
		}

		$formKey = $request->input('form');
		$route = $request->input('route');
		$page = $request->input('page');
		$need_review = $request->input('need_review');
		$can_review = $request->input('can_review');
		if ($id == 'only') {
			$associationData = parent::getAssociationData($page, $data['id']);
		} else {
			$associationData = parent::getAssociationData($page, $id ? $id : $data);
		}

		$josnArray = parent::getJsonArray($page);
		if(!empty($josnArray))
		{
			foreach ($josnArray as $key => $value) 
			{
				$data['json'][$value] = json_decode($data[$value], true);
			}
		}

		$options = parent::getOption($page);

	    $message['view'] = View::make( $route.'.edit',
	    [
	      "formKey" => $formKey,
	      "data" => $data,
	      "model" => $model,
	      "options" => $options,
	      "associationData" => $associationData,
	      "need_review" => $need_review,
	      "can_review" => $can_review,
        ])->render();
        
	    return $message;
	}
	/*update*/
	public function updateData($branch,$locale,Request $request)
	{
		$all = $request->all();
		$modelName = $all['modelName'];
		$id = $all['dataId'];
		/*是否有自己的資料要updated*/
		if(isset($all[$modelName]))
		{
			$data = $all[$modelName];

			$information = parent::$ModelsArray[$modelName]::where('id',$id)->first();
			foreach($data as $key => $value)
			{
				if(is_array($value)){
					$value = json_encode($value, JSON_UNESCAPED_UNICODE);
				}
				$information->$key = $value;
			}
			$information->save();
		}
        /*確認關聯資料*/
		$message['change_id'] = self::checkAssociationData($branch,$locale,$all,$all['page'],$id);


		$message['result'] = true;

		return $message;
	}
	/*確認與整理關聯資料*/
	public static function checkAssociationData($branch,$locale,$data,$page,$id)
	{
		$newDataArray = [];
		$type = gettype($page);
		if($page == 'menu')
		{
			if(isset($data['CmsChild']))
			{
				$name_array = [];
				foreach ($data['CmsChild'] as $key => $value) 
				{
					array_push($name_array, $key);
				}

				foreach ($data['CmsChild']['id'] as $key => $value) 
				{
					if(empty($value))
					{
						$tempData = new parent::$ModelsArray['CmsChild'];
					}
					else
					{
						$tempData = parent::$ModelsArray['CmsChild']::where('id',$value)->first();
					}
					// dd($name_array);
					foreach($name_array as $key2 => $value2)
					{
						if($value2 != 'id' && $value2 != 'quillFantasyKey')
						{
							$tempData->$value2 = $data['CmsChild'][$value2][$key];
						}
					}
					$tempData->menu_id = $id;
					//$tempData->updated_at = date();
					$tempData->save();

					if(empty($value))
					{
						$temp['key'] = $data['CmsChild']['quillFantasyKey'][$key];
						$temp['id'] = $tempData->id;
						array_push($newDataArray, $temp);
					}
				}
			}

			if(isset($data['CmsParent']))
			{
				$name_array = [];
				foreach ($data['CmsParent'] as $key => $value) 
				{
					array_push($name_array, $key);
				}

				foreach ($data['CmsParent']['id'] as $key => $value) 
				{
					if(empty($value))
					{
						$tempData = new parent::$ModelsArray['CmsParent'];
					}
					else
					{
						$tempData = parent::$ModelsArray['CmsParent']::where('id',$value)->first();
					}
					// dd($name_array);
					foreach($name_array as $key2 => $value2)
					{
						if($value2 != 'id' && $value2 != 'quillFantasyKey')
						{
							try {
								$tempData->$value2 = $data['CmsParent'][$value2][$key];
							} catch (\Throwable $th) {
								dd($data['CmsParent'],$value2,[$key],'188');
							}
						}
					}
					$tempData->menu_id = $id;
					//$tempData->updated_at = date();
					$tempData->save();

					if(empty($value))
					{
						$temp['key'] = $data['CmsParent']['quillFantasyKey'][$key];
						$temp['id'] = $tempData->id;
						array_push($newDataArray, $temp);
					}
				}
			}
		}
		else if($page == 'option')
		{
			if(isset($data['OptionItem']))
			{
				$name_array = [];

				foreach ($data['OptionItem'] as $key => $value) 
				{
					array_push($name_array, $key);
				}

				foreach ($data['OptionItem']['id'] as $key => $value) 
				{
					if(empty($value))
					{
						$tempData = new parent::$ModelsArray['OptionItem'];
					}
					else
					{
						$model_temp = parent::$ModelsArray['OptionItem'];
						$tempData = $model_temp::where('id',$value)->first();
					}
					// dd($name_array);
					foreach($name_array as $key2 => $value2)
					{
						if($value2 != 'id' && $value2 != 'quillFantasyKey')
						{
							$tempData->$value2 = $data['OptionItem'][$value2][$key];
						}
					}
					$tempData->option_set_id = $id;
					//$tempData->updated_at = date();
					$tempData->save();

					if(empty($value))
					{
						$temp['key'] = $data['OptionItem']['quillFantasyKey'][$key];
						$temp['id'] = $tempData->id;
						array_push($newDataArray, $temp);
					}
				}
			}
		}
		else if($page == 'key')
		{
		}
		else if($page == 'file')
		{
		}
		else
		{
			$model_temp = parent::$ModelsArray['CmsChild'];
			$sonData = $model_temp::where('menu_id',$page)->get()->toArray();
			$tempSon = [];
			foreach($sonData as $key => $row)
			{
				if(isset($data[$row['child_model']]))
				{
					$name_array = [];


					foreach ($data[$row['child_model']] as $key => $value) 
					{
						array_push($name_array, $key);						
					}
					
					
					foreach ($data[$row['child_model']]['id'] as $key => $value) 
					{
						if(empty($value))
						{
							$tempData = new parent::$ModelsArray[$row['child_model']];
						}
						else
						{
							$model_temp = parent::$ModelsArray[$row['child_model']];
							$tempData = $model_temp::where('id',$value)->first();
                        }

						foreach($name_array as $key2 => $value2)
						{
							if($value2 != 'id' && $value2 != 'quillFantasyKey')
							{
								$tempData->$value2 = $data[$row['child_model']][$value2][$key];
							}
						}
						$child_key = $row['child_key'];
						$tempData->$child_key = $id;
						$tempData->branch_id = parent::$baseBranchId;
						//$tempData->updated_at = date();
						$tempData->save();

						if(empty($value))
						{
							$temp['key'] = $data[$row['child_model']]['quillFantasyKey'][$key];
							$temp['id'] = $tempData->id;
							array_push($newDataArray, $temp);
							$newDataArray[$key]['son'] = [];
						}
						else
						{
							$temp['key'] = $data[$row['child_model']]['quillFantasyKey'][$key];
							$temp['id'] = $data[$row['child_model']]['id'][$key];
							array_push($newDataArray, $temp);
							$newDataArray[$key]['son'] = [];
						}
					}
				}
			}
			foreach($sonData as $key => $row)
			{
				if(isset($data[$row['child_model']]))
				{
					$model_ass_son = parent::$ModelsArray['CmsChildSon'];
					$son_son_Data = $model_ass_son::where('child_id',$row['id'])->get()->toArray();
					foreach($son_son_Data as $key22 => $row22)
					{

						if(isset($data[$row22['model_name']]))
						{
							$name22_array = [];
							// dd($data);
							foreach ($data[$row22['model_name']] as $key33 => $value33) 
							{
								array_push($name22_array, $key33);
							}
							foreach ($data[$row22['model_name']]['id'] as $key33 => $value33) 
							{
								if($value33 == 0)
								{
									$tempData22 = new parent::$ModelsArray[$row22['model_name']];
								}
								else
								{
									$model22_temp = parent::$ModelsArray[$row22['model_name']];
									$tempData22 = $model22_temp::where('id',$value33)->first();
								}

								foreach ($name22_array as $key77 => $value77) 
								{
									if($value77 != 'id' && $value77 != 'quillSonFantasyKey')
									{
										$tempData22->$value77 = $data[$row22['model_name']][$value77][$key33];
									}
								}

								foreach($newDataArray as $key_88 => $value_88)
								{
									$temp_22_id = $row22['child_key'];
									if($data[$row22['model_name']]['quillSonFantasyKey'][$key33] == $value_88['key'])
									{
										$tempData22->$temp_22_id = $value_88['id'];
									}
								}
								$tempData22->branch_id = parent::$baseBranchId;

								$tempData22->save();

								if($value33 == 0){
									$tempSon[$data[$row22['model_name']]['quillSonFantasyKey'][$key33]][] = $tempData22->id;
								}else{
									$tempSon[$data[$row22['model_name']]['quillSonFantasyKey'][$key33]][] = $data[$row22['model_name']]['id'][$key33];																			
								}
							}
						}
					}
				}
				foreach ($tempSon as $son_key => $son_value) {
					foreach ($newDataArray as $par_key => $par_value) {
						if($son_key==$par_value['key']){
							$newDataArray[$par_key]['son'] = $son_value;
						}
					}
				}
			}
			// dd($newDataArray);
		}
		return $newDataArray;
	}
	/*Create*/
	public function createData($branch,$locale,$modelName)
	{
		$modelData = new parent::$ModelsArray[$modelName];

		if( $modelData->save() )
        {
        	$message['id'] = $modelData->id;

        	return $message;
        }
        else
        {

        }
	}
	/*Delete Data Group*/
	public function deleteDataArray($branch,$locale,$modelName,Request $request)
	{
		$id_array = $request->input('ids');
		if(!empty($id_array))
		{
			foreach ($id_array as $key => $value) 
			{
				$data = parent::$ModelsArray[$modelName]::where('id',$value)->first();
				if(!empty($data))
				{
					$data->delete();
				}
			}
		}
		$message['result'] = true;

		return $message;
	}
	/*Clone Data Group*/
	public function cloneDataArray($branch,$locale,$modelName,Request $request)
	{
		$id_array = $request->input('clone_id');
		if(count($id_array)>0)
		{
			BaseFunction::cloneData($modelName, $id_array);
		}
		$message['result'] = true;

		return $message;
	}
	/*關聯式下拉選單*/
	public function relateSelect($branch,$locale,$parent_model,$model,$id,Request $request)
	{
		$option_text = $request->input('option_text');
		$_model = app(Config::get('models.'.$model));
		return $_model::select('id', DB::Raw($option_text.' AS option_text'))->where($_model::parent_key[$parent_model], $id)->get()->toArray();
	}
	/*狀態列ajax更改*/
	public function radioSwitch($branch,$locale,$model,$id,Request $request)
	{
		
		$member = Session::get('fantasy_user');
		$branch_id = app(Config::get('models.' . 'BranchOrigin'))::where('url_title', $branch)->select('id')->first()->id;
		$cms_id = app(Config::get('models.' . 'CmsMenu'))::where('model', $model)->select('id')->first()->id;
		$user_Permission = Config('models.CmsRole')::where('user_id', $member['id'])->where('branch_id', $branch_id)->first()->roles;

		$has_Permission = explode(";", json_decode($user_Permission, true)[$cms_id])['3'];

		if (empty($has_Permission)) {
			$message['result'] = false;
			$message['error_msg'] = '您無權限編輯';

			return $message;
		}
		$column = $request->input('column');
		$item = $request->input('item');

		$data = parent::$ModelsArray[$model]::where('id', $id)->first();

		$data->$column = $item;

		if ($data->save()) {
			$message['result'] = true;

			return $message;
		}
	}
	/*Table Reset*/
	public function tableReset($branch,$locale,$model,$page,Request $request)
	{
		$isEdit = $request->input('_table_edit');
		$isDelete = $request->input('_table_delete');
		$isCreate = $request->input('_table_create');
		$search = $request->input('_table_search');
		$key = $request->input('_table_key');
		$menu = parent::$ModelsArray['CmsMenu']::where('model', $model)->first();
		$route = $request->input('_table_route');
		$search = (!empty($search)) ? json_decode($search, true) : [];
		$hasAuth = $request->input('_table_auth');
		$pageTitle = $request->input('_table_pagetitle');

		if($model == 'CmsMenu'){
			$data = parent::getDataNew($model, 0 ,$page,$search, 1000, $key);
		}else{
			$data = parent::getDataNew($model, $menu->has_auth, $page, $search, Config::get('cms.pageSize', 10), $key);
		}

        $options = parent::getOption($key);
        /*組Table頁面*/
        $content['view'] = View::make( $route.'.table',
        [
			'modelName' => $model,
			'isEdit' => $isEdit,
			'isDelete' => $isDelete,
			'isCreate' => $isCreate,
			'exportName'=>$model.','.$key,
			'options'=>$options,
			'data'=>$data['data'],
            'count'=>$data['count'],
            'pn'=>$data['pn'],
            'search'=>$search,
			'page'=>$page,
			'hasAuth'=>$hasAuth,
			'pageTitle'=>$pageTitle,
			'pageId' => $key
        ])->render();

        $content['count'] = $data['count'];

        return $content;
	}
	/*後台----------End*/
	/*前台路徑無語系無分舘*/
	public function prefixBranch()
	{
		$isBranch = Config::get('cms.setBranchs', false);

		if($isBranch)
		{
			return redirect( url( App::getLocale() ) );
		}
		else
		{
			$firstBranch = parent::$ModelsArray['BranchOrigin']::where('is_active',1)->first();
			$branch_link = BaseFunction::processTitleToUrl($firstBranch->url_title);

			// return redirect( url( $branch_link.'/'.App::getLocale() ) );
			return redirect( url( App::getLocale() ) );	//此為無分館要把分館層級移除的方法
		}
	}
	/*前台路徑無語系*/
	public function prefixLocale($branch)
	{
		$branch_title = BaseFunction::revertUrlToTitle($branch);
		$thisBranch = parent::$ModelsArray['BranchOrigin']::where('url_title',$branch_title)->first();
		if(!empty($thisBranch))
		{
			$thisId = $thisBranch->id;
			$model_temp = parent::$ModelsArray['BranchOriginUnit'];
			$firstBranchLocale = $model_temp::where('origin_id',$thisId)->first();
			if(empty($firstBranchLocale))
			{
				return redirect( url('/') );
			}
			else
			{
				// return redirect( url( $branch.'/'.$firstBranchLocale->locale ) );
				return redirect( url( $firstBranchLocale->locale ) );	//此為無分館要把分館層級移除的方法
			}
		}
		else
		{
			return redirect( url('/') );
		}
	}

	public function db_lbox()
	{
		$isBranch = parent::$setBranchs;

		return View::make('Fantasy.load.db_lbox',
		[
		]);
		
	}
}