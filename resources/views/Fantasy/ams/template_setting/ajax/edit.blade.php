<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
<div class="backEnd_quill">
    <div class="hiddenArea_frame">
        <div class="hiddenArea_frame_box">
            <div class="detailEditor">
		         <div class="editorBody">
		              <div class="editorHeader">
                <div class="info">
                    <div class="title">
                        <p class="ams_type_create_zz" style="display:none;">Create CMS Template 新增功能設定</p>
                        <p class="ams_type_edit_zz" style="display:none;">Edit CMS Template 編輯功能設定</p>
                    </div>
                    <div class="area">
                        <div class="control">
                            <ul class="btnGroup">
                                <li class="check">
                                    <a href="javascript:void(0)" class="updated_ams_edit_btn"
                                        data-type="template-setting">
                                        <span class="fa fa-check"></span>
                                    </a>
                                </li>
                                <li class="trash delete_ams_hiddenArea">
                                    <a href="javascript:void(0)" class="delete_ams_information"
                                        data-type="template-setting">
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
                    <li class="inventory row_style">
                        <div class="ios_switch on mrg-l-30 ams_ios_switch ios_switch_selectAll"
                            style="position:absolute;">
                            <p class="title mrg-r-10">全部選項</p>
                            <input type="hidden" value="" class="check_ams_rabio">
                            <div class="box ams_switch_ball">
                                <span class="ball"></span>
                            </div>
                        </div>
                    </li>
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
                    {{UnitMaker::select([
                        'name' => 'amsData[origin_id]',
                        'title' => '分館',
                        'value' => ( !empty($data['origin_id']) )? $data['origin_id'] : '',
                        'options' => $branch_options
                    ])}}
                                {{UnitMaker::select([
                        'name' => 'amsData[locale]',
                        'title' => '語系',
                        'value' => ( !empty($data['locale']) )? $data['locale'] : '',
                        'options' => $locale_options
                    ])}}
                    @foreach($key_group as $key => $row)
                    <li class="inventory row_style tr_style">
                        <div class="title">
                            <p class="subtitle">{{ $row['title'] }}</p>
                        </div>
                        <div class="inner">
                            <div class="inner_box row_style">
                                <div class="info_text">
                                    <p class="f-900">{{ $row['title'] }}-功能是否啟用</p>
                                    {{-- <p><span class="f-900">Cover page</span> : {{ $row['overview_list'] }}</p> --}}
                                    <p><span class="f-900">CMS</span> : {{ $row['template_list'] }}</p>
                                    <p><span class="f-900">FMS</span> : {{ $row['overview_list'] }}</p>
                                    <div class="tips">
                                        <span class="title">TIPS</span>
                                        <p>未啟用功能，將無法進入前後端相關頁面。</p>
                                    </div>
                                </div>
                                <div class="switch_box">
                                    @if(isset($json[ $row['key'] ]))
                                    @if($json[ $row['key'] ] == 1)
                                    <div class="ios_switch on ams_ios_switch">
                                        @else
                                        <div class="ios_switch ams_ios_switch">
                                            @endif
                                            @else
                                            <div class="ios_switch ams_ios_switch on">
                                                @endif
                                                @if(isset($json[ $row['key'] ]))
                                                <input type="hidden" value="{{ $json[ $row['key'] ] }}"
                                                    class="check_ams_rabio" name="jsonData[{{$row['key']}}]">
                                                @else
                                                <input type="hidden" value="1" class="check_ams_rabio"
                                                    name="jsonData[{{$row['key']}}]">
                                                @endif
                                                <input type="checkbox">
                                                <div class="box">
                                                    <span class="ball"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                    <a href="javascript:void(0)" class="updated_ams_edit_btn" data-type="template-setting">
                        <span class="fa fa-check"></span>
                        <p>SETTING</p>
                    </a>
                </li>
                <li class="trash delete_ams_hiddenArea">
                    <a href="javascript:void(0)" class="delete_ams_information" data-type="template-setting">
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