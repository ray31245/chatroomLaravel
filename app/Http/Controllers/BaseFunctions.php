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

use App\Services\Front\ProductService;

use App\Http\Models\Basic\Branch\BranchOrigin;
use App\Http\Models\Basic\Cms\CmsDataAuth;
use App\Http\Models\Basic\Fms\FmsFile;
use App\Http\Models\Basic\Fms\FmsFirst;
use App\Http\Models\Basic\Fms\FmsSecond;
use App\Http\Models\Basic\Fms\FmsThird;
use App\Http\Models\Basic\LogData;
use App\Http\Models\Website\Seo;
use App\Http\Models\Set\BasicSetting;
use App\Http\Models\Product\ProductTheme;

class BaseFunctions extends BaseController {

	public function __construct()
	{
		parent::__construct();
	}

	public static function checkRouteLang()
	{
		$parameters = Route::current()->parameters();
		/*補上資料庫語系前綴*/
		if(isset($parameters['locale']) AND !empty($parameters['locale']))
		{
			Config::set('app.dataBasePrefix',''.$parameters['locale'].'_');
			View::share('baseLocale', $parameters['locale']);
		}
	}

	public static function processTitleToUrl( $title )
	{
		$replace1 = str_replace(' ', '*', $title);
		$replace2 = str_replace('/', '^', $replace1);
		$replace3 = str_replace('.', '`', $replace2);
		$replace4 = str_replace('?', '@', $replace3);

		return rawurlencode($replace4);
	}


	public static function revertUrlToTitle( $url )
	{
		$replace1 = str_replace('*', ' ', $url);
		$replace2 = str_replace('^', '/', $replace1);
		$replace3 = str_replace('`', '.', $replace2);
		$replace4 = str_replace('@', '?', $replace3);

		return $replace4;
	}
	
	/*抓網址有分舘and語系*/
	public static function b_url($url)
	{
		$parameters = Route::current()->parameters();

		if(isset($parameters['locale']) AND !empty($parameters['locale']))
		{
			$locale = $parameters['locale'];
		}
		else
		{
			$locale = '';
		}

		if(isset($parameters['branch']) AND !empty($parameters['branch']))
		{
			$branch = $parameters['branch'];
		}
		else
		{
			$branch = '';
		}

		// $path = ($branch=='' ? '':'/'.$branch).($locale=='' ? '':'/'.$locale).'/'.$url;
		$path = $locale.'/'.$url;	//此為無分館要把分館層級移除的方法

		return url($path);
	}
	public static function p_url($url)
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

		if(isset($parameters['branch']) AND !empty($parameters['branch']))
		{
			$branch = $parameters['branch'];
		}
		else
		{
			$branch = 'branch_default_quill';
		}

		$path = $branch.'/'.$locale.'/'.$url;

