<?php 
namespace App\Http\Controllers\Fantasy\ams;

use App\Http\Controllers\Fantasy\AmsController as AmsPaPa;
use App\Http\Controllers\Fantasy\MenuController as MenuFunction;
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
use App\Http\Models\Basic\Branch\BranchOrigin;
use App\Http\Models\Basic\Branch\BranchOriginUnit;

class TemplateSettingController extends AmsPaPa 
{
	public static $fileInformationArray = [];

	public function __construct()
	{
		parent::__construct();
		self::$fileInformationArray = BaseFunction::getAllFilesArray();
		View::share('fileInformationArray', self::$fileInformationArray);
		View::share('langArray',parent::$langArray);
		$branch_options = [];
		$locale_options = [];
        foreach (parent::$langArray as $key => $value) 
        {
	          $temp = 
	          [
	            'title' => $value['title'],
	            'key' => $value['abb_en_title']
	          ];
	          $locale_options[ $value['abb_en_title'] ] = $temp;
	          // array_push($locale_options, $temp);
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
          	// array_push($branch_options, $temp);
        }
        View::share('branch_options',$branch_options);
        View::share('locale_options',$locale_options);
	}

	public function index()
	{
		$data = BranchOriginUnit::get()->toArray();
		return View::make('Fantasy.ams.template_setting.index',
		[
			'data' => $data
		]);
	}
	public function update(Request $request)
	{
		$data = $request->input('amsData');
		$json = $request->input('jsonData');

		if($data['id'] == 0)
		{
			$info = new BranchOriginUnit;

			foreach ($data as $key => $value) 
			{
				if($key != 'id')
				{
					$info->$key = $value;
				}
			}
			$info->unit_set = json_encode($json);
			$info->save();
			$reback = 
			[
				'id' => $info->id,
				'result' => true,
				'status' => 'create'
			];
		}
		else
		{
			$info = BranchOriginUnit::where('id',$data['id'])->first();
			if(!empty($info))
			{
				foreach ($data as $key => $value) 
				{
					if($key != 'id')
					{
						$info->$key = $value;
					}
				}
				$info->unit_set = json_encode($json);
				$info->save();
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
		$info = BranchOriginUnit::where('id',$kill_id)->first();
		if(!empty($info))
		{
			$info->delete();
		}
	}
	public function reset()
	{
		$data = BranchOriginUnit::get()->toArray();
		return View::make('Fantasy.ams.template_setting.ajax.index',
		[
			'data' => $data
		]);
	}
}