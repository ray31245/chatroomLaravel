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
    'isLink' => '',
    'isEdit' => $isEdit,
    'isDelete' => 0,
    'isCreate' => 0,
    'isSearch' => 0,
    'isClone' => 0,
    'page' => $page,
    'search' => $search,
    'data' => $data,
    'pn' => $pn,
    'isLink' => '/',
    //寬度 w_TableMaintitle / w_Category
    'tableSet' => [
        [
        "type" => "text",
        "width" => "w_TableMaintitle",
        'text-center' => false,
        "title" => "單元名稱",
        "columns" => "Identify_title"
        ], 
        // [
        //     "type" => "rank"    
        // ],
        [
            "type" => "updated"        
        ],
    ],
])}}