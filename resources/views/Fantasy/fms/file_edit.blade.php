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
            <input type="hidden" name="fms[edit_id]" value="0">
            <input type="hidden" name="fms[folder_level]" value="{{$File['level']}}">
            <input type="hidden" name="fms[folder_id]" value="{{$File['folder_id']}}">
            <div class="editorContent">
                <ul class="box_block_frame">
                    <li class="inventory file_box fileInformation">
                        <div class="file_frame">
                            <div class="file_frame_info">
                                <div class="img_box">
                                    <img src="{{ (!empty($file_type['img']))?$file_type['img']:$File['real_route'] }}"
                                        alt="">
                                </div>
                                <div class="info_box">
                                    <p class="type">
                                        <span>{{ $file_type['title'].', '.$File['type'] }}</span>
                                        <i>|</i>
                                        <span class="number">@if($file_type['title']=='影像')
                                            {{ $File['resolution'] }}, @endif{{ $File['_this_size'] }}</span>
                                        <span>, 資料夾內有</span>
                                        <span class="number">{{ $count_file }}</span>
                                        <span>個檔案</span>
                                    </p>
                                    <p class="path">{{ $file_path }}</p>
                                </div>
                            </div>
                            <div class="toolBtn">
                                @if($area_detail!='資料夾')
                                @if($file_type['title']=='影像')
                                <span class="icon fa fa-eye  open_img_box"
                                    data-src="{{ $File['real_route'] }}"></span>
                                @endif
                                <span class="icon pg-download file_fantasy_download"
                                    data-src="{{ $File['real_route'] }}"
                                    data-title="{{ $File['title'] }}"></span>
                                @endif
                            </div>
                        </div>
                    </li>
                    <li class="inventory row_style">
                        <div class="title">
                            <p class="subtitle">檔案/資料夾名稱</p>
                        </div>
                        <div class="inner">
                            <input class="normal_input" name="fms[title]" type="text" placeholder=""
                                value="{{ $File['title']}}">
                            <div class="tips">
                                <span class="title">TIPS</span>
                                <p>單行輸入，輸入特殊符號如 : @#$%?/\|*及全形也盡量避免。</p>
                            </div>
                        </div>
                    </li>
                    <li class="inventory row_style">
                        <div class="title">
                            <p class="subtitle">檔案目錄位置</p>
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

                                            @if(!empty($row0['FmsFirst']))
                                                <ul class="option_list" data-id="0" data-level="1">
                                                    @foreach($row0['FmsFirst'] as $key => $row)
                                                        <li class="option" data-id="{{$row['id']}}" data-level="1">
                                                            <p class="title">{{$row['title']}}</p>
                                                            @if(!empty($row['FmsSecond']))
                                                                <ul class="option_list" data-level="2">
                                                                    @foreach($row['FmsSecond'] as $key2 => $row2)
                                                                        <li class="option" data-id="{{$row2['id']}}" data-level="2">
                                                                            <p class="title">{{$row2['title']}}</p>
                                                                            @if(!empty($row2['FmsThird']))
                                                                                <ul class="option_list" data-level="3">
                                                                                    @foreach($row2['FmsThird'] as $key3 => $row3)
                                                                                        <li class="option" data-id="{{$row3['id']}}"
                                                                                            data-level="3">
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
                                <p>你可以指定檔案的資料夾位置，不用擔心已經設定關聯的檔案位置會被改變。<br>注意：必須點選雲朵Icon才能正確選擇資料夾</p>
                            </div>
                        </div>
                    </li>
                    @php
                    $owner_options = [];
                    foreach ($all_owner as $key => $value) {
                    $temp =[
                    'title' => $value['name'],
                    'key' => $value['id']
                    ];
                    array_push($owner_options, $temp);
                    }
                    @endphp
                    {{-- 權限功能，Honda交給你惹! --}}
                    <li class="inventory row_style">
                        <div class="title">
                            <p class="subtitle">備註與說明</p>
                        </div>
                        <div class="inner">
                            <textarea name="fms[note]" id="file_outSite_textarea3"
                                placeholder="可以針對檔案下被註記說明">{{ $File['note']}}</textarea>
                            <div class="tips">
                                <span class="title">TIPS</span>
                                <p>可輸入多行文字，內容不支援HTML及CSS、JQ、JS等語法，斷行請多利用Shift+Enter，輸入區域可拖曳右下角縮放。</p>
                            </div>
                        </div>
                    </li>
                    <li class="inventory row_style">
                        <div class="title">
                            <p class="subtitle">最後異動時間</p>
                        </div>
                        <div class="inner">
                            <div class="file_date">
                                @if(!empty($last_edit_user))
                                <p class="name">{{$last_edit_user['name']}},</p>
                                <p>在 {{ date("Y 年 m 月 d 日 H : i : s", strtotime($File['updated_at'])) }} 修改過</p>
                                @else
                                <p class="name">{{$owner['name']}},</p>
                                <p>在 {{ date("Y 年 m 月 d 日 H : i : s", strtotime($File['updated_at'])) }} 修改過</p>
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
                            <p class="subtitle">建立日期</p>
                        </div>
                        <div class="inner">
                            <div class="file_date">
                                <p class="name">{{$owner['name']}},</p>
                                <p>在 {{ date("Y 年 m 月 d 日 H : i : s", strtotime($File['created_at'])) }} 建立</p>
                            </div>
                            <div class="tips">
                                <span class="title">TIPS</span>
                                <p>不開放修改，由系統自行更新。</p>
                            </div>
                        </div>
                    </li>
                    <li class="inventory row_style">
                        <div class="title">
                            <p class="subtitle">擁有者</p>
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
    <!--區塊功能按鈕-->
    <div class="hiddenArea_frame_controlBtn">
        <ul class="btnGroup">
            <li class="check file_edit_upload">
                <a href="javascript:void(0)">
                    <span class="fa fa-check"></span>
                    <p>SETTING</p>
                </a>
            </li>
            <li class="trash file_edit_delete">
                <a href="javascript:void(0)">
                    <span class="fa fa-trash"></span>
                    <p>DELETE</p>
                </a>
            </li>
            <li class="remove">
                <a href="javascript:void(0)" class="close_btn">
                    <span class="fa fa-remove"></span>
                    <p>CANCEL</p>
                </a>
            </li>
        </ul>
    </div>
</div>