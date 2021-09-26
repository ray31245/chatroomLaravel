{{-- Table的按鈕 --}}
<li>
    <!--按鈕群-->
    <section class="composite_btn">
        {{--    Tips --}}
        @if (!empty($table_tip))
            <div class="for_ajax_tips">
                <div class="tips">
                    <span class="title">TIPS</span>
                    <p>{!!$table_tip!!}</p>
                </div>
            </div>
        @endif
        
        <div class="for_ajax_box">
            {{-- 按鈕框框 --}}
            @if ($create == 'yes' || $delete == 'yes' || $sort == 'yes' || $teach == 'yes')
                @if ($MultiDatacreate == 'yes')
                    <ul class="box open_db_lightbox">
                @else
                    <ul class="box">
                @endif
            @endif

            {{-- 新增按鈕 --}}
            @if ($create == 'yes')
                <li data-table="{{$randomWord}}" class="addValueInTable" data-content="{{$stack}}">
                    <span class="fa fa-plus"></span>
                    <p>Add</p>
                </li>
            @endif

            {{-- 批次新增圖片按鈕 --}}
            @if ($MultiImgcreate == 'yes')
                <li data-table="{{$randomWord}}" data-key="{{$randomWord}}" class="lbox_fms_open" data-model="{{$set['name']}}" data-type="sontable" data-column="{{$set['imageColumn']}}" data-content="{{$stack}}">
                    <span class="fa fa-plus"></span>
                    <p>Add multi image</p>
                </li>
            @endif

            {{-- 批次新增單選按鈕 --}}
            @if ($MultiDatacreate == 'yes')
                <li data-table="{{$randomWord}}" data-key="{{$randomWord}}" class="ajax_open sontable" data-sontablemodel="{{$set['name']}}" data-model="{{$set['MultiDatamodel']}}" data-type="sontable" data-cls="sontable"  data-column="{{$set['DataColumn']}}" data-content="{{$stack}}">
                    <span class="fa fa-plus"></span>
                    <p>Add multi By Data</p>
                </li>
            @endif

            {{-- 刪除按鈕 --}}
            @if ($delete == 'yes')
                <li data-table="{{$randomWord}}" class="deleteSonTableDataGroup" data-model="{{$set['name']}}">
                    <span class="fa fa-trash"></span>
                    <p>Delete</p>
                </li>
            @endif

            {{-- 排序按鈕 --}}
            @if ($sort == 'yes')
                <li data-table="{{$randomWord}}" class="rankSonTableUp">
                    <span class="fa fa-long-arrow-up"></span>
                    <p>Sort Up</p>
                </li>

                <li data-table="{{$randomWord}}" class="rankSonTableDown">
                    <span class="fa fa-long-arrow-down"></span>
                    <p>Sort Down</p>
                </li>
            @endif

            {{-- 不知道是甚麼按鈕 --}}
            @if ($teach == 'yes')
                <li data-table="{{$randomWord}}">
                    <span class="fa fa-question-circle"></span>
                    <p>Teaching</p>
                </li>
            @endif

        {{-- 按鈕END --}}
        @if ($create == 'yes' || $delete == 'yes' || $sort == 'yes' || $teach == 'yes')
            </ul>
        @endif
        </div>
    </section>
</li>

{{-- table內容 --}}
{{---- 表頭 ----}}
@if (empty($value))
    <li data-table="{{$randomWord}}" class="emptyContent emptyContent_{{$randomWord}}">
        <!--沒內容-->
        <div class="no_content">
            <p class="title">NO CONTENT</p>
            <p class="text"></p>
        </div>
    </li>
    <li class="tabulation_head tabulation_head_{{$randomWord}}" style="display:none;">
@else
    <li class="tabulation_head tabulation_head_{{$randomWord}}">
@endif
        <div class="list">
            <div class="item t-a-c check_box">
                <p>選擇</p>
            </div>

            @if ($sort == 'yes')
                <div class="item t-a-c sort_number">
                    <p>順序</p>
                </div>
            @endif

            @foreach ($tableSet as $key => $row)
                @if ($row['type'] == 'radio_btn')
                    <div class="item t-a-c switch_btn">
                        <p>{{$row['title']}}</p>
                    </div>
                @else
                    <div class="item t-a-c text">
                        <p>{{$row['title']}}</p>
                    </div>
                @endif
            @endforeach

            <div class="item t-a-c edit_btnGroup">
                <p>編輯</p>
            </div>
        </div>
    </li>


