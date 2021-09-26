<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
<input type="hidden" name="_lang" value="<?php echo Config::get('app.dataBasePrefix'); ?>">
<div class="backEnd_quill">
    <div class="hiddenArea_frame">
        <div class="hiddenArea_frame_box">
            <div class="detailEditor">
                <div class="editorBody">
                    <div class="editorHeader">
                        <div class="info">
                            <div class="title">
                                <!-- <p class="ams_type_create_zz" style="display:none;">Create CMS Template 新增功能設定</p> -->
                                <p class="ams_type_edit_zz">Edit CMS Template 權限設定</p>
                            </div>
                            <div class="area">
                                @if(isset($data['users_data']))
                                <h3>{{ $data['users_data']['name'] }}</h3>
                                @else
                                <h3>歡迎，新冒險家</h3>
                                @endif
                                <div class="control">
                                    <ul class="btnGroup">
                                        <li class="check">
                                            <a href="javascript:void(0)" class="updated_ams_edit_btn"
                                                data-type="cms-manager">
                                                <span class="fa fa-check"></span>
                                            </a>
                                        </li>
                                        <li class="trash delete_ams_hiddenArea">
                                            <a href="javascript:void(0)" class="delete_ams_information"
                                                data-type="cms-manager">
                                                <span class="fa fa-trash"></span>
                                            </a>
                                        </li>
                                        <!--<li class="file">-->
                                        <!--<a href="javascript:void(0)">-->
                                        <!--<<span class="fa fa-files-o"></span>-->
                                        <!--<</a>-->
                                        <!--<</li>-->
                                        <li class="remove">
                                            <a href="javascript:void(0)" class="close_btn close_ams_hiddenArea">
                                                <span class="fa fa-remove"></span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tips">
                                <span class="title">Tips</span>
                                <p>設定 Fantasy Account 的 CMS Template 管理權限，若未開啟管理權限，則管理者無法於 CMS 中檢視/編輯 Template 內容</p>
                            </div>
                        </div>
                    </div>
                    <div class="editorContent">
                        <ul class="box_block_frame">
                            @if(isset($data['id']) AND !empty($data['id']))
                            <input type="hidden" value="{{$data['id']}}" name="amsData[id]" class="supportAmsId_Input">
                            @else
                            <input type="hidden" value="0" name="amsData[id]" class="supportAmsId_Input">
                            @endif
                            <li class="inventory row_style tr_style img_title open_ams_lightbox">
                                <!--有大頭照時，就把no_selfie拿掉-->
                                <!--沒大頭照時，就把<p>的內容改成Select Accout-->
                                @php
                                $randomKey = \Illuminate\Support\Str::random(rand(13, 21));
                                @endphp
                                @if(isset($data['users_data']))
                                @if(isset($fileInformationArray[ $data['users_data']['photo_image'] ]) AND
                                !empty($fileInformationArray[ $data['users_data']['photo_image'] ]))
                                <div class="title member_title_{{ $randomKey }}">
                                    @else
                                    <div class="title no_selfie member_title_{{ $randomKey }}">
                                        @endif
                                        @else
                                        <div class="title no_selfie member_title_{{ $randomKey }}">
                                            @endif
                                            <div class="img_box ajax_open open_member_list" data-key="{{ $randomKey }}">
                                                <span class="add fa fa-plus"></span>
                                                @if(isset($data['users_data']))
                                                @if(isset($fileInformationArray[ $data['users_data']['photo_image'] ])
                                                AND
                                                !empty($fileInformationArray[ $data['users_data']['photo_image'] ]))
                                                <img src="{{ $fileInformationArray[ $data['users_data']['photo_image'] ]['real_route'] }}"
                                                    alt="" class="member_img_{{ $randomKey }}">
                                                @else
                                                <img src="" alt="" class="member_img_{{ $randomKey }}">
                                                @endif
                                                @else
                                                <img src="" alt="" class="member_img_{{ $randomKey }}">
                                                @endif
                                            </div>
                                            @if(isset($data['users_data']))
                                            <p class="subtitle t-a-c member_title_{{ $randomKey }}">
                                                {{ $data['users_data']['name'] }}</p>
                                            <input type="hidden" name="amsData[user_id]"
                                                value="{{ $data['users_data']['id'] }}"
                                                class="member_input_{{ $randomKey }}">
                                            @else
                                            <p class="subtitle t-a-c member_title_{{ $randomKey }}"
                                                style="width: 100px; font-family: '微軟正黑體'"></p>
                                            <input type="hidden" name="amsData[user_id]" value="0"
                                                class="member_input_{{ $randomKey }}">
                                            @endif
                                        </div>
                                        <div class="inner">
                                            <div class="inner_box row_style">
                                                <div class="info_text">
                                                    <p class="title">設定 CMS Template 管理權限是否啟用-P</p>
                                                    <p>選擇要取得 
                                                        <strong>CMS emplate</strong>管理授權的管理者帳號，打開授權開關將可決定管理帳號是否可進入
                                                        <strong>CMS Template</strong> 進行管理 </p>
                                                </div>
                                                <div class="switch_box">
                                                    @if(isset($data['is_active']))
                                                    @if($data['is_active'] == 1)
                                                    <div class="ios_switch on mrg-l-30 ams_ios_switch">
                                                        @else
                                                        <div class="ios_switch mrg-l-30 ams_ios_switch">
                                                            @endif
                                                            @else
                                                            <div class="ios_switch on mrg-l-30 ams_ios_switch">
                                                                @endif
                                                                <input type="checkbox">
                                                                @if(isset($data['is_active']))
                                                                <input type="hidden" value="{{ $data['is_active'] }}"
                                                                    class="check_ams_rabio" name="amsData[is_active]">
                                                                @else
                                                                <input type="hidden" value="1" class="check_ams_rabio"
                                                                    name="amsData[is_active]">
                                                                @endif
                                                                <div class="box ams_switch_ball">
                                                                    <span class="ball"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                            </li>
                            {{UnitMaker::select([
                                'name' => 'amsData[branch_id]',
                                'title' => '分館-語系',
                                'value' => ( !empty($data['branch_id']) )? $data['branch_id'] : '',
                                'options' => $branch_unit_options
                            ])}}
                            <li class="inventory row_style">
                                <div class="title">
                                    <p class="subtitle">同步啟用/取消</p>
                                </div>
                                <div class="inner">
                                    <div class="inner_box row_style">
                                        <div class="info_text">
                                            <p class="title">CMS Template 同步啟用/關閉管理權限</p>
                                            <p>請注意開啟此同步設計，該帳號也會同步失去此 <strong>CMS Template</strong> 的所有管理權限
                                            </p>
                                        </div>
                                        <div class="switch_box">
                                            <div class="ios_switch on mrg-l-30 ams_ios_switch ios_switch_selectAll">
                                                <p class="title mrg-r-10">同步設定</p>
                                                <input type="hidden" value="" class="check_ams_rabio">
                                                <div class="box ams_switch_ball">
                                                <span class="ball"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @foreach($key_group as $key =>$row)
                            <li class="inventory row_style  tr_style">
                                <div class="title">
                                    <p class="subtitle">{{$row['title']}}</p>
                                </div>
                                <div class="inner">
                                    @foreach($row['cms_menu'] as $key2 => $row2)
                                    <div class="inner_box row_style">
                                        <div class="info_text">
                                            <strong>{{$row2['title']}}</strong>
                                            {{--                       <div class="tips">
                                        <span class="title"></span>
                                    </div> --}}
                                        </div>
                                        <div>
                                            <div class="switch_box" style="display: flex;">
                                                @if(isset($jsonSup[ $row2['id'] ][1]))
                                                @if($jsonSup[ $row2['id'] ][1] == 1)
                                                <div class="ios_switch on ams_ios_switch mrg-l-30">
                                                    @else
                                                    <div class="ios_switch ams_ios_switch mrg-l-30">
                                                        @endif
                                                        @else
                                                        <div class="ios_switch on mrg-l-30 ams_ios_switch">
                                                            @endif
                                                            <p class="title mrg-r-10">新增</p>
                                                            @if(isset($jsonSup[ $row2['id'] ][1]))
                                                            <input type="hidden"
                                                                value="{{ $jsonSup[ $row2['id'] ][1] }}"
                                                                class="check_ams_rabio"
                                                                name="jsonData[{{$row2['id']}}][]">
                                                            @else
                                                            <input type="hidden" value="1" class="check_ams_rabio"
                                                                name="jsonData[{{$row2['id']}}][]">
                                                            @endif
                                                            <input type="checkbox">
                                                            <div class="box">
                                                                <span class="ball"></span>
                                                            </div>
                                                        </div>
                                                        @if(isset($jsonSup[ $row2['id'] ][2]))
                                                        @if($jsonSup[ $row2['id'] ][2] == 1)
                                                        <div class="ios_switch on ams_ios_switch mrg-l-30">
                                                            @else
                                                            <div class="ios_switch ams_ios_switch mrg-l-30">
                                                                @endif
                                                                @else
                                                                <div class="ios_switch on mrg-l-30 ams_ios_switch">
                                                                    @endif
                                                                    <p class="title mrg-r-10">刪除</p>
                                                                    @if(isset($jsonSup[ $row2['id'] ][2]))
                                                                    <input type="hidden"
                                                                        value="{{ $jsonSup[ $row2['id'] ][2] }}"
                                                                        class="check_ams_rabio"
                                                                        name="jsonData[{{$row2['id']}}][]">
                                                                    @else
                                                                    <input type="hidden" value="1"
                                                                        class="check_ams_rabio"
                                                                        name="jsonData[{{$row2['id']}}][]">
                                                                    @endif
                                                                    <input type="checkbox">
                                                                    <div class="box">
                                                                        <span class="ball"></span>
                                                                    </div>
                                                                </div>
                                                                @if(isset($jsonSup[ $row2['id'] ][3]))
                                                                @if($jsonSup[ $row2['id'] ][3] == 1)
                                                                <div class="ios_switch on ams_ios_switch mrg-l-30">
                                                                    @else
                                                                    <div class="ios_switch ams_ios_switch mrg-l-30">
                                                                        @endif
                                                                        @else
                                                                        <div
                                                                            class="ios_switch on mrg-l-30 ams_ios_switch">
                                                                            @endif
                                                                            <p class="title mrg-r-10">編輯</p>
                                                                            @if(isset($jsonSup[ $row2['id'] ][3]))
                                                                            <input type="hidden"
                                                                                value="{{ $jsonSup[ $row2['id'] ][3] }}"
                                                                                class="check_ams_rabio"
                                                                                name="jsonData[{{$row2['id']}}][]">
                                                                            @else
                                                                            <input type="hidden" value="1"
                                                                                class="check_ams_rabio"
                                                                                name="jsonData[{{$row2['id']}}][]">
                                                                            @endif
                                                                            <input type="checkbox">
                                                                            <div class="box">
                                                                                <span class="ball"></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @if($row2['has_auth']==$row2['id'])
                                                                    <input type='hidden' name='auth_menu_id[][]'
                                                                        value="{{$row2['id']}}" />
                                                                    <ul id="multi_select_has_auth_{{ $row2['id'] }}"
                                                                        class="multi_select_has_auth"
                                                                        data-menu_id="{{ $row2['id'] }}"
                                                                        data-model="{{ $row2['model'] }}">
                                                                        {{UnitMaker::selectMulti([
                                                                        'name' => 'authData[auth_data]['.$row2['id'].']',
                                                                        'options'=> ( !empty($data['branch_id']) ) ? (Config::get('models.'.$row2['model']))::get_cms_option(( !empty($data['branch_id']) )? $data['branch_id'] : 0) : [],
                                                                        'value' => ( array_key_exists($row2['id'], $data['cms_data_auth']) && $data['cms_data_auth'][$row2['id']]['data_id'] != '') ? $data['cms_data_auth'][$row2['id']]['data_id'] : '',
                                                                        ])}}
                                                                    </ul>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        </div>
                            </li>
                            @endforeach
                            <li class="inventory row_style tr_style">
                                <div class="title">
                                    <p class="subtitle">最後異動時間</p>
                                </div>
                                <div class="inner">
                                    <div class="file_date">
                                        @if(isset($data['updated_at']) AND !empty($data['updated_at']))
                                        <p>{{$data['updated_at']}}</p>
                                        @else
                                        <p></p>
                                        @endif
                                    </div>
                                    <div class="tips">
                                        <span class="title">TIPS</span>
                                        <p>不開放修改，由系統自行更新。</p>
                                    </div>
                                </div>
                            </li>
                            <li class="inventory row_style tr_style">
                                <div class="title">
                                    <p class="subtitle">建立日期</p>
                                </div>
                                <div class="inner">
                                    <div class="file_date">
                                        @if(isset($data['created_at']) AND !empty($data['created_at']))
                                        <p>{{$data['created_at']}}</p>
                                        @else
                                        <p></p>
                                        @endif
                                    </div>
                                    <div class="tips">
                                        <span class="title">TIPS</span>
                                        <p>不開放修改，由系統自行更新。</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--區塊功能按鈕-->
        <div class="hiddenArea_frame_controlBtn">
            <ul class="btnGroup">
                <li class="check">
                    <a href="javascript:void(0)" class="updated_ams_edit_btn" data-type="cms-manager">
                        <span class="fa fa-check"></span>
                        <p>SETTING</p>
                    </a>
                </li>
                <li class="trash delete_ams_hiddenArea">
                    <a href="javascript:void(0)" class="delete_ams_information" data-type="cms-manager">
                        <span class="fa fa-trash"></span>
                        <p>DELETE</p>
                    </a>
                </li>
                <li class="remove">
                    <a href="javascript:void(0)" class="close_btn close_ams_hiddenArea">
                        <span class="fa fa-remove"></span>
                        <p>CANCEL</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>