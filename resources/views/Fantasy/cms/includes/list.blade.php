<input type="hidden" class="base-url-cms" value="{{ BaseFunction::cms_url('/') }}">

<!--分館/語系 head-bar-->
<ul class="head-bar">
    <li class="level-1">
        <a href="javascript:;" class="display-title">
            <span class="title">{{ $branchMenuList['now'] }}</span>
            <span class="icon-open-menu"></span>
        </a>

        <ul class="sub-menu">
            @foreach($branchMenuList['list'] as $key => $row)
                @if(empty($row['list']))
                    <li class="lng level-2">                        
                        <a class="title-box" href="{{ $row['link'] }}">
                            <i class="fa fa-toggle-on _off"></i>
                            <span class="title">{{ $row['title'] }}</span>
                        </a>
                    </li>
                @else
                    <li class="level-2">
                        <a class="title-box" href="{{ $row['link'] }}">							
                            <i class="fa fa-toggle-on _off"></i>
                            <span class="title">{{ $row['title'] }}</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            @foreach($row['list'] as $key2 => $row2)
                                <li class="level-3">
                                    <a href="{{ $row2['link'] }}">
                                        <span class="iconSquare"></span>
                                        <span class="title">{{ $row2['title'] }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif
            @endforeach
        </ul>
    </li>
</ul>
<!--分館/語系 head-bar-->

<!--CMS主選項-->
<ul class="body-list">
	@foreach($cmsMenuList as $key => $row)
		<li class="level-1 level_list {{ $row['active'] }}">
            <a href="{{ $row['link'] }}" class="content">
                <span class="icon">{{ sprintf("%02d", $key+1) }}.</span>
                <span class="title">{{ $row['title'] }}</span>
                @if(isset($row['list']) AND !empty($row['list']))
                	<span class="arrow {{ $row['active'] }}"></span>
                @endif
            </a>
            @if(isset($row['list']) AND !empty($row['list']))
	            <ul class="sub-menu" @if(!empty($row['active'])) style="display:block;" @endif>
                    @foreach($row['list'] as $key2 => $row2)
	            		<li class="level-2 level_list {{ $row2['active'] }}">
		                    <a href="{{ $row2['link'] }}">
		                      	<span class="iconSquare"></span>
                                <span class="title">{{ $row2['title'] }}</span>
                                @if(isset($row2['list']) AND !empty($row2['list']))
                                    <span class="arrow {{ $row2['active'] }}"></span>
                                @endif
                            </a>
                            @if(isset($row2['list']) AND !empty($row2['list']))
                                <ul class="sub-menu" @if(!empty($row2['active'])) style="display:block;" @endif>
                                    @foreach($row2['list'] as $key3 => $row3)
                                        <li class="level-3 level_list {{ $row3['active'] }}">
                                            <a href="{{ $row3['link'] }}">
                                                <span class="iconSquare"></span>
                                                <span class="title">{{ $row3['title'] }}</span>
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
	@endforeach
</ul>
<!--CMS主選項-->