<li class="tabulation_body contnetParagraph tabulation_body_{{$randomWord}}" data-table="{{$randomWord}}">
    @php    
        // 得擋案Array
        $files_temp_array = [];
        $fileIds = [];
        foreach ($value as $key => $row) {
            foreach ($tableSet as $key2 => $row2) {
                if ($row2['type'] == 'filesText') {
                    array_push($fileIds, $row[$row2['value']]);
                }
            }
        }
        $files_temp_array = BaseFunction::getFilesArray($fileIds);
        // 擋案Array---END
    @endphp
@foreach ($value as $key => $row)
        @php
            $keyRank = $key + 1;
            $randomWord_va = \Illuminate\Support\Str::random(5);
        @endphp

        <div class="list stack_state cms_new_{{$randomWord_va}}" data-key="{{$randomWord_va}}" data-id="{{$row['id']}}" data-rank="{{$keyRank}}">
            <div class="list_box">
                <div class="item check_box cms_new_{{$randomWord_va}}" data-id="{{$row['id']}}" data-key="{{$randomWord_va}}">
                    <input type="checkbox" class="content_input list_checkbox">
                    <label class="content_inputBox">
                        <span></span>
                    </label>
                </div>
                <input type="hidden" value="{{$row['id']}}" name="{{$set['name']}}[id][]" class="cms_new_{{$randomWord_va}}">
                <input type="hidden" value="{{$randomWord_va}}" name="{{$set['name']}}[quillFantasyKey][]">

                @if ($sort == 'yes')
                    <div class="item sort_number">
                        <p>{{$keyRank}}</p>
                        <input type="hidden" value="{{$keyRank}}" name="{{$set['name']}}[rank][]">
                    </div>
                @endif

                {{-- 表格內容 --}}
                @foreach ($tableSet as $key2 => $row2)
                    @if ($row2['type'] == 'textInput')
                        
                        @if (!empty($row[$row2['value']]))
                            <div class="item text">
                                <input type="text" value="{{$row[$row2['value']]}}" style="border-style:none;" name="{{$set['name']}}[{{$row2['value']}}][]">
                            </div>
                        @else
                            <div class="item text">
                                <input type="text" value="{{!empty($row2['default']) ? $row2['default'] : ''}}" style="border-style:none" name="{{$set['name']}}[{{$row2['value']}}][]">
                            </div>
                        @endif

                    @elseif ($row2['type'] == 'filesText')

                        @if (isset($files_temp_array[$row[$row2['value']]]))
                            @if ($files_temp_array[$row[$row2['value']]]['type'] == 'pdf')

                            @else
                                <div class="item text btn_ctable">
                                    <div class="s_img">
                                        <img src="{{$files_temp_array[$row[$row2['value']]]['real_route']}}" alt="">
                                    </div>
                                    <p>{{$files_temp_array[$row[$row2['value']]]['title']}}.{{$files_temp_array[$row[$row2['value']]]['type']}}</p>
                                </div>
                            @endif
                        @else
                            <div class="item text btn_ctable">
                                <div class="s_img">
                                    <img src="" alt="">
                                </div>
                                <p></p>
                            </div>
                        @endif

                    @elseif ($row2['type'] == 'radio_btn')

                        @if ($row[$row2['value']] == 0)
                            <div class="item switch_btn ios_switch radio_btn_switch">
                        @else
                            <div class="item switch_btn ios_switch radio_btn_switch on">
                        @endif

                                <input type="text" name="{{$set['name']}}[{{$row2['value']}}][]" value="{{$row[$row2['value']]}}">
                                <div class="box">
                                    <span class="ball"></span>
                                </div>
                            </div>

                    @elseif ($row2['type'] == 'select_just_show')

                        @php
                            $temp_options = (!empty($row2['options'])) ? $row2['options'] : [];
                            $this_value = (!empty($row[$row2['value']])) ? $row[$row2['value']] : 0;
                        @endphp

                        <div class="item text btn_ctable">
                            @if (isset($temp_options[$this_value]['title']) and !empty($temp_options[$this_value]['title']))
                                <p>{{$temp_options[$this_value]['title']}}</p>
                            @else
                                <p>-</p>
                            @endif
                        </div>

                    @elseif ($row2['type'] == 'select')

                        @php
                            $temp_options = (!empty($row2['options'])) ? $row2['options'] : [];
                            $options_group_set = (!empty($row2['options_group_set'])) ? $row2['options_group_set'] : 'no';
                            $options_group = (!empty($row2['options_group'])) ? $row2['options_group'] : [];
                            $this_value = (!empty($row[$row2['value']])) ? $row[$row2['value']] : 0;
                        @endphp

                        <div class="item text">
                            <div class="quill_select" style="width:100%;">
                                <div class="select_object" style="border-style: none;">
                                    @if (isset($temp_options[$this_value]['title']) and !empty($temp_options[$this_value]['title']))
                                        <p class="title">{{$temp_options[$this_value]['title']}}</p>
                                    @else
                                        <p class="title"></p>
                                    @endif
                                    <span class="arrow pg-arrow_down"></span>
                                </div>

                                <div class="select_wrapper">
                                    <ul class="select_list edit_select">
                                        @if ($options_group_set == 'yes')
                                            @foreach ($options_group as $key_1 => $row_1)
                                                <p class="category">{{$row_1['title']}}</p>

                                                @foreach ($row_1['key'] as $row2)
                                                    @foreach ($temp_options as $key3 => $row3)
                                                        @if ($row3['key'] == $row2)
                                                            <li class="option single_select_fantasy" data-id="{{$row3['key']}}">
                                                                <p>{{$row3['title']}}</p>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        @else
                                            @foreach ($temp_options as $key3 => $row3) {
                                                <li class="option single_select_fantasy" data-id="{{$row3['key']}}">
                                                    <p>{{$row3['title']}}</p>
                                                </li>
                                            @endforeach
                                        @endif

                                        <input type="hidden" name="{{$set['name']}}[{{$row2['value']}}][]" value="{{$this_value}}">
                                    </ul>
                                </div>
                            </div>
                        </div>

                    @elseif ($row2['type'] == 'just_show')

                        @if (!empty($row[$row2['value']]))
                            <div class="item text btn_ctable">
                                <p>{{$row[$row2['value']]}}</p>
                            </div>
                        @else
                            <div class="item text btn_ctable">
                                <p>{{!empty($row2['default']) ? $row2['default'] : ''}}</p>
                            </div>
                        @endif

                    @endif
                @endforeach
                
                {{-- 編輯按鈕群 --}}
                <div class="item edit_btnGroup">

                    @if ($hasContent == 'yes')
                        <span class="fa fa-pencil-square-o btn_ctable" data-key="{{$randomWord_va}}"></span>
                    @endif

                    @if($delete == 'yes')
                        <span class="fa fa-trash deleteSonTableData" data-id="{{$row['id']}}" data-key="{{$randomWord_va}}" data-model="{{$set['name']}}"></span>
                    @endif

                    @if ($is_link == 'yes')
                        <a href="javascript:;" class="{{$link_class}}" @foreach ($link_key as $dataSet) data-{{$dataSet}}="{{$row[$dataSet]}}" @endforeach>
                            <span class="fa fa-link"></span>
                        </a>
                    @endif
                </div>
                {{-- 編輯按鈕群 --- END --}}
            </div>

            @if ($hasContent == 'yes')
                <div class="list_frame list_frame_{{$randomWord_va}}">

                    {{-- $tabSet --}}
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
                                    @foreach ($row_2['content'] as $key_3 => $row_3)

                                        @php
                                            $auto = (isset($row_3['auto'])) ? ' AutoSet':'';
                                            $autoSelect = (isset($row_3['auto'])) ? 'AutoSetSelect':'';
                                            $autosetup = (isset($row_3['auto'])) ? 'AutoSet_'.$row_3['value']:'';    
                                        @endphp
                                        
                                        @if ($row_3['type'] == 'textInput')

                                            <li class="inventory">
                                                <p class="subtitle">{{!empty($row_3['title']) ? $row_3['title'] : ''}}</p>

                                                <input class="normal_input {{$auto}}" data-autosetup="{{$autosetup}}" type="text" value="{{$row[$row_3['value']]}}" name="{{$set['name']}}[{{$row_3['value']}}][]" {{!empty($row_3['disabled']) ? $row_3['disabled'] : ''}}>
                                                @if (!empty($row_3['tip']))
                                                    <div class="tips">
                                                        <span class="title">TIPS</span>
                                                        <p>{!!$row_3['tip']!!}</p>
                                                    </div>
                                                @endif
                                            </li>

                                        @elseif ($row_3['type'] == 'select')
                                        
                                            @php
                                                $row_3['auto'] = $autoSelect;
                                                $row_3['autosetup'] = $autosetup; 
                                                $row_3['sontable'] = true;
                                                $row_3['sontable_add'] = true;
                                                $row_3['name'] = $set['name'] . '[' . $row_3['value'] . '][]';
                                                $row_3['value'] = $row[$row_3['value']];
                                                $row_3['custom'] = true;                                         
                                            @endphp
                                            {{UnitMaker::select2($row_3)}}
                                            
                                        @elseif ($row_3['type'] == 'selectBydata')

                                            @php
                                                $row_3['sontable'] = true;
                                                $row_3['sontable_add'] = true;
                                                $row_3['name'] = $set['name'] . '[' . $row_3['value'] . '][]';
                                                $row_3['value'] = $row[$row_3['value']];
                                            @endphp
                                            {{UnitMaker::selectBydata($row_3)}}

                                        @elseif ($row_3['type'] == 'textArea')

                                            <li class="inventory">
                                                <p class="subtitle">{{!empty($row_3['title']) ? $row_3['title'] : ''}}</p>
                                                <textarea type="text" name="{{$set['name']}}[{{$row_3['value']}}][]" {{!empty($row_3['disabled']) ? $row_3['disabled'] : ''}}>{{$row[$row_3['value']]}}</textarea>

                                                @if (!empty($row_3['tip']))
                                                    <div class="tips">
                                                        <span class="title">TIPS</span>
                                                        <p>{!!$row_3['tip']!!}</p>
                                                    </div>
                                                @endif
                                            </li>

                                        @elseif ($row_3['type'] == 'sn_textArea')

                                            @php
                                                $row_3['sontable'] = true;
                                                $row_3['name'] = $set['name'] . '[' . $row_3['value'] . '][]';
                                                $row_3['value'] = $row[$row_3['value']];
                                                $row_3['tips'] = (!empty($row_3['tip'])) ? $row_3['tip'] : '';
                                            @endphp
                                            {{UnitMaker::sn_textArea($row_3)}}

                                        @elseif ($row_3['type'] == 'radio_btn')

                                            @php
                                                $row_3['sontable'] = true;
                                                $row_3['sontable_add'] = false;
                                                $row_3['name'] = $set['name'] . '[' . $row_3['value'] . '][]';
                                                $row_3['value'] = $row[$row_3['value']];
                                            @endphp
                                             {{UnitMaker::radio_btn($row_3)}}

                                        @elseif ($row_3['type'] == 'image_group')

                                            @php
                                                $image_array = !empty($row_3['image_array']) ? $row_3['image_array'] : [];
                                                $fileInformationArray = [];
                                                $fileIds = [];
                                                foreach ($image_array as $key_img => $value_img) {
                                                    array_push($fileIds, $row[$value_img['value']]);
                                                }
                                                if (!empty($fileIds)) {
                                                    $fileInformationArray = BaseFunction::getFilesArray($fileIds);
                                                }
                                            @endphp

                                           <li class="inventory  productImage">
                                                <p class="subtitle">{{!empty($row_3['title']) ? $row_3['title'] : ''}}</p>

                                                <div class="picture_box">
                                                    @foreach ($image_array as $key_img => $value_img)

                                                        @php
                                                            // $length = 34;
                                                            // $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
                                                            // $charactersLength = strlen($characters);
                                                            // $randomWord_img = '';
                                                            // for ($i = 0; $i < $length; $i++) {
                                                            //     $randomWord_img .= $characters[rand(0, $charactersLength - 1)];
                                                            // }
                                                            $randomWord_img = \Illuminate\Support\Str::random(34);

                                                            if (isset($fileInformationArray[$row[$value_img['value']]]) and !empty($fileInformationArray[$row[$value_img['value']]])) {
                                                                $imgClass = 'has_img';
                                                                $imgSrc = $fileInformationArray[$row[$value_img['value']]]['real_route'];
                                                            } else {
                                                                $imgClass = '';
                                                                $imgSrc = 'javascript:;';
                                                            }

                                                            if ($value_img['set_size'] == 'yes') {
                                                                $width = ($value_img['width'] / $value_img['height']) * 100;
                                                                $width .= 'px;';
                                                                $img_style = '';
                                                            } else {
                                                                $width = 'auto;';
                                                                $img_style = 'height:100px;';
                                                            }

                                                            if (isset($value_img['disabled']) and $value_img['disabled'] == 'disabled') {
                                                                $lbox_fms_open = '';
                                                            } else {
                                                                $lbox_fms_open = 'lbox_fms_open';
                                                            }
                                                        @endphp

                                                        <div class="frame open_fms_lightbox {{$imgClass}}">

                                                            <div class="box" style="width:{{$width}}">
                                                                <img src="{{$imgSrc}}" style="{{$img_style}}" class="img_{{$randomWord_img}}">
                                                                <input type="hidden" name="{{$set['name']}}[{{$value_img['value']}}][]" value="{{$row[$value_img['value']]}}" class="value_{{$randomWord_img}}">
                                                                <span class="icon fa fa-plus {{$lbox_fms_open}}" data-key="{{$randomWord_img}}" data-type="img"></span>

                                                                <div class="tool">
                                                                    <span class="t_icon fa fa-folder file_detail_btn"></span>
                                                                    <span class="t_icon fa fa-pencil {{$lbox_fms_open}}" data-key="{{$randomWord_img}}" data-type="img"></span>
                                                                    <span class="t_icon fa fa-trash image_remove" data-key="{{$randomWord_img}}" data-type="img"></span>
                                                                </div>
                                                            </div>

                                                            <div class="info">
                                                                <p>{{$value_img['title']}}</p>
                                                            </div>

                                                            @if (isset($fileInformationArray[$row[$value_img['value']]]) and !empty($fileInformationArray[$row[$value_img['value']]]))
                                                                @php
                                                                    $_this_file_path = BaseFunction::get_file_path($fileInformationArray[$row[$value_img['value']]]);
                                                                @endphp

                                                                <div class="file_detail_box">
                                                                    <div class="info_detail">
                                                                        <p class="file_{{$randomWord_img}}"><span>FILE</span>{{$fileInformationArray[$row[$value_img['value']]]['title']}}.{{$fileInformationArray[$row[$value_img['value']]]['type']}}</p>
                                                                        <p class="folder_{{$randomWord_img}}"><span>FOLDER</span>{{$_this_file_path}}</p>
                                                                        <p class="type_{{$randomWord_img}}"><span>TYPE</span>{{$fileInformationArray[$row[$value_img['value']]]['type']}}</p>
                                                                        <p class="size_{{$randomWord_img}}"><span>SIZE</span>{{$fileInformationArray[$row[$value_img['value']]]['resolution']}}</p>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <div class="file_detail_box">
                                                                    <div class="info_detail">
                                                                        <p class="file_{{$randomWord_img}}"><span>FILE</span></p>
                                                                        <p class="folder_{{$randomWord_img}}"><span>FOLDER</span></p>
                                                                        <p class="type_{{$randomWord_img}}"><span>TYPE</span></p>
                                                                        <p class="size_{{$randomWord_img}}"><span>SIZE</span></p>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>

                                                @if (!empty($row_3['tip']))
                                                    <div class="tips">
                                                        <span class="title">TIPS</span>
                                                        <p>{!!$row_3['tip']!!}</p>
                                                    </div>
                                                @endif
                                            </li>

                                        @elseif ($row_3['type'] == 'selectMulti')

                                            @php
                                                $select_value = (!empty($row[$row_3['value']])) ? $row[$row_3['value']] : '';
                                                $select_options = (!empty($row_3['options'])) ? $row_3['options'] : [];
                                                $options_group_set = (!empty($row_3['options_group_set'])) ? $row_3['options_group_set'] : 'no';
                                                $options_group = (!empty($row_3['options_group'])) ? $row_3['options_group'] : [];

                                                // 隨機亂碼
                                                // $length = 30;
                                                // $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
                                                // $charactersLength = strlen($characters);
                                                // $randomWord = '';
                                                // for ($i = 0; $i < $length; $i++) {
                                                //     $randomWord .= $characters[rand(0, $charactersLength - 1)];
                                                // }
                                                $randomWord = \Illuminate\Support\Str::random(30);
                                                
                                                // Json Decode
                                                if (!empty($select_value)) {
                                                    $value_array = json_decode($select_value, true);
                                                } else {
                                                    $value_array = [];
                                                }

                                                $select_value = htmlentities($select_value);
                                            @endphp

                                            <li class="inventory">
                                                <p class="subtitle">{{!empty($row_3['title']) ? $row_3['title'] : ''}}</p>

                                                <div class="inner">
                                                    <div class="quill_select multi_select">
                                                        <div class="select_object">
                                                            <p class="title" data-key="{{$randomWord}}"></p>
                                                            <span class="arrow pg-arrow_down"></span>
                                                        </div>

                                                        @if (!empty($disabled) and $disabled == 'disabled')

                                                        @else
                                                            <input type="hidden" name="{{$set['name']}}[{{$row_3['value']}}][]" value="{{$select_value}}" class="multi_select_{{$randomWord}}">
                                                            <div class="select_wrapper">
                                                                <ul class="select_list multi_sselect_list_{{$randomWord}}" data-key="{{$randomWord}}">

                                                                    @if ($options_group_set == 'yes')
                                                                        @foreach ($options_group as $key_1 => $row_1)
                                                                            <p class="category">{{$row_1['title']}}</p>

                                                                            @foreach ($row_1['key'] as $row_key)
                                                                                @foreach ($select_options as $keyy => $roww)
                                                                                    @if ($value_o['key'] == $row_key)
                                                                                        @php
                                                                                            $value_on = '';
                                                                                            foreach ($value_array as $keyy2 => $roww2) {
                                                                                                if ($roww2 == $roww['key']) {
                                                                                                    $value_on = 'default';
                                                                                                }
                                                                                            }
                                                                                        @endphp

                                                                                        <li class="multi_select_fantasy option {{$value_on}}" data-id="{{$roww['key']}}">
                                                                                            <p>{{$roww['title']}}</p>
                                                                                        </li>
                                                                                    @endif
                                                                                @endforeach
                                                                            @endforeach
                                                                        @endforeach
                                                                    @else
                                                                        @foreach ($select_options as $keyy => $roww)
                                                                            @php
                                                                                $value_on = '';
                                                                                foreach ($value_array as $keyy2 => $roww2) {
                                                                                    if ($roww2 == $roww['key']) {
                                                                                        $value_on = 'default';
                                                                                    }
                                                                                }
                                                                            @endphp

                                                                            <li class="multi_select_fantasy option {{$value_on}}" data-id="{{$roww['key']}}">
                                                                                <p>{{$roww['title']}}</p>
                                                                            </li>
                                                                        @endforeach
                                                                    @endif
                                                                </ul>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>

                                                @if (!empty($row_3['tip']))
                                                    <div class="tips">
                                                        <span class="title">TIPS</span>
                                                        <p>{!!$row_3['tip']!!}</p>
                                                    </div>
                                                @endif
                                            </li>

                                        @elseif ($row_3['type'] == 'selectGroup')

                                            @php
                                                $row_3['sontable'] = true;
                                                $row_3['sontable_add'] = false;
                                                $row_3['rand'] = $randomWord_va;
                                                $row_3['name'] = $set['name'] . '[' . $row_3['value'] . '][]';
                                                $row_3['value'] = $row[$row_3['value']];
                                            @endphp

                                            {{UnitMaker::selectGroup($row_3)}}

                                        @elseif ($row_3['type'] == 'selectMultiBydata')

                                            @php
                                                $row_3['sontable'] = true;
                                                $row_3['sontable_add'] = true;
                                                $row_3['name'] = $set['name'] . '[' . $row_3['value'] . '][]';
                                                $row_3['value'] = $row[$row_3['value']];
                                            @endphp
                                            {{UnitMaker::selectMultiBydata($row_3)}}

                                        @elseif ($row_3['type'] == 'datePicker')

                                            <li class="inventory">
                                                <p class="subtitle">{{!empty($row_3['title']) ? $row_3['title'] : ''}}</p>
                                                <div class="inner">
                                                    @if (!empty($disabled) and $disabled == 'disabled')
                                                        <input type="text" class="normal_input" name="{{$set['name']}}[{{$row_3['value']}}][]" value="{{$row[$row_3['value']]}}" {{!empty($row_3['disabled']) ? $row_3['disabled'] : ''}}>
                                                    @else
                                                        <input type="text" class="normal_input datepicker-input" name="{{$set['name']}}[{{$row_3['value']}}][]" value="{{$row[$row_3['value']]}}">
                                                    @endif

                                                    @if (!empty($row_3['tip']))
                                                    <div class="tips">
                                                        <span class="title">TIPS</span>
                                                        <p>{!!$row_3['tip']!!}</p>
                                                    </div>
                                                @endif
                                                </div>
                                            </li>
                                        
                                        @elseif($row_3['type'] == 'dateRange')
                                        
                                            @php
                                                $row_3['sontable'] = true;
                                                $row_3['sontable_add'] = false;
                                                $row_3['name'] = $set['name'].'['.$row_3['value'].'][]';
                                                $row_3['name2'] = $set['name'].'['.$row_3['value2'].'][]';
                                                $row_3['value'] = $row[$row_3['value']];
                                                $row_3['value2'] = $row[$row_3['value2']];
                                            @endphp
                                            {{UnitMaker::dateRange($row_3)}}
                                        
                                        @elseif ($row_3['type'] == 'colorPicker')

                                            @php
                                                $disabled = !empty($row_3['disabled']) ? $row_3['disabled'] : '';
                                            @endphp

                                            @if (!empty($disabled) and $disabled == 'disabled')
                                                <li class="inventory">
                                                    <p class="subtitle">{{!empty($row_3['title']) ? $row_3['title'] : ''}}</p>

                                                    <div class="color_picker">
                                                        <div class="sp-replacer sp-light">
                                                            <div class="sp-preview">
                                                                <div class="sp-preview-inner" style="background-color: {{$row[$row_3['value']]}};"></div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="ticket_field" style="">
                                                            <p>{{$row[$row_3['value']]}}</p>
                                                        </div>
                                                    </div>

                                                    @if (!empty($row_3['tip']))
                                                    <div class="tips">
                                                        <span class="title">TIPS</span>
                                                        <p>{!!$row_3['tip']!!}</p>
                                                    </div>
                                                @endif
                                                </li>
                                            @else
                                                <li class="inventory">
                                                    <p class="subtitle">{{!empty($row_3['title']) ? $row_3['title'] : ''}}</p>

                                                    <div class="color_picker">
                                                        <input type="text" class="palette" value="{{$row[$row_3['value']]}}" name="{{$set['name']}}[{{$row_3['value']}}][]"/>
                                                    </div>
                                                    @if (!empty($row_3['tip']))
                                                        <div class="tips">
                                                            <span class="title">TIPS</span>
                                                            <p>{!!$row_3['tip']!!}</p>
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

                                                $fileInformationArray = [];
                                                $fileIds = [];

                                                array_push($fileIds, $row[$row_3['value']]);
                                                if (!empty($fileIds)) {
                                                    $fileInformationArray = BaseFunction::getFilesArray($fileIds);
                                                }


                                                // $length = 12;
                                                // $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
                                                // $charactersLength = strlen($characters);
                                                // $randomWord = '';
                                                // for ($i = 0; $i < $length; $i++) {
                                                //     $randomWord .= $characters[rand(0, $charactersLength - 1)];
                                                // }
                                                
                                                $randomWord = \Illuminate\Support\Str::random(12);
                                                if (isset($fileInformationArray[$row[$row_3['value']]]) and !empty($fileInformationArray[$row[$row_3['value']]])) {
                                                    $fileData = $fileInformationArray[$row[$row_3['value']]]['title'] . '.' . $fileInformationArray[$row[$row_3['value']]]['type'];
                                                    $fileRoute = $fileInformationArray[$row[$row_3['value']]]['real_route'];
                                                } else {
                                                    $fileData = '';
                                                    $fileRoute = '';
                                                }
                                            @endphp

                                            <li class="inventory">
                                                <p class="subtitle">{{$title}}</p>'
                                            
                                                <input class="normal_input filepicker_input_{{$randomWord}}" type="text" value="{{$fileData}}" style="width:70%;" disabled>
                                                <input class="normal_input {{$openClass}}" type="button" value="..." style="width:5%;cursor: pointer;" data-key="{{$randomWord}}" data-type="file">
                                                
                                                @if ($fileData != "")
                                                    <input class="normal_input file_fantasy_download filepicker_src_{{$randomWord}} filepicker_title_{{$randomWord}} type="button" value="⇩" style="width:5%;cursor: pointer;" data-src="{{$fileRoute}}" data-title="{{$fileData}}">
                                                    <input id="onlyfileremove" class="normal_input fa-remove"  type="button" value="X" style="width:5%;cursor: pointer;" >
                                                @endif

                                                <input type="hidden" value="{{$row[$row_3['value']]}}" name="{{$set['name']}}[{{$row_3['value']}}][]" class="filepicker_value_{{$randomWord}}">
                                                @if (!empty($row_3['tip']))
                                                    <div class="tips">
                                                        <span class="title">TIPS</span>
                                                        <p>{!!$row_3['tip']!!}</p>
                                                    </div>
                                                @endif
                                            </li>
                                        @endif
                                    @endforeach

                                    @php
                                        $is_three = (!empty($row_2['is_three'])) ? $row_2['is_three'] : 'no';
                                        $three = (!empty($row_2['three'])) ? $row_2['three'] : [];
                                    @endphp
                                    
                                    @if ($is_three == 'yes') 
                                        @php
                                            $son_son_db = $row_2['three_model'];
                                            $third_randomWord = \Illuminate\Support\Str::random(9);

                                            $threeDataArray =[
                                                'son_son_db' => $son_son_db,
                                                'three'=>$three,
                                            ]; 
                                            $add_html = View::make('Fantasy.cms.includes.template.WNsontable.add_html', $threeDataArray)->render(); 
                                        @endphp   

                                        <li class="inventory">
                                            <p class="subtitle">{{$three['title']}}</p>

                                            <div class="tips">
                                                <span class="title">TIPS</span>
                                                <p>{!!$three['tip']!!}</p>
                                            </div>

                                            {{-- 編輯按鈕群 --}}
                                            <div class="frame">
                                                <!--photo，video點了打開FMS ， embed點了直接新增一個list-->
                                                <ul class="table_head">
                                                    <li class="table_head_th">                                                        
                                                        
                                                        <div class="td tool_btn addInThirdTb" data-table="{{$third_randomWord}}" data-content="{{$add_html}}" toolBtn-id="1">
                                                            <span class="fa fa-plus"></span>
                                                            <p>Add New</p>
                                                        </div>                                                        

                                                        <div class="td tool_btn deleteThirdTableDataGroup" data-table="{{$third_randomWord}}" data-model="{{$son_son_db}}" toolBtn-id="4">
                                                            <span class="fa fa-trash"></span>
                                                            <p>Delete</p>
                                                        </div>

                                                        <div class="td tool_btn rankThirdUp" data-table="{{$third_randomWord}}" toolBtn-id="5">
                                                            <span class="fa fa-long-arrow-up"></span>
                                                            <p>Sort Up</p>
                                                        </div>

                                                        <div class="td tool_btn rankThirdDown" data-table="{{$third_randomWord}}" toolBtn-id="6">
                                                            <span class="fa fa-long-arrow-down"></span>
                                                            <p>Sort Down</p>
                                                        </div>
                                                    </li>
                                                </ul>

                                                <ul class="table_list quill_partImg table_box thirdTbNew_{{$third_randomWord}}">
                                                    
                                                    @php
                                                        $son_fileIds = [];
                                                        foreach ($row['son'][$son_son_db] as $key_son_img => $value_son_img) {
                                                            if (!empty($value_son_img['image'])) {
                                                                array_push($son_fileIds, $value_son_img['image']);
                                                            }
                                                        }
                                                        if (!empty($son_fileIds)) {
                                                            $fileInformationArray = BaseFunction::getFilesArray($son_fileIds);
                                                        }
                                                        // dd($row['son'][$son_son_db], $three['three_content']);
                                                    @endphp

                                                    @foreach ($row['son'][$son_son_db] as $key_son => $value_son)
                                                        @php
                                                            $keyRank = $key_son + 1;
                                                            $randomWord_son = \Illuminate\Support\Str::random(5);

                                                            // {{-- 抓圖片or預設圖 --}}
                                                            if (!empty($value_son['image']) and isset($fileInformationArray[$value_son['image']]) and !empty($fileInformationArray[$value_son['image']])) {
                                                                $imgClass = 'has_img';
                                                                $imgSrc = $fileInformationArray[$value_son['image']]['real_route'];
                                                                $imgSize = $fileInformationArray[$value_son['image']]['resolution'] . ', ' . BaseFunction::cvt_file_size($fileInformationArray[$value_son['image']]['size']);
                                                            } else {
                                                                $imgClass = '';
                                                                $imgSrc = '/vender/assets/img/none-pic.jpg';
                                                                $imgSize = '';
                                                            }
                                                        @endphp
                                                        
                                                        <li class="item  new_{{$randomWord_son}}" partImg-id="{{$value_son['id']}}" data-rank="{{$keyRank}}">
                                                            <div class="check_box" style="position: relative;">
                                                                <input type="checkbox" class="content_input">
                                                                <label class="content_inputBox"></label>
                                                                <input type="hidden" value="{{$value_son['id']}}" name="{{$son_son_db}}[id][]" class="addThirdId">
                                                                <input type="hidden" value="{{$randomWord_va}}" name="{{$son_son_db}}[quillSonFantasyKey][]">
                                                                <input type="hidden" value="{{$value_son[$three['SecondIdColumn']]}}" name="{{$son_son_db}}[{{$three['SecondIdColumn']}}][]" class="addThirdSid">
                                                            </div>
                                                            <div class="sort_number">
                                                                <p>{{$keyRank}}</p>                                        
                                                                <input type="hidden" value="{{$keyRank}}" name="{{$son_son_db}}[rank][]">
                                                            </div>
                                                            <div class="ThreeContent">
                                                                @include('Fantasy.cms.includes.template.WNsontable.three_content')
                                                            </div>                                                            
                                                            
                                                            <div class="edit">
                                                                <span class="fa fa-trash deleteThirdTableData" data-id="{{$value_son['id']}}" data-key="{{$randomWord_son}}" data-model="{{$son_son_db}}"></span>
                                                            </div>                                                      
                                                        </li>
                                                    @endforeach

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
    @endforeach
</li>