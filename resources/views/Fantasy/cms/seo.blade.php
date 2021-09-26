{{UnitMaker::textInput([
    'name' => $model.'[web_title]',
    'title' => '頁面標題',
    'value' => ( !empty($data['web_title']) )? $data['web_title'] : '',
    'tip'  => '單行輸入，內容不支援HTML及CSS、JQ、JS等語法，特殊符號如 : @#$%?/\|*.及全形也盡量避免。', 
])}}

{{UnitMaker::textArea([
    'name' => $model.'[meta_keyword]',
    'title' => 'meta keyword',
    'value' => ( !empty($data['meta_keyword']) )? $data['meta_keyword'] : '',
    'tip' => '可輸入多行文字，內容不支援HTML及CSS、JQ、JS等語法，斷行請多利用Shift+Enter，輸入區域可拖曳右下角縮放。', 
])}}

{{UnitMaker::textArea([
    'name' => $model.'[meta_description]',
    'title' => 'meta description',
    'value' => ( !empty($data['meta_description']) )? $data['meta_description'] : '',
    'tip' => '可輸入多行文字，內容不支援HTML及CSS、JQ、JS等語法，斷行請多利用Shift+Enter，輸入區域可拖曳右下角縮放。', 
])}}
{{-- 神奇的一個網站多的GA、GTM --}}
{{UnitMaker::textInput([
    'name' => $model.'[ga_code]',
    'title' => '網頁GA碼',
    'tip'=>'輸入編號即可，不需要整段程式碼。',
    'value' => ( !empty($data['ga_code']) )? $data['ga_code'] : ''
])}}
{{UnitMaker::textInput([
    'name' => $model.'[gtm_code]',
    'title' => '網頁GTM碼',
    'tip'=>'輸入編號即可，不需要整段程式碼。',
    'value' => ( !empty($data['gtm_code']) )? $data['gtm_code'] : ''
])}}
{{UnitMaker::textInput([
    'name' => $model.'[gtag]',
    'title' => '全域網站代碼',
    'tip'=>'輸入編號即可，不需要整段程式碼。',
    'value' => ( !empty($data['gtag']) )? $data['gtag'] : ''
])}}
{{-- 神奇的一個網站多的GA、GTM --}}
{{UnitMaker::textArea([
    'name' => $model.'[schema_code]',
    'title' => '結構化標籤',
    'value' => ( !empty($data['schema_code']) )? $data['schema_code'] : '',
    'tip'  => '可輸入多行文字,使用方式可參考<a target="_blank" href="https://schema.org/">https://schema.org/</a>',
    // 'tip'  => '可輸入多行文字,使用方式可參考<br>換行',
])}}
{{UnitMaker::imageGroup([
    'title' => '分享縮圖',
    'image_array' =>
    [
        [
            'name' => $model.'[og_image]',
            'title' => '分享縮圖',
            'value' => ( !empty($data['og_image']) )? $data['og_image'] : '',
            'set_size' => 'yes',
            'width' => '1200',
            'height' => '628',
        ],
    ],
    'tip' => '建議尺寸:1200 x 628'
])}}

{{UnitMaker::textInput([
    'name' => $model.'[og_title]',
    'title' => '分享標題',
    'value' => ( !empty($data['og_title']) )? $data['og_title'] : '',
    'tip'  => '單行輸入，內容不支援HTML及CSS、JQ、JS等語法，特殊符號如 : @#$%?/\|*.及全形也盡量避免。', 
])}}

{{UnitMaker::textArea([
    'name' => $model.'[og_description]',
    'title' => '分享介紹',
    'value' => ( !empty($data['og_description']) )? $data['og_description'] : '',
'tip' => '可輸入多行文字，內容不支援HTML及CSS、JQ、JS等語法，斷行請多利用Shift+Enter，輸入區域可拖曳右下角縮放。', 
])}}