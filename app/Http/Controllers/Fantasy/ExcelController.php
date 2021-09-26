<?php
namespace App\Http\Controllers\Fantasy;
/**原生函式**/

use Illuminate\Http\Request;
use View;
use Session;
use Mail;
use Config;
use Lang;

use Cache;

use App\Export\ContactExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Export\LostExport;

use App\Imports\UsersImport;

use GuzzleHttp\Client;
use Post;
use Auth;

use ItemMaker;

use BaseFunction;

/**相關Controller**/

use App\Http\Controllers\Fantasy\BackendController;

class ExcelController extends BackendController
{
	
	protected static $columns;   
	protected static $options;   
	protected static $relation_option_arr;   
    public function __construct()
    {
        parent::__construct();
    }

    public function export($branch, $locale, $name, Request $request)
    {
        // if($name== 'contact'){
        //     $data = $request->all();
        //     return (new ContactExport($branch, $data))->download('聯絡表單_' . date('Ymd') .'.xls');
        // }      
		$search = json_decode($request->search, true);
		$PathName = explode(",", \Request::route()->parameters['name']);
        $model = $PathName[0];
        $menu_id = $PathName[1];
        
        $data = Config::get('models.'.$model)::where('id','>=',0);
        $CustomWhere = (defined(parent::$ModelsArray[$model].'::CustomWhere')) ? parent::$ModelsArray[$model]::CustomWhere : "";
		if($CustomWhere != ""){
			foreach($CustomWhere as $val){
				//如果有設定
				if($menu_id == $val['menu_id']){
					foreach($val['Where'] as $WhereVal){
						if($WhereVal['type'] == "and"){
							$data = $data->where($WhereVal['name'],$WhereVal['judge'],$WhereVal['value']);
						}
						if($WhereVal['type'] == "or"){
							$data = $data->orWhere($WhereVal['name'],$WhereVal['judge'],$WhereVal['value']);
						}
						//閉包
						if($WhereVal['type'] == "function"){
							$query = function ($search_qry) use ($WhereVal) {
								foreach($WhereVal['Search'] as $key=>$valSub){
									if($valSub['type'] == "and"){
										$search_qry->where($valSub['name'],$valSub['judge'],$valSub['value']);
									}
									if($valSub['type'] == "or"){
										$search_qry->orWhere($valSub['name'],$valSub['judge'],$valSub['value']);
									}
								}
							};
							$data = $data->where($query);
						}
					}
				}
			}
        }
        if(!empty($search)){
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
							else $search_qry->orwhereRaw($cond1, $cond2);
							break;
						case "radio":
							$cond1 = 'IFNULL(' . $key . ', \'0\') = ?';
							$cond2 = $value == 't' ? 1 : 0;
							if ($i == 0) $search_qry->whereRaw($cond1, $cond2);
							else $search_qry->orwhereRaw($cond1, $cond2);
							break;
						case "datePicker":
							if ($i == 0) $search_qry->whereDate($key, '=', $value);
							else $search_qry->orwhereDate($key, '=', $value);
							break;
						case "single_select":
							$cond = $key . ' = ?';
							if ($i == 0) $search_qry->whereRaw($cond, $value);
							else $search_qry->orwhereRaw($cond, $value);
							break;
						case "dateRange":
							$date = explode(',', $value);
							if ($i == 0) $search_qry->where($key, '>=', $date[0])->where($key, '<=', $date[1]);
							else $search_qry->orwhere(function($query) use ($key, $date) {
									$query->where($key, '>=', $date[0]);
									$query->where($key, '<=', $date[1]);
								});
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
        $data = $data->get();
        $dbpath = Config::get('models.'.$model);
        $db = new $dbpath;
		$relate_arr = $db->relate_model;
		$CoverData = $TableData = [];
		
        $tableName = isset($db->export_table_name)?$db->export_table_name:'';
		
		self::$columns = collect($db->table_map);
		self::$options = collect([]);
		$option_arr = collect($db->option?:[]);
		foreach ($option_arr as $key => $option) {
			$column = $option['column'];
			$option_ids = array_unique(
				$data->reduce(function($preitem,$item)use($column){
					return array_merge(
						$preitem,
						is_object($item)&&!empty($item)?[$item->$column]:[]
					);
				},[])
			);
			$option_name = $option['name'];
			// dd($option_ids);
			if(!empty(self::$options->$option_name))
			{
				self::$options->$option_name = self::$options->$option_name->merge(Config::get('models.'.$option['name'])::whereIn('id',$option_ids)->get())->unique('id');
			}else{
				self::$options->$option_name = Config::get('models.'.$option['name'])::whereIn('id',$option_ids)->get();
			}
		}
		self::$relation_option_arr = collect([]);
		if($relate_arr)
		{
			$data = self::GetRelatedData($data,$model);
		}
		$CoverData = ['title'=>$tableName,'columns'=>self::$columns,'data'=>$data,'options'=>self::$options,'option_arr'=>collect($option_arr),'relation_option_arr'=>collect(self::$relation_option_arr),'relate_arr'=>collect($relate_arr)];
        // dd($CoverData);
        return (new LostExport($branch, $CoverData))->download($tableName.date('Ymd').'.xls');  
    }
	public static function GetRelatedData($data,$model)
	{
		
        $dbpath = Config::get('models.'.$model);
		$db = new $dbpath;
		$relate_arr = $db->relate_model;
		// dd($relate);
		foreach ($relate_arr as $key => $relate) {
			$relate_model = $relate['name'];
			$relate_column = $relate['column'];
	
			$relate_ids = array_unique(
				$data->reduce(function($preitem,$item){
					return array_merge(
						$preitem,
						is_object($item)&&!empty($item)?[$item->id]:[]
					);
				},[])
			);
	
			$relate_dbpath = Config::get('models.'.$relate_model);
			$relate_db = new $relate_dbpath;
			$relate_data = $relate_db->whereIn($relate['column'],$relate_ids)->get();
			$data->map(function($item)use($relate_data,$relate,$key){
				$son = $relate['name'];
				$item->$son = $relate_data->where($relate['column'],$item->id)->flatten();
				return $item;
			});
			$relate_columns = $relate_db->table_map;
			self::$columns = self::$columns->merge($relate_columns)->sortBy('rank');


			$option_arr = $relate_db->option?:[];
			self::$relation_option_arr = self::$relation_option_arr->merge($option_arr);
			foreach ($option_arr as $key => $option) {
				$column = $option['column'];
				// dump($option,$relate_model);
				$option_ids = array_unique(
					$data->reduce(function($preitem,$item)use($column,$relate_model){
						// dump($preitem);
						$file_arr = $item->$relate_model->reduce(function($preitem2,$item2)use($column){
							return array_merge(
								$preitem2,
								is_object($item2)&&!empty($item2)?[$item2->$column]:[]
							);
						},[])?:[];
						return array_merge($preitem,$file_arr);
					},[])
				);
				$option_name = $option['name'];
				if(!empty(self::$options->$option_name))
				{
					self::$options->$option_name = self::$options->$option_name->merge(Config::get('models.'.$option['name'])::whereIn('id',$option_ids)->get())->unique('id');
				}else{
					self::$options->$option_name = Config::get('models.'.$option['name'])::whereIn('id',$option_ids)->get();
				}
				// dd($data->toArray(),self::$options->$option_name,$option_ids);
			}
		}
		// foreach($data as $key => $value)
		// {
		// 	dump($value->son0);
		// }
		// dd($data);
		return $data;
    }
    public function import($barnch,$loacle,$name,Request $request){
		// dd('匯入excel',$name,$request);
		$PathName = explode(",", \Request::route()->parameters['name']);
        $model = $PathName[0];
		$menu_id = isset($PathName[1])?$PathName[1]:'';
		
		// $filePath = storage_path('import/最新消息20200426.xls');
		$filePath = request()->file('file');
		session::put("importModel",$model);
		$sessionModelName = session::get("importModel",'');
		// dd($model,$sessionModelName);
		if (in_array(pathinfo($filePath->getClientOriginalName(), PATHINFO_EXTENSION),['xls','xlsx'])) {
			$data = Excel::import(new UsersImport, $filePath);
		}else{
			return '<script>alert("請上傳xls檔");history.back();</script>';
		}
		// Excel::import(new UsersImport, $filePath);
		dd($data);
	}
	public function importlang($barnch,$loacle,$name,Request $request)
	{
		$lang = storage_path('lang/'.$loacle.'/'.$name.'.php');
		$langarr = Lang::get($name);
		$newlangarr = explode("\r\n",$request->all()['importtext']);
		$newlangarr = array_map(function($item){$item2 = explode("\t",$item);return $item2;},$newlangarr);
		$importarr = [];
		$importexptarr = [];
		$importmodifiarr = [];
		$importlossarr = [];

		foreach ($newlangarr as $key => $value) {
			if (isset($langarr[$value[0]])) {
				array_push($importarr,$value);
				// $importarr[$value[0]] = $value[1];
				if($langarr[$value[0]] != $value[2])
				{
					// dump($langarr[$value[0]],$value[2]);
					array_push($importmodifiarr,$value);
				}
			}else {
				array_push($importexptarr,$value);
			}
		}
		foreach ($langarr as $key => $value) {
			if (array_filter($newlangarr,function($item)use($key){return $item[0]==$key;})) {
			}else{
				$importlossarr[$key] = $value;
				// array_push($importlossarr,$value);
			}
		}
		foreach ($importarr as $key => $value) {
			print '//'.$value[1].'<br>'.'\''.$value[0].'\' => \''.htmlspecialchars($value[2]).'\','.'<br>';
		}
		print '<br><br><br>//---------多出來的謎之陣列------<br><br><br>';
		foreach ($importexptarr as $key => $value) {
			print '//'.$value[1].'<br>'.'\''.$value[0].'\' => \''.htmlspecialchars($value[2]).'\','.'<br>';
		}
		dd('原語系陣列:',$langarr,'輸入語系陣列:',$newlangarr,'印出來的語系陣列:',$importarr,'有修改過的語系陣列:',$importmodifiarr,'多出來的謎之語系陣列:',$importexptarr,'被遺忘的語系陣列:',$importlossarr);
	}
	public function importui()
	{
		$modellist=config('models');
		$locale_list=config('models.BranchOriginUnit')::get();
		// dd($modellist);
		return view('import',['modellist'=>$modellist,'locale_list'=>$locale_list]
		// , $data
	);
	}
}