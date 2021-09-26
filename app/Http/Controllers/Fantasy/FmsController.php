<?php
namespace App\Http\Controllers\Fantasy;

use App\Http\Controllers\Fantasy\MenuController as MenuFunction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use View;
use Redirect;
use Auth;
use Debugbar;
use Route;
use App;
use Config;
use Session;
use Image;

use UnitMaker;
use TableMaker;
use BaseFunction;

use App\Http\Models\Basic\Fms\FmsFirst;
use App\Http\Models\Basic\Fms\FmsSecond;
use App\Http\Models\Basic\Fms\FmsThird;
use App\Http\Models\Basic\Fms\FmsFile;
use App\Http\Models\Basic\FantasyUsers;
use App\Http\Models\Basic\Fms\FmsZero;

class FmsController extends BackendController
{

	public function __construct()
	{
		parent::__construct();
		// parent::checkRouteLang();
		// parent::checkRouteBranch();
		View::share('unitTitle', 'Fms');
		View::share('unitSubTitle', 'File Management System');
		View::share('FantasyUser', session('fantasy_user'));
	}

	public function index()
	{
		$isBranch = parent::$setBranchs;

		/*此專案是否有分館*/
		$menuBranchList = MenuFunction::getFmsBranchMenu($isBranch);

		$getList = MenuFunction::getFmsFolderMenu(1, $menuBranchList['now_branch']);
		$menuList = $getList['list'];
		$zeroList = $getList['zero'];	
		// dd($zeroList, $menuList);
		return View::make(
			'Fantasy.fms.index',
			[
				'menuBranchList' => $menuBranchList,
				'zeroList' => $zeroList,
				'menuList' => $menuList,
				'now_type' => 1
			]
		);
	}

	public function postFilesFms($branch, $locale, Request $request)
	{
		$member = Session::get('fantasy_user');
		$data = $request->all();

		/*隨機6碼*/
		$length = 6;
		$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
		$charactersLength = strlen($characters);
		$randomWord = '';
		for ($i = 0; $i < $length; $i++) {
			$randomWord .= $characters[rand(0, $charactersLength - 1)];
		}

		$fileName = date("YmdHis") . $randomWord . $data['key'];
		$folder = '/upload/' . date("Y_m_d") . $member['id'];

		$message = self::saveFileToDBAndServer($fileName, $folder, $data['first'], $data['second'], $data['third'], $data['branch'], $member['id'], $data['file']);

		return json_encode($message);
	}
	public function postNewFolder($branch, $locale, Request $request)
	{
		$area = $request->all();
		// dd($area);
		if ($area['area_first'] == 0) {
			if ($area['area_second'] == 0) {
				// 因為只會在第一第二層做用 所以第三層就不判斷了
				$back['an'] = false;
				$back['message'] = '請選擇第一層或第二層資料夾';
				return $back;
			} else {

				$FmsThird = new FmsThird;
				$FmsThird->second_id = $area['area_second'];
				$FmsThird->title = $area['newFolder'];
				if ($FmsThird->save()) {
					$back['an'] = true;
					$back['lastId'] = $FmsThird->id;
					return $back;
				} else {
					$back['an'] = false;
					$back['message'] = '存檔成失敗';
					return $back;
				}
			}
		} else {
			$FmsSecond = new FmsSecond;
			$FmsSecond->first_id = $area['area_first'];
			$FmsSecond->title = $area['newFolder'];
			if ($FmsSecond->save()) {
				$back['an'] = true;
				$back['lastId'] = $FmsSecond->id;
				return $back;
			} else {
				$back['an'] = false;
				$back['message'] = '存檔成失敗';
				return $back;
			}
		}
	}

	public function postNameFolder($branch, $locale, Request $request)
	{
		$area = $request->all();

		if ($area['area_first'] == 0) {

			if ($area['area_second'] == 0) {
				if ($area['area_third'] == 0) {

					$back['an'] = false;
					$back['message'] = '存檔失敗';
					return $back;
				} else {
					$FmsThird =  FmsThird::FindOrFail($area['area_third']);
					$FmsThird['title'] = $area['nameFolder'];
					if ($FmsThird->save()) {
						$back['an'] = true;
						return $back;
					} else {
						$back['an'] = false;
						$back['message'] = '存檔失敗';
						return $back;
					}
				}
			} else {

				$FmsSecond =  FmsSecond::FindOrFail($area['area_second']);
				$FmsSecond['title'] = $area['nameFolder'];
				if ($FmsSecond->save()) {
					$back['an'] = true;
					return $back;
				} else {
					$back['an'] = false;
					$back['message'] = '存檔失敗';
					return $back;
				}
			}
		} else {

			$FmsFirst =  FmsFirst::FindOrFail($area['area_first']);
			$FmsFirst['title'] = $area['nameFolder'];
			if ($FmsFirst->save()) {
				$back['an'] = true;
				return $back;
			} else {
				$back['an'] = false;
				$back['message'] = '存檔失敗';
				return $back;
			}
		}
	}

