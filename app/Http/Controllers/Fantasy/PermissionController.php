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

class PermissionController extends BackendController 
{

	public static function getCmsAuthority( $set )
	{
		$data['edit'] = 0;
		$data['delete'] = 0;
		$data['create'] = 0;
		$data['need_review'] = 0;
		$data['can_review'] = 0;

		$branch_id = parent::$baseBranchId;
		$locale = parent::$baseLocale;
		$user = Session::get('fantasy_user');
		// dd($user);
		if($branch_id == 0)
		{
			$role = CmsRole::where('type',1)->where('user_id',$user['id'])->first();
			$role = !empty($role) ? $role->toArray() : [];
		}
		else
		{
			$branchunit = BranchOriginUnit::where('origin_id',$branch_id)->where('locale',$locale)->first();
			$branchunit = !empty($branchunit) ? $branchunit->toArray() : [];

			/*======檢查是否有 新增/刪除 審核 ======*/
			$branch = BranchOrigin::where('id', $branch_id)->whereRaw('IFNULL(local_review_set, \'\') LIKE ?', '%"'.$locale.'"%')->first();
			if($branch)
			{
				$data['need_review'] = 1;
				
				if($branchunit!=[])
				{
					$crs_role = CrsRole::where('type',2)->where('is_active', 1)->where('user_id',$user['id'])->where('branch_id',$branchunit['id'])->first();
					if(!empty($crs_role))
					{
						$crs_role_json = json_decode($crs_role['roles'],true);
						foreach($crs_role_json as $key => $value)
						{
							if($set == $key)
							{
								$crs_role_json_temp = explode(";", $value);
								$data['can_review'] = $crs_role_json_temp[1];
							}
						}
					}
				}
			}
			
			/*======檢查是否有 新增/刪除 審核 ======*/

			$role = CmsRole::where('type',2)->where('user_id',$user['id'])->where('branch_id',$branchunit['id'])->first();
			$role = !empty($role) ? $role->toArray() : [];
		}

		if(!empty($role))
		{
			$role_json = json_decode($role['roles'],true);
			// dd($role_json);
			foreach($role_json as $key => $value)
			{
				if($set == $key)
				{
					$role_json_temp = explode(";", $value);
					// dd($role_json_temp);
					$data['edit'] = $role_json_temp[3];
					$data['delete'] = $role_json_temp[2];
					$data['create'] = $role_json_temp[1];
				}
			}
		}

		return $data;
	}
	public static function getCrsAuthority( $set )
	{

	}
}