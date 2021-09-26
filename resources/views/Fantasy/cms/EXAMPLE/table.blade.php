{{TableMaker::listNewTable([
    'menuList' => isset($menuList) ? $menuList : "",
    'viewRoute' => isset($viewRoute) ? $viewRoute : "",
    'pageKey' => isset($pageKey) ? $pageKey : "",
    'need_Review' => isset($need_Review) ? $need_Review : "",
    'can_Review' => isset($can_Review) ? $can_Review : "",
    'pageTitle' => $pageTitle,  //標題
    'pageId' => $pageId,  
    'pageIntroduction' => '',
    'hasAuth' => $hasAuth, 
    'QuickSearch' => 'title', //快速搜尋的欄位
    'modelName' => $modelName,
    'isEdit' => $isEdit,
    'isDelete' => $isDelete,
    'isCreate' => $isCreate,
    'isSearch' => true,
    'isClone' => true,
    'page' => $page,
    'search' => $search,
    'data' => $data,
    'pn' => $pn,
    //寬度 w_TableMaintitle / w_Category
    'tableSet' => [
        [
            "type" => "text",
            "width" => "w_TableMaintitle",
            'text-center' => false,
            "title" => "標題",
            "columns" => "title",
        ],
        [
            "type" => "rank"    
        ],
        [
            "type" => "preview"         
        ],
        [
            "type" => "visible"          
        ],
        [
            "type" => "admin"         
        ],
        [
            "type" => "updated"        
        ],
    ],
])}}