	public function postDeleteFolder($branch, $locale, Request $request)
	{
		$area = $request->all();
		if ($area['fms_shot'] == 'one_shot') {
			if ($area['area_first'] == 0) {

				if ($area['area_second'] == 0) {

					if ($area['area_third'] == 0) {

						$back['an'] = false;
						$back['message'] = '請選擇資料夾';
						return $back;
					} else {

						$FmsThird = FmsThird::FindOrFail($area['area_third']);
						$isdelete = self::check_user($FmsThird['created_user']);
						if ($isdelete) {
							if ($FmsThird->delete()) {
								$back['an'] = true;
								return $back;
							} else {
								$back['an'] = false;
								$back['message'] = '刪除失敗';
								return $back;
							}
						} else {
							$back['an'] = false;
							$back['message'] = '您非該資料夾的擁有者，無法刪除該資料夾。';
							return $back;
						}
					}
				} else {
					$FmsSecond = FmsSecond::FindOrFail($area['area_second']);
					$isdelete = self::check_user($FmsSecond['created_user']);
					if ($isdelete) {
						if ($FmsSecond->delete()) {
							$back['an'] = true;
							return $back;
						} else {
							$back['an'] = false;
							$back['message'] = '刪除失敗';
							return $back;
						}
					} else {
						$back['an'] = false;
						$back['message'] = '您非該資料夾的擁有者，無法刪除該資料夾。';
						return $back;
					}
				}
			} else {
				$FmsFirst = FmsFirst::FindOrFail($area['area_first']);
				$isdelete = self::check_user($FmsFirst['created_user']);
				if ($isdelete) {
					if ($FmsFirst->delete()) {
						$back['an'] = true;
						return $back;
					} else {
						$back['an'] = false;
						$back['message'] = '刪除失敗';
						return $back;
					}
				} else {
					$back['an'] = false;
					$back['message'] = '您非該資料夾的擁有者，無法刪除該資料夾。';
					return $back;
				}
			}
		}

		if ($area['fms_shot'] == 'multi_shot'){
			$undeleteFilder =[];

			foreach ($area['folder_level'] as $key => $value) {
				switch ($value) {
					case 'first':
						$FmsFirst = FmsFirst::FindOrFail($area['folder_id'][$key]);
						$isdelete = self::check_user($FmsFirst['created_user']);
						if ($isdelete) {
							if ($FmsFirst->delete()) {

							} else {
								array_push($undeleteFilder, $FmsFirst['title'] . '刪除失敗');
							}
						} else {
							array_push($undeleteFilder, '您非該資料夾' . $FmsFirst['title'] . '的擁有者，無法刪除該資料夾。');
						}
						break;
					case 'second':
						$FmsSecond = FmsSecond::FindOrFail($area['folder_id'][$key]);
						$isdelete = self::check_user($FmsSecond['created_user']);
						if ($isdelete) {
							if ($FmsSecond->delete()) {

							} else {
								array_push($undeleteFilder, $FmsSecond['title'] . '刪除失敗');
							}
						} else {
							array_push($undeleteFilder, '您非該資料夾' . $FmsSecond['title'] . '的擁有者，無法刪除該資料夾。');
						}
						break;
					case 'third':
						$FmsThird = FmsThird::FindOrFail($area['folder_id'][$key]);
						$isdelete = self::check_user($FmsThird['created_user']);
						if ($isdelete) {
							if ($FmsThird->delete()) {
								
							} else {
								array_push($undeleteFilder , $FmsThird['title']. '刪除失敗' );
							}
						} else {
							array_push($undeleteFilder, '您並非資料夾:'.$FmsThird['title']. '的擁有者，無法刪除該資料夾。');
						}
						break;
				}
			}
			if (count($undeleteFilder) > 0) {
				$back['an'] = false;
				$back['message'] = implode(" ,\n ", $undeleteFilder);
				return $back;
			} else {
				$back['an'] = true;
				return $back;
			}
		}

		
	}
	public function postEditFiles($branch, $locale, Request $request)
	{

		$form_data = $request->all();
		$member = Session::get('fantasy_user');
		$file = FmsFile::FindOrFail($form_data['id']);
		$isdelete = self::check_user($file['created_user']);
		if ($isdelete) {
			$data = [];
			if ($form_data['folder_level'] == '0') {
				$folder_zero_id = $form_data['folder_id'];
				$folder_first_id = '0';
				$folder_second_id = '0';
				$folder_third_id = '0';
			} elseif ($form_data['folder_level'] == '1') {
				$folder_zero_id = '0';
				$folder_first_id = $form_data['folder_id'];
				$folder_second_id = '0';
				$folder_third_id = '0';
			} elseif ($form_data['folder_level'] == '2') {
				$folder_zero_id = '0';
				$folder_first_id = '0';
				$folder_second_id = $form_data['folder_id'];
				$folder_third_id = '0';
			} elseif ($form_data['folder_level'] == '3') {
				$folder_zero_id = '0';
				$folder_first_id = '0';
				$folder_second_id = '0';
				$folder_third_id = $form_data['folder_id'];
			}

			// $upload = FmsFile::where('id', $form_data['id'])
			// 	->update([
			// 		'title' => $form_data['title'],
			// 		'zero_id' => $folder_zero_id,
			// 		'first_id' => $folder_first_id,
			// 		'second_id' => $folder_second_id,
			// 		'third_id' => $folder_third_id,
			// 		// 'share_group'=> $form_data['share_group'],
			// 		'note' => $form_data['note'],
			// 		'last_edit_user' => $member['id'],
			// 	]);

			$upload = new FmsFile();
			$upload = FmsFile::find($form_data['id']);
			$upload->title = $form_data['title'];
			$upload->zero_id = $folder_zero_id;
			$upload->first_id = $folder_first_id;
			$upload->second_id = $folder_second_id;
			$upload->third_id = $folder_third_id;
			$upload->note = $form_data['note'];
			$upload->last_edit_user = $member['id'];
			$upload->save();

			if ($upload) {
				$back['an'] = true;
				return $back;
			} else {
				$back['an'] = false;
				$back['message'] = '編輯失敗';
				return $back;
			}
		} else {
			$back['an'] = false;
			$back['message'] = '您非檔案擁有者，無法編輯該檔案';
			return $back;
		}
	}

	public function postEditFolder($branch, $locale, Request $request)
	{

        $form_data = $request->all();
		if ($form_data['id'] != '0') { //等於0就是新增

			$member = Session::get('fantasy_user');
            $data = [];

            // 有移動路徑 -> 搬移資料夾
            if($form_data['id'] != $form_data['folder_id'] || $form_data['origin_folder_level'] != $form_data['folder_level']){
                self::AddNewFolderAndMoveTheFileThenCheckTheSubFolder($form_data['id'], $form_data['origin_folder_level'], $form_data['folder_id'], $form_data['folder_level']);

                $back['an'] = true;
                return $back;
            }
            else{
                if ($form_data['folder_level'] == '1') {
                    $upload = FmsFirst::where('id', $form_data['id'])
                        ->update([
                            'title' => $form_data['title'],
                            // 'share_group' => $form_data['share_group'], 
                            'note' => $form_data['note'],
                            'last_edit_user' => $member['id'],
                            // 'zero_id' => $form_data['note']
                        ]);
                } elseif ($form_data['folder_level'] == '2') {
                    $upload = FmsSecond::where('id', $form_data['id'])
                        ->update([
                            'title' => $form_data['title'],
                            // 'share_group' => $form_data['share_group'],
                            'note' => $form_data['note'],
                            'last_edit_user' => $member['id'],
                        ]);
                } elseif ($form_data['folder_level'] == '3') {
                    $upload = FmsThird::where('id', $form_data['id'])
                        ->update([
                            'title' => $form_data['title'],
                            // 'share_group' => $form_data['share_group'],
                            'note' => $form_data['note'],
                            'last_edit_user' => $member['id'],
                        ]);
                }
                if ($upload) {
                    $back['an'] = true;
                    return $back;
                } else {
                    $back['an'] = false;
                    $back['message'] = '編輯失敗';
                    return $back;
                }
            }
			
		} else {
			$member = Session::get('fantasy_user');
			$data = [];
			$now_date = date("Y-m-d H:i:s");
			if ($form_data['folder_level'] == '1') {
				$upload = FmsSecond::insert([
					'title' => $form_data['title'],
					// 'share_group' => $form_data['share_group'],
					'note' => $form_data['note'],
					'last_edit_user' => $member['id'],
					'first_id' => $form_data['folder_id'],
					'created_user' => $member['id'],
					'created_at' => $now_date,
					'updated_at' => $now_date,


				]);
			} elseif ($form_data['folder_level'] == '2') {
				$upload = FmsThird::insert([
					'title' => $form_data['title'],
					// 'share_group' => $form_data['share_group'],
					'note' => $form_data['note'],
					'last_edit_user' => $member['id'],
					'second_id' => $form_data['folder_id'],
					'created_user' => $member['id'],
					'created_at' => $now_date,
					'updated_at' => $now_date,
				]);
			} elseif ($form_data['folder_level'] == '0') {
				$upload = FmsFirst::insert([
					'title' => $form_data['title'],
					// 'share_group' => $form_data['share_group'],
					'note' => $form_data['note'],
					'last_edit_user' => $member['id'],
					'created_user' => $member['id'],
					'created_at' => $now_date,
					'updated_at' => $now_date,
					'zero_id' => $form_data['folder_id'],
					'is_active' => '1',
					'type' => '1'
				]);
			}

			if ($upload) {
				$back['an'] = true;
				return $back;
			} else {
				$back['an'] = false;
				$back['message'] = '新增失敗';
				return $back;
			}
		}
    }
    
