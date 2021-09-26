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
    'QuickSearch' => '', //快速搜尋的欄位
    'modelName' => $modelName,
    'isEdit' => $isEdit,
    'isDelete' => 0,
    'isCreate' => 0,
    'isSearch' => 0,
    'isClone' => 0,
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
            "type" => "text",
            "width" => "w_Category",
            'text-center' => false,
            "title" => "副標題",
            "columns" => "title2",
        ],
        // [
        //     "type" => "rank"    
        // ],
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