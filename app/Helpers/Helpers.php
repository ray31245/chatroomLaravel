<?php

if (!function_exists('ff')) {
    function ff($collection)
    {
        dd($collection->toarray());
    }
}

if (!function_exists('Seo')) {
  function Seo($array)
  {
    $seo = [];
		foreach($array as $key=>$val){
      if($key == 'seo_title'){$seo['seo_title'] = $val;}
      if($key == 'seo_keyword'){$seo['seo_keyword'] = $val;}
      if($key == 'seo_meta'){$seo['seo_meta'] = $val;}
      if($key == 'seo_ga'){$seo['seo_ga'] = $val;}
      if($key == 'seo_gtm'){$seo['seo_gtm'] = $val;}
      if($key == 'seo_img'){$seo['seo_img'] = $val;}
		}
		return $seo;
  }
}
if (!function_exists('M')) {
    function M($str)
    {
		$str = ucfirst($str);
		$new_str = "App\\Http\\Models\\$str\\$str";
		return $new_str;
    }
}
if (!function_exists('M_one')) {
  function M_one($str,$key="",$val="")
  {
		$str = ucfirst($str);
    $new_str = "App\\Http\\Models\\$str\\$str";
    if(!empty($key)){
      $arr = $new_str::where($key,$val)->first();
    }else{
      $arr = $new_str::first();
    }
    if(!empty($arr)){
      $arr = imgsrc(idorname($arr->toArray()));
    }else{
      $arr = [];
    }
		return $arr;
  }
}
if (!function_exists('M_one_rand')) {
  function M_one_rand($str,$key="",$val="")
  {
		$str = ucfirst($str);
    $new_str = "App\\Http\\Models\\$str\\$str";
    if(!empty($key)){
      $arr = $new_str::isVisible()->where($key,$val)->inRandomOrder()->first();
    }else{
      $arr = $new_str::isVisible()->inRandomOrder()->first();
    }
    if(!empty($arr)){
      $arr = imgsrc(idorname($arr->toArray()));
    }else{
      $arr = [];
    }
		return $arr;
  }
}
if (!function_exists('M_array')) {
  function M_array($str,$key="",$val="")
  {
		$str = ucfirst($str);
    $new_str = "App\\Http\\Models\\$str\\$str";
    if(!empty($key)){
      $arr = imgsrc(idorname($new_str::isVisible()->where($key,$val)->doSort()->get()->toArray()));
    }else{
      $arr = imgsrc(idorname($new_str::isVisible()->doSort()->get()->toArray()));
    }
		return $arr;
  }
}
if (!function_exists('M_table')) {
    function M_table($str)
    {
      $str = ucfirst($str);
		$new_str = "App\\Http\\Models\\$str\\$str";
		$table = with(new $new_str)->getTable();
		return $table;
    }
}
if (!function_exists('M_son')) {
  function M_son($model1,$model2,$k)
  {
    $data = idorname(M($model1)::isVisible()->get()->toArray());
    foreach($data as $key=>$val){
      $data[$key][$k] = idorname(M($model2)::isVisible()->where('parent_id',$val['id'])->get()->toArray());
    }
    return $data;
  }
}
if (!function_exists('M_group')) {
  function M_group($data1,$data2,$key,$col)
  {
    $is_find = false;
    foreach($data1 as $val){
      if(findkey($data2,'id',$val[$key]) !== null){
        $is_find = true;
        $data2[findkey($data2,'id',$val[$key])][$col][] = $val;
      }
    }
    if(!$is_find){
      foreach($data2 as $k => $v){
        $data2[$k][$col] = [];
      }
      
    }
    return $data2;
  }
}
if (!function_exists('M_content')) {
  function M_content($model,$id)
  {
    $data = M($model)::where(function($query){$query->where('is_preview', 1)->orwhere('is_visible', 1);})->where('parent_id',$id)->doSort()->get()->toArray();
    foreach($data as $key=>$val){
      $data[$key]['contentimg'] = M($model.'_img')::where('second_id',$val['id'])->doSort()->get()->toArray();
    }
    return $data;
  }
}
if (!function_exists('M_second')) {
  function M_second($model,$second,$id)
  {
    $data = imgsrc(idorname(M($model)::isVisible()->where('parent_id',$id)->doSort()->get()->toArray()));
    foreach($data as $key=>$val){
      $data[$key]['son'] = imgsrc(idorname(M($second)::where('second_id',$val['id'])->doSort()->get()->toArray()));
    }
    return $data;
  }
}
if (!function_exists('Mail_VerificationCode')) {
  function Mail_VerificationCode($blade,$MailInfo)
  {
		$Code = mt_rand (100000,999999);
		if(empty(Session::get('MailCheckCode'))){
		Session::put('MailCheckCode',$Code);
    }else{
      $Code = Session::get('MailCheckCode');
    }
    Session::put('MailCheckState',false);
    Session::save();
    $MailInfo['code'] = $Code;

    Mail::send($blade, ['data' => $MailInfo], function ($message) use ($MailInfo) {
			$message->from($MailInfo['from'], $MailInfo['from_name']);
			$message->subject($MailInfo['subject']);
      $message->to($MailInfo['to']);
    });
		return $Code;
  }
}
//取得網址名稱
if (!function_exists('idorname')) {
  function idorname($data)
  {
    if(!empty($data)){
      foreach($data as $col=>$v){
        if(!is_array($data[$col])) {
					$data['url_name'] = (isset($data['url_name']) && !empty($data['url_name'])) ? $data['url_name'] : $data['id'];
        }else{
          $data[$col] = idorname($data[$col]);
        }
      }
    }
    return $data;
  }
}
//轉換圖片
if (!function_exists('imgsrc')) {
  function imgsrc($data)
  {
    if(!empty($data)){
      foreach($data as $col=>$v){
        if(!is_array($data[$col])) {
					if(strpos($col,'o_img') !== false){ 
            $data[$col] = BaseFunction::RealFiles($data[$col]);
            $data[$col.'_alt'] = BaseFunction::RealFilesAlt($data[$col]);
            if(empty($data[$col.'_alt'])){
              $data[$col.'_alt'] = imgsrcAlt($data);
            }
					}
        }else{
          $data[$col] = imgsrc($data[$col]);
        }
      }
    }
    return $data;
  }
  function imgsrcAlt($data)
  {
    $alt = '';
    foreach($data as $col=>$v){
      if($col == 'w_title'){ 
        $alt = $data[$col];
      }
    }
    return $alt;
  }
}
//找KEY
if (!function_exists('findkey')) {
  function findkey($array,$key,$value)
  {
    $returnKey = null;
    foreach($array as $k=>$val){
      if((string)$val[$key] === (string)$value){
        $returnKey = $k;
      }
    }
    return $returnKey;
  }
}
if (!function_exists('findkeyval')) {
  function findkeyval($array,$key,$value)
  {
    $returnKey = null;
    $returnNullArray = [];
    if(!empty($array)){
      foreach($array[0] as $k=>$val){
        $returnNullArray[$k] = '';
      }
    }
    foreach($array as $k=>$val){
      if((string)$val[$key] === (string)$value){
        $returnKey = $k;
      }
    }
    $returnData = ($returnKey !== null) ? $array[$returnKey] : $returnNullArray;
    return $returnData;
  }
}
if (!function_exists('fsize')) {
function fsize($path) { 
    $fp = fopen($path,"r"); 
    $inf = stream_get_meta_data($fp); 
    fclose($fp); 
    foreach($inf["wrapper_data"] as $v) { 
      if (stristr($v, "content-length")) { 
        $v = explode(":", $v); 
        return floor(trim($v[1]) / 1024); 
      } 
    } 
    return 0;
  } 
}
if (!function_exists('Leon_article')) {
  function Leon_article($content)
  {
    return View::make('article_v2',
    [
      'data' => $content,
    ]);
  }
}
if (!function_exists('mustlogin')) {
  function mustlogin()
  {
    $UserData = Session::get('UserData');
    if(empty($UserData)){
      header('Location: '.BaseFunction::b_url('member'));
      exit();
    }
    return $UserData;
  }
}
if (!function_exists('CheckStorePass')) {
  function CheckStorePass()
  {
    $StorePass = Session::get('StorePass');
    if(empty($StorePass)){
      header('Location: '.BaseFunction::b_url('store/login'));
      exit();
    }
    //如果存在但隔天就強制再登入一次
    if($StorePass['date'] != \Carbon\Carbon::today()->format('Y-m-d')){
      header('Location: '.BaseFunction::b_url('store/login'));
      exit();
    }
    return $StorePass;
  }
}
if (!function_exists('HtmlCoverUrlMail')) {
  function HtmlCoverUrlMail($text)
  {
    $regex_url = "/(?i)\b((?:https?:\/\/|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:'\".,<>?«»“”‘’]))/";
    $text = preg_replace($regex_url, "<a href=\"$1\">$1</a>", $text);

    $regex_mail = '/(\S+@\S+\.\S+)/';
    $text = preg_replace($regex_mail, '<a href="mailto:$1">$1</a>', $text);  
    return $text;
  }
}