    public function AddNewFolderAndMoveTheFileThenCheckTheSubFolder($OriginalFolderId , $OriginalFolderLevel, $NewFolderId , $NewFolderLevel)
    {
        // 原本的資料夾 && 底下的檔案/資料夾
        switch ($OriginalFolderLevel) {
            case 1:
                $AbdicateFolder = FmsFirst::whereId($OriginalFolderId)->first();
                $MovingFile = FmsFile::where('first_id', $OriginalFolderId)->where('second_id',0)->where('third_id',0);
                $MovingFolder = FmsSecond::where('first_id', $OriginalFolderId)->get();
                $MovingFolderLevel = 2;
                break;
            case 2:
                $AbdicateFolder = FmsSecond::whereId($OriginalFolderId)->first();
                $MovingFile = FmsFile::where('first_id', 0)->where('second_id', $OriginalFolderId)->where('third_id', 0);
                $MovingFolder = FmsThird::where('second_id', $OriginalFolderId)->get();
                $MovingFolderLevel = 3;
                break;
            case 3:
                $AbdicateFolder = FmsThird::whereId($OriginalFolderId)->first();
                $MovingFile = FmsFile::where('first_id', 0)->where('second_id', 0)->where('third_id', $OriginalFolderId);
                $MovingFolder = collect([]);
                break;
        }

        // 建立新的資料夾 && 移動檔案
        switch ($NewFolderLevel) {
            case 0:
                $BildeFolderLevel = 1;
                $BildeFolderID = FmsFirst::insertGetId([
                    'title' => $AbdicateFolder['title'],
                    'note' => $AbdicateFolder['note'],
                    'last_edit_user' => $AbdicateFolder['last_edit_user'],
                    'created_user' => $AbdicateFolder['created_user'],
                    'created_at' => $AbdicateFolder['created_at'],
                    'updated_at' => $AbdicateFolder['updated_at'],
                    'zero_id' => $NewFolderId,
                    'is_active' => '1',
                    'type' => '1'
                ]);
                $MovingFile->update(['first_id' => $BildeFolderID, 'second_id'=> 0 , 'third_id' => 0]);
                break;
            case 1:
                $BildeFolderLevel = 2;
                $BildeFolderID = FmsSecond::insertGetId([
                    'title' => $AbdicateFolder['title'],
                    'note' => $AbdicateFolder['note'],
                    'last_edit_user' => $AbdicateFolder['last_edit_user'],
                    'created_user' => $AbdicateFolder['created_user'],
                    'created_at' => $AbdicateFolder['created_at'],
                    'updated_at' => $AbdicateFolder['updated_at'],
                    'first_id' => $NewFolderId,
                ]);
                $MovingFile->update(['first_id' => 0, 'second_id' => $BildeFolderID, 'third_id' => 0]);
                break;
            case 2:
                $BildeFolderLevel = 3;
                $BildeFolderID = FmsThird::insertGetId([
                    'title' => $AbdicateFolder['title'],
                    'note' => $AbdicateFolder['note'],
                    'last_edit_user' => $AbdicateFolder['last_edit_user'],
                    'created_user' => $AbdicateFolder['created_user'],
                    'created_at' => $AbdicateFolder['created_at'],
                    'updated_at' => $AbdicateFolder['updated_at'],
                    'second_id' => $NewFolderId,
                ]);
                $MovingFile->update(['first_id' => 0, 'second_id' => 0, 'third_id' => $BildeFolderID]);
                break;
            case 3:
                $UpId = FmsThird::where('id', $NewFolderId)->first();
                $OldFolderId = FmsThird::where('id', $OriginalFolderId)->update(['second_id' => $UpId['second_id']]);
                break;  
                          
        }

        // 刪除原本的資料夾
        switch ($OriginalFolderLevel) {
            case 1:
                FmsFirst::whereId($OriginalFolderId)->delete();
                break;
            case 2:
                FmsSecond::whereId($OriginalFolderId)->delete();
                break;
            case 3:
                if($NewFolderLevel != 3){
                    FmsThird::whereId($OriginalFolderId)->delete();
                }
                break;
        }

        // 移動底下的資料夾
        if (count($MovingFolder) > 0) {
            foreach ($MovingFolder as $key => $value) {
                self::AddNewFolderAndMoveTheFileThenCheckTheSubFolder($value['id'], $MovingFolderLevel, $BildeFolderID, $BildeFolderLevel);
            }
        }
    }

