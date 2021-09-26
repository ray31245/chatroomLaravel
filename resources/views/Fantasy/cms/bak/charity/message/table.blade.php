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
    'QuickSearch' => 'name', //快速搜尋的欄位
    'modelName' => $modelName,
    'isEdit' => $isEdit,
    'isDelete' => 1,
    'isCreate' => 0,
    'isSearch' => 1,
    'isClone' => 0,
    'page' => $page,
    'search' => $search,
    'data' => $data,
    'pn' => $pn,
    //寬度 w_TableMaintitle / w_Category
    'tableSet' => [
        [
            "type" => "select",
            "width" => "w_Category",
            'text-center' => false,
            "title" => "狀態",
            "columns" => "state",
            "options" => Config::get('options.MessageState')
        ],
        [
            'type' => 'select_parent',
            'width' => 'w_Category',
            'text-center' => false,
            'title' => '公益名稱',
            'columns' => 'charity_id',
            'parent' => 'Charity', //父層model關聯
            'parentTitle' => 'title',     //父層欄位
        ], 
        [
            "type" => "text",
            "width" => "w_Category",
            'text-center' => false,
            "title" => "留言者",
            "columns" => "name",
        ],
        [
            "type" => "text",
            "width" => "w_TableMaintitle",
            'text-center' => false,
            "title" => "留言內容",
            "columns" => "message",
        ],
        [
            "type" => "text",
            "width" => "w_TableMaintitle",
            'text-center' => false,
            "title" => "回覆內容",
            "columns" => "reply",
        ],
        // [
        //     "type" => "rank"    
        // ],
        // [
        //     "type" => "preview"         
        // ],
        // [
        //     "type" => "visible"          
        // ],
        // [
        //     "type" => "admin"         
        // ],
        [
            "type" => "text",
            "width" => "w_Category",
            'text-center' => false,
            "title" => "留言時間",
            "columns" => "created_at",
        ],
        [
            "type" => "text",
            "width" => "w_Category",
            'text-center' => false,
            "title" => "最後異動時間",
            "columns" => "updated_at",
        ],
        // [
        //     "type" => "updated"        
        // ],
    ],
])}}