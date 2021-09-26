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
            'type' => 'select_just_show',
            'title' => '段落樣式',
            'value' => 'article_style',
            'options' =>[
                            '_articletype'=> ["title" => "基本段落，標題置頂+上圖+內文置下","key" => '_articletype'],
                            '-'=> ["title" => "--------------------------------------","key" => '-'],
                            '_articletype_L'=> ["title" => "文章置左，圖置右","key" => '_articletype_L'],
                            '_articletype_L -v'=> ["title" => "文章置左，圖置右-圖文垂直置中","key" => '_articletype_L -v'],
                            '_articletype_L -RWDrow2'=> ["title" => "文章置左，圖置右-RWD2圖並排 (若僅上傳單圖，尺寸依舊為並排大小)","key" => '_articletype_L -RWDrow2'],
                            '--'=> ["title" => "--------------------------------------","key" => '--'],
                            '_articletype_R'=> ["title" => "文章置右，圖置左","key" => '_articletype_R'],
                            '_articletype_R -v'=> ["title" => "文章置右，圖置左-圖文垂直置中","key" => '_articletype_R -v'],
                            '_articletype_R -RWDrow2'=> ["title" => "文章置右，圖置左-RWD2圖並排 (若僅上傳單圖，尺寸依舊為並排大小)","key" => '_articletype_R -RWDrow2'],
                            '---'=> ["title" => "--------------------------------------","key" => '---'],
                            '_articletype_LR'=> ["title" => "文章繞圖，圖置右","key" => '_articletype_LR'],
                            '_articletype_LR -RWDrow2'=> ["title" => "文章繞圖，圖置右-RWD2圖並排 (若僅上傳單圖，尺寸依舊為並排大小)","key" => '_articletype_LR -RWDrow2'],
                            '----'=> ["title" => "--------------------------------------","key" => '----'],
                            '_articletype_RR'=> ["title" => "文章繞圖，圖置左","key" => '_articletype_RR'],
                            '_articletype_RR -RWDrow2'=> ["title" => "文章繞圖，圖置左-RWD2圖並排 (若僅上傳單圖，尺寸依舊為並排大小)","key" => '_articletype_RR -RWDrow2'],
                            '-----'=> ["title" => "--------------------------------------","key" => '-----'],
                            '_articletype_U'=> ["title" => "文章置上，圖置下","key" => '_articletype_U'],
                            '_articletype_D'=> ["title" => "文章置下，圖置上","key" => '_articletype_D'],
                        ],
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
            'title' => '內容編輯',
            'content' => 
            [
                //內容元件												
                [
                    'type' => 'select',
                    'title' => '段落樣式',
                    'value' => 'article_style',
                    'default' => '',
                    'options' =>[
                                '_articletype'=> ["title" => "基本段落，標題置頂+上圖+內文置下","key" => '_articletype'],
                                '-'=> ["title" => "--------------------------------------","key" => '-'],
                                '_articletype_L'=> ["title" => "文章置左，圖置右","key" => '_articletype_L'],
                                '_articletype_L -v'=> ["title" => "文章置左，圖置右-圖文垂直置中","key" => '_articletype_L -v'],
                                '_articletype_L -RWDrow2'=> ["title" => "文章置左，圖置右-RWD2圖並排 (若僅上傳單圖，尺寸依舊為並排大小)","key" => '_articletype_L -RWDrow2'],
                                '--'=> ["title" => "--------------------------------------","key" => '--'],
                                '_articletype_R'=> ["title" => "文章置右，圖置左","key" => '_articletype_R'],
                                '_articletype_R -v'=> ["title" => "文章置右，圖置左-圖文垂直置中","key" => '_articletype_R -v'],
                                '_articletype_R -RWDrow2'=> ["title" => "文章置右，圖置左-RWD2圖並排 (若僅上傳單圖，尺寸依舊為並排大小)","key" => '_articletype_R -RWDrow2'],
                                '---'=> ["title" => "--------------------------------------","key" => '---'],
                                '_articletype_LR'=> ["title" => "文章繞圖，圖置右","key" => '_articletype_LR'],
                                '_articletype_LR -RWDrow2'=> ["title" => "文章繞圖，圖置右-RWD2圖並排 (若僅上傳單圖，尺寸依舊為並排大小)","key" => '_articletype_LR -RWDrow2'],
                                '----'=> ["title" => "--------------------------------------","key" => '----'],
                                '_articletype_RR'=> ["title" => "文章繞圖，圖置左","key" => '_articletype_RR'],
                                '_articletype_RR -RWDrow2'=> ["title" => "文章繞圖，圖置左-RWD2圖並排 (若僅上傳單圖，尺寸依舊為並排大小)","key" => '_articletype_RR -RWDrow2'],
                                '-----'=> ["title" => "--------------------------------------","key" => '-----'],
                                '_articletype_U'=> ["title" => "文章置上，圖置下","key" => '_articletype_U'],
                                '_articletype_D'=> ["title" => "文章置下，圖置上","key" => '_articletype_D'],
                            ],
                ],
                [
                    'type' => 'select',
                    'title' => '多圖並排 (僅多張圖片時使用)',
                    'value' => 'is_row',
                    'default' => '',
                    'options' =>[
                                    '0'=> ["title" => "不使用並排","key" => '0'],
                                    '-row2'=> ["title" => "兩張圖並排","key" => '-row2'],
                                    '-row3'=> ["title" => "三張圖並排(僅基本段落/文章置上下使用)","key" => '-row3'],
                                    '-row4'=> ["title" => "四張圖並排(僅基本段落/文章置上下使用)","key" => '-row4'],
                                    '-row5'=> ["title" => "五張圖並排(僅基本段落/文章置上下使用)","key" => '-row5'],
                                ],
                ],
                [
                    'type' => 'radio_btn',
                    'title' => '是否使用拼圖模式',
                    'value' => 'is_ex',
                    'tip' => '使用後圖片會以拼接方式呈現。'
                    // when it open , class add ' --ex'
                ],
                [
                    'type' => 'radio_btn',
                    'title' => '是否圖片置中',
                    'value' => 'is_vcenter',
                    'tip' => '使用後對所有併排圖片做垂直置中設定。 (僅基本段落/文章置上下使用)'
                    // when it open , class add ' --vcenter'
                ],
                [
                    'type' => 'radio_btn',
                    'title' => '是否限制圖片寬度',
                    'value' => 'is_wauto',
                    'tip' => '使用後限制圖片寬度為500px。 (僅基本段落/文章置上下使用)'
                    // when it open , class add ' --wauto'
                ],
                [
                    'type' => 'textInput',
                    'title' => '段落名稱',
                    'value' => 'article_title',
                    'tip' => '單行輸入，內容不支援HTML及CSS、JQ、JS等語法，特殊符號如 : @#$%?/\|*.及全形也盡量避免。'
                ],
                [
                    'type' => 'textArea',
                    'title' => '段落內容',
                    'value' => 'article_inner',
                    'tip' => '可輸入多行文字，斷行請多利用Shift+Enter，輸入區域可拖曳右下角縮放。'
                ],
            ],
        ],
        [
            'title' => '圖片管理',
            'content' => 
            [	
                
            ],
            'is_three' => 'yes',
            'three_model' => $ThreeModel,
            'three' =>
            [
                'title' => '圖片 / 影片管理',
                'tip' => '可設定多張圖片 / 影片的編排格式，其中靠上圖片、靠下圖片、圖片 / 影片的段落類型編排為橫向並排，而文繞圖、靠左圖片、靠右圖片段落類型的編排為重直排列。',
                // 'is_add' => 'no',  /* 單一欄位 */
                // 'is_photo' => 'yes',  /* 圖片 */
                // 'is_embed' => 'yes',  /* 嵌入影片,填影片ID */
                // 'embed_place' => '請輸入YouTube影片代碼',  /* 嵌入影片,填影片ID */
                // 'embed_url' => 'https://www.youtube.com/embed/',  /* 嵌入影片,填影片ID */
                // 'is_video' => 'no',  /* 上傳影片,現在他沒功能 */
                'SecondIdColumn' => 'second_id', //存放第二層ID的欄位
                'three_content' => 
                [
                    [
                        'type' => 'image_group',
                        'title' => '圖片',
                        // 'tip' => '圖片建議尺寸: 860x540。',
                        'image_array' => 
                        [
                            [
                                'title' => '圖片',
                                'value' => 'image',
                                'set_size' => 'no',
                            ]
                        ]
                    ],
                ]
            ],
        ],
    ]
])}}