	public function postEditDelete($branch, $locale, Request $request)
	{
		$form_data = $request->all();
		$member = Session::get('fantasy_user');

		$data = [];
		if ($form_data['folder_level'] == '1') {
			$delete = FmsFirst::where('id', $form_data['this_id'])->first();
			$isdelete = self::check_user($delete['created_user']);
			if ($isdelete) {
				$delete->delete();
			} else {
				$back['an'] = false;
				$back['message'] = '您非該資料夾的擁有者，無法刪除該資料夾。';
				return $back;
			}
		} elseif ($form_data['folder_level'] == '2') {
			$delete = FmsSecond::where('id', $form_data['this_id'])->first();
			$isdelete = self::check_user($delete['created_user']);
			if ($isdelete) {
				$delete->delete();
			} else {
				$back['an'] = false;
				$back['message'] = '您非該資料夾的擁有者，無法刪除該資料夾。';
				return $back;
			}
		} elseif ($form_data['folder_level'] == '3') {
			$delete = FmsThird::where('id', $form_data['this_id'])->first();
			$isdelete = self::check_user($delete['created_user']);
			if ($isdelete) {
				$delete->delete();
			} else {
				$back['an'] = false;
				$back['message'] = '您非該資料夾的擁有者，無法刪除該資料夾。';
				return $back;
			}
		}

		if ($delete) {
			$back['an'] = true;
			return $back;
		} else {
			$back['an'] = false;
			$back['message'] = '刪除失敗';
			return $back;
		}
	}


	public function postDeleteFiles($branch, $locale, Request $request)
	{
		$area = $request->all();

		$type =  $area['type'];

		if($type == 'one'){
			$id = $area['id'];
			$src = $area['src'];
			$trueSrc = str_replace('/upload/', '', $area['src']);
			$file = FmsFile::FindOrFail($id);

			$isdelete = self::check_user($file['created_user']);
			if ($isdelete) {
				if (Storage::disk('localPublic')->exists($trueSrc)) {

					$File = FmsFile::FindOrFail($id);
					if ($File->delete()) {
						$back['an'] = true;
						return $back;
					} else {
						$back['an'] = false;
						$back['message'] = '刪除失敗';
						return $back;
					}
				} else {
					$File = FmsFile::FindOrFail($id);
					if ($File->delete()) {
						$back['an'] = true;
						return $back;
					} else {
						$back['an'] = false;
						$back['message'] = '此檔案不存在';
						return $back;
					}
				}
			} else {
				$back['an'] = false;
				$back['message'] = '您非檔案擁有者，無法刪除該檔案';
				return $back;
			}
		}

		if ($type == 'multi') {
			
			$id = $area['id'];
			$file = FmsFile::whereIn('id', $id);
			$user = Session::get('fantasy_user');
			$allClear = 0;
			$notClearFileTitle=[];
			foreach ($file->get() as $key => $value) {
				if (!($value['created_user'] == $user['id'] || $user['fms_admin'] == '1')){					
					$allClear += 1;
					array_push($notClearFileTitle , $value['title'].'.'. $value['type'] );
				}
			}			

			if ($allClear == 0) {

				$FailMSG =[];

				foreach ($id as $key => $value) {

					$src = $area['src'][$key];
					$trueSrc = str_replace('/upload/', '', $src);

					if (Storage::disk('localPublic')->exists($trueSrc)) 
					{
						$File = FmsFile::FindOrFail($value);
						if ($File->delete()) {

						} else {
							array_push($FailMSG, $File['title'] . '.' .$File['type'] . '刪除失敗');
						}
					} 
					else 
					{
						$File = FmsFile::FindOrFail($value);
						if ($File->delete()) {

						} else {
							array_push($FailMSG, $File['title'] . '.' . $File['type'] . '檔案不存在');
						}
					}
				}
				if ( count($FailMSG) >0 ){
					$back['an'] = false;
					$back['message'] = implode(" ,\n ", $FailMSG);
					return $back;
				}else{
					$back['an'] = true;
					return $back;
				}


			} else {
				$back['an'] = false;
				$back['message'] = '您非'. implode(" , ", $notClearFileTitle).'擁有者，無法刪除該檔案';
				return $back;
			}
			
		}
		
	}
	public function postDownloadFiles($branch, $locale, Request $request)
	{
		$area = $request->all();
		$id = $area['id'];
		$src = $area['src'];
		$trueSrc = str_replace('/upload/', '', $area['src']);

		if (Storage::disk('localPublic')->exists($trueSrc)) {

			$file =  asset($src);
			$back['an'] = true;
			$back['src'] = $file;
			return $back;
		} else {
			$back['an'] = false;
			$back['message'] = '下載失敗';
			return $back;
		}
	}
	public static function saveFileToDBAndServer($name, $folder, $first, $second, $third, $branch, $user, $file)
	{
		$mimeName = $file->getClientOriginalName();
		$mimeSize = $file->getSize();
		$fileType = pathinfo($mimeName, PATHINFO_EXTENSION);
		$fileOriginalName =  str_replace('.' . $fileType, '', $mimeName);

		$fileName = $name . '.' . $fileType;
		$path = public_path() . $folder;
		$filePath = $path . '/' . $fileName;
		$file->move($path, $fileName);
		if (file_exists($filePath)) {
			$modelData = new parent::$ModelsArray['FmsFile'];

			$fileImformation = getimagesize($filePath);

			$modelData->real_route = $folder . '/' . $fileName;
            //超過3000*3000不縮圖
            if(!empty($fileImformation)){
                if ($fileImformation[0] < 2000 && $fileImformation[1] < 2000) {
                    $modelData->real_m_route = self::get_thumbnail($folder, $name, $fileType);
                } else {
                    $modelData->real_m_route = $folder . '/' . $fileName;
                }
            } else {
                $modelData->real_m_route = $folder . '/' . $fileName;
            }

			$modelData->first_id = $first;
			$modelData->title = $fileOriginalName;
			$modelData->second_id = $second;
			$modelData->third_id = $third;
			$modelData->branch_id = $branch;
			$modelData->created_user = $user;
			$modelData->type = $fileType;
			$modelData->size = $mimeSize;
			$modelData->resolution = (!empty($fileImformation)) ? $fileImformation[0] . 'x' . $fileImformation[1] : '';

			if ($modelData->save()) {
				$back['avatar_id'] = $modelData->id;
				$back['an'] = true;
				return $back;
			} else {
				$back['an'] = false;
				$back['message'] = '檔案上傳失敗';
				return $back;
			}
		} else {
			$back['an'] = false;
			$back['message'] = '檔案上傳失敗';
			return $back;
		}
	}

