@php
    $article_options = [
        // 樣式
        'Style' => [
            '_article'=> ["title" => "基本段落樣式，由上至下排列，依序為主標題 > 影像+描述 > 副標題 > 內文＋按鈕。","key" => '_article'],
            // '_articleSL'=> ["title" => "由上至下排列，依序為主標題 > 影像+描述 > 副標題置左 > 內文＋按鈕置右。","key" => '_articleSL'],
            // '_articleSR'=> ["title" => "由上至下排列，依序為主標題 > 影像+描述 > 副標題置右 > 內文＋按鈕置左。","key" => '_articleSR'],

            '_articleU'=> ["title" => "由上至下排列，依序為主標題 > 副標題 > 內文＋按鈕 > 影像+描述。","key" => '_articleU'],
            // '_articleUL'=> ["title" => "由上至下排列，依序為主標題置左 > 副標題 + 內文＋按鈕置右 > 影像+描述。","key" => '_articleUL'],
            // '_articleUR'=> ["title" => "由上至下排列，依序為主標題置右 > 副標題 + 內文＋按鈕置左 > 影像+描述。","key" => '_articleUR'],

            '_articleD'=> ["title" => "由上至下排列，依序為影像+描述 > 主標題 > 副標題 > 內文＋按鈕。","key" => '_articleD'],
            // '_articleDL'=> ["title" => "由上至下排列，依序為影像+描述 > 主標題置左 > 副標題 + 內文＋按鈕置右。","key" => '_articleDL'],
            // '_articleDR'=> ["title" => "由上至下排列，依序為影像+描述 > 主標題置右 > 副標題 + 內文＋按鈕置左。","key" => '_articleDR'],

            '_articleL'=> ["title" => "依序為主標題 + 副標題 + 內文＋按鈕置左 > 影像+描述置右。","key" => '_articleL'],
            '_articleLR'=> ["title" => "依序為主標題 + 副標題 + 內文＋按鈕置左圍繞影像+描述置右。","key" => '_articleLR'],
            '_articleR'=> ["title" => "依序為影像+描述置左 > 主標題 + 副標題 + 內文＋按鈕置右。","key" => '_articleR'],
            '_articleRR'=> ["title" => "依序為主標題 + 副標題 + 內文＋按鈕置右圍繞影像+描述置左。","key" => '_articleRR'],

            '_article -typeFull'=> ["title" => "滿版背景，段落垂直置中，由上至下依序為主標題 > 影像+描述 > 副標題 > 內文＋按鈕。","key" => '_article -typeFull'],
            '_article -typeFull-L'=> ["title" => "滿版背景，段落垂直置左，由上至下依序為主標題 > 影像+描述 > 副標題 > 內文＋按鈕。","key" => '_article -typeFull-L'],
            '_article -typeFull-R'=> ["title" => "滿版背景，段落垂直置右，由上至下依序為主標題 > 影像+描述 > 副標題 > 內文＋按鈕。","key" => '_article -typeFull-R'],

            '_article -typeFull-Box'=> ["title" => "滿版背景並使段落區塊中的內文區域產生色塊，段落垂直置中，由上至下依序為主標題 > 影像+描述 > 副標題 > 內文＋按鈕。","key" => '_article -typeFull-Box'],
            '_article -typeFull-Box-L'=> ["title" => "滿版背景並使段落區塊中的內文區域產生色塊，段落垂直置左，由上至下依序為主標題 > 影像+描述 > 副標題 > 內文＋按鈕。","key" => '_article -typeFull-Box-L'],
            '_article -typeFull-Box-R'=> ["title" => "滿版背景並使段落區塊中的內文區域產生色塊，段落垂直置右，由上至下依序為主標題 > 影像+描述 > 副標題 > 內文＋按鈕。","key" => '_article -typeFull-Box-R'],

            // '_article -typeFull-BoxSlice'=> ["title" => "滿版背景，區塊預設為左右置中對齊，段落區塊左右置中垂直切割區塊，，由上至下依序為主標題 > 影像+描述 > 副標題 > 內文＋按鈕。","key" => '_article -typeFull-BoxSlice'],
            // '_article -typeFull-BoxSlice-L'=> ["title" => "滿版背景，區塊預設為置左對齊，段落區塊置左垂直切割區塊，由上至下依序為主標題 > 影像+描述 > 副標題 > 內文＋按鈕。","key" => '_article -typeFull-BoxSlice-L'],
            // '_article -typeFull-BoxSlice-R'=> ["title" => "滿版背景，區塊預設為置右對齊，段落區塊置右垂直切割區塊，由上至下依序為主標題 > 影像+描述 > 副標題 > 內文＋按鈕。","key" => '_article -typeFull-BoxSlice-R'],

            '_article -typeSwiper-L'=> ["title" => "設定段落為 Swiper 模式，段落內容由左至右依序為影像 > 主標題＋副標題＋內文＋按鈕","key" => '_article -typeSwiper-L'],
            '_article -typeSwiper-R'=> ["title" => "設定段落為 Swiper 模式，段落內容由左至右依序為主標題＋副標題＋內文＋按鈕 > 影像","key" => '_article -typeSwiper-R'],

            // '_article -typeOverlap-LU'=> ["title" => "段落區塊由上至下編排，依序為影像*2-大圖置左小圖置右下 > 主標題 > 副標題 > 內文 > 按鈕","key" => '_article -typeOverlap-LU'],
            // '_article -typeOverlap-LD'=> ["title" => "段落區塊由上至下編排，依序為主標題 > 副標題 > 內文 > 按鈕 > 影像*2-大圖置左小圖置右上","key" => '_article -typeOverlap-LD'],
            // '_article -typeOverlap-RU'=> ["title" => "段落區塊由上至下編排，依序為影像*2-大圖置右小圖置左下 > 主標題 > 副標題 > 內文 > 按鈕","key" => '_article -typeOverlap-RU'],
            // '_article -typeOverlap-RD'=> ["title" => "段落區塊由上至下編排，依序為影像*2-大圖置右小圖置左上 > 主標題 > 副標題 > 內文 > 按鈕","key" => '_article -typeOverlap-RD'],
        ],

        // 標題對齊設定
        'AlignHorizontal4Title' => [
            'center'=> ["title" => "置中","key" => 'center'],
            'left'=> ["title" => "靠左對齊","key" => 'left'],
            'right'=> ["title" => "靠右對齊","key" => 'right'],
        ],

        // 副標題對齊設定
        'AlignHorizontal4SubTitle' => [
            'center'=> ["title" => "置中","key" => 'center'],
            'left'=> ["title" => "靠左對齊","key" => 'left'],
            'right'=> ["title" => "靠右對齊","key" => 'right'],
        ],

        // 內文區塊對齊設定
        'AlignHorizontal4Text' => [
            'center'=> ["title" => "置中","key" => 'center'],
            'left'=> ["title" => "靠左對齊","key" => 'left'],
            'right'=> ["title" => "靠右對齊","key" => 'right'],
        ],

        // 按鈕連結開啟方式
        'LinkType' => [
            '1' => ['key' => '1', 'title' => '本頁開啟'],
            '2' => ['key' => '2', 'title' => '另開新頁'],
        ],

        // 按鈕文字 - 對齊方式
        'AlignHorizontal4BtnText' => [
            // 'center'=> ["title" => "置中","key" => 'center'],
            'left'=> ["title" => "靠左對齊","key" => 'left'],
            // 'right'=> ["title" => "靠右對齊","key" => 'right'],
        ],

        // 按鈕位置 - 對齊方式
        'AlignHorizontal4Btn' => [
            'center'=> ["title" => "置中","key" => 'center'],
            'left'=> ["title" => "靠左對齊","key" => 'left'],
            'right'=> ["title" => "靠右對齊","key" => 'right'],
        ],

        // 影片來源
        'VideoType' =>[
            'youtube'=> ["title" => "YouTube","key" => 'youtube'],
            // 'youku'=> ["title" => "YOUKU","key" => 'youku'],
        ],

        // 圖片每列數量設定
        'isRow4Img'=>[
            'x1'=> ["title" => "一張圖","key" => 'x1'],
            'x2'=> ["title" => "兩張圖","key" => 'x2'],
            'x3'=> ["title" => "三張圖","key" => 'x3'],
            'x4'=> ["title" => "四張圖","key" => 'x4'],
            'x5'=> ["title" => "五張圖","key" => 'x5'],
        ],

        // 圖片比例設定
        'imgSize' => [
            'x11'=> ["title" => "1:1","key" => 'x11'],
            'x34'=> ["title" => "3:4","key" => 'x34'],
            'x43'=> ["title" => "4:3","key" => 'x43'],
            'x169'=> ["title" => "16:9","key" => 'x169'],
        ],

        // 文字與圖片垂直對齊設定
        'AlignVertical4TextWithImg' => [
            'center'=> ["title" => "置中","key" => 'center'],
            'up'=> ["title" => "置上","key" => 'up'],
            'down'=> ["title" => "置下","key" => 'down'],
        ],

        // 圖片垂直對齊設定
        'CommonAlignVertical4Img' => [
            'center'=> ["title" => "置中","key" => 'center'],
            'up'=> ["title" => "置上","key" => 'up'],
            'down'=> ["title" => "置下","key" => 'down'],
        ],

        // 圖片描述文字對齊
        'CommonAlignHorizontal4ImgText' => [
            'center'=> ["title" => "置中","key" => 'center'],
            'left'=> ["title" => "靠左對齊","key" => 'left'],
            'right'=> ["title" => "靠右對齊","key" => 'right'],
        ],

        // 圖片輪播 - 出現圖片數量
        'isRow4Swiper'=>[
            'x1'=> ["title" => "一張圖","key" => '1'],
            'x2'=> ["title" => "兩張圖","key" => '2'],
            'x3'=> ["title" => "三張圖","key" => '3'],
            'x4'=> ["title" => "四張圖","key" => '4'],
            'x5'=> ["title" => "五張圖","key" => '5'],
        ],
        
        // 內文寬度設定
        'fullSize'=>[
            's'=> ["title" => "小","key" => 's'],
            'm'=> ["title" => "中","key" => 'm'],
            'l'=> ["title" => "大","key" => 'l'],
        ],
    ];