if (!function_exists('CoverPostInput')) {
  function CoverPostInput($requestData)
  {
    $val = [];
    if(!empty($requestData)){
      foreach($requestData as $v){
        if(isset($v['name']) && isset($v['val'])){
          $val[$v['name']] = $v['val'];
        }
      }
    }
    return $val;
  }
}

if (!function_exists('b_url')) {
  function b_url($requestData)
  {
    return BaseFunction::b_url($requestData);
  }
}
if (!function_exists('article_options')) {
  function article_options()
  {
    $article_options = [
            'Style' => [
                '_article'=> ["title" => "基本段落樣式，由上至下排列，依序為主標題 > 影像+描述 > 副標題 > 內文＋按鈕。","key" => '_article'],
                '_articleSL'=> ["title" => "由上至下排列，依序為主標題 > 影像+描述 > 副標題置左 > 內文＋按鈕置右。","key" => '_articleSL'],
                '_articleSR'=> ["title" => "由上至下排列，依序為主標題 > 影像+描述 > 副標題置右 > 內文＋按鈕置左。","key" => '_articleSR'],
                '-'=> ["title" => "--------------------------------------","key" => '-'],
                '_articleU'=> ["title" => "由上至下排列，依序為主標題 > 副標題 > 內文＋按鈕 > 影像+描述。","key" => '_articleU'],
                '_articleUL'=> ["title" => "由上至下排列，依序為主標題置左 > 副標題 + 內文＋按鈕置右 > 影像+描述。","key" => '_articleUL'],
                '_articleUR'=> ["title" => "由上至下排列，依序為主標題置右 > 副標題 + 內文＋按鈕置左 > 影像+描述。","key" => '_articleUR'],
                '--'=> ["title" => "--------------------------------------","key" => '--'],
                '_articleD'=> ["title" => "由上至下排列，依序為影像+描述 > 主標題 > 副標題 > 內文＋按鈕。","key" => '_articleD'],
                '_articleDL'=> ["title" => "由上至下排列，依序為影像+描述 > 主標題置左 > 副標題 + 內文＋按鈕置右。","key" => '_articleDL'],
                '_articleDR'=> ["title" => "由上至下排列，依序為影像+描述 > 主標題置右 > 副標題 + 內文＋按鈕置左。","key" => '_articleDR'],
                '---'=> ["title" => "--------------------------------------","key" => '---'],
                '_articleL'=> ["title" => "依序為主標題 + 副標題 + 內文＋按鈕置左 > 影像+描述置右。","key" => '_articleL'],
                '_articleLR'=> ["title" => "依序為主標題 + 副標題 + 內文＋按鈕置左圍繞影像+描述置右。","key" => '_articleLR'],
                '_articleR'=> ["title" => "依序為影像+描述置左 > 主標題 + 副標題 + 內文＋按鈕置右。","key" => '_articleR'],
                '_articleRR'=> ["title" => "依序為主標題 + 副標題 + 內文＋按鈕置右圍繞影像+描述置左。","key" => '_articleRR'],
                //'----'=> ["title" => "--------------------------------------","key" => '----'],
                //'_article -typeFull'=> ["title" => "滿版背景，段落垂直置中，由上至下依序為主標題 > 影像+描述 > 副標題 > 內文＋按鈕。","key" => '_article -typeFull'],
                //'_article -typeFull-L'=> ["title" => "滿版背景，段落垂直置左，由上至下依序為主標題 > 影像+描述 > 副標題 > 內文＋按鈕。","key" => '_article -typeFull-L'],
                //'_article -typeFull-R'=> ["title" => "滿版背景，段落垂直置右，由上至下依序為主標題 > 影像+描述 > 副標題 > 內文＋按鈕。","key" => '_article -typeFull-R'],
                //'_article -typeFull-Box'=> ["title" => "滿版背景並使段落區塊中的內文區域產生色塊，段落垂直置中，由上至下依序為主標題 > 影像+描述 > 副標題 > 內文＋按鈕。","key" => '_article -typeFull-Box'],
                //'_article -typeFull-Box-L'=> ["title" => "滿版背景並使段落區塊中的內文區域產生色塊，段落垂直置左，由上至下依序為主標題 > 影像+描述 > 副標題 > 內文＋按鈕。","key" => '_article -typeFull-Box-L'],
                //'_article -typeFull-Box-R'=> ["title" => "滿版背景並使段落區塊中的內文區域產生色塊，段落垂直置右，由上至下依序為主標題 > 影像+描述 > 副標題 > 內文＋按鈕。","key" => '_article -typeFull-Box-R'],
                //'_article -typeFull-BoxSlice'=> ["title" => "滿版背景，區塊預設為左右置中對齊，段落區塊左右置中垂直切割區塊，，由上至下依序為主標題 > 影像+描述 > 副標題 > 內文＋按鈕。","key" => '_article -typeFull-BoxSlice'],
                //'_article -typeFull-BoxSlice-L'=> ["title" => "滿版背景，區塊預設為置左對齊，段落區塊置左垂直切割區塊，由上至下依序為主標題 > 影像+描述 > 副標題 > 內文＋按鈕。","key" => '_article -typeFull-BoxSlice-L'],
                //'_article -typeFull-BoxSlice-R'=> ["title" => "滿版背景，區塊預設為置右對齊，段落區塊置右垂直切割區塊，由上至下依序為主標題 > 影像+描述 > 副標題 > 內文＋按鈕。","key" => '_article -typeFull-BoxSlice-R'],
                //'-----'=> ["title" => "--------------------------------------","key" => '-----'],
                //'_article -typeSwiper-L'=> ["title" => "設定段落為 Swiper 模式，段落內容由左至右依序為影像 > 主標題＋副標題＋內文＋按鈕","key" => '_article -typeSwiper-L'],
                //'_article -typeSwiper-R'=> ["title" => "設定段落為 Swiper 模式，段落內容由左至右依序為主標題＋副標題＋內文＋按鈕 > 影像","key" => '_article -typeSwiper-R'],
                // '------'=> ["title" => "--------------------------------------","key" => '------'],
                // '_article -typeOverlap-LU'=> ["title" => "段落區塊由上至下編排，依序為影像*2-大圖置左小圖置右下 > 主標題 > 副標題 > 內文 > 按鈕","key" => '_article -typeOverlap-LU'],
                // '_article -typeOverlap-LD'=> ["title" => "段落區塊由上至下編排，依序為主標題 > 副標題 > 內文 > 按鈕 > 影像*2-大圖置左小圖置右上","key" => '_article -typeOverlap-LD'],
                // '_article -typeOverlap-RU'=> ["title" => "段落區塊由上至下編排，依序為影像*2-大圖置右小圖置左下 > 主標題 > 副標題 > 內文 > 按鈕","key" => '_article -typeOverlap-RU'],
                // '_article -typeOverlap-RD'=> ["title" => "段落區塊由上至下編排，依序為影像*2-大圖置右小圖置左上 > 主標題 > 副標題 > 內文 > 按鈕","key" => '_article -typeOverlap-RD'],
            ],
            'CommonAlignVertical' => [
                'center'=> ["title" => "置中","key" => 'center'],
                'up'=> ["title" => "置上","key" => 'up'],
                'down'=> ["title" => "置下","key" => 'down'],
            ],
            'CommonAlignHorizontal' => [
                'center'=> ["title" => "置中","key" => 'center'],
                'left'=> ["title" => "置左","key" => 'left'],
                'right'=> ["title" => "置右","key" => 'right'],
            ],
            'CommonLinkType' => [
        '1' => ['key' => '1', 'title' => '本頁開啟'],
        '2' => ['key' => '2', 'title' => '另開新頁'],
      ],
    ];
    return $article_options;
  }
}