	public function f_lbox_full($branch, $locale, $getType, $getKey, $fileId, Request $request)
	{
		$zero = ($request->input('zero')!='undefined')? $request->input('zero'):(FmsZero::where('is_active',1)->first()->id);
		$isBranch = parent::$setBranchs;

		if ($getType == 'img') {
			$one_class = 'one_shot';
		} else if ($getType == 'file') {
			$one_class = 'one_shot';
		} else {
			$one_class = 'multi_shot';
		}

		/*此專案是否有分館*/
		$menuBranchList = MenuFunction::getFmsBranchMenu($isBranch);
		
		$getList = MenuFunction::getFmsFolderMenu(1, $menuBranchList['now_branch'], $zero);
		$menuList = $getList['list'];
		$zeroList = $getList['zero'];
		if($zero!=''){
			$nowZero = collect($zeroList)->where('id', $zero)->first();
		}else{
			$nowZero = $zeroList[0];
		}		
		// $menuList = MenuFunction::getFmsFolderMenu(1, $menuBranchList['now_branch']);
		// dd($menuList);
		return View::make(
			'Fantasy.fms.lbox_full',
			[
				'menuBranchList' => $menuBranchList,
				'zeroList' => $zeroList,
				'nowZero' => $nowZero,
				'menuList' => $menuList,
				'now_type' => 1,
				'unit_type' => $getType,
				'one_class' => $one_class,
				'img_key' => $getKey,
				'first'=> 0,
				'second'=> 0,
				'third'=> 0
			]
		);
	}
	public function f_lbox($branch, $locale, $getType, $getKey, $fileId, Request $request)
	{
		$zero = ($request->input('zero')!='undefined')? $request->input('zero'):(FmsZero::where('is_active',1)->first()->id);
		$isBranch = parent::$setBranchs;

		if ($getType == 'img') {
			$one_class = 'one_shot';
		} else if ($getType == 'file') {
			$one_class = 'one_shot';
		} else {
			$one_class = 'multi_shot';
		}

		/*此專案是否有分館*/
		$menuBranchList = MenuFunction::getFmsBranchMenu($isBranch);
		
		$getList = MenuFunction::getFmsFolderMenu(1, $menuBranchList['now_branch'], $zero);
		$menuList = $getList['list'];
		$zeroList = $getList['zero'];
		if($zero!=''){
			$nowZero = collect($zeroList)->where('id', $zero)->first();
		}else{
			$nowZero = $zeroList[0];
		}		
		// $menuList = MenuFunction::getFmsFolderMenu(1, $menuBranchList['now_branch']);
		// dd($img_key);
		return View::make(
			'Fantasy.fms.lbox',
			[
				'menuBranchList' => $menuBranchList,
				'zeroList' => $zeroList,
				'nowZero' => $nowZero,
				'menuList' => $menuList,
				'now_type' => 1,
				'unit_type' => $getType,
				'one_class' => $one_class,
				'img_key' => $getKey,
				'first' => 0,
				'second' => 0,
				'third' => 0
			]
		);
	}
	public function get_file_folder($branch, $locale, $list_type, $first, $second, $third, $type, Request $request)
	{		
		$zero = ($request->input('zero')!='undefined')? $request->input('zero'):(FmsZero::where('is_active',1)->first()->id);
		if ($first != 0) {
			$folder = FmsSecond::where('first_id', $first);
			$folderLevel = 'second';
			$file = FmsFile::where('first_id', $first);
		} 
		else {
			if ($second != 0) {
				$folder = FmsThird::where('second_id', $second);
				$folderLevel = 'third';
				$file = FmsFile::where('second_id', $second);
			} 
			else {
				if ($third != 0) {
					$folder = [];
					$folderLevel = '';
					$file = FmsFile::where('third_id', $third);
				} 
				else {
					$folder = FmsFirst::where('zero_id', $zero);
					$folderLevel = 'first';
					$file = FmsFile::where('zero_id', $zero)
							->where('first_id', '0')->where('second_id', '0')->where('third_id', '0');
				}
			}
		}
		if (!empty($_GET['rank'])) {
			switch ($_GET['rank']) {
				case 'title':
					$folder = ($folder == []) ? [] : $folder->orderBy('title')->get()->toArray();
					$file = $file->orderBy('title')->get()->toArray();
					break;

				case 'type':
					$folder = ($folder == []) ? [] : $folder->get()->toArray();
					$file = $file->orderBy('type')->get()->toArray();
					break;

				case 'file_type':
					$folder = ($folder == []) ? [] : $folder->get()->toArray();
					$file = $file->orderBy('type')->get()->toArray();
					break;

				case 'size':
					$folder = ($folder == []) ? [] : $folder->get()->toArray();
					$file = $file->orderBy('size')->get()->toArray();
					break;

				case 'resolution':
					$folder = ($folder == []) ? [] : $folder->get()->toArray();
					$file = $file->orderBy('resolution')->get()->toArray();
					break;

				case 'updated_at':
					$folder = ($folder == []) ? [] : $folder->orderBy('updated_at')->get()->toArray();
					$file = $file->orderBy('updated_at')->get()->toArray();
					break;

				case 'created_at':
					$folder = ($folder == []) ? [] : $folder->orderBy('created_at')->get()->toArray();
					$file = $file->orderBy('created_at')->get()->toArray();
					break;

				case 'create_id':
					$folder = ($folder == []) ? [] : $folder->orderBy('created_user')->get()->toArray();
					$file = $file->orderBy('created_user')->get()->toArray();
					break;

				default:
					$folder = ($folder == []) ? [] : $folder->get()->toArray();
					$file = $file->get()->toArray();
					
					break;
			}
		} else {
			$folder = ($folder == []) ? [] : $folder->get()->toArray();
			if( !empty($file)){
				$file = $file->get()->toArray();
			}else{
				$file=[];
			}
			
		}

		foreach ($file as $key => $value) {
			$file[$key]['file_type'] = self::get_file_type($value['type']);
			$file[$key]['_this_size'] = BaseFunction::cvt_file_size($value['size']);
		}

		if ($list_type == 'lt_mode') {
			$view = 'Fantasy.fms.lt_mode';
		} else if ($list_type == 'lp_mode') {
			$view = 'Fantasy.fms.lp_mode';
		} else if ($list_type == 'gd_mode') {
			$view = 'Fantasy.fms.gd_mode'; 
		}
		return View::make(
			$view,
			[
				'folder' => $folder,
				'folderLevel' => $folderLevel,
				'file' => $file,
				'countFile'=> count($file)
			]
		);
	}
	public function get_fms_sidebar($branch, $locale, $first, $second, $third, Request $request)
	{
		$zero = ($request->input('zero')!='undefined')? $request->input('zero'):(FmsZero::where('is_active',1)->first()->id);
		$isBranch = parent::$setBranchs;
		/*此專案是否有分館*/
		$menuBranchList = MenuFunction::getFmsBranchMenu($isBranch);

		$getList = MenuFunction::getFmsFolderMenu(1, $menuBranchList['now_branch'], $zero);
		$menuList = $getList['list'];
		$zeroList = $getList['zero'];
		if($zero!=''){
			$nowZero = collect($zeroList)->where('id', $zero)->first();
		}else{
			$nowZero = $zeroList[0];
		}
		return View::make(
			'Fantasy.fms.sidebar',
			[
				'menuBranchList' => $menuBranchList,
				'zeroList' => $zeroList,
				'nowZero' => $nowZero,
				'menuList' => $menuList,
				'first' => $first,
				'second' => $second,
				'third' => $third,
				'now_type' => 1,
			]
		);
	}
	public function get_file_detail($branch, $locale, $file_id)
	{
		$File = FmsFile::FindOrFail($file_id);
		if (!$File) {
			return 0;
		} else {
			$owner = FantasyUsers::where('id', $File['created_user'])->first();
			$last_edit_user = FantasyUsers::where('id', $File['last_edit_user'])->first();
			//檔案大小
			$File['_this_size'] = BaseFunction::cvt_file_size($File['size']);

			//路徑
			$file_path = BaseFunction::get_file_path($File);

			$count_file = FmsFile::where('first_id', $File['first_id'])
				->where('second_id', $File['second_id'])
				->where('third_id', $File['third_id'])
				->count();

			$file_type = self::get_file_type($File['type']);
			//0220 jax add 洗擁有權限的名子
			$share_user = [];

			if ($File['share_group'] != '' && $File['share_group'] != '[""]') {
				// var_dump($File['share_group']);
				// die();
				$share_user_array = json_decode($File['share_group']);
				foreach ($share_user_array as $key => $row) {
					$user = $owner = FantasyUsers::where('id', $row)->first();
					array_push($share_user, $user['name']);
				}
			}
			return View::make(
				'Fantasy.fms.file_detail',
				[
					'File' =>  $File,
					'file_path' =>  $file_path,
					'count_file' =>  $count_file,
					'file_type' =>  $file_type,
					'owner' =>  $owner,
					'share_user' => $share_user,
					'last_edit_user' => $last_edit_user,
					'area_title' => 'FILE INFORMATION 檔案資訊',
					'area_detail' => '檔案',
				]
			);
		}
	}
	public function get_file_edit($branch, $locale, $file_id)
	{
		$File = FmsFile::FindOrFail($file_id);

		$isdelete = self::check_user($File['created_user']);

		if (!$File) {
			return 0;
		} else if (!$isdelete) {
			return 'not_user';
		} else {
			$owner = FantasyUsers::where('id', $File['created_user'])->first();
			$last_edit_user = FantasyUsers::where('id', $File['last_edit_user'])->first();
			$all_owner = FantasyUsers::where('is_active', '1')->get();
			if ($File['size'] > 1048576) {
				$File['_this_size'] = round($File['size'] / 1048576, 2) . ' MB';
			} else {
				$File['_this_size'] = round($File['size'] / 1024, 2) . ' KB';
			}

			//路徑
			if($File['zero_id'] != 0){
				$folder0 = FmsZero::where('id', $File['zero_id'])->first();
			}else{
				$folder0 = FmsZero::where('is_active', 1)->first();
			}			
			$file_path = $folder0['title'].' / ';
			$file_path_for_edit = $folder0['title'].' / ';
			
			if ($File['first_id'] != 0) {
				$folder = FmsFirst::where('id', $File['first_id'])->first();
				$file_path .= $folder['title'];
				$file_path_for_edit .= $folder['title'];
			} elseif ($File['second_id'] != 0) {
				$folder = FmsSecond::where('id', $File['second_id'])
					->with('FmsFirst')
					->first();
				$file_path .= $folder->FmsFirst['title'] . ' / ' . $folder['title'];
				$file_path_for_edit .= $folder->FmsFirst['title'] . ' / ' . $folder['title'];
			} elseif ($File['third_id'] != 0) {
				$folder = FmsThird::where('id', $File['third_id'])
					->with('FmsSecond')
					->first();
				$f_folder = FmsFirst::where('id', $folder->FmsSecond['first_id'])->first();

				$file_path .= $f_folder['title'] . ' / ' . $folder->FmsSecond['title'] . ' / ' . $folder['title'];
				$file_path_for_edit .= $f_folder['title'] . ' / ' . $folder->FmsSecond['title'] . ' / ' . $folder['title'];
			}
			
			$count_file = FmsFile::where('first_id', $File['first_id'])
				->where('second_id', $File['second_id'])
				->where('third_id', $File['third_id'])
				->count();
			$file_type = self::get_file_type($File['type']);

            $new_file_path_for_edit = FmsZero::where('is_active', '1')
                                    ->with(['FmsFirst' => function($query) {
                                        $query->with(['FmsSecond' => function($q){
                                            $q->with('FmsThird');
                                        }]);
                                    }])
                                    ->get();


			$folder_data_array = FmsFirst::where('is_active', '1')->with('FmsSecond')->get()->toArray();

			foreach ($folder_data_array as $key => $row) {
				foreach ($row['fms_second'] as $key2 => $row2) {
					$folder_data_array[$key]['fms_second'][$key2]['fms_third'] = FmsThird::where('second_id', $row2['id'])->get()->toArray();
				}
			}

			$folder_data = [];
			foreach ($folder_data_array as $key => $row) {
				array_push($folder_data, array('Level' => '1', 'router' => $row['title'] . ' /', 'id' => $row['id']));
				if (!empty($row['fms_second'])) {
					foreach ($row['fms_second'] as $key2 => $row2) {
						array_push($folder_data, array('Level' => '2', 'router' => $row['title'] . ' / ' . $row2['title'], 'id' => $row2['id']));
						if (!empty($row2['fms_third'])) {
							foreach ($row2['fms_third'] as $key3 => $row3) {
								array_push($folder_data, array('Level' => '3', 'router' => $row['title'] . ' / ' . $row2['title'] . ' / ' . $row3['title'], 'id' => $row3['id']));
							}
						}
					}
				}
			}

			if ($File['first_id'] != '0') {
				$File['level'] = '1';
				$File['folder_id'] = $File['first_id'];
			} elseif ($File['second_id'] != '0') {
				$File['level'] = '2';
				$File['folder_id'] = $File['second_id'];
			} elseif ($File['third_id'] != '0') {
				$File['level'] = '3';
				$File['folder_id'] = $File['third_id'];
			}


			return View::make(
				'Fantasy.fms.file_edit',
				[
					'File' => $File,
					'file_path' => $file_path,
					'count_file' => $count_file,
					'file_type' => $file_type,
					'file_path_for_edit' => $file_path_for_edit,
					'new_file_path_for_edit' => $new_file_path_for_edit,
					'folder_data' => $folder_data,
					'owner' => $owner,
					'all_owner' => $all_owner,
					'last_edit_user' => $last_edit_user,
					'area_title' => 'FILE EDIT 檔案編輯',
					'area_detail' => '檔案',
				]
			);
		}
	}

