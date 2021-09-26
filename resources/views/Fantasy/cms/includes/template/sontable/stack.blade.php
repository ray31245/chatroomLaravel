{{----------$html------------------------------------------------------}}
<div class="list stack_state addDataKey addKeyClass" data-key="">
    <div class="list_box">

        {{-- 選擇按鈕 --}}
        <div class="item check_box addKeyClass addDataKey" data-id="" data-key="">
            <input type="checkbox" class="content_input list_checkbox">
            <label class="content_inputBox">
                <span></span>
            </label>
        </div>
        
        <input type="hidden" value="" name="{{$set['name']}}[id][]" class="addKeyClass">
        <input type="hidden" value="" name="{{$set['name']}}[quillFantasyKey][]" class="addKeyValue">
        
        {{-- 排序 --}}
        @if ($sort == 'yes')
            <div class="item sort_number">
                <p></p>
                <input type="hidden" value="" name="{{$set['name']}}[rank][]">
            </div>
        @endif

        {{-- 項目 --}}
        @foreach ($tableSet as $key2 => $row2)
            @if ($row2['type'] == 'textInput')

                <div class="item text">
                    <input type="text" value="{{!empty($row2['default']) ? $row2['default'] : ''}}" style="border-style:none" name="{{$set['name']}}[$row2['value']][]">
                </div>

            @elseif ($row2['type'] == 'filesText')

                <div class="item text btn_ctable">
                    <div class="s_img">
                        <img src="" alt="">
                    </div>
                    <p></p>
                </div>

            @elseif ($row2['type'] == 'radio_btn')

                <div class="item switch_btn ios_switch radio_btn_switch on">
                    <input type="text" name="{{$set['name']}}[{{$row2['value']}}][]" value="1">
                    <div class="box">
                        <span class="ball"></span>
                    </div>
                </div>

            @elseif ($row2['type'] == 'select_just_show')

                <div class="item text btn_ctable">
                <p>{{!empty($row2['default']) ? $row2['default'] : ''}}</p>
                </div>

            @elseif ($row2['type'] == 'select')
                @php
                    $temp_options = (!empty($row2['options'])) ? $row2['options'] : [];
                @endphp

                <div class="item text">
                    <div class="quill_select" style="width:100%;">
                        <div class="select_object" style="border-style: none;">
                            <p class="title"></p>
                            <span class="arrow pg-arrow_down"></span>
                        </div>

                        <div class="select_wrapper">
                            <ul class="select_list edit_select">
                                @foreach ($temp_options as $key3 => $row3)
                                    <li class="option single_select_fantasy" data-id="{{$row3['key']}}">
                                        <p>{{$row3['title']}}</p>
                                    </li>
                                @endforeach
                                <input type="hidden" name="{{$set['name']}}[{{$row2['value']}}][]" value="">
                            </ul>
                        </div>
                    </div>
                </div>

            @elseif ($row2['type'] == 'just_show')

                <div class="item text btn_ctable">
                    <p>{{!empty($row2['default']) ? $row2['default'] : ''}}</p>
                </div>

            @endif
        @endforeach

        {{-- 編輯刪除按鈕 --}}
        <div class="item edit_btnGroup">
            @if ($hasContent == 'yes')
                <span class="fa fa-pencil-square-o btn_ctable addDataKey" data-key=""></span>
            @endif
            <span class="fa fa-trash addKeyClass addDataKey deleteSonTableData" data-id="" data-key="" data-model="{{$set['name']}}"></span>
        </div>

    </div>

    {{-- 展開項目 --}}
    @if ($hasContent == 'yes')
        <div class="list_frame addkeyFrame">

            {{-- tabSet --}}
            @if (count($tabSet) > 0)                
                <ul class="list_headBar">
                    @foreach ($tabSet as $key_2 => $row_2)
                        @if ($key_2 == 0)
                            <li class="now" bar-id="{{$key_2}}">
                            <p>{{$row_2['title']}}</p>
                            </li>
                        @else
                            <li bar-id="{{$key_2}}">
                            <p>{{$row_2['title']}}</p>
                            </li>
                        @endif
                    @endforeach
                </ul>
            @endif

            <ul class="list_body">
                @foreach ($tabSet as $key_2 => $row_2)
                    <li class="list_bodyL part_content" body-id="{{$key_2}}">
                        <ul class="list_part_body">
                            {{-- 第二層元件 --}}
                            @foreach ($row_2['content'] as $key_3 => $row_3)
                                @if ($row_3['type'] == 'textInput')

                                    <li class="inventory">
                                        <p class="subtitle">{{(!empty($row_3['title'])) ? $row_3['title'] : ''}}</p>
                                        <input class="normal_input" type="text" value="" name="{{$set['name']}}[{{$row_3['value']}}][]" {{(!empty($row_3['disabled'])) ? $row_3['disabled'] : ''}} >
                                        @if (!empty($tip))
                                            <div class="tips">
                                                <span class="title">TIPS</span>
                                                <p>{!!(!empty($row_3['tip'])) ? $row_3['tip'] : ''!!}</p>
                                            </div>
                                        @endif
                                    </li>

                                @elseif ($row_3['type'] == 'select')

                                    @php
                                        $row_3['sontable'] = true;
                                        $row_3['sontable_add'] = true;
                                        $row_3['name'] = $set['name'] . '[' . $row_3['value'] . '][]';
                                    @endphp
                                    {{UnitMaker::select($row_3)}}

                                @elseif ($row_3['type'] == 'selectBydata')

                                    @php
                                        $row_3['sontable'] = true;
                                        $row_3['sontable_add'] = true;
                                        $row_3['name'] = $set['name'] . '[' . $row_3['value'] . '][]';
                                    @endphp
                                    {{UnitMaker::selectBydata($row_3)}}

                                @elseif ($row_3['type'] == 'textArea')

                                    <li class="inventory">
                                        <p class="subtitle">{{(!empty($row_3['title'])) ? $row_3['title'] : ''}}</p>
                                        <textarea type="text" name="{{$set['name']}}[{{$row_3['value']}}][]" {{(!empty($row_3['disabled'])) ? $row_3['disabled'] : ''}}></textarea>

                                        @if (!empty($tip))
                                            <div class="tips">
                                            <span class="title">TIPS</span>
                                            <p>{!!(!empty($row_3['tip'])) ? $row_3['tip'] : ''!!}</p>
                                            </div>
                                        @endif
                                    </li>

                                @elseif ($row_3['type'] == 'sn_textArea')

                                    @php
                                        $row_3['sontable'] = true;
                                        $row_3['name'] = $set['name'] . '[' . $row_3['value'] . '][]';
                                        $row_3['tips'] = (!empty($row_3['tip'])) ? $row_3['tip'] : '';
                                    @endphp
                                    {{UnitMaker::sn_textArea($row_3)}}

                                @elseif ($row_3['type'] == 'radio_btn')

                                    @php
                                        $row_3['sontable'] = true;
                                        $row_3['sontable_add'] = true;
                                        $row_3['name'] = $set['name'] . '[' . $row_3['value'] . '][]';
                                        $row_3['value'] = 0;
                                    @endphp
                                    {{UnitMaker::radio_btn($row_3)}}

                                @elseif ($row_3['type'] == 'image_group')

                                    @php
                                        $title = (!empty($row_3['title'])) ? $row_3['title'] : '';
                                        $tip = (!empty($row_3['tip'])) ? $row_3['tip'] : '';
                                        $image_array = (!empty($row_3['image_array'])) ? $row_3['image_array'] : [];

                                        $fileInformationArray = [];
                                        $fileIds = [];
                                    @endphp

                                    <li class="inventory  productImage">
                                        <p class="subtitle">{{$title}}</p>
                                        <div class="picture_box">

                                            @foreach ($image_array as $key_img => $value_img)
                                                @php
                                                    // $length = 3;
                                                    // $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
                                                    // $charactersLength = strlen($characters);
                                                    // $randomWord_img = '';
                                                    // for ($i = 0; $i < $length; $i++) {
                                                    //     $randomWord_img .= $characters[rand(0, $charactersLength - 1)];
                                                    // }
                                                    $randomWord_img = \Illuminate\Support\Str::random(9);
                                                    $imgClass = '';
                                                    $imgSrc = 'javascript:;';

                                                    if ($value_img['set_size'] == 'yes') {
                                                        $width = ($value_img['width'] / $value_img['height']) * 100;
                                                        $width .= 'px;';
                                                        $img_style = '';
                                                    } else {
                                                        $width = 'auto;';
                                                        $img_style = 'height:auto;';
                                                    }

                                                    if (isset($value_img['disabled']) and $value_img['disabled'] == 'disabled') {
                                                        $lbox_fms_open = '';
                                                    } else {
                                                        $lbox_fms_open = 'lbox_fms_open';
                                                    }
                                                @endphp

                                                <div class="frame open_fms_lightbox {{$imgClass}}">
                                                    <div class="box" style="width:{{$width}}">
                                                        <img src="{{$imgSrc}}" style="{{$img_style}}" class="addImgClass" data-key="{{$randomWord_img}}">
                                                        <input type="hidden" name="{{$set['name']}}[{{$value_img['value']}}][]" value="" class="addImgValClass" data-key="{{$randomWord_img}}">
                                                        <span class="icon fa fa-plus addImgKey {{$lbox_fms_open}}" data-key="{{$randomWord_img}}" data-type="img"></span>
                                                        <div class="tool">
                                                            <span class="t_icon fa fa-folder file_detail_btn"></span>
                                                            <span class="t_icon fa fa-pencil addImgKey {{$lbox_fms_open}}" data-key="{{$randomWord_img}}" data-type="img"></span>
                                                            <span class="t_icon fa fa-trash image_remove" data-key="{{$randomWord_img}}" data-type="img"></span>
                                                        </div>
                                                    </div>

                                                    <div class="info">
                                                        <p>{{$value_img['title']}}</p>
                                                    </div>

                                                    <div class="file_detail_box">
                                                        <div class="info_detail">
                                                            <p class="addFileClass"><span>FILE</span></p>
                                                            <p class="addFolderClass"><span>FOLDER</span></p>
                                                            <p class="addTypeClass"><span>TYPE</span></p>
                                                            <p class="addSizeClass"><span>SIZE</span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        @if (!empty($tip))
                                            <div class="tips">
                                                <span class="title">PHOTO TIPS</span>
                                                <p>{!!$tip!!}</p>
                                            </div>
                                        @endif
                                    </li>

                                @elseif ($row_3['type'] == 'selectMulti')
                                
                                    @php
                                        $title = (!empty($row_3['title'])) ? $row_3['title'] : '';
                                        $select_value = (!empty($row_3['value'])) ? $row_3['value'] : 0;
                                        $select_options = (!empty($row_3['options'])) ? $row_3['options'] : [];
                                        $options_group_set = (!empty($row_3['options_group_set'])) ? $row_3['options_group_set'] : 'no';
                                        $options_group = (!empty($row_3['options_group'])) ? $row_3['options_group'] : [];
                                        $tip = (!empty($row_3['tip'])) ? $row_3['tip'] : '';

                                        // $length = 17;
                                        // $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
                                        // $charactersLength = strlen($characters);
                                        // $randomWord_multi = '';
                                        // for ($i = 0; $i < $length; $i++) {
                                        //     $randomWord_multi .= $characters[rand(0, $charactersLength - 1)];
                                        // }

                                        $randomWord_multi =  \Illuminate\Support\Str::random(17);
                                    @endphp

                                    <li class="inventory">
                                        <p class="subtitle">{{$title}}</p>
                                        <div class="inner">
                                            <div class="quill_select multi_select">
                                                <div class="select_object">
                                                    <p class="title addMultiKey" data-key="{{$randomWord_multi}}"></p>
                                                    <span class="arrow pg-arrow_down"></span>
                                                </div>

                                                @if (!empty($disabled) and $disabled == 'disabled')

                                                @else
                                                    <input type="hidden" name="{{$set['name']}}[{{$row_3['value']}}][]" value="" class="addMulitSelectClass" data-key="{{$randomWord_multi}}">
                                                    <div class="select_wrapper">
                                                        <ul class="addMultiKey addMulitListClass select_list" data-key="{{$randomWord_multi}}">
                                                            @if ($options_group_set == 'yes')
                                                                @foreach ($options_group as $key_1 => $row_1)
                                                                    <p class="category">{{$row_1['title']}}</p>

                                                                    @foreach ($row_1['key'] as $row_key)
                                                                        @foreach ($select_options as $keyy => $roww)
                                                                            @if ($value_o['key'] == $row_key)
                                                                                <li class="multi_select_fantasy option {{''}}" data-id="{{$roww['key']}}">
                                                                                    <p>{{$roww['title']}}</p>
                                                                                </li>
                                                                            @endif
                                                                        @endforeach
                                                                    @endforeach
                                                                @endforeach
                                                                
                                                            @else

                                                                @foreach ($select_options as $keyy => $roww)
                                                                    <li class="multi_select_fantasy option {{''}}" data-id="{{$roww['key']}}">
                                                                        <p>{{$roww['title']}}</p>
                                                                    </li>
                                                                @endforeach

                                                            @endif
                                                        </ul>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        @if (!empty($tip))
                                            <div class="tips">
                                                <span class="title">TIPS</span>
                                                <p>{!!$tip!!}</p>
                                            </div>
                                        @endif
                                    </li>

                                @elseif ($row_3['type'] == 'selectMultiBydata')

                                    @php
                                        $row_3['sontable'] = true;
                                        $row_3['sontable_add'] = true;
                                        $row_3['name'] = $set['name'] . '[' . $row_3['value'] . '][]';
                                    @endphp
                                    {{UnitMaker::selectMultiBydata($row_3)}}

                                @elseif ($row_3['type'] == 'selectGroup')

                                    @php
                                        $row_3['sontable'] = true;
                                        $row_3['sontable_add'] = true;
                                        $row_3['rand'] = '';
                                        $row_3['name'] = $set['name'] . '[' . $row_3['value'] . '][]';
                                        $row_3['value'] = 0;
                                    @endphp
                                    {{UnitMaker::selectGroup($row_3)}}

                                @elseif ($row_3['type'] == 'datePicker')

                                    @php
                                        $title = (!empty($row_3['title'])) ? $row_3['title'] : '';
                                        $tip = (!empty($row_3['tip'])) ? $row_3['tip'] : '';
                                    @endphp

                                    <li class="inventory">
                                        <p class="subtitle">{{$title}}</p>

                                        <div class="inner">
                                        @if (!empty($disabled) and $disabled == 'disabled')
                                            <input type="text" class="normal_input" name="{{$set['name']}}[{{$row_3['value']}}][]" value="" {{(!empty($row_3['disabled'])) ? $row_3['disabled'] : ''}}>
                                        @else
                                            <input type="text" class="normal_input datepicker-input" name="{{$set['name']}}[{{$row_3['value']}}][]" value="">
                                        @endif

                                        @if (!empty($tip))
                                            <div class="tips">
                                                <span class="title">TIPS</span>
                                                <p>{!!$tip!!}</p>
                                            </div>
                                        @endif
                                        </div>
                                    </li>
                                
                                @elseif($row_3['type'] == 'dateRange')
                                
                                    @php
                                        $row_3['sontable'] = true;
                                        $row_3['sontable_add'] = true;
                                        $row_3['name'] = $set['name'].'['.$row_3['value'].'][]';
                                        $row_3['name2'] = $set['name'].'['.$row_3['value2'].'][]';
                                        $row_3['value'] = '';
                                        $row_3['value2'] = '';
                                    @endphp
                                    {{UnitMaker::dateRange($row_3)}}
                                
                                @elseif ($row_3['type'] == 'colorPicker') 
                                
                                    @php
                                        $title = (!empty($row_3['title'])) ? $row_3['title'] : '';
                                        $tip = (!empty($row_3['tip'])) ? $row_3['tip'] : '';
                                        $disabled = (!empty($row_3['disabled'])) ? $row_3['disabled'] : '';
                                    @endphp

                                    @if (!empty($disabled) and $disabled == 'disabled')
                                        <li class="inventory">
                                            <p class="subtitle">{{$title}}</p>
                                            <div class="color_picker">
                                                <div class="sp-replacer sp-light">
                                                    <div class="sp-preview">
                                                        <div class="sp-preview-inner" style="background-color:#fff;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="ticket_field" style="">
                                                    <p>{{$row[$row_3['value']]}}</p>
                                                </div>
                                            </div>
                                            @if (!empty($tip))
                                                <div class="tips">
                                                <span class="title">TIPS</span>
                                                <p>{!!$tip!!}</p>
                                                </div>
                                            @endif
                                        </li>
                                    @else
                                        <li class="inventory">
                                            <p class="subtitle">{{$title}}</p>
                                            <div class="color_picker">
                                                <input type="text" class="palette" value="#fff" name="{{$set['name']}}[{{$row_3['value']}}][]"/>
                                            </div>
                                            @if (!empty($tip))
                                                <div class="tips">
                                                    <span class="title">TIPS</span>
                                                    <p>{!!$tip!!}</p>
                                                </div>
                                            @endif
                                        </li>
                                    @endif

                                @elseif ($row_3['type'] == 'filePicker')

                                    @php
                                        $title = (!empty($row_3['title'])) ? $row_3['title'] : '';
                                        $tip = (!empty($row_3['tip'])) ? $row_3['tip'] : '';
                                        $disabled = (!empty($row_3['disabled'])) ? $row_3['disabled'] : '';

                                        if (!empty($disabled) and $disabled == 'disabled') {
                                            $openClass = '';
                                        } else {
                                            $openClass = 'lbox_fms_open';
                                        }

                                        // $length = 25;
                                        // $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
                                        // $charactersLength = strlen($characters);
                                        // $randomWord = '';
                                        // for ($i = 0; $i < $length; $i++) {
                                        //     $randomWord .= $characters[rand(0, $charactersLength - 1)];
                                        // }
                                         $randomWord=\Illuminate\Support\Str::random(25);
                                    @endphp

                                    <li class="inventory">
                                        <p class="subtitle">{{$title}}</p>
                                        <input class="normal_input filepicker_input_key" type="text" value="" data-key="{{$randomWord}}" style="width:89%;" disabled>
                                        <input class="filepicker_change_key normal_input {{$openClass}}" type="button" value="..." style="width:5%;cursor: pointer;" data-key="{{$randomWord}}" data-type="file">
                                        <input class="normal_input file_fantasy_download filepicker_src_key filepicker_title_key" type="button" value="⇩" style="width:5%;cursor: pointer;" data-src="" data-title="" data-key="{{$randomWord}}">
                                        <input type="hidden" value="" name="{{$set['name']}}[{{$row_3['value']}}][]" class="filepicker_value_key" data-key="{{$randomWord}}">

                                        @if (!empty($tip))
                                            <div class="tips">
                                                <span class="title">TIPS</span>
                                                <p>{!!$tip!!}</p>
                                            </div>
                                        @endif
                                    </li>

                                @endif
                            @endforeach

                            {{-------------------------------第三層圖片管理-------------------------------}}
                            @php
                                $is_three = (!empty($row_2['is_three'])) ? $row_2['is_three'] : 'no';
                                $three = (!empty($row_2['three'])) ? $row_2['three'] : [];
                            @endphp

                            @if ($is_three == 'yes')

                                @php
                                    $son_son_db = $row_2['three_model'];

                                    // $length = 9;
                                    // $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
                                    // $charactersLength = strlen($characters);
                                    // $third_randomWord = '';
                                    // for ($i = 0; $i < $length; $i++) {
                                    //     $third_randomWord .= $characters[rand(0, $charactersLength - 1)];
                                    // }
                                    $third_randomWord = \Illuminate\Support\Str::random(9);

                                    $is_add = isset($three['is_add']) ? $three['is_add'] : 'no';
                                    $is_photo = isset($three['is_photo']) ? $three['is_photo'] : 'no';
                                    $is_embed = isset($three['is_embed']) ? $three['is_embed'] : 'no';
                                    $is_video = isset($three['is_video']) ? $three['is_video'] : 'no';

                                    $is_add_three_content = isset($three['is_add_three_content']) ? $three['is_add_three_content'] : 'no';
                                    $three_content = isset($three['three_content']) ? $three['three_content'] : [];

                                    $threeDataArray =[
                                                'son_son_db' => $son_son_db,
                                                'three'=>$three,
                                                'is_add'=>$is_add,
                                                'is_photo'=>$is_photo,
                                                'is_embed'=>$is_embed,
                                                'is_video'=>$is_video,
                                            ]; 
                                    $add_html = View::make('Fantasy.cms.includes.template.sontable.add_html', $threeDataArray)->render(); 
                                    $photo_html = View::make('Fantasy.cms.includes.template.sontable.photo_html', $threeDataArray)->render(); 
                                    $video_html = View::make('Fantasy.cms.includes.template.sontable.video_html', $threeDataArray)->render(); 
                                    $embed_html = View::make('Fantasy.cms.includes.template.sontable.embed_html', $threeDataArray)->render(); 
                                @endphp                     

                                <li class="inventory">
                                    <p class="subtitle">{{$three['title']}}</p>

                                    <div class="tips">
                                        <span class="title">TIPS</span>
                                        <p>{{$three['tip']}}</p>
                                    </div>

                                    {{-- /*編輯按鈕群*/ --}}
                                    <div class="frame">
                                        <!--photo，video點了打開FMS ， embed點了直接新增一個list-->
                                        <ul class="table_head">
                                            <li class="table_head_th">

                                                @if ($is_photo == 'yes')
                                                    @if (!empty($is_add) && $is_add == "yes")
                                                        <div class="td tool_btn addInThirdTb" data-table="{{$third_randomWord}}" toolBtn-id="1" data-content='{{$add_html}}'>
                                                            <!--打開fms-->
                                                            <span class="fa fa-plus"></span>
                                                            <p>Add</p>
                                                        </div>
                                                    @else
                                                        <div class="td tool_btn addInThirdTb" data-table="{{$third_randomWord}}" toolBtn-id="1" data-content='{{$photo_html}}'>
                                                            <!--打開fms-->
                                                            <span class="fa fa-plus"></span>
                                                            <p>Photo</p>
                                                        </div>
                                                    @endif
                                                @endif

                                                @if ($is_video == 'yes')
                                                    <div class="td tool_btn addInThirdTb" data-table="{{$third_randomWord}}" toolBtn-id="2" data-content='{{$video_html}}'>
                                                        <!--打開fms-->
                                                        <span class="fa fa-plus"></span>
                                                        <p>Video</p>
                                                    </div>
                                                @endif

                                                @if ($is_embed == 'yes')
                                                    <div class="td tool_btn addInThirdTb" data-table="{{$third_randomWord}}" toolBtn-id="3" data-content='{{$embed_html}}'>
                                                        <span class="fa fa-plus"></span>
                                                        <p>Embed Video</p>
                                                    </div>
                                                @endif

                                                <div class="td tool_btn deleteThirdTableDataGroup" data-table="{{$third_randomWord}}" toolBtn-id="4" data-model="{{$son_son_db}}">
                                                    <span class="fa fa-trash"></span>
                                                    <p>Delete</p>
                                                </div>

                                                <div class="td tool_btn rankThirdUp" toolBtn-id="5" data-table="{{$third_randomWord}}">
                                                    <span class="fa fa-long-arrow-up"></span>
                                                    <p>Sort Up</p>
                                                </div>

                                                <div class="td tool_btn rankThirdDown" toolBtn-id="6" data-table="{{$third_randomWord}}">
                                                    <span class="fa fa-long-arrow-down"></span>
                                                    <p>Sort Down</p>
                                                </div>
                                            </li>
                                        </ul>

                                        <ul class="table_list quill_partImg table_box thirdTb_{{$third_randomWord}}">
                                        </ul>
                                    </div>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
        
</div>
{{--------------------------------------------------------------------------}}