@endphp

{{UnitMaker::WNsonTable([
    'sort' => 'yes',//是否可以調整順序
    'teach' => 'no',
    'hasContent' => 'yes', //是否可展開
    'tip' => '文章段落編輯',
    'create' => 'yes', //是否可新增
    'delete' => 'yes', //是否可刪除
    'value' => ( !empty($associationData['son'][$Model]) )? $associationData['son'][$Model] : [],
    'name' => $Model,
    'tableSet' => 
    [
        //tableSet元件        
        [
            'type' => 'select_article4_show',
            'title' => '段落樣式',
            'value' => 'article_style',
            'options' => $article_options['Style'],
			'auto' => true,
        ],
        [
            'type' => 'radio_btn',
            'title' => '是否顯示',
            'value' => 'is_visible',
        ]
    ],
    'tabSet'=>
    [
        [
            'title' => '基本內容編輯',
            'content' => 
            [
                //內容元件												
                [
                    'type' => 'select2',
                    'title' => '段落樣式',
                    'value' => 'article_style',
                    'default' => '',
                    'options' => $article_options['Style'],
                    'article4' => true,
                    'auto' => true,
                ],
                [
                    'type' => 'textInput',
                    'title' => '標題欄位',
                    'value' => 'article_title',
                    'tip' => '單行輸入，內容不支援HTML及CSS、JQ、JS等語法，特殊符號如 : @#$%?/\|*.及全形也盡量避免。'
                ],
                [
                    'type' => 'textInput',
                    'title' => '副標題欄位',
                    'value' => 'article_sub_title',
                    'tip' => '單行輸入，內容不支援HTML及CSS、JQ、JS等語法，特殊符號如 : @#$%?/\|*.及全形也盡量避免。'
                ],
                [
                    'type' => 'textArea',
                    'title' => '內文欄位',
                    'value' => 'article_inner',
                    'tip' => '可輸入多行文字，斷行請多利用Shift+Enter，輸入區域可拖曳右下角縮放，<br>若欲於文字間穿插超連結，請直接寫入 html 語法。'
                ],
                [
                    'type' => 'select2',
                    'empty' => 'yes',
                    'title' => '標題對齊設定',
                    'value' => 'h_align',
                    'tip' => '標題對齊設定，預設為靠左對齊。',
                    'options' => $article_options['AlignHorizontal4Title'],
                ],
                [
                    'type' => 'select2',
                    'empty' => 'yes',
                    'title' => '副標題對齊設定',
                    'value' => 'subh_align',
                    'tip' => '副標題對齊設定，預設為靠左對齊。',
                    'options' => $article_options['AlignHorizontal4SubTitle'],
                ],
                [
                    'type' => 'select2',
                    'empty' => 'yes',
                    'title' => '內文區塊對齊設定 - 左右',
                    'value' => 'p_align',
                    'tip' => '內文區塊左右對齊設定，預設為靠左對齊。',
                    'options' => $article_options['AlignHorizontal4Text'],
                ],                
                [
                    'type' => 'colorPicker',
                    'title' => '標題文字顏色',
                    'value' => 'h_color',
                    'tip' => '標題文字顏色設定，預設為黑色。'
                ], 
                [
                    'type' => 'colorPicker',
                    'title' => '副標題文字顏色',
                    'value' => 'subh_color',
                    'tip' => '副標題文字顏色設定，預設為黑色。'
                ],
                [
                    'type' => 'colorPicker',
                    'title' => '內文文字顏色',
                    'value' => 'p_color',
                    'tip' => '內文文字顏色設定，預設為黑色。'
                ],
            ],
        ],
        [
            'title' => '按鈕設定',
            'content' => 
            [
                [
                    'type' => 'textInput',
                    'title' => '按鈕文字',
                    'value' => 'button',
                    'tip' => '此欄位為選填，單行輸入，內容不支援HTML及CSS、JQ、JS等語法，特殊符號如 : @#$%?/\|*.及全形也盡量避免。'
                ],
                [
                    'type' => 'textInput',
                    'title' => '按鈕連結',
                    'value' => 'button_link',
                    'tip' => '請填入連結網址，此欄位為選填，若未填寫連結則不顯示按鈕。'
                ],
                [
                    'type' => 'select2',
                    'empty' => 'yes',
                    'title' => '按鈕連結開啟方式',
                    'value' => 'link_type',
                    'empty' => 'yes',
                    'options' => $article_options['LinkType'],
                ],         
                [
                    'type' => 'select2',
                    'empty' => 'yes',
                    'title' => '按鈕文字 - 對齊方式',
                    'value' => 'btn_textalign',
                    'tip' => '按鈕文字對齊方式設定。',
                    'options' => $article_options['AlignHorizontal4BtnText'],
                ],                
                [
                    'type' => 'select2',
                    'empty' => 'yes',
                    'title' => '按鈕位置 - 對齊方式',
                    'value' => 'btn_align',
                    'tip' => '按鈕位置對齊方式設定，預設為靠左對齊。',
                    'options' => $article_options['AlignHorizontal4Btn'],
                ],
                [
                    'type' => 'colorPicker',
                    'title' => '按鈕文字 - 顏色',
                    'value' => 'btn_textcolor',
                    'tip' => '按鈕文字顏色設定。'
                ],
                [
                    'type' => 'colorPicker',
                    'title' => '按鈕文字 - hover顏色',
                    'value' => 'btn_textcolor_hover',
                    'tip' => '按鈕文字滑鼠移至顏色設定。'
                ],
                [
                    'type' => 'colorPicker',
                    'title' => '按鈕底色 - 顏色',
                    'value' => 'btn_color',
                    'tip' => '按鈕顏色設定。'
                ],
                [
                    'type' => 'colorPicker',
                    'title' => '按鈕底色 - hover顏色',
                    'value' => 'btn_color_hover',
                    'tip' => '按鈕滑鼠移至顏色設定。'
                ],
                [
                    'type' => 'colorPicker',
                    'title' => '按鈕框線 - 顏色',
                    'value' => 'btn_border',
                    'tip' => '按鈕邊框顏色設定。'
                ],
                [
                    'type' => 'colorPicker',
                    'title' => '按鈕框線 - hover顏色',
                    'value' => 'btn_border_hover',
                    'tip' => '按鈕邊框滑鼠移至顏色設定。'
                ],
            ],
        ],
        [
            'title' => '圖片 / 影片管理',
            'content' => [],
            'is_three' => 'yes',
            'three_model' => $ThreeModel,
            'three' =>
            [
                'title' => '圖片 / 影片管理',
                'tip' => '可設定多張圖片 / 影片的編排格式，其中靠上圖片、靠下圖片、圖片 / 影片的段落類型編排為橫向並排，而文繞圖、靠左圖片、靠右圖片段落類型的編排為重直排列。',
                'SecondIdColumn' => 'second_id', //存放第二層ID的欄位
                'three_content' => 
                [                    
                    [
                        'type' => 'image_group',
                        'title' => '圖片',
                        'tip' => '請選擇圖片，若需多張圖請再增加一筆圖片 / 影片資料。',
                        'image_array' => 
                        [
                            [
                                'title' => '圖片',
                                'value' => 'image',
                                'set_size' => 'no',
                            ]
                        ]
                    ],
                    [
                        'type' => 'textInput',
                        'title' => '圖片描述',
                        'value' => 'title',
                        'tip' => '單行輸入，內容不支援HTML及CSS、JQ、JS等語法，特殊符號如 : @#$%?/\|*.及全形也盡量避免。'
                    ],
                    [
                        'type' => 'select2',
                        'title' => '影片來源',
                        'value' => 'video_type',
                        'options' => $article_options['VideoType'],
                        'tip' => '請務必選擇影片來源，預設為YouTube。'
                    ],
                    [
                        'type' => 'textInput',
                        'title' => 'Youtube影片代碼',
                        'value' => 'video',
                        'tip' => '若來源選擇YouTube，在欄位內輸入Youtube影片網址V後面的英文數字。<br>例：https://www.youtube.com/watch?v=abcdef，請輸入abcdef<br><br>若來源選擇YOUKU，在欄位內輸入YOUKU影片網址/id_後面到==.html前的英文數字。<br>例：https://v.youku.com/v_show/id_abcdef==.html ，請輸入abcdef。'
                    ],

                    [
                        'type' => 'textInput',
                        'title' => 'typeSwiper 專用 - 標題',
                        'value' => 'sw_title',
                        'tip' => '若段落樣式為Swiper模式則段落標題填寫於此，單行輸入，內容不支援HTML及CSS、JQ、JS等語法，特殊符號如 : @#$%?/\|*.及全形也盡量避免。'
                    ],
                    [
                        'type' => 'textArea',
                        'title' => 'typeSwiper 專用 - 內文',
                        'value' => 'content',
                        'tip' => '若段落樣式為Swiper模式則段落內文填寫於此，可輸入多行文字，斷行請多利用Shift+Enter，輸入區域可拖曳右下角縮放，若欲於文字間穿插超連結，請直接寫入 html 語法。'
                    ],
                ]
            ],
        ],       
        [
            'title' => '圖片樣式設定',
            'content' => 
            [	
                
                [
                    'type' => 'radio_btn',
                    'title' => '是否為拼圖模式',
                    'value' => 'is_ex',
                    'tip' => '使用後會隱藏圖片間距及描述，以拼接方式呈現，<br>若段落選擇Swiper模式，或選擇圖片為輪播不適用此規則。'
                ],
                [
                    'type' => 'radio_btn',
                    'title' => '首圖是否放大',
                    'value' => 'is_firstbig',
                    'tip' => '使用後對首圖強制100%放大，<br>若段落選擇Swiper模式，或選擇圖片為輪播不適用此規則。'
                ],
                [
                    'type' => 'select2',
                    'empty' => 'yes',
                    'title' => '圖片每列數量設定',
                    'value' => 'is_row',
                    'tip' => '圖片每列數量設定，預設為一張圖，<br>若段落選擇Swiper模式，或選擇圖片為輪播不適用此規則。',
                    'default' => '',
                    'options' => $article_options['isRow4Img'],
                ],
                [
                    'type' => 'select2',
                    'empty' => 'yes',
                    'title' => '圖片比例設定',
                    'value' => 'img_size',
                    'tip' => '圖片比例設定，預設為依照圖片大小，<br>若設定比例，圖片不足部分將呈現淺灰色底，並將圖片自動置中。',
                    'options' => $article_options['imgSize'],
                ],                
                [
                    'type' => 'select2',
                    'empty' => 'yes',
                    'title' => '文字與圖片垂直對齊設定',
                    'value' => 'article_align',
                    'tip' => '內文區塊上下對齊設定，預設為靠上對齊。',
                    'options' => $article_options['AlignVertical4TextWithImg'],
                ], 
                [
                    'type' => 'select2',
                    'empty' => 'yes',
                    'title' => '圖片垂直對齊設定',
                    'value' => 'img_flex',
                    'tip' => '圖片垂直對齊設定，預設為置上。',
                    'options' => $article_options['CommonAlignVertical4Img'],
                ],               

                [
                    'type' => 'colorPicker',
                    'title' => '圖片描述文字顏色',
                    'value' => 'des_color',
                    'tip' => '圖片描述文字顏色，預設為淺灰色。'
                ],  
                [
                    'type' => 'select2',
                    'empty' => 'yes',
                    'title' => '圖片描述文字對齊',
                    'value' => 'des_align',
                    'tip' => '圖片描述文字對齊，預設為靠左對齊。',
                    'options' => $article_options['CommonAlignHorizontal4ImgText'],
                ],   
                [
                    'type' => 'radio_btn',
                    'title' => '圖片是否為輪播',
                    'value' => 'is_slick',
                    'tip' => '開啟後圖片為輪播方式呈現，需填入圖片輪播相關設定。'
                ],                 
                [
                    'type' => 'select2',
                    'empty' => 'yes',
                    'title' => '圖片輪播 - 出現圖片數量',
                    'value' => 'swiper_num',
                    'tip' => '填寫輪播一次出現圖片數量，若開啟圖片為輪播方式呈現或段落樣式為Swiper模式則必填。',
                    'options' => $article_options['isRow4Swiper'],                    
                ],
                [
                    'type' => 'radio_btn',
                    'title' => '圖片輪播 - 是否開啟自動播放',
                    'value' => 'swiper_autoplay',
                    'tip' => '是否開啟自動播放，若開啟圖片為輪播方式呈現或段落樣式為Swiper模式則必填。'
                ],
                [
                    'type' => 'radio_btn',
                    'title' => '圖片輪播 - 是否啟用左右箭頭按鈕',
                    'value' => 'swiper_arrow',
                    'tip' => '是否啟用左右箭頭按鈕，若開啟圖片為輪播方式呈現或段落樣式為Swiper模式則必填。'
                ],
                [
                    'type' => 'radio_btn',
                    'title' => '圖片輪播 - 是否啟用下方切換選單',
                    'value' => 'swiper_nav',
                    'tip' => '是否啟用下方切換選單，若開啟圖片為輪播方式呈現或段落樣式為Swiper模式則必填。'
                ],
            ],
        ],
        [
            'title' => 'TypeFull / Type Swiper 樣式',
            'content' => 
            [  
                [
                    'type' => 'select2',
                    'title' => '內文寬度設定',
                    'value' => 'full_size',
                    'empty' => 'yes',
                    'tip' => '若段落樣式選擇滿版背景，才需填寫此欄位。',
                    'options' => $article_options['fullSize'],
                ],                
                [
                    'type' => 'colorPicker',
                    'title' => '內文底色設定',
                    'value' => 'full_box_color',
                    'tip' => '若段落樣式選擇滿版背景並使段落區塊中的內文區域產生色塊，才需填寫此欄位。'
                ],
                [
                    'type' => 'colorPicker',
                    'title' => '段落底色設定',
                    'value' => 'article_color',
                    'tip' => '整個段落區塊的背景色，建議選擇Swiper模式式時填寫底色。'
                ],
                [
                    'type' => 'image_group',
                    'title' => '背景圖片',
                    'tip' => '若段落樣式選擇滿版背景，才需選擇背景圖片，且兩張圖片皆必填。<br>圖片建議尺寸：寬度介於900-1100像素。',
                    'image_array' => 
                    [
                        [
                            'title' => '背景圖片',
                            'value' => 'full_img',
                            'set_size' => 'no',
                            'width' => '',
                            'height' => '',
                        ],
                        [
                            'title' => '背景圖片-手機版',
                            'value' => 'full_img_rwd',
                            'set_size' => 'no',
                            'width' => '',
                            'height' => '',
                        ],
                    ]
                ],
            ],
        ], 
        
    ]
])}}