	public function get_folder_detail($branch, $locale, $folder_type, $folder_id)
	{
		if ($folder_type == 1) {
			$folder = FmsFirst::where('id', $folder_id)->first();
			$f0 = FmsZero::where('id', $folder['zero_id'])->first();
			$file_path = $f0['title']. ' / ' . $folder['title'];

			$count_file = FmsFile::where('first_id', $folder_id)->count();
			$folder_size = FmsFile::where('first_id', $folder_id)->sum('size');
		} elseif ($folder_type == 2) {
			$folder = FmsSecond::where('id', $folder_id)
				->with('FmsFirst')
				->first();
			$f0 = FmsZero::where('id', $folder->FmsFirst['zero_id'])->first();
			$file_path = $f0['title']. ' / ' . $folder->FmsFirst['title'] . ' / ' . $folder['title'];

			$count_file = FmsFile::where('second_id', $folder_id)->count();
			$f_folder_size = FmsFile::where('first_id', $folder->FmsFirst['id'])->sum('size');
			$s_folder_size = FmsFile::where('second_id', $folder_id)->sum('size');
			$folder_size = $f_folder_size + $s_folder_size;
		} elseif ($folder_type == 3) {
			$folder = FmsThird::where('id', $folder_id)
				->with('FmsSecond')
				->first();
			$f_folder = FmsFirst::where('id', $folder->FmsSecond['first_id'])->first();
			$f0 = FmsZero::where('id', $f_folder['zero_id'])->first();
			$file_path = $f0['title']. ' / '  . $f_folder['title'] . ' / ' . $folder->FmsSecond['title'] . ' / ' . $folder['title'];

			$count_file = FmsFile::where('third_id', $folder_id)->count();
			$f_folder_size = FmsFile::where('first_id', $f_folder['id'])->sum('size');
			$s_folder_size = FmsFile::where('second_id', $folder->FmsSecond['id'])->sum('size');
			$t_folder_size = FmsFile::where('third_id', $folder_id)->sum('size');
			$folder_size = $f_folder_size + $s_folder_size + $t_folder_size;
		}
		if (!$folder) {
			return 0;
		} else {
			$folder['_this_size'] = BaseFunction::cvt_file_size($folder_size);

			$folder['resolution'] = 'x';
			$file_type['title'] = '資料夾';
			$file_type['img'] = '/vender/assets/img/folder.png';
			$owner = FantasyUsers::where('id', $folder['created_user'])->first();

			return View::make(
				'Fantasy.fms.file_detail',
				[
					'File' =>  $folder,
					'file_path' =>  $file_path,
					'count_file' =>  $count_file,
					'file_type' =>  $file_type,
					'folder_type' => $folder_type,
					'owner' =>  $owner,
					'area_title' => 'FOLDER INFORMATION 資料夾資訊',
					'area_detail' => '資料夾',
				]
			);
		}
	}
	public function get_folder_edit($branch, $locale, $folder_type, $folder_id)
	{
		$all_owner = FantasyUsers::where('is_active', '1')->get();

		if ($folder_type == 1) {
			$folder = FmsFirst::where('id', $folder_id)->first();
			$f0 = FmsZero::where('id', $folder['zero_id'])->first();
			$file_path = $f0['title']. ' / ' .$folder['title'];

			$count_file = FmsFile::where('first_id', $folder_id)->count();
			$folder_size = FmsFile::where('first_id', $folder_id)->sum('size');
		} elseif ($folder_type == 2) {
			$folder = FmsSecond::where('id', $folder_id)
				->with('FmsFirst')
				->first();
			$f0 = FmsZero::where('id', $folder->FmsFirst['zero_id'])->first();
			$file_path = $f0['title']. ' / ' .$folder->FmsFirst['title'] . ' / ' . $folder['title'];

			$count_file = FmsFile::where('second_id', $folder_id)->count();
			$f_folder_size = FmsFile::where('first_id', $folder->FmsFirst['id'])->sum('size');
			$s_folder_size = FmsFile::where('second_id', $folder_id)->sum('size');
			$folder_size = $f_folder_size + $s_folder_size;
		} elseif ($folder_type == 3) {
			$folder = FmsThird::where('id', $folder_id)
				->with('FmsSecond')
				->first();
			$f_folder = FmsFirst::where('id', $folder->FmsSecond['first_id'])->first();
			$f0 = FmsZero::where('id', $f_folder['zero_id'])->first();
			$file_path = $f0['title']. ' / ' .$f_folder['title'] . ' / ' . $folder->FmsSecond['title'] . ' / ' . $folder['title'];

			$count_file = FmsFile::where('third_id', $folder_id)->count();
			$f_folder_size = FmsFile::where('first_id', $f_folder['id'])->sum('size');
			$s_folder_size = FmsFile::where('second_id', $folder->FmsSecond['id'])->sum('size');
			$t_folder_size = FmsFile::where('third_id', $folder_id)->sum('size');
			$folder_size = $f_folder_size + $s_folder_size + $t_folder_size;
		}
		$isdelete = self::check_user( $folder['created_user']);
		if( $isdelete){
			if (!$folder) {
				return 0;
			} else {
				if ($folder_size > 1048576) {
					$folder['_this_size'] = round($folder_size / 1048576, 2) . ' MB';
				} else {
					$folder['_this_size'] = round($folder_size / 1024, 2) . ' KB';
				}
				$folder['resolution'] = 'x';
				$file_type['title'] = '資料夾';
				$file_type['img'] = '/vender/assets/img/folder.png';
				$owner = FantasyUsers::where('id', $folder['created_user'])->first();
                $last_edit_user = FantasyUsers::where('id', $folder['last_edit_user'])->first();

                //路徑
                if ($folder_type == 1) {
                    $ThisFolder = FmsFirst::whereId($folder_id)->with('FmsZero')->first();
                    $file_path_for_edit = $ThisFolder['FmsZero']['title'];
                } else if ($folder_type == 2) {
                    $ThisFolder = FmsSecond::whereId($folder_id)->with('FmsFirst.FmsZero')->first();
                    $file_path_for_edit = $ThisFolder['FmsFirst']['FmsZero']['title'] . ' / ' . $ThisFolder['FmsFirst']['title'];
                } else if ($folder_type == 3) {
                    $ThisFolder = FmsThird::whereId($folder_id)->with('FmsSecond.FmsFirst.FmsZero')->first();
                    $file_path_for_edit = $ThisFolder['FmsSecond']['FmsFirst']['FmsZero']['title'] . ' / ' . $ThisFolder['FmsSecond']['FmsFirst']['title'] . ' / ' . $ThisFolder['FmsSecond']['title'];
                }
                $new_file_path_for_edit = FmsZero::where('is_active', '1')
                                        ->with(['FmsFirst' => function ($query) use ($folder_type, $folder_id){
                                            $query->when($folder_type == 1, function ($query) use ($folder_id) {
                                                    $query->whereNotIn('id', [$folder_id]);
                                                })
                                                ->with(['FmsSecond' => function ($q) use ($folder_type, $folder_id){
                                                    $q->when($folder_type == 2, function ($query) use ($folder_id) {
                                                        $query->whereNotIn('id', [$folder_id]);
                                                    })->with('FmsThird');
                                            }]);
                                        }])
                                        ->get()->toarray();               

				return View::make(
					'Fantasy.fms.folder_edit',
					[
						'File' => $folder,
						'file_path' => $file_path,
						'count_file' => $count_file,
						'file_type' => $file_type,
						'all_owner' => $all_owner,
						'folder_type' => $folder_type,
						'last_edit_user' => $last_edit_user,
						'owner' => $owner,
						'area_title' => 'FOLDER EDIT 資料夾編輯',
						'area_detail' => '資料夾',
                        'new_file_path_for_edit' => $new_file_path_for_edit,
                        'file_path_for_edit' => $file_path_for_edit,
					]
				);
			}
		}else{
				return 'not_user';
		}
    }
    
