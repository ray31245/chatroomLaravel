<div class="backEnd_quill">
    <div class="detailEditor">
        <div class="editorBody">
            <div class="editorHeader">
                <div class="info">
                    <div class="title">
                        <p>{{ $area_title }}</p>
                    </div>
                    <div class="area">
                        <h3>{{ $File['title'].((!empty($File['type']))?'.'.$File['type']:'') }}</h3>
                        <div class="control">
                            <ul class="btnGroup">   
                                <li class="remove">
                                    <a href="javascript:;" class="close_btn">
                                        <span class="fa fa-remove"></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name = "fms[origin_folder_level]" value="{{$folder_type}}">
            <input type="hidden" name = "fms[folder_level]" value="{{$folder_type}}">
            @if($File['id']=='0')
                <input type="hidden" name = "fms[folder_id]" value="{{$new_file_path_for_edit[0]['id']}}">
            @else
                <input type="hidden" name = "fms[folder_id]" value="{{$File['id']}}">
            @endif
            <input type="hidden" name = "fms[this_id]" value="{{$File['id']}}">
            <div class="editorContent">
                <ul class="box_block_frame">
                    @if($File['id']!='0')
                        <li class="inventory file_box fileInformation">
                            <div class="file_frame">
                                <div class="file_frame_info">
                                    <div class="img_box">
                                        <img src="{{ (!empty($file_type['img']))?$file_type['img']:$File['real_route'] }}" alt="">
                                    </div>
                                    <div class="info_box">
                                        <p class="type">
                                            <span>{{ $file_type['title'].', '.$File['type'] }}</span>
                                            <i>|</i>
                                            <span class="number">@if($file_type['title']=='??????') {{ $File['resolution'] }}, @endif{{ $File['_this_size'] }}</span>
                                            <span>, ???????????????</span>
                                            <span class="number">{{ $count_file }}</span>
                                            <span>?????????</span>
                                        </p>
                                        <p class="path">{{ $file_path }}</p>
                                    </div>
                                </div>
                                <div class="toolBtn">
                                    @if($area_detail!='?????????')
                                        <span class="icon fa fa-eye @if($file_type['title']=='??????') open_img_box" @else " onclick="window.open('{{ $File['real_route'] }}')" @endif data-src="{{ $File['real_route'] }}" ></span>
                                        <span class="icon pg-download file_fantasy_download" data-src="{{ $File['real_route'] }}" data-title="{{ $File['title'] }}"></span>
                                    @endif
                                </div>
                            </div>
                        </li>
                    @endif
                    <li class="inventory row_style">
                        <div class="title">
                            <p class="subtitle">??????/???????????????</p>
                        </div>
                        <div class="inner">
                            <input class="normal_input" name = "fms[title]"type="text" placeholder="" value="{{ $File['title']}}">
                            <div class="tips">
                                <span class="title">TIPS</span>
                                <p>???????????????????????????????????? : @#$%?/\|*???????????????????????????</p>
                            </div>
                        </div>
                    </li>
                    {{-- @if($File['id']=='0')  --}}
                        <li class="inventory row_style">
                            <div class="title">
                                <p class="subtitle">??????????????????</p>
                            </div>
                            <div class="inner">
                                <div class="select_Box" data-type="path">
                                    <div class="select_Btn" data-id="0">
                                        <p class="title">{{$file_path_for_edit}}</p>
                                        <i class="arrow pg-arrow_down"></i>
                                    </div>
                                    <ul class="option_list" data-id="0" data-level="0">
                                    @foreach($new_file_path_for_edit as $key0 => $row0)
                                    <li class="option" data-id="{{ $row0['id'] }}" data-level="0">
                                        <p class="title">{{ $row0['title'] }}</p>
                                        @if(!empty($row0['fms_first']))
                                        <ul class="option_list" data-id="0" data-level="1">
                                            @foreach($row0['fms_first'] as $key => $row)
                                            <li class="option" data-id="{{$row['id']}}" data-level="1">
                                                <p class="title">{{$row['title']}}</p>
                                                @if(!empty($row['fms_second']))
                                                <ul class="option_list" data-level="2">
                                                    @foreach($row['fms_second'] as $key2 => $row2)                                
                                                    <li class="option" data-id="{{$row2['id']}}" data-level="2">
                                                        <p class="title">{{$row2['title']}}</p>                                  
                                                        @if(!empty($row2['fms_third']))
                                                        <ul class="option_list" data-level="3">
                                                            @foreach($row2['fms_third'] as $key3 => $row3)
                                                            <li class="option" data-id="{{$row3['id']}}" data-level="3">
                                                                <p class="title">{{$row3['title']}}</p>
                                                            </li>
                                                            @endforeach
                                                        </ul>                                      
                                                        @endif
                                                    </li>
                                                    @endforeach
                                                </ul>
                                                @endif
                                            </li>
                                            @endforeach
                                        </ul>
                                        @endif
                                    </li>
                                    @endforeach
                                </ul>
                                </div>
                                <div class="tips">
                                    <span class="title">TIPS</span>
                                    <p>??????????????????????????????????????????????????????????????????????????????????????????????????????<br>???????????????????????????Icon???????????????????????????</p>
                                </div>
                            </div>
                        </li>
                    {{-- @endif --}}
                    <?php
                        $owner_options = [];
                        foreach ($all_owner as $key => $value){
                            $temp = [
                                'title' => $value['name'],
                                'key' => $value['id']
                            ];
                            array_push($owner_options, $temp);
                        }
                    ?>
                    {{-- ???????????????Honda????????????! --}}
                    <li class="inventory row_style">
                        <div class="title">
                            <p class="subtitle">???????????????</p>
                        </div>
                        <div class="inner">
                            <textarea name="fms[note]" id="file_outSite_textarea3" placeholder="????????????????????????????????????">{{ $File['note']}}</textarea>
                            <div class="tips">
                                <span class="title">TIPS</span>
                                <p>???????????????????????????????????????HTML???CSS???JQ???JS??????????????????????????????Shift+Enter??????????????????????????????????????????</p>
                            </div>
                        </div>
                    </li>
                    @if($File['id']!='0')
                        <li class="inventory row_style">
                            <div class="title">
                                <p class="subtitle">??????????????????</p>
                            </div>
                            <div class="inner">
                                <div class="file_date">
                                    @if(!empty($last_edit_user))
                                        <p class="name">{{$last_edit_user['name']}},</p> 
                                        <p>??? {{ date("Y ??? m ??? d ??? H : i : s", strtotime($File['updated_at'])) }} ?????????</p>
                                    @else 
                                        <p class="name">{{$owner['name']}},</p>
                                        <p>??? {{ date("Y ??? m ??? d ??? H : i : s", strtotime($File['updated_at'])) }} ?????????</p>
                                    @endif
                                </div>
                                <div class="tips">
                                    <span class="title">TIPS</span>
                                    <p>??????????????????????????????????????????</p>
                                </div>
                            </div>
                        </li>
                        <li class="inventory row_style">
                            <div class="title">
                                <p class="subtitle">????????????</p>
                            </div>
                            <div class="inner">
                                <div class="file_date">
                                    <p class="name">{{$owner['name']}},</p> 
                                    <p>??? {{ date("Y ??? m ??? d ??? H : i : s", strtotime($File['created_at'])) }} ??????</p>
                                </div>
                                <div class="tips">
                                    <span class="title">TIPS</span>
                                    <p>??????????????????????????????????????????</p>
                                </div>
                            </div>
                        </li>
                    @endif
                    <li class="inventory row_style">
                        <div class="title">
                            <p class="subtitle">?????????</p>
                        </div>
                        <div class="inner">
                            <div class="owner">
                                <!--32*32-->
                                <p class="name">{{$owner['name']}}</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--??????????????????-->
    <div class="hiddenArea_frame_controlBtn">
        <ul class="btnGroup">
            <li class="check folder_edit_upload"> 
                <a href="javascript:void(0)">
                    <span class="fa fa-check"></span>
                    <p>SETTING</p>
                </a>
            </li>
            @if($File['id']!='0')
                <li class="trash folder_edit_delete">
                    <a href="javascript:void(0)">
                        <span class="fa fa-trash"></span>
                        <p>DELETE</p>
                    </a>
                </li>
            @endif
            <li class="remove">
                <a href="javascript:void(0)" class="close_btn">
                    <span class="fa fa-remove"></span>
                    <p>CANCEL</p>
                </a>
            </li>
        </ul>
    </div>
</div>