		return $path;
	}
	/*抓網址有分舘and語系(後台用)*/
	public static function f_url($url)
	{
		$parameters = Route::current()->parameters();

		if(isset($parameters['locale']) AND !empty($parameters['locale']))
		{
			$locale = $parameters['locale'];
		}
		else
		{
			$locale = 'locale_default';
		}

		if(isset($parameters['branch']) AND !empty($parameters['branch']))
		{
			$branch = $parameters['branch'];
		}
		else
		{
			$branch = 'branch_default';
		}

		$path = '/Fantasy/'.$branch.'/'.$locale.'/'.$url;

		return url($path);
	}
	/*抓網址有分舘and語系(CMS用)*/
	public static function cms_url($url)
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

		if(isset($parameters['branch']) AND !empty($parameters['branch']))
		{
			$branch = $parameters['branch'];
		}
		else
		{
			$branch = 'branch_default_quill';
		}

		$path = '/Fantasy/Cms/'.$branch.'/'.$locale.'/'.$url;

		return url($path);
	}
	/*用標題得分館資料*/
	public static function getBranchByTitle($title)
	{
		$data = BranchOrigin::where('url_title',$title)->first();
		$data = (!empty($data)) ? $data->toArray() : [];
		if($title == 'overview')
		{
			$data['id'] = 0;
			$data['title'] = '品牌總覽';
			$data['url_title'] = 'overview';
		}
		return $data;
	}

	public static function getFilesRouteArray($ids)
	{
		$data = [];
		$file = FmsFile::whereIn('id',$ids)->select('id','real_route')->get()->toArray();
		foreach ($file as $key => $value) 
		{
			$data[ $value['id'] ] = $value['real_route'];
		}
		$data[0] = '';

		return $data;
	}
	//抓縮圖
	public static function getFilesRouteArrayM($ids)
	{
		$data = [];
		$file = FmsFile::whereIn('id',$ids)->select('id','real_m_route')->get()->toArray();
		foreach ($file as $key => $value) 
		{
			$data[ $value['id'] ] = $value['real_m_route'];
		}
		foreach ($ids as $key => $value){
			if(empty($data[ $value ])){
				$data[ $value ] = '';
			}
		}
		$data[0] = '';

		return $data;
	}

	public static function getFilesArray($ids)
	{
		$data = [];
		$file = FmsFile::whereIn('id',$ids)->get()->toArray();
		foreach ($file as $key => $value) 
		{
			$data[ $value['id'] ] = $value;
		}

		return $data;
	}

	public static function getAllFilesArray()
	{
		$data = [];
		$file = FmsFile::get()->toArray();
		foreach ($file as $key => $value) 
		{
			$data[ $value['id'] ] = $value;
		}

		return $data;
	}

	public static function getSeoInKey($key='')
	{
		$globalSeo = Seo::where('key','all')->first();
		$globalSeo = !empty($globalSeo) ? $globalSeo->toArray() : [];

		$unitSeo = $key=='' ? [] : Seo::where('key', $key)->first();
		$unitSeo = !empty($unitSeo) ? $unitSeo->toArray() : [];

		$seo = 
		[
			'web_title' => (!empty($unitSeo['web_title'])) ? $unitSeo['web_title'] : $globalSeo['web_title'],
			'meta_keyword' => (!empty($unitSeo['meta_keyword'])) ? $unitSeo['meta_keyword'] : $globalSeo['meta_keyword'],
			'meta_description' => (!empty($unitSeo['meta_description'])) ? $unitSeo['meta_description'] : $globalSeo['meta_description'],
			'ga_code' => (!empty($unitSeo['ga_code'])) ? $unitSeo['ga_code'] : $globalSeo['ga_code'],
			'gtm_code' => (!empty($unitSeo['gtm_code'])) ? $unitSeo['gtm_code'] : $globalSeo['gtm_code'],
			'og_description' => (!empty($unitSeo['og_description'])) ? $unitSeo['og_description'] : $globalSeo['og_description'],
			'og_image' => (!empty($unitSeo['og_image']) AND $unitSeo['og_image']!=0) ? $unitSeo['og_image'] : $globalSeo['og_image'],
		];
		
		return $seo;
	}

	public static function getV()
	{
		return date('md');
	}

    /*=======複製資料功能=======*/
    public static function cloneData($modelname, $id_array)
    {
        $data = Config::get('models.' . $modelname)::whereIn('id', $id_array)->get();
        foreach ($data as $row) {
            if (isset($row['title'])) {
                $row['title'] = $row['title'] .= ' - 複製';
            }
            // 複製主資料
            $new_row = $row->replicate();
            $new_row->push();
            // 複製關聯資料
            self::cloneDataFn($modelname, $row, $new_row);
        }
    }

	public static function cloneDataFn($modelname, $old_data, $new_data){
					
		// 清空關聯
		$old_data->relations = [];
		
		// 判斷是否有要複製的關聯
		if(!defined(Config::get('models.'.$modelname).'::clone_relations')) return false;

		// 要複製的關聯
		$clone_relations = Config::get('models.'.$modelname)::clone_relations;

		// 複製關聯資料
		foreach($clone_relations as $model){
			
			// 載入關聯資料
			$old_data->load($model);

			// 有關聯資料才複製
			if($old_data->has($model)&&$old_data->$model()->count()>0){
				$relate_data = $old_data->$model()->get();
				$arr_assoc = [];
				foreach($relate_data as $relate_row){
					array_push($arr_assoc, $relate_row->replicate());
				}
				if(count($arr_assoc)>0){
					// 儲存關聯資料
					$new_data->$model()->saveMany($arr_assoc);
					
					// 檢查下一層是否有要複製的關聯
					if(defined(Config::get('models.'.$model).'::clone_relations')){

						// 複製下一層資料
						for($i=0;$i<count($relate_data);$i++){
							self::cloneDataFn($model, $relate_data[$i], $arr_assoc[$i]);
						}
					}
				}
			}
		}
	}
	/*=======複製資料功能=======*/

	public static function writeLogData($type, $data)
	{
		$logData = new LogData();
		$logData->create_time = date('Y-m-d H:i:s');
		$ChangeData = (isset($data['ChangeData'])) ? $data['ChangeData'] : '';
		$classname = (!empty($data['classname'])) ? $data['classname'] : 'CMS';

		if(!empty($ChangeData)){
			switch ($type) {
				case 'insert':
					$logData->table_name = $data['table'];
					$logData->data_id = $data['id'];
					$logData->log_type = $type;
					$logData->ChangeData = $ChangeData;
					$logData->classname = $classname;
					break;
				case 'edit':
					$logData->table_name = $data['table'];
					$logData->data_id = $data['id'];
					$logData->log_type = $type;
					$logData->ChangeData = $ChangeData;
					$logData->classname = $classname;
					break;
				case 'login':
					$logData->log_type = 'login';
					$logData->classname = 'Login';
					break;
				case 'del':
					$logData->table_name = $data['table'];
					$logData->data_id = $data['id'];
					$logData->log_type = 'del';
					$logData->ChangeData = $ChangeData;
					$logData->classname = $classname;
					break;
				default:
					$logData->log_type = 'NONE';
					break;
			}

			$logData->user_id = Session::get('fantasy_user.id');
			$logData->save();
		}else{
			if($type == 'login'){
				$logData->log_type = 'login';
				$logData->classname = 'Login';
				$logData->user_id = Session::get('fantasy_user.id');
				$logData->save();
			}
		}
		
	}

	public static function get_file_path($File){
        $file_path = '共用目錄 / ';
        if($File['first_id']!=0){
        	$folder = FmsFirst::where('id', $File['first_id'])->first();
        	$file_path .= $folder['title'];
        }elseif($File['second_id']!=0){
        	$folder = FmsSecond::where('id', $File['second_id'])
        				->with('FmsFirst')
        				->first();
        	$file_path .= $folder['FmsFirst']['title'].' / '.$folder['title'];
        }elseif($File['third_id']!=0){
        	$folder = FmsThird::where('id', $File['third_id'])
        				->with('FmsSecond')
        				->first();
        	$f_folder = FmsFirst::where('id', $folder['FmsSecond']['first_id'])->first();

        	$file_path .= $f_folder['title'].' / '.$folder['FmsSecond']['title'].' / '.$folder['title'];

        }

        return $file_path;
	}

	public static function cvt_file_size($file_size){
		if($file_size > 1048576){
            $new_size = round($file_size/1048576, 2).' MB';
        }
        else{
            $new_size = round($file_size/1024, 2).' KB';
        }

        return $new_size;
	}

	public static function get_auth_id($menu_id,$branch_id)
	{
	
		$data_id = CmsDataAuth::where('menu_id', $menu_id)->where('lang', substr(Config::get('app.dataBasePrefix'), 0, 2))->whereHas('CmsRole', function ($query) use( $branch_id) {
			$query->where('user_id', Session::get('fantasy_user.id'))	
			->whereHas('BranchOriginUnit', function ($query1) use ($branch_id) {
				$query1->where('origin_id', $branch_id);
			});
		});
		if ($data_id->count() > 0 && $data_id->first()->data_id != '')  return json_decode($data_id->first()->data_id);
		else return [];
	}

	public static function get_folder_level($zero, $first, $second, $third)
	{
		if($third!=0){
			$f3 = Config::get('models.FmsThird')::where('id', $third)->first();
			$f2 = Config::get('models.FmsSecond')::where('id', $f3['second_id'])->first();
			$f1 = Config::get('models.FmsFirst')::where('id', $f2['first_id'])->first();
			$f0 = Config::get('models.FmsZero')::where('id', $f1['zero_id'])->first();
		}elseif($second!=0){
			$f3 = ['id'=>0];
			$f2 = Config::get('models.FmsSecond')::where('id', $second)->first();
			$f1 = Config::get('models.FmsFirst')::where('id', $f2['first_id'])->first();
			$f0 = Config::get('models.FmsZero')::where('id', $f1['zero_id'])->first();
		}elseif($first!=0){
			$f3 = ['id'=>0];
			$f2 = ['id'=>0];
			$f1 = Config::get('models.FmsFirst')::where('id', $first)->first();
			$f0 = Config::get('models.FmsZero')::where('id', $f1['zero_id'])->first();
		}else{
			return [
				$zero, $first, $second, $third
			];
		}

		return [
			$f0['id'], $f1['id'], $f2['id'], $f3['id']
		];
	}

    public static function RealFiles($id = '' , $default = true)
    {
        $file = FmsFile::where("id", $id)->first();

        if (!empty($file)) {
            return $file['real_route'];
        } else {
            if($default){
                return "/noimage.svg";
            }else{
                return "";
            }
        }
    }

	public static function C_Format($num)
	{		
		if ($num > 1000) {
			$a = round($num);
			$a_number_format = number_format($a);
			$a_array = explode(',', $a_number_format);
			$a_parts = array('k', 'm', 'b', 't');
			$a_count_parts = count($a_array) - 1;
			$a_display = $a;
			$a_display = $a_array[0] . ((int) $a_array[1][0] !== 0 ? '.' . $a_array[1][0] : '');
			$a_display .= $a_parts[$a_count_parts - 1];
			
			return $a_display;
		}

		return $num;
	}
}