	public function get_folder_add($branch, $locale, $folder_level, $folder_id)
	{
		$File = ['id' => '0', 'title' => '未命名資料夾', 'share_group' => '', 'note' => '', 'level' => $folder_level, 'folder_id' => $folder_id];
		$folder_type = $folder_level;
		$owner = Session::get('fantasy_user');
		$all_owner = FantasyUsers::where('is_active', '1')->get();


		//路徑
		$file_path ='';
		$new_file_path_for_edit = FmsZero::where('is_active', '1')->with([
							'FmsFirst' => function($query) {
								$query->with('FmsSecond');
							}])
							->get()->toArray();


		$file_type['title'] = '資料夾';
        $file_type['img'] = '/vender/assets/img/folder.png';
        
		if ($folder_type == '0' || $folder_type == '3') {
			$folder_type = '0';
        }
        
        if ($folder_type == 1) {
            $ThisFolder = FmsFirst::whereId($folder_id)->with('FmsZero')->first();
            $file_path_for_edit = $ThisFolder['FmsZero']['title'] . ' / ' . $ThisFolder['title'];
        } else if ($folder_type == 2) {
            $ThisFolder = FmsSecond::whereId($folder_id)->with('FmsFirst.FmsZero')->first();
            $file_path_for_edit = $ThisFolder['FmsFirst']['FmsZero']['title'] . ' / ' . $ThisFolder['FmsFirst']['title'] . ' / ' . $ThisFolder['title'];
        } else if ($folder_type == 3) {
            $ThisFolder = FmsThird::whereId($folder_id)->with('FmsSecond.FmsFirst.FmsZero')->first();
            $file_path_for_edit = $ThisFolder['FmsSecond']['FmsFirst']['FmsZero']['title'] . ' / ' . $ThisFolder['FmsSecond']['FmsFirst']['title'] . ' / ' . $ThisFolder['FmsSecond']['title'] . ' / ' . $ThisFolder['title'];
        }else{
            $file_path_for_edit = '';
        }

		return View::make(
			'Fantasy.fms.folder_edit',
			[
				'File' => $File,
				'file_path' => $file_path,
				// 'count_file' => $count_file,
				'folder_id' => $folder_id,
				'folder_type' => $folder_type,
				'file_type' => $file_type,
				'file_path_for_edit' => $file_path_for_edit,
				'new_file_path_for_edit' => $new_file_path_for_edit,
				// 'folder_data' => $folder_data,
				'owner' => $owner,
				'all_owner' => $all_owner,
				'area_title' => 'FILE EDIT 檔案編輯',
				'area_detail' => '檔案',
			]
		);
	}
	public function get_file_type($f_extension)
	{
		$f_extension = strtolower($f_extension);
		return Config::get('fms.mime_type_info.' . Config::get('fms.mime_type.' . $f_extension, 'default'));
	}

