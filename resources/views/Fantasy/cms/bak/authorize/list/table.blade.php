
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
    'isDelete' => 1,
    'isCreate' => 1,
    'isSearch' => true,
    'isClone' => true,
    'page' => $page,
    'search' => $search,
    'data' => $data,
    'pn' => $pn,
    //寬度 w_TableMaintitle / w_Category
    'tableSet' => [
        [
            "type" => "text_image",
            "width" => "w_TableMaintitle",
            'text-center' => false,
            "title" => "標題",
            "columns" => "title",
            "img" => "img"
        ],
        [
            'type' => 'select_parent',
            'width' => 'w_Category',
            'text-center' => false,
            'title' => '授權分類',
            'columns' => 'category2_id',
            'parent' => 'AuthorizeCategory2', //父層model關聯
            'parentTitle' => 'title',     //父層欄位
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