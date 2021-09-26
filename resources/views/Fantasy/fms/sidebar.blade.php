<div class="sidebar-menu">
    <!--語系-->
    <ul class="head-bar">
        <li class="level-1">
        <!---->
        <a href="javascript:void(0);" class="display-title">
            <span class="title">{{ $nowZero['title'] }}</span>
            <span class="arrow"></span>
        </a>
        <!--==============================-->
        <!--二層(依情況選擇 二層 或 一層)-->
        <ul class="sub-menu">
            @foreach($zeroList as $key => $row)
            <li class="level-2">
                <a class="title-box fms_menu_change {{ ($nowZero['id']==$row['id'])? 'active':'' }}" href="javascript:void(0);" data-id="{{ $row['id'] }}" data-type="{{ $row['type'] }}" data-branch="" data-folder="0">
                    <span class="title">{{ $row['title'] }}</span>
                    @if(!empty($row['list']))
                    <span class="arrow"></span>
                    @endif
                </a>
                @if(!empty($row['list']))
                    <ul class="sub-menu">
                    @foreach($row['list'] as $row2)
                        <li class="level-3">
                            <a href="javascript:void(0);" data-branch="{{ $row2['branch_id'] }}" data-type="{{ $row['type'] }}" class="fms_menu_change">
                                <span class="title">{{ $row2['title'] }}</span>
                            </a>
                        </li>
                    @endforeach
                    </ul>
                @endif
            </li>
            @endforeach
        </ul>
        </li>
    </ul>
    <!--列表list-->
    <ul class="body-list">
        @foreach($zeroList as $key0 => $value0)
            <li class="level-1 level_list {{$nowZero['id']==$value0['id'] ? 'open2' : ''}}">
                <a href="javascript:void(0);" class="content fms_lbox_folder_btn" data-zero="{{ $value0['id'] }}" data-type="{{ $now_type }}" data-folder="0">
                    <span class="iconFolder _close fa fa-folder"></span>
                    <span class="iconFolder _open fa fa-folder-open"></span>
                    <span class="title">{{ $value0['title'] }}</span>
                    @if(!empty($menuList))
                        <span class="arrow"></span>
                    @endif
                </a>
                <ul class="sub-menu" style="{{$nowZero['id'] == $value0['id'] ? 'display: block;' : ''}}">
                    @foreach($menuList as $key => $value1)
                        @if($value1['zero_id'] == $value0['id'])
                        <li class="level-2 level_list {{$first==$value1['id'] ? 'open2' : ''}}">
                            <a href="javascript:void(0);" class="content fms_lbox_folder_btn" data-first="{{ $value1['id'] }}" data-type="{{ $now_type }}" data-folder="1">
                                <span class="iconFolder _close fa fa-folder"></span>
                                <span class="iconFolder _open fa fa-folder-open"></span>
                                <span class="title">{{ $value1['title'] }}</span>
                                @if(!empty($value1['list']))
                                    <span class="arrow"></span>
                                @endif
                            </a>
                            @if(!empty($value1['list']))
                                <ul class="sub-menu" style="{{$first==$value1['id'] ? 'display: block;' : ''}}">
                                    @foreach($value1['list'] as $key2 => $value2)
                                        <li class="level-3 level_list {{$second==$value2['id'] ? 'open2' : ''}}">
                                            <a href="javascript:void(0);" class="content fms_lbox_folder_btn" data-second="{{$value2['id']}}" data-type="{{$now_type}}" data-folder="2">
                                                <span class="iconFolder _close fa fa-folder"></span>
                                                <span class="iconFolder _open fa fa-folder-open"></span>
                                                <span class="title">{{ $value2['title'] }}</span>
                                                @if(!empty($value2['list']))
                                                    <span class="arrow"></span>
                                                @endif
                                            </a>
                                            @if(!empty($value2['list']))
                                                <ul class="sub-menu" style="{{$second==$value2['id'] ? 'display: block' : ''}}">
                                                    @foreach($value2['list'] as $key3 => $value3)
                                                        <li class="level-4 level_list {{$third==$value3['id']?'open2':''}}">
                                                            <a href="javascript:void(0);" class="content fms_lbox_folder_btn" data-third="{{ $value3['id'] }}" data-type="{{ $now_type }}" data-folder="3">
                                                                <span class="iconFolder _close fa fa-folder"></span>
                                                                <span class="iconFolder _open fa fa-folder-open"></span>
                                                                <span class="title">{{ $value3['title'] }}</span>
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        @endif
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
    <div class="clearfix"></div>
</div>