	// 若上傳的為圖檔，則回傳縮圖路徑
	public static function get_thumbnail($folder, $name, $ext)
	{

        $file_path = public_path() . $folder . '/' . $name . '.' . $ext;
        
		// 判斷檔案是否存在
		if (file_exists($file_path)) {
			// 判斷檔案是否為圖檔，若不是圖檔回傳空值，否則產生縮圖後回傳路徑
            $file_type = mime_content_type($file_path);
            
            if($file_type == 'image/svg+xml' || $file_type == 'svg' ){
                return $folder . '/' . $name . '.' . $ext;
            }

			if (Config::get('fms.mime_type.' . $file_type, '') !== 'image') return '';
			else {
				$img = Image::make($file_path);
				$new_img = $folder . '/' . $name . '_m.' . $ext;

				// 上傳圖檔尺寸
				$w = $img->width();
				$h = $img->height();

				// 縮圖尺寸
				$tw = Config::get('fms.thumbnail.width');
				$th = Config::get('fms.thumbnail.height');

				// 產生縮圖
				if ($w == $h) $img->resize($tw, $th)->save(public_path() . $new_img);
				else if ($w > $h) $img->resize($tw, floor($h * $tw / $w))->save(public_path() . $new_img);
				else $img->resize(floor($w * $th / $h), $th)->save(public_path() . $new_img);

				return $new_img;
			}
		} else {
			return '';
		}
	}

	public function check_user($file_user_id)
	{
		$user = Session::get('fantasy_user');
		if ($file_user_id == $user['id'] || $user['fms_admin'] == '1') {
			return true;
		} else {
			return false;
		}
	}

	public function getSontableMultiImage(Request $request)
	{
		$data = $request->all();

		$file = FmsFile::whereIn('id', json_decode($data['file_id']))->with('FmsFirst', 'FmsSecond', 'FmsThird')->get();

		foreach ($file as $value) {
			$value['randomCode'] = Str::random(5);
			$value['this_file_path'] = BaseFunction::get_file_path($value);
		}

		return response()->json(array(
			'file' => $file,
			'data' => $data,
		));
	}
}
