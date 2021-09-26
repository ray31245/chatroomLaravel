@foreach ($conset as $ley => $value)
    @if ($value['type']=='textInput')
        {{UnitMaker::textInput([
            'name' => $model.'['.$value['colum'].']',
            'title' => $value['title'],
            'value' => ( !empty($data[$value['colum']]) )? $data[$value['colum']] : '',
            'tip'  => ($value['tip']?:'單行輸入，內容不支援HTML及CSS、JQ、JS等語法，特殊符號如 : @#$%?/*.及全形也盡量避免。').$value['tip_add'],
        ])}}
    @elseif($value['type']=='textArea')
        {{UnitMaker::textArea([
            'name' => $model.'['.$value['colum'].']',
            'title' => $value['title'],
            'value' => ( !empty($data[$value['colum']]) )? $data[$value['colum']] : '',
            'tip'  => ($value['tip']?:'多行輸入，內容不支援HTML及CSS、JQ、JS等語法，特殊符號如 : @#$%?/*.及全形也盡量避免。').$value['tip_add'],
        ])}}
    @elseif(in_array($value['type'],['select','select2','Select','Select2']))
        {{UnitMaker::Select2([
            'name' => $model.'['.$value['colum'].']',
            'title' => $value['title'],
            'value' => ( !empty($data[$value['colum']]) )? $data[$value['colum']] : '',
            'empty' => ( !empty($value['empty']) )? $value['empty'] : '',
            'options' => $value['options'],
            'tip'  => ($value['tip']?:'請務必選擇一項主要對應之類別選項。').$value['tip_add'],
        ])}}
    @elseif($value['type']=='imageGroup')
        @php
            $imgset = array_map(function($item)use($model,$data){
                    $item['name']=$model.'['.$item['colum'].']';
                    $item['title']=$item['title'];
                    $item['value']=( !empty($data[$item['colum']]) )? $data[$item['colum']] : '';
                    $item['set_size']=in_array($item['set_size'],['yes','Yes','YES',1,'1'])&&$item['width']&&$item['height']?'yes':'no';
                    $item['width']=$item['width'];
                    $item['height']=$item['height'];
                    return $item;
                },$value['image_array']);
        @endphp
        {{UnitMaker::imageGroup([
            'title' => $value['title'],
            'image_array' =>
                $imgset
            ,
            'tip' => $value['tip']?:'電腦版建議尺寸：<br>手機版建議尺寸：，檔案格式限定:JPG、PNG、GIF。'.$value['tip_add'],
        ])}}
    @elseif($value['type']=='datePicker')
        {{UnitMaker::datePicker([
            'name' => $model.'['.$value['colum'].']',
            'title' => $value['title'],
            'value' => ( !empty($data[$value['colum']]) )? $data[$value['colum']] : '',
            'tip' => ($value['tip']?:'').$value['tip_add'],
        ])}}
    @elseif($value['type']=='colorPicker')
        {{UnitMaker::colorPicker([
            'name' => $model.'['.$value['colum'].']',
            'title' => $value['title'],
            'value' => ( !empty($data[$value['colum']]) )? $data[$value['colum']] : '',
            'tip' => ($value['tip']?:'').$value['tip_add'],
        ])}}
    @elseif(in_array($value['type'],['select2Multi','selectMulti','select2multi','selectmulti']))
        {{UnitMaker::select2Multi([
            'name' => $model.'['.$value['colum'].']',
            'title' => $value['title'],
            'options' => $value['options'],
            'value' => ( !empty($data[$value['colum']]) )? $data[$value['colum']] : '',
            'tip'  => ($value['tip']?:'請務必選擇一項主要對應之類別選項。').$value['tip_add'],
        ])}}
    @elseif($value['type']=='filePicker')
        {{UnitMaker::filePicker([
            'name' => $model.'['.$value['colum'].']',
            'title' => $value['title'],
            'value' => ( !empty($data[$value['colum']]) )? $data[$value['colum']] : '',
            'tip'  => ($value['tip']?:'請選擇檔案上傳。').$value['tip_add'],
        ])}}
    @elseif($value['type']=='numberInput')
        {{UnitMaker::numberInput([
            'name' => $model.'['.$value['colum'].']',
            'title' => $value['title'],
            'value' => ( !empty($data[$value['colum']]) )? $data[$value['colum']] : '',
            'tip'  => ($value['tip']?:'').$value['tip_add'],
        ])}}
    @endif
@endforeach
@php
// ['type'=>'textInput','colum'=>'index_sub_title','title'=>'列表顯示副標題','tip'=>'','tip_add'=>''],
// ['type'=>'Select','colum'=>'cate_id','title'=>'所屬分類','tip'=>'','tip_add'=>'','options'=>$options['NewsCategory']],
// ['type'=>'imageGroup','title'=>'列表圖','tip'=>'建議尺寸：620 x 410<br>，檔案格式限定:JPG、PNG、GIF。','tip_add'=>'','image_array'=>[['colum'=>'img','title'=>'列表圖','set_size' => 'yes','width' => '620','height' => '410']]],
// ['type'=>'datePicker','colum'=>'down_date','title'=>'下架日期','tip'=>'下架日期若是沒有輸入，則為不會下架','tip_add'=>''],
// ['type'=>'colorPicker','colum'=>'l_bg_color','title'=>'左邊區塊背景顏色','tip'=>'','tip_add'=>''],
@endphp