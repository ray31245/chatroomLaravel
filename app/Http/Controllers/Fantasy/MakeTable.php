<?php 
namespace App\Http\Controllers\Fantasy;

use Illuminate\Routing\Controller as BaseController;

use Config;
use BaseFunction;
use View;
use Illuminate\Support\Arr;

class MakeTable extends BackendController {
	
	/*列表Table*/
	public static function listTable($set = [])
	{
		
		$isEdit = (isset($set['isEdit'])) ? $set['isEdit'] : 1;
		$isDelete = (isset($set['isDelete'])) ? $set['isDelete'] : 1;
		$isCreate = (isset($set['isCreate'])) ? $set['isCreate'] : 1;
		$isSearch = (isset($set['isSearch'])) ? $set['isSearch'] : 1;
        $isClone = (isset($set['isClone'])) ? $set['isClone'] : 0;
        $isFMS = (isset($set['isFMS'])) ? $set['isFMS'] : 1;
        $isExport = (isset($set['isExport'])) ? $set['isExport'] : 0;
        $exportName = (isset($set['exportName'])) ? $set['exportName'] : '';
        $tableSet = (!empty($set['tableSet'])) ? $set['tableSet'] : [];
        $page = (isset($set['page'])) ? $set['page'] : 1;
        $pn = (isset($set['pn'])) ? $set['pn'] : 1;
        $search = (!empty($set['search'])) ? $set['search'] : [];
        $modelName = $set['modelName'];
        $data = $set['data'];
        /*能否開內容頁的class*/
        if($isEdit == 1)
        {
        $editClass = 'open_builder';
        }
        else
        {
        $editClass = '';
        }

        /*將搜尋條件放在頁面上以供使用*/
        foreach ($search as $key => $value){
            print('<input type="hidden" class="searchRulesSet" data-type="'.$value['type'].'" data-name="'.$key.'" data-value="'.$value['value'].'">');
        }

		/*列表組成並Print*/
		print('	<div class="card-header cms-index_table" data-edit="'.$isEdit.'" data-delete="'.$isDelete.'" data-create="'.$isCreate.'" data-model="'.$modelName.'" data-page="'.$page.'" data-pn="'.$pn.'">
                       <div class="subtitle">');
                       
		/*按鈕群*/
        print('<ul class="btn-group">');
		/*是否有新增權限*/
		if($isCreate == 1)
		{
			print('	<li style="background-color: #10cfbd;" class="createBtn" data-model="'.$modelName.'">
                      	<a href="javascript:void(0)">
                        	<span class="fa fa-plus"></span>
                      	</a>
                    </li>');
		}
		/*是否有刪除權限*/
		if($isDelete == 1)
		{
			print('	<li style="background-color: #464646;">
                      <a href="javascript:void(0)" class="remove-data-btn" data-model="'.$modelName.'">
                        <span class="fa fa-trash"></span>
                      </a>
                    </li>');
		}
        /*是否有需要搜尋*/
        if($isSearch == 1)
        {
            print('	    <li style="background-color: #000000;">
                        <a href="javascript:void(0)" class="searchBtn" data-model="'.$modelName.'">
                            <span class="fa fa-search"></span>
                        </a>
                        </li>');
        }
        /*是否有需要匯出*/
        if($isExport == 1)
        {
            print('	    <li style="background-color: #4D938E;">
                        <a href="'. BaseFunction::f_url("Excel/".$exportName).'" target="_blank" class="ExportBtn" data-model="'.$modelName.'" title="匯出所有資料">
                            <span class="fa fa-file-excel-o"></span>
                        </a>
                    </li>
                    <li style="background-color: #4D938E;">
                        <a href="javacript:void(0)" target="" class="ExportBtnSrh" data-model="'.$modelName.'" title="下載搜尋結果">
                        <span class="fa fa-download"></span>
                        </a>
                    </li>');
        }
        /*是否有需要複製*/
        if($isClone == 1)
        {
            print('	    <li style="background-color: #000000;">
                        <a href="javascript:void(0)" class="cloneBtn" data-model="'.$modelName.'">
                            <span class="fa fa-copy"></span>
                        </a>
                        </li>');
        }
        /*列表FMS*/
        if ($isFMS == 1) {
        print('     <li style="background-color: #775bc2;">
                        <a href="javascript:void(0)" class="lbox_fms_open" data-model="' . $modelName . '" title="FMS 檔案管理">
                            <span class="fa fa-folder-open"></span>
                        </a>
                        </li>');
        }
        print('</ul>');
		/*按鈕群END*/
		/*右左滑動按鈕*/
		print(' <div class="arrow-group">
                    <div class="text">
                      	<p>SLIDE TABLE</p>
                    </div>
                    <div class="arrow">
                      	<span class="left fa fa-long-arrow-left"></span>
                      	<span class="right fa fa-long-arrow-right"></span>
                    </div>
                </div>');
		/*右左滑動按鈕END*/
		print('		</div>
            </div>');
		/*table*/
		print('	<div class="card-block">
              <table class="table table-hover">');
		/*thead + 下拉選單*/
		print('	<thead>
              <tr>
                <th style="width:20px" class="text-center menu-list">
                  <button class="btn btn-link">
                    <i class="pg-unordered_list"></i>
                  </button>
                  <div class="dropdown dropdown-default">
                    <a class="btn dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">
                      <i class="icon pg-unordered_list"></i>
                      <p>Default</p>
                    </a>
                    <ul class="dropdown-menu">');
        if ($isDelete == 1) {
            print('         <li>
                                <a class="dropdown-item remove-data-btn" href="javascript:void(0)" data-toggle="modal" data-target="#batch-modify" to-do="delete" data-model="'.$modelName.'">
                                <p>刪除</p>
                                </a>
                            </li>');
        }
        if($isCreate == 1){
            // print('           <li>
            //                     <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#batch-modify" to-do="copy">
            //                       <p>複製</p>
            //                     </a>
            //                   </li>');
        }
        if($isEdit == 1){
            // print('           <li>
            //                     <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#batch-modify" to-do="batch">
            //                       <p>批次修改</p>
            //                     </a>
            //                   </li>');
        }
        print('         </ul>
                    </div>
                    </th>');

        /*標頭*/
        foreach ($tableSet as $key => $value){
            $width = (!empty($value['width'])) ? $value['width'] : 100;
            print('<th style="width:'.$width.'px;">'.$value['title'].'</th>');
        }

        print('		</tr>
            </thead>');
        /*thead END*/

        /*先組擋案(圖片)真實路徑Array 以免進行多次sql查詢拖慢網頁速度*/
        $fileRouteArray = [];
        $fileIds = [];
        foreach ($data as $key => $value) {
            foreach ($tableSet as $key2 => $value2) {
                if($value2['type'] == 'text_image'){
                    array_push($fileIds, $value[ $value2['img'] ]);
                }
            }
        }

        if(!empty($fileIds)){
            $fileRouteArray = BaseFunction::getFilesArray($fileIds);
        }
        // dd($fileRouteArray);
        /*End*/

        /*tbody Start*/
        print('<tbody>');
        foreach ($data as $key => $value){
            /*Data-Tr*/
            print('<tr class="check-box-index" data-id="'.$value['id'].'" data-model="'.$modelName.'">');

            /*checkBox*/
            print(' <td class="v-align-middle">
                        <div class="checkbox text-center">
                        <input type="checkbox" value="3" id="checkbox1" class="input_number">
                        <label for="checkbox1" class="no-padding no-margin">
                            <span></span>
                        </label>
                        </div>
                    </td>');

            /*Data-content*/
            foreach ($tableSet as $key2 => $value2){

                if($value2['type'] == 'text'){
                    print('<td class="v-align-middle '.$editClass.'" data-id="'.$value['id'].'" data-model="'.$modelName.'">
                                <div class="box text">
                                <p>'.$value[ $value2['columns'] ].'</p>
                                </div>
                            </td>');
                }

                else if($value2['type'] == 'text_image'){
                    /*從array中得真實路徑*/
                    if( isset( $fileRouteArray[ $value[ $value2['img'] ] ] ) )
                    {
                        if(!empty($fileRouteArray[ $value[ $value2['img'] ] ]['real_route'])){
                            $fileSrc = $fileRouteArray[ $value[ $value2['img'] ] ]['real_route'];
                        }
                        else{
                            $fileSrc = '/vendor/assets/img/demo/NoImage.png';
                        }
                    }
                    else{
                        $fileSrc = '/vendor/assets/img/demo/NoImage.png';
                    }
                    print('<td class="v-align-middle '.$editClass.'" data-id="'.$value['id'].'" data-model="'.$modelName.'">
                                <div class="box text_pic">
                                <img src="'.$fileSrc.'" alt="">
                                <p>'.$value[ $value2['columns'] ].'</p>
                                </div>
                            </td>');
                }

                else if($value2['type'] == 'select'){
                    $keyName='';
                    /*串出option值*/
                    foreach ($value2['options'] as $key3 => $value3) 
                    {
                        if( $value3['key'] == $value[ $value2['columns'] ] )
                        {
                        $keyName = $value3['title'];
                        }
                    }
                    print(' <td class="v-align-middle '.$editClass.'" data-id="'.$value['id'].'" data-model="'.$modelName.'">
                                <div class="box multi">
                                <p>'.$keyName.'</p>
                                </div>
                            </td>');

                } 
                
                else if ($value2['type'] == 'selectMulti') {
                    $keyName = '';
                    if (!empty(json_decode($value[$value2['columns']]))) {
                        $_this_ids = json_decode($value[$value2['columns']]);
                        /*串出option值*/
                        foreach ($value2['options'] as $key3 => $value3) {
                            if (in_array($value3['key'], $_this_ids)) {
                                $keyName .= ($keyName != '') ? '、' . $value3['title'] : $value3['title'];
                            }
                        }
                    }
                    print(' <td class="v-align-middle ' . $editClass . '" data-id="' . $value['id'] . '" data-model="' . $modelName . '">
                            <div class="box multi">
                            <p>' . $keyName . '</p>
                            </div>
                        </td>');
                }

                else if($value2['type'] == 'radio'){

                    print(' <td class="v-align-middle">
                                <div class="box multi">
                                <ul class="radio_group">');
                                
                    foreach ($value2['group'] as $key3 => $value3){
                        if($value[ $value3['columns'] ] == 1){
                            print('<li class="ch" data-id="'.$value['id'].'" data-model="'.$modelName.'" data-column="'.$value3['columns'].'">');
                        }
                        else{
                            print('<li data-model="'.$modelName.'" data-column="'.$value3['columns'].'" data-id="'.$value['id'].'">');
                        }

                        print('   <p>'.$value3['icon'].'</p>
                                </li>');
                    }
                    print('     </ul>
                                </div>
                            </td>');
                }
            }
            print('</tr>');
        }
        print('     </tbody>
                </table>');

        /*頁碼*/
        print('   <ul class="page_foot">');

        if($page != 1 AND $pn != 1){
        print('   <li class="pn_btn" data-type="last">
                    <span class="ibtn pg-arrow_left"></span>
                    </li>');
        }

        for ($i = 1; $i <= $pn; $i++){ 
            if($page == $i){
                $now = 'now';
            }
            else{
                $now = '';
            }
            print('   <li class="page_btn pn_btn '.$now.'" data-page="'.$i.'" data-type="page">
                        <p>'.$i.'</p>
                        </li>');
        }

        if($page != $pn){
        print('   <li class="pn_btn" data-type="next">
                    <span class="ibtn pg-arrow_right"></span>
                    </li>');
        }
        
        print('   </ul>');
        /*頁碼END*/
        print(' </div>');
    }

    /*列表NewTable*/
    public static function listNewTable($set = [])
    {
        $isLink = (isset($set['isLink'])) ? $set['isLink'] : "";
        $isClone = (isset($set['isClone'])) ? $set['isClone'] : 0;
        $isFMS = (isset($set['isFMS'])) ? $set['isFMS'] : 1;
        $isExport = (isset($set['isExport'])) ? $set['isExport'] : 0;
        $isExport2 = (isset($set['isExport2'])) ? $set['isExport2'] : 0;
        $exportName = (isset($set['exportName'])) ? $set['exportName'] : '';
        
        $isEdit = (isset($set['isEdit'])) ? $set['isEdit'] : 1;
        $isDelete = (isset($set['isDelete'])) ? $set['isDelete'] : 1;
        $isCreate = (isset($set['isCreate'])) ? $set['isCreate'] : 1;
        $tableSet = (!empty($set['tableSet'])) ? $set['tableSet'] : [];
        $page = (isset($set['page'])) ? $set['page'] : 1;
        $search = (!empty($set['search'])) ? $set['search'] : [];
        $modelName = $set['modelName'];
        $isSearch = (isset($set['isSearch'])) ? $set['isSearch'] : 1;

        $pageTitle = (isset($set['pageTitle'])) ? $set['pageTitle'] : '';
        $pageId = (isset($set['pageId'])) ? $set['pageId'] : '';
        $pageIntroduction = (isset($set['pageIntroduction'])) ? $set['pageIntroduction'] : '';
        $hasAuth = (isset($set['hasAuth'])) ? $set['hasAuth'] : 0;
        $QuickSearch = (isset($set['QuickSearch'])) ? $set['QuickSearch'] : '';
        /*能否開內容頁的class*/
        $editClass = $isEdit == 1 ? 'open_builder' : '';

        if ($modelName == 'CmsMenu') {
            $info = parent::getDataNew($modelName, 0, $page, $search, 1000, $pageId);
        } else {
            $info = parent::getDataNew($modelName, $hasAuth, $page, $search, Config::get('cms.pageSize', 10), $pageId);
        }

        $count = $info['count'];
        $data = $info['data'];
        $pn = (isset($info['pn'])) ? $info['pn'] : 1;

        $fileRouteArray = [];
        $fileIds = [];
        foreach ($data as $key => $value) {
            foreach ($tableSet as $key2 => $value2) {
                if ($value2['type'] == 'text_image') {
                    array_push($fileIds, $value[$value2['img']]);
                }
            }
        }
        if (!empty($fileIds)) {
            $fileRouteArray = BaseFunction::getFilesArray($fileIds);
        }

        $fantasyUser = Arr::pluck(config('models.FantasyUsers')::all()->toarray(), 'name','id');
        
        $html =  View::make('Fantasy.cms.includes.makeTable', [
            'isLink'=> $isLink,
            'isClone'=> $isClone,
            'isFMS'=> $isFMS,
            'isExport'=> $isExport,
            'isExport2'=> $isExport2,
            'exportName'=> $exportName,
            'isEdit'=> $isEdit,
            'isDelete'=> $isDelete,
            'isCreate'=> $isCreate,
            'tableSet'=> $tableSet,
            'page'=> $page,
            'search'=> $search,
            'modelName'=> $modelName,
            'isSearch'=> $isSearch,
            'pageTitle'=> $pageTitle,
            'pageIntroduction'=> $pageIntroduction,
            'hasAuth'=> $hasAuth,
            'QuickSearch'=> $QuickSearch,
            'editClass'=> $editClass,
            'info'=> $info,
            'count'=> $count,
            'data'=> $data,
            'pn'=> $pn,
            'fileRouteArray'=> $fileRouteArray,
            'fileIds'=> $fileIds,
            'fantasyUser'=> $fantasyUser,
        ])->render();

        print($html);
    }   

}