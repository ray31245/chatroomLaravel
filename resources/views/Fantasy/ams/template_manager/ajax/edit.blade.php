<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
<div class="backEnd_quill">
    <div class="hiddenArea_frame">
        <div class="hiddenArea_frame_box">
            <div class="detailEditor">
		         <div class="editorBody">
		              <div class="editorHeader">
                <div class="info">
                    <div class="title">
                        <p class="ams_type_create_zz" style="display:none;">Create CMS Template 新增管理與設定</p>
                        <p class="ams_type_edit_zz" style="display:none;">Edit CMS Template 編輯管理與設定</p>
                    </div>
                    <div class="area">
                        <div class="control">
                            <ul class="btnGroup">
                                <li class="check">
                                    <a href="javascript:void(0)" class="updated_ams_edit_btn"
                                        data-type="template-manager">
                                        <span class="fa fa-check"></span>
                                    </a>
                                </li>
                                <li class="trash delete_ams_hiddenArea">
                                    <a href="javascript:void(0)" class="delete_ams_information"
                                        data-type="template-manager">
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
                        <span class="title">{{-- TIPS --}}</span>
                        <p></p>
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
                    <li class="inventory row_style">
                        <div class="title">
                            <p class="subtitle">是否啟用</p>
                        </div>
                        <div class="inner">
                            <div class="inner_box row_style">
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
                                                @if(isset($data['is_active']))
                                                <input type="hidden" value="{{ $data['is_active'] }}"
                                                    class="check_ams_rabio" name="amsData[is_active]">
                                                @else
                                                <input type="hidden" value="1" class="check_ams_rabio"
                                                    name="amsData[is_active]">
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
                    <li class="inventory row_style">
                        <div class="title">
                            <p class="subtitle">Template 中文名稱</p>
                        </div>
                        <div class="inner">
                            @if(isset($data['title']) AND !empty($data['title']))
                            <input class="normal_input" type="text" placeholder="" name="amsData[title]"
                                value="{{$data['title']}}">
                            @else
                            <input class="normal_input" type="text" placeholder="" name="amsData[title]" value="">
                            @endif
                            <div class="tips">
                                <span class="title">TIPS</span>
                                <p>不可與其他Template名稱重複，特殊符號如 : @#$%?/\|*.及全形輸入也請盡量避免。</p>
                            </div>
                        </div>
                    </li>
                    <li class="inventory row_style">
                        <div class="title">
                            <p class="subtitle">Template 英文名稱</p>
                        </div>
                        <div class="inner">
                            @if(isset($data['en_title']) AND !empty($data['en_title']))
                            <input class="normal_input" type="text" placeholder="" name="amsData[en_title]"
                                value="{{$data['en_title']}}">
                            @else
                            <input class="normal_input" type="text" placeholder="" name="amsData[en_title]" value="">
                            @endif
                            <div class="tips">
                                <span class="title">TIPS</span>
                                <p>不可與其他Template名稱重複，特殊符號如 : @#$%?/\|*.及全形輸入也請盡量避免。</p>
                            </div>
                        </div>
                    </li>
                    <li class="inventory row_style">
                        <div class="title">
                            <p class="subtitle">Template 網址標題</p>
                        </div>
                        <div class="inner">
                            @if(isset($data['url_title']) AND !empty($data['url_title']))
                            <input class="normal_input" type="text" placeholder="" name="amsData[url_title]"
                                value="{{$data['url_title']}}">
                            @else
                            <input class="normal_input" type="text" placeholder="" name="amsData[url_title]" value="">
                            @endif
                            <div class="tips">
                                <span class="title">TIPS</span>
                                <p>不可與其他Template名稱重複，特殊符號如 : @#$%?/\|*.及全形輸入也請盡量避免。</p>
                            </div>
                        </div>
                    </li>
                    @php
                    $locale_options = [];
                    foreach ($langArray as $key => $value)
                    {
                    $temp =
                    [
                    'title' => $value['title'],
                    'key' => $value['abb_en_title']
                    ];
                    array_push($locale_options, $temp);
                    }
                    @endphp
                    {{UnitMaker::selectMulti([
                        'name' => 'amsData[local_set]',
                        'title' => 'Template 多語系設定',
                        'tips' => '設定 Template 所開放的多語系。',
                        'options'=>$locale_options,
                        'value' => ( !empty($data['local_set']) )? $data['local_set'] : '',
                        'disabled' => ''
                    ])}}
                    {{UnitMaker::selectMulti([
                        'name' => 'amsData[local_review_set]',
                        'title' => 'Template 多語系審核設定',
                        'tips' => '設定 Template 語系是否開啟審核功能。',
                        'options'=>$locale_options,
                        'value' => ( !empty($data['local_review_set']) )? $data['local_review_set'] : '',
                        'disabled' => ''
                    ])}}
                    <li class="inventory row_style">
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
                    <li class="inventory row_style">
                        <div class="title">
                            <p class="subtitle">帳號建立日期</p>
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
                    <a href="javascript:void(0)" class="updated_ams_edit_btn" data-type="template-manager">
                        <span class="fa fa-check"></span>
                        <p>SETTING</p>
                    </a>
                </li>
                <li class="trash delete_ams_hiddenArea">
                    <a href="javascript:void(0)" class="delete_ams_information" data-type="template-manager">
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