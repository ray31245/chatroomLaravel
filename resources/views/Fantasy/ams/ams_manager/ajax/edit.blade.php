<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
<div class="backEnd_quill">
    <div class="hiddenArea_frame">
        <div class="hiddenArea_frame_box">
            <div class="detailEditor">
                <div class="editorBody">
                    <div class="editorHeader">
                        <div class="info">
                            <div class="title">
                                <!-- <p class="ams_type_create_zz" style="display:none;">Create AMS 新增管理權限</p> -->
                                <p class="ams_type_edit_zz">Edit AMS 權限管理</p>
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
                                                data-type="ams-manager">
                                                <span class="fa fa-check"></span>
                                            </a>
                                        </li>
                                        <li class="trash delete_ams_hiddenArea">
                                            <a href="javascript:void(0)" class="delete_ams_information"
                                                data-type="ams-manager">
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
                                <span class="title">Tips{{-- TIPS --}}</span>
                                <p>設定與管理 Fantasy Account 在 AMS 中的操作權限</p>
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
                                !empty($fileInformationArray[
                                $data['users_data']['photo_image'] ]))
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
                                            <p class="subtitle t-a-c member_title_{{ $randomKey }}"
                                                style="width: 100px; font-family: '微軟正黑體'">
                                                {{ $data['users_data']['name'] }}</p>
                                            <input type="hidden" name="amsData[user_id]"
                                                value="{{ $data['users_data']['id'] }}"
                                                class="member_input_{{ $randomKey }}">
                                            @else
                                            <p class="subtitle t-a-c member_title_{{ $randomKey }}"
                                                style="width: 100px; font-family: '微軟正黑體'">
                                            </p>
                                            <input type="hidden" name="amsData[user_id]" value="0"
                                                class="member_input_{{ $randomKey }}">
                                            @endif
                                        </div>
                                        <div class="inner">
                                            <div class="inner_box row_style">
                                                <div class="info_text">
                                                    <p class="title">設定 AMS 管理權限是否啟用-P</p>
                                                    <p>選擇要取得
                                                        <strong>AMS</strong> 管理授權的管理者帳號，打開授權開關將可決定管理帳號是否可進入 
                                                        <strong>AMS</strong> 進行管理 
                                                    </p>
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
                                                    <div class="inner_box" style="display:none;">
                                                        <ul class="radio state_button mrg-0">
                                                            <li class="mrg-r-20">
                                                                <input type="radio" checked="checked" value=""
                                                                    name="radio2" id="stateA">
                                                                <label for="stateA">
                                                                    <strong>Administrator</strong>最大權限管理者
                                                                </label>
                                                            </li>
                                                            <li class="mrg-r-20">
                                                                <input type="radio" value="no" name="radio2"
                                                                    id="stateB">
                                                                <label for="stateB">
                                                                    <strong>Manager</strong>限定權限管理者
                                                                </label>
                                                            </li>
                                                        </ul>
                                                        <div class="tips">
                                                            <span class="title">TIPS</span>
                                                            <p>Administrator 最大權限管理者可對所有管理項目進行管理，Manage
                                                                限定權限管理者只可對被指派項目進行管理。</p>
                                                        </div>
                                                    </div>
                                                </div>
                            </li>
                            <li class="inventory row_style tr_style">
                                <div class="title">
                                    <p class="subtitle">ams</p>
                                </div>
                                <div class="inner">
                                    <div class="inner_box row_style">
                                        <div class="info_text">
                                            <p class="title">AMS 管理權限是否啟用</p>
                                            <p>打開授權開關，將授權管理帳號管理 
                                                <strong>AMS 權限管理</strong>，並對內容及設定進行編輯作業
                                            </p>
                                        </div>
                                        <div class="switch_box">
                                            @if(isset($data['is_ams']))
                                            @if($data['is_ams'] == 1)
                                            <div class="ios_switch on mrg-l-30 ams_ios_switch">
                                                @else
                                                <div class="ios_switch mrg-l-30 ams_ios_switch">
                                                    @endif
                                                    @else
                                                    <div class="ios_switch on mrg-l-30 ams_ios_switch">
                                                        @endif
                                                        @if(isset($data['is_ams']))
                                                        <input type="hidden" value="{{ $data['is_ams'] }}"
                                                            class="check_ams_rabio" name="amsData[is_ams]">
                                                        @else
                                                        <input type="hidden" value="1" class="check_ams_rabio"
                                                            name="amsData[is_ams]">
                                                        @endif
                                                        <input type="checkbox">
                                                        <div class="box ams_switch_ball">
                                                            <span class="ball"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            </li>
                            @if($configSet['setBranchs'])
                            <li class="inventory row_style tr_style">
                                <div class="title">
                                    <p class="subtitle">cover page</p>
                                </div>
                                <div class="inner">
                                    <div class="inner_box row_style">
                                        <div class="info_text">
                                            <p class="title">Cover Page 權限管理是否啟用</p>
                                            <p>打開授權開關，將授權管理帳號管理 
                                                <strong>Cover Page 權限管理</strong>，並對內容及設定進行編輯作業
                                            </p>
                                        </div>
                                        <div class="switch_box">
                                            @if(isset($data['is_cover_page']))
                                            @if($data['is_cover_page'] == 1)
                                            <div class="ios_switch on mrg-l-30 ams_ios_switch">
                                                @else
                                                <div class="ios_switch mrg-l-30 ams_ios_switch">
                                                    @endif
                                                    @else
                                                    <div class="ios_switch on mrg-l-30 ams_ios_switch">
                                                        @endif
                                                        @if(isset($data['is_cover_page']))
                                                        <input type="hidden" value="{{ $data['is_cover_page'] }}"
                                                            class="check_ams_rabio" name="amsData[is_cover_page]">
                                                        @else
                                                        <input type="hidden" value="1" class="check_ams_rabio"
                                                            name="amsData[is_cover_page]">
                                                        @endif
                                                        <input type="checkbox">
                                                        <div class="box ams_switch_ball">
                                                            <span class="ball"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            </li>
                            @endif
                            <li class="inventory row_style tr_style">
                                <div class="title">
                                    <p class="subtitle">cms template</p>
                                </div>
                                <div class="inner">
                                    <div class="inner_box row_style">
                                        <div class="info_text">
                                            <p class="title">CMS Template 權限管理是否啟用</p>
                                            <p>打開授權開關，將授權管理帳號管理 
                                                <strong>CMS Template 權限管理</strong>，並對內容及設定進行編輯作業
                                            </p>
                                        </div>
                                        <div class="switch_box">
                                            @if(isset($data['is_cms_template_ma']))
                                            @if($data['is_cms_template_ma'] == 1)
                                            <div class="ios_switch on mrg-l-30 ams_ios_switch">
                                                @else
                                                <div class="ios_switch mrg-l-30 ams_ios_switch">
                                                    @endif
                                                    @else
                                                    <div class="ios_switch on mrg-l-30 ams_ios_switch">
                                                        @endif
                                                        @if(isset($data['is_cms_template_ma']))
                                                        <input type="hidden" value="{{ $data['is_cms_template_ma'] }}"
                                                            class="check_ams_rabio" name="amsData[is_cms_template_ma]">
                                                        @else
                                                        <input type="hidden" value="1" class="check_ams_rabio"
                                                            name="amsData[is_cms_template_ma]">
                                                        @endif
                                                        <input type="checkbox">
                                                        <div class="box ams_switch_ball">
                                                            <span class="ball"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            </li>
                            @if($configSet['setBranchs'])
                            <li class="inventory row_style tr_style">
                                <div class="title">
                                    <p class="subtitle">cms template</p>
                                </div>
                                <div class="inner">
                                    <div class="inner_box row_style">
                                        <div class="info_text">
                                            <p class="title">CMS Template 管理與設定是否啟用</p>
                                            <p>打開授權開關，將授權管理帳號管理 
                                                <strong>CMS Template 管理與設定</strong>，並對內容及設定進行編輯作業
                                            </p>
                                        </div>
                                        <div class="switch_box">
                                            @if(isset($data['is_cms_template']))
                                            @if($data['is_cms_template'] == 1)
                                            <div class="ios_switch on mrg-l-30 ams_ios_switch">
                                                @else
                                                <div class="ios_switch mrg-l-30 ams_ios_switch">
                                                    @endif
                                                    @else
                                                    <div class="ios_switch on mrg-l-30 ams_ios_switch">
                                                        @endif
                                                        @if(isset($data['is_cms_template']))
                                                        <input type="hidden" value="{{ $data['is_cms_template'] }}"
                                                            class="check_ams_rabio" name="amsData[is_cms_template]">
                                                        @else
                                                        <input type="hidden" value="1" class="check_ams_rabio"
                                                            name="amsData[is_cms_template]">
                                                        @endif
                                                        <input type="checkbox">
                                                        <div class="box ams_switch_ball">
                                                            <span class="ball"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            </li>
                            <li class="inventory row_style tr_style">
                                <div class="title">
                                    <p class="subtitle">cms template</p>
                                </div>
                                <div class="inner">
                                    <div class="inner_box row_style">
                                        <div class="info_text">
                                            <p class="title">CMS Template 功能設定是否啟用</p>
                                            <p>打開授權開關，將授權管理帳號管理 
                                                <strong>CMS Template 功能設定</strong>，並對內容及設定進行編輯作業
                                            </p>
                                        </div>
                                        <div class="switch_box">
                                            @if(isset($data['is_cms_template_setting']))
                                            @if($data['is_cms_template_setting'] == 1)
                                            <div class="ios_switch on mrg-l-30 ams_ios_switch">
                                                @else
                                                <div class="ios_switch mrg-l-30 ams_ios_switch">
                                                    @endif
                                                    @else
                                                    <div class="ios_switch on mrg-l-30 ams_ios_switch">
                                                        @endif
                                                        @if(isset($data['is_cms_template_setting']))
                                                        <input type="hidden"
                                                            value="{{ $data['is_cms_template_setting'] }}"
                                                            class="check_ams_rabio"
                                                            name="amsData[is_cms_template_setting]">
                                                        @else
                                                        <input type="hidden" value="1" class="check_ams_rabio"
                                                            name="amsData[is_cms_template_setting]">
                                                        @endif
                                                        <input type="checkbox">
                                                        <div class="box ams_switch_ball">
                                                            <span class="ball"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            </li>
                            <li class="inventory row_style tr_style">
                                <div class="title">
                                    <p class="subtitle">cover page</p>
                                </div>
                                <div class="inner">
                                    <div class="inner_box row_style">
                                        <div class="info_text">
                                            <p class="title">Cover Page 功能設定是否啟用</p>
                                            <p>打開授權開關，將授權管理帳號管理 
                                                <strong>Cover Page 功能設定</strong>，並對內容及設定進行編輯作業
                                            </p>
                                        </div>
                                        <div class="switch_box">
                                            @if(isset($data['is_cover_page_setting']))
                                            @if($data['is_cover_page_setting'] == 1)
                                            <div class="ios_switch on mrg-l-30 ams_ios_switch">
                                                @else
                                                <div class="ios_switch mrg-l-30 ams_ios_switch">
                                                    @endif
                                                    @else
                                                    <div class="ios_switch on mrg-l-30 ams_ios_switch">
                                                        @endif
                                                        @if(isset($data['is_cover_page_setting']))
                                                        <input type="hidden"
                                                            value="{{ $data['is_cover_page_setting'] }}"
                                                            class="check_ams_rabio"
                                                            name="amsData[is_cover_page_setting]">
                                                        @else
                                                        <input type="hidden" value="1" class="check_ams_rabio"
                                                            name="amsData[is_cover_page_setting]">
                                                        @endif
                                                        <input type="checkbox">
                                                        <div class="box ams_switch_ball">
                                                            <span class="ball"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            </li>
                            <li class="inventory row_style tr_style">
                                <div class="title">
                                    <p class="subtitle">crs</p>
                                </div>
                                <div class="inner">
                                    <div class="inner_box row_style">
                                        <div class="info_text">
                                            <p class="title">Cover Page Review 權限管理是否啟用</p>
                                            <p>打開授權開關，將授權管理帳號管理 
                                                <strong>Cover Page Review 權限管理</strong>，並對內容及設定進行編輯作業
                                            </p>
                                        </div>
                                        <div class="switch_box">
                                            @if(isset($data['is_crs_role']))
                                            @if($data['is_crs_role'] == 1)
                                            <div class="ios_switch on mrg-l-30 ams_ios_switch">
                                                @else
                                                <div class="ios_switch mrg-l-30 ams_ios_switch">
                                                    @endif
                                                    @else
                                                    <div class="ios_switch on mrg-l-30 ams_ios_switch">
                                                        @endif
                                                        @if(isset($data['is_crs_role']))
                                                        <input type="hidden" value="{{ $data['is_crs_role'] }}"
                                                            class="check_ams_rabio" name="amsData[is_crs_role]">
                                                        @else
                                                        <input type="hidden" value="1" class="check_ams_rabio"
                                                            name="amsData[is_crs_role]">
                                                        @endif
                                                        <input type="checkbox">
                                                        <div class="box ams_switch_ball">
                                                            <span class="ball"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            </li>
                            @endif
                            @if($configSet['isReview'])
                            <li class="inventory row_style tr_style">
                                <div class="title">
                                    <p class="subtitle">crs</p>
                                </div>
                                <div class="inner">
                                    <div class="inner_box row_style">
                                        <div class="info_text">
                                            <p class="title">CMS Review 權限管理是否啟用</p>
                                            <p>打開授權開關，將授權管理帳號管理 
                                                <strong>CMS Review 權限管理</strong>，並對內容及設定進行編輯作業
                                            </p>
                                        </div>
                                        <div class="switch_box">
                                            @if(isset($data['is_overview_crs']))
                                            @if($data['is_overview_crs'] == 1)
                                            <div class="ios_switch on mrg-l-30 ams_ios_switch">
                                                @else
                                                <div class="ios_switch mrg-l-30 ams_ios_switch">
                                                    @endif
                                                    @else
                                                    <div class="ios_switch on mrg-l-30 ams_ios_switch">
                                                        @endif
                                                        @if(isset($data['is_overview_crs']))
                                                        <input type="hidden" value="{{ $data['is_overview_crs'] }}"
                                                            class="check_ams_rabio" name="amsData[is_overview_crs]">
                                                        @else
                                                        <input type="hidden" value="1" class="check_ams_rabio"
                                                            name="amsData[is_overview_crs]">
                                                        @endif
                                                        <input type="checkbox">
                                                        <div class="box ams_switch_ball">
                                                            <span class="ball"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            </li>
                            @endif
                            <li class="inventory row_style tr_style">
                                <div class="title">
                                    <p class="subtitle">fms</p>
                                </div>
                                <div class="inner">
                                    <div class="inner_box row_style">
                                        <div class="info_text">
                                            <p class="title">Fma Folder 管理權限是否啟用</p>
                                            <p>打開授權開關，將授權管理帳號可進入 
                                                <strong>Fms Folder 基本目錄管理</strong>，並對內容及設定進行編輯作業
                                            </p>
                                        </div>
                                        <div class="switch_box">
                                            @if(isset($data['is_folder']))
                                            @if($data['is_folder'] == 1)
                                            <div class="ios_switch on mrg-l-30 ams_ios_switch">
                                                @else
                                                <div class="ios_switch mrg-l-30 ams_ios_switch">
                                                    @endif
                                                    @else
                                                    <div class="ios_switch on mrg-l-30 ams_ios_switch">
                                                        @endif
                                                        @if(isset($data['is_folder']))
                                                        <input type="hidden" value="{{ $data['is_folder'] }}"
                                                            class="check_ams_rabio" name="amsData[is_folder]">
                                                        @else
                                                        <input type="hidden" value="1" class="check_ams_rabio"
                                                            name="amsData[is_folder]">
                                                        @endif
                                                        <input type="checkbox">
                                                        <div class="box ams_switch_ball">
                                                            <span class="ball"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            </li>
                            <li class="inventory row_style tr_style">
                                <div class="title">
                                    <p class="subtitle">fantasy</br>account</p>
                                </div>
                                <div class="inner">
                                    <div class="inner_box row_style">
                                        <div class="info_text">
                                            <p class="title">Fantasy Account 管理權限是否啟用</p>
                                            <p>打開授權開關，將授權管理帳號可進入 
                                                <strong>Account 帳號管理</strong>，並對內容及設定進行編輯作業
                                            </p>
                                        </div>
                                        <div class="switch_box">
                                            @if(isset($data['is_fantasy']))
                                            @if($data['is_fantasy'] == 1)
                                            <div class="ios_switch on mrg-l-30 ams_ios_switch">
                                                @else
                                                <div class="ios_switch mrg-l-30 ams_ios_switch">
                                                    @endif
                                                    @else
                                                    <div class="ios_switch on mrg-l-30 ams_ios_switch">
                                                        @endif
                                                        @if(isset($data['is_fantasy']))
                                                        <input type="hidden" value="{{ $data['is_fantasy'] }}"
                                                            class="check_ams_rabio" name="amsData[is_fantasy]">
                                                        @else
                                                        <input type="hidden" value="1" class="check_ams_rabio"
                                                            name="amsData[is_fantasy]">
                                                        @endif
                                                        <input type="checkbox">
                                                        <div class="box ams_switch_ball">
                                                            <span class="ball"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            </li>
                            <li class="inventory row_style tr_style" style="display:none;">
                                <div class="title">
                                    <p class="subtitle">fantasy</br>setting</p>
                                </div>
                                <div class="inner">
                                    <div class="inner_box row_style">
                                        <div class="info_text">
                                            <p class="title">Fantasy Setting 管理權限是否啟用</p>
                                            <p>打開授權開關，將授權管理帳號可進入 
                                                <strong>Fantasy Setting 權限管理</strong>，並對內容及設定進行編輯作業
                                            </p>
                                        </div>
                                        <div class="switch_box">
                                            @if(isset($data['is_fantasy_setting']))
                                            @if($data['is_fantasy_setting'] == 1)
                                            <div class="ios_switch on mrg-l-30 ams_ios_switch">
                                                @else
                                                <div class="ios_switch mrg-l-30 ams_ios_switch">
                                                    @endif
                                                    @else
                                                    <div class="ios_switch on mrg-l-30 ams_ios_switch">
                                                        @endif
                                                        @if(isset($data['is_fantasy_setting']))
                                                        <input type="hidden" value="{{ $data['is_fantasy_setting'] }}"
                                                            class="check_ams_rabio" name="amsData[is_fantasy_setting]">
                                                        @else
                                                        <input type="hidden" value="1" class="check_ams_rabio"
                                                            name="amsData[is_fantasy_setting]">
                                                        @endif
                                                        <input type="checkbox">
                                                        <div class="box ams_switch_ball">
                                                            <span class="ball"></span>
                                                        </div>
                                                    </div>
                                                </div>
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
                    <a href="javascript:void(0)" class="updated_ams_edit_btn" data-type="ams-manager">
                        <span class="fa fa-check"></span>
                        <p>SETTING</p>
                    </a>
                </li>
                <li class="trash delete_ams_hiddenArea">
                    <a href="javascript:void(0)" class="delete_ams_information" data-type="ams-manager">
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