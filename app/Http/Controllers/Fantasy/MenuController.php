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


class MenuController extends BackendController 
{

	public static function getFmsBranchMenu( $isBranch )
	{
		if($isBranch)
		{
			$branch_id = parent::$baseBranchId;
			
			$member = Session::get('fantasy_user');
			/*得此帳號所有的role*/
			$cmsRoles = parent::$ModelsArray['CmsRole']::where('is_active',1)
														->where('user_id',$member['id'])
														->where('type',2)
														// ->where('branch_id',$branch_id)
														->with('CmsPermissionWithMenu')
														->get()
														->toArray();
				// dd($cmsRoles);
			/*根據帳號Role得其可使用之分館與預設第一個分館*/
			if(!empty($cmsRoles))
			{
				$firstBranch = [];
				/*無分館 所以得第一間分館即可*/
				foreach ($cmsRoles as $key => $value) 
				{
					if(!empty($value['cms_permission_with_menu']))
					{
						$firstBranch = $value;
						break;
					}
				}
				$role_branch_id = [];
				foreach ($cmsRoles as $key => $value) 
				{
					if(!empty($value['cms_permission_with_menu']))
					{
						array_push($role_branch_id,$value['branch_id']);
					}
				}

				if(empty($firstBranch))
				{
					echo "No Permission to Fms or you don't have Cms permission.";
					die;
				}
				else
				{
					$nowBranchWithLocale = parent::$ModelsArray['BranchOriginUnit']::where('is_active',1)
																					->where('origin_id',$firstBranch['branch_id'])
																					->first();
					if(empty($nowBranchWithLocale))
					{
						echo "Your branch cms role set in wrong Branch.";
						die;
					}
					else
					{
						$nowBranch = parent::$ModelsArray['BranchOrigin']::where('is_active',1)->where('id',$nowBranchWithLocale->origin_id)->first();
						if(empty($nowBranchWithLocale))
						{
							echo "Call System because maybe you delete Something to cause this error.";
							die;
						}
						/*串當前分館名稱與語系及其ID*/
						// $data['now'] = $nowBranch->title.' - '.parent::$langArray[$nowBranchWithLocale->locale]['title'];
						// $data['now_branch'] = $nowBranchWithLocale->id;
						$data['now'] = '共用目錄';
						$data['now_branch'] = '';
						$data['list'] = [];

						$share['title'] = '共用目錄';
						$share['type'] = '1';
						$share['list'] = [];
						array_push($data['list'],$share);
						/*單一分館*/
						// $localeList = parent::$ModelsArray['BranchOriginUnit']::where('is_active',1)
						// 														->where('origin_id',$nowBranch['id'])
						// 														->whereIn('id',$role_branch_id)
						// 														->get()
						// 														->toArray();
						// $thisBranch['title'] = $nowBranch->title;
						// $thisBranch['type'] = '3';
						// foreach ($localeList as $key => $value) 
						// {
						// 	$thisBranch['list'][$key]['title'] = parent::$langArray[$value['locale']]['title'];
						// 	$thisBranch['list'][$key]['branch_id'] = $value['id'];
						// }
						// array_push($data['list'],$thisBranch);
					}
				}

			}
			else
			{
				echo "No Permission to Fms or you don't have Cms permission.";
				die;
			}
			return $data;

		}
		else
		{
			$member = Session::get('fantasy_user');
			/*得此帳號所有的role*/
			$cmsRoles = parent::$ModelsArray['CmsRole']::where('is_active',1)
														->where('user_id',$member['id'])
														->where('type',2)
														->with('CmsPermissionWithMenu')
														->get()
														->toArray();
			/*根據帳號Role得其可使用之分館與預設第一個分館*/
			if(!empty($cmsRoles))
			{
				$firstBranch = [];
				// dd($cmsRoles);
				/*無分館 所以得第一間分館即可*/
				foreach ($cmsRoles as $key => $value) 
				{
					if(!empty($value['cms_permission_with_menu']))
					{
						$firstBranch = $value;
						break;
					}
				}
				$role_branch_id = [];
				foreach ($cmsRoles as $key => $value) 
				{
					if(!empty($value['cms_permission_with_menu']))
					{
						array_push($role_branch_id,$value['branch_id']);
					}
				}

				if(empty($firstBranch))
				{
					echo "No Permission to Fms or you don't have Cms permission.";
					die;
				}
				else
				{
					$nowBranchWithLocale = parent::$ModelsArray['BranchOriginUnit']::where('is_active',1)
																					->where('origin_id',$firstBranch['branch_id'])
																					->first();
					if(empty($nowBranchWithLocale))
					{
						echo "Your branch cms role set in wrong Branch.";
						die;
					}
					else
					{
						$nowBranch = parent::$ModelsArray['BranchOrigin']::where('is_active',1)->where('id',$nowBranchWithLocale->origin_id)->first();
						if(empty($nowBranchWithLocale))
						{
							echo "Call System because maybe you delete Something to cause this error.";
							die;
						}
						/*串當前分館名稱與語系及其ID*/
						// $data['now'] = $nowBranch->title.' - '.parent::$langArray[$nowBranchWithLocale->locale]['title'];
						// $data['now_branch'] = $nowBranchWithLocale->id;
						$data['now'] = '共用目錄';
						$data['now_branch'] = '';
						$data['list'] = [];

						$share['title'] = '共用目錄';
						$share['type'] = '1';
						$share['list'] = [];
						array_push($data['list'],$share);
						/*單一分館*/
						// $localeList = parent::$ModelsArray['BranchOriginUnit']::where('is_active',1)
						// 														->where('origin_id',$nowBranch['id'])
						// 														->whereIn('id',$role_branch_id)
						// 														->get()
						// 														->toArray();
						// $thisBranch['title'] = $nowBranch->title;
						// $thisBranch['type'] = '3';
						// foreach ($localeList as $key => $value) 
						// {
						// 	$thisBranch['list'][$key]['title'] = parent::$langArray[$value['locale']]['title'];
						// 	$thisBranch['list'][$key]['branch_id'] = $value['id'];
						// }
						// array_push($data['list'],$thisBranch);
					}
				}

			}
			else
			{
				echo "No Permission to Fms or you don't have Cms permission.";
				die;
			}
			return $data;
		}
	}
	public static function getFmsFolderMenu( $type,$branch_id="",$zero_id='')
	{
		$member = Session::get('fantasy_user');
		if($type == '1')
		{
			/*第零層*/
			$zero = parent::$ModelsArray['FmsZero']::where('is_active', 1)
													->where('type',1)
													->orderBy('rank','asc')
													->get()
													->toArray();
			if(empty($zero)){
				echo "請先至Account帳號管理，建立FMS基本目錄";
				die;
			}
			/*第一層*/
			$list = [];
			$firstList = parent::$ModelsArray['FmsFirst']::where('is_active',1);
			if($zero_id!=''){
				$firstList = $firstList->where('zero_id', $zero_id);
			}else{
				// $firstList = $firstList->where('zero_id',$zero[0]['id']);
			}
			$firstList = $firstList->where('type',$type)
								->orderBy('rank','asc')
								->get()
								->toArray();

			foreach($firstList as $key => $value)
			{
				array_push($list, $value);
			}
			/*第二層*/
			foreach($list as $key => $value)
			{
				$temp_model = parent::$ModelsArray['FmsSecond'];
				$list[$key]['list'] = $temp_model::where('first_id',$value['id'])
												->get()
												->toArray();
			}
			/*第三層*/
			foreach($list as $key => $value)
			{
				if(!empty($value['list']))
				{
					foreach($value['list'] as $key2 => $value2)
					{
						$temp_model = parent::$ModelsArray['FmsThird'];
						$list[$key]['list'][$key2]['list'] = $temp_model::where('second_id',$value2['id'])
																		->get()
																		->toArray();
					}
				}
			}
		}
		elseif($type == '2')
		{

		}
		elseif($type == '3')
		{
			$temp_model = parent::$ModelsArray['CmsRole'];
			$cmsRoles = $temp_model::where('is_active',1)
														->where('user_id',$member['id'])
														->where('branch_id',$branch_id)
														->where('type',2)
														->with('CmsPermissionWithMenu')
														->first();
			$cmsRoles = (!empty($cmsRoles)) ? $cmsRoles->toArray() : [];
			if(empty($cmsRoles))
			{
				echo "No Permission.";
				die;
			}
			else
			{
				/*Web Key*/
				$key_group = [];
				foreach($cmsRoles['cms_permission_with_menu'] as $value2)
				{
					array_push($key_group,$value2['cms_menu']['key_id']);
				}
				/*第一層*/
				$list = [];
				if($cmsRoles['branch_manage'] == 1)
				{
					$temp_model = parent::$ModelsArray['FmsFirst'];
					$list = $temp_model::where('is_active',1)
																->where('type',4)
																->orderBy('rank','asc')
																->get()
																->toArray();
				}
				$temp_model = parent::$ModelsArray['FmsFirst'];
				$firstList = $temp_model::where('is_active',1)
														->whereIn('key_id',$key_group)
														->where('type',$type)
														->orderBy('rank','asc')
														->get()
														->toArray();
				foreach($firstList as $key => $value)
				{
					array_push($list, $value);
				}
				/*第二層*/
				foreach($list as $key => $value)
				{
					$temp_model = parent::$ModelsArray['FmsSecond'];
					$list[$key]['list'] = $temp_model::where('first_id',$value['id'])
													->where('branch_id',$branch_id)
													->get()
													->toArray();
				}
				/*第三層*/
				foreach($list as $key => $value)
				{
					if(!empty($value['list']))
					{
						foreach($value['list'] as $key2 => $value2)
						{
							$temp_model = parent::$ModelsArray['FmsThird'];
							$list[$key]['list'][$key2]['list'] = $temp_model::where('second_id',$value['id'])
																			->where('branch_id',$branch_id)
																			->get()
																			->toArray();
						}
					}
				}
				/*檢查是否有私有資料夾*/
				/*2*/
				/*3*/
			}

		}
		return [
			'list' => $list,
			'zero' => $zero
		];
	}
	public static function makeCmsBranchMenu( $branch_id,$locale,$isBranch )
	{
		$member = Session::get('fantasy_user');
		$data = [];
		if($isBranch)
		{
			$tttrvsdf_db = parent::$ModelsArray['BranchOrigin'];
			$nowBranch = $tttrvsdf_db::where('is_active',1)->where('id',$branch_id)->first();
			if(empty($nowBranch) AND $branch_id != 0)
			{
				return [];
			}
			else
			{
				if($branch_id == 0)
				{
					$nowBranch['title'] = '品牌總覽';
				}
				else
				{
					$nowBranch = $nowBranch->toArray();
				}
				$temp_model2 = parent::$ModelsArray['BranchOrigin'];
				$branchData = $temp_model2::where('is_active',1)->get()->toArray();
				$firstList = [];
				$overviewList = [];
				$chkOvList = [];
				$count_ov = 0;

				foreach($branchData as $key => $row)
				{
					$temp_model3 = parent::$ModelsArray['BranchOriginUnit'];
					$branchWithLocale = $temp_model3::where('is_active',1)->where('origin_id',$row['id'])->get()->toArray();
					$firstList[$key]['title'] = $row['title'];
					$firstList[$key]['link'] = 'javascript:;';

					$secondList = [];
					foreach($branchWithLocale as $key2 => $row2)
					{
						$secondList[$key2]['title'] = parent::$langArray[$row2['locale']]['title'];
						$nowBranchUrlTitle = BaseFunction::processTitleToUrl($row['url_title']);
						$secondList[$key2]['link'] = url('/Fantasy/Cms/'.$nowBranchUrlTitle.'/'.$row2['locale']);

						//品牌總覽語系
						if(!in_array($row2['locale'], $chkOvList)){
							array_push($chkOvList, $row2['locale']);
							$overviewList[$count_ov]['title'] = parent::$langArray[$row2['locale']]['title'];
							$overviewList[$count_ov]['link'] = url('/Fantasy/Cms/overview/'.$row2['locale']);
							$count_ov++;
						}
					}
					$firstList[$key]['list'] = $secondList;
				}
				$overview = 
				[
					'title'=>'品牌總覽',
					'link'=>'javascript:;',
					'list'=>$overviewList
				];
				array_push($firstList, $overview);
			}
			$data['list'] = $firstList;
			if($branch_id == 0)
			{
				$data['now'] = $nowBranch['title'];
			}
			else
			{
				$data['now'] = $nowBranch['title'].' - '.parent::$langArray[$locale]['title'];
			}
		}
		else
		{
			/*暫不權限 無交叉比對*/
			$nowBranch = parent::$ModelsArray['BranchOrigin']::where('is_active',1)->where('id',$branch_id)->first();

			if(empty($nowBranch))
			{
				return '';
			}
			else
			{
				$branchWithLocale = parent::$ModelsArray['BranchOriginUnit']::where('is_active',1)->where('origin_id',$branch_id)->get()->toArray();

				if(empty($branchWithLocale))
				{
					return '';
				}

				$firstList = [];
				foreach($branchWithLocale as $key => $row)
				{
					$firstList[$key]['title'] = parent::$langArray[$row['locale']]['title'];
					$nowBranchUrlTitle = BaseFunction::processTitleToUrl($nowBranch->url_title);
					$firstList[$key]['link'] = url('/Fantasy/Cms/'.$nowBranchUrlTitle.'/'.$row['locale']);
					$firstList[$key]['list'] = [];
				}
				$data['list'] = $firstList;
				$data['now'] = $nowBranch->title.' - '.parent::$langArray[$locale]['title'];
			}
		}
		return $data;
	}
    public static function makeCmsMenu($branch_id, $locale, $now_id)
    {
        $member = Session::get('fantasy_user');
        /*暫不權限 無交叉比對*/
        $nowBranch = parent::$ModelsArray['BranchOrigin']::where('is_active', 1)->where('id', $branch_id)->first();

        $temp_role = DB::table('basic_cms_role')->where('branch_id', $branch_id)->where('user_id', $member['id'])->first();
        if (empty($temp_role)) {
            return [];
        }
        $role = collect(json_decode($temp_role->roles, true))
            ->map(function ($value) {
                return explode(';', substr($value, 1));
            });
        if (empty($nowBranch) and $branch_id != 0) {
            return [];
        } else {
            if ($branch_id == 0) {
                $use_type = 1;
                $nowBranchUrlTitle = 'overview';
            } else {
                $use_type = 2;
                $nowBranchUrlTitle = BaseFunction::processTitleToUrl($nowBranch->url_title);
            }

            $type_can = ['1', '2'];
            /*無串權限*/
            $temp_model = parent::$ModelsArray['CmsMenu'];
            $firstList = $temp_model::where('is_active', 1)
                ->where('use_type', $use_type)
                ->whereIn('type', $type_can)
                ->orderBy('rank', 'asc')
                ->get()
                ->filter(function ($item) use ($role) {
                    return isset($role[$item['id']]) && ($role[$item['id']][0] || $role[$item['id']][1] || $role[$item['id']][2]);
                })
                ->values()
                ->toArray();
        }
        foreach ($firstList as $key => $row) {
            if ($row['type'] == 1) {
                $temp_model = parent::$ModelsArray['CmsMenu'];
                $firstList[$key]['list'] = $temp_model::where('is_active', 1)
                    ->where('use_type', $use_type)
                    ->whereIn('type', ['3', '4'])
                    ->where('parent_id', $row['id'])
                    ->orderBy('rank', 'asc')
                    ->get()
                    ->filter(function ($item) use ($role) {
                        return isset($role[$item['id']]) && ($role[$item['id']][0] || $role[$item['id']][1] || $role[$item['id']][2]);
                    })
                    ->map(function ($item, $key) use ($use_type, $role) {
                        $item['list'] = parent::$ModelsArray['CmsMenu']::where('is_active', 1)
                            ->where('use_type', $use_type)
                            ->where('type', '5')
                            ->where('parent_id', $item['id'])
                            ->orderBy('rank', 'asc')
                            ->get()
                            ->filter(function ($item) use ($role) {
                                return isset($role[$item['id']]) && ($role[$item['id']][0] || $role[$item['id']][1] || $role[$item['id']][2]);
                            })
                            ->toArray();
                        return $item;
                    })
                    ->toArray();
            }
        }
        /*串連結*/
        foreach ($firstList as $key => $row) {
            if ($row['type'] == 2) {
                $firstList[$key]['link'] = url('/Fantasy/Cms/' . $nowBranchUrlTitle . '/' . $locale . '/' . $row['id']);
            } else {
                $firstList[$key]['link'] = 'javascript:;';
            }

            if (!empty($row['list'])) {
                foreach ($row['list'] as $key2 => $row2) {

                    if ($row2['type'] == 3) {
                        $firstList[$key]['list'][$key2]['link'] = url('/Fantasy/Cms/' . $nowBranchUrlTitle . '/' . $locale . '/' . $row['id'] . '/' . $row2['id']);
                    } elseif ($row2['type'] == 4) {
                        $firstList[$key]['list'][$key2]['link'] = 'javascript:;';
                    }

                    if (!empty($row2['list'])) {
                        foreach ($row2['list'] as $key3 => $row3) {
                            $firstList[$key]['list'][$key2]['list'][$key3]['link'] = url('/Fantasy/Cms/' . $nowBranchUrlTitle . '/' . $locale . '/' . $row['id'] . '/' . $row3['id']);
                        }
                    }
                }
            }
        }

        /*如果有要串父親DB*/
        /*找當前單元*/
        foreach ($firstList as $key => $row) {
            if ($row['id'] == $now_id) {
                $firstList[$key]['active'] = 'open active';
            } else {
                $firstList[$key]['active'] = '';
            }


            if (!empty($row['list'])) {
                foreach ($row['list'] as $key2 => $row2) {
                    if ($row2['id'] == $now_id) {
                        $firstList[$key]['list'][$key2]['active'] = 'open active';
                        $firstList[$key]['active'] = 'open active';
                    } else {
                        if (!empty($row2['list'])) {
                            $firstList[$key]['list'][$key2]['active'] = '';
                            foreach ($row2['list'] as $key3 => $row3) {
                                if ($row3['id'] == $now_id) {
                                    $firstList[$key]['list'][$key2]['list'][$key3]['active'] = 'open active';
                                    $firstList[$key]['list'][$key2]['active'] = 'open active';
                                    $firstList[$key]['active'] = 'open active';
                                } else {
                                    $firstList[$key]['list'][$key2]['list'][$key3]['active'] = '';
                                }
                            }
                        } else {
                            $firstList[$key]['list'][$key2]['active'] = '';
                        }
                    }
                }
            }
        }
        return $firstList;
    }
}