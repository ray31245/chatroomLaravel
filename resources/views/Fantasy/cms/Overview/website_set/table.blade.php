{{TableMaker::listNewTable([
  // 新欄位
  'pageTitle' => $pageTitle,
  'pageIntroduction' => '',
  'hasAuth' => $hasAuth, 
  'QuickSearch' => '', //快速搜尋的欄位
  // 新欄位END
  'modelName' => $modelName,
  'isEdit' => $isEdit,
  'isDelete' => 0,
  'isCreate' => 0,
  'isSearch' => false,
  'isClone' => false,
  'page' => $page,
  'search' => $search,
  'data' => $data,
  'pn' => $pn,
  //寬度 w_TableMaintitle / w_Category
  'tableSet' => [     
    [
        "type" => "none",
        "width" => "w_TableMaintitle",
        'text-center' => false,
        "title" => "標題",
        "columns" => "title"
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
    [
        "type" => "admin"         
    ],
    [
        "type" => "updated"        
    ],
  ],
])}}

