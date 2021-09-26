<!-- cms主要內容區 -->
<div class="mainBody page-container extract-block">
    <!-- header -->
    @include('Fantasy.includes.header')
    <!-- header -->

    <!-- 內容 CONTENT -->
    <div class="page-content-wrapper mainContent full-height">
        <div class="content full-height">
            <!-- SIDEBAR MENU-->
            <nav class="content-sidebar">
                <div class="sidebar-menu">
                    <!--分館/語系 head-bar-->
                    @include('Fantasy.cms.includes.list')
                    <!--分館/語系 head-bar-->
                    <div class="clearfix"></div>
                </div>
            </nav>
            <!-- SIDEBAR MENU-->

            <!-- 右邊 inner-content -->
            <div class="inner-content">
                <!-- 目前路徑 jumbotron -->
                <div class="jumbotron">
                    <div class="container-fluid">
                        <div class="inner">
                            <div class="inner-left">
                                <div class="switch-menu">
                                    <span class="bar"></span>
                                    <span class="bar"></span>
                                    <span class="bar"></span>
                                </div>

                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="{{Basefunction::cms_url('/')}}">{{$nowBranchData['title']}} - {{$nowLocale['abb_title']}}</a>
                                        </li>

                                        @if(is_object($parentMenu))
                                            <li class="breadcrumb-item"><a>{{$parentMenu['title']}}</a></li>
                                        @endif

                                        <li class="breadcrumb-item active" aria-current="page">{{ $pageTitle }}</li>
                                    </ol>
                                </nav>
                            </div>

                            <div class="total">
                                <p>
                                    <span class="text">Total Data</span>
                                    <span class="num">&nbsp;{{ number_format($count) }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>                        
                <!-- 目前路徑 jumbotron -->
                <!-- 上面區塊 -->

                <!-- 下面列表 -->
                @if($isContent==1)
                    <div class="content-scrollbox hiddenArea cms_hiddenArea main_container_frame editContentArea" data-id="only" data-model="{{$modelName}}" data-mod="" data-page="{{ $pageKey }}" data-route="{{ $viewRoute }}">
                        <div class="hiddenArea_frame">
                            <!--表格-->
                            <div class="singleEditer">
                                <!--Body-->
                                <div class="editorBody">
                                    <!--Header-->
                                    <div class="editorHeader">
                                        <div class="info">
                                            <div class="title">
                                                <p class="editTypeTitle"></p>
                                            </div>
                                            <h3 class="dataEditTitle"></h3>
                                            <p class="form-name editFormName">-</p>
                                        </div>

                                        <div class="control">
                                            <ul class="btnGroup">
                                            <li class="check editSentBtn">
                                                <a href="javascript:void(0)">
                                                <span class="fa fa-check"></span>
                                                </a>
                                            </li>
                                            @if($isDelete == 1)
                                                <li class="trash cms-delete-btn">
                                                <a href="javascript:void(0)">
                                                    <span class="fa fa-trash"></span>
                                                </a>
                                                </li>
                                            @endif
                                            @if($isCreate == 1)
                                                {{-- <li class="file">
                                                <a href="javascript:void(0)">
                                                    <span class="fa fa-files-o"></span>
                                                </a>
                                                </li> --}}
                                            @endif
                                            <li class="remove">
                                                <a href="javascript:void(0)" class="close_btn">
                                                <span class="fa fa-remove"></span>
                                                </a>
                                            </li>
                                            </ul>
                                            <p class="sub_title">
                                            內容管理選項
                                            </p>
                                        </div>
                                    </div>

                                    <!--editorContent-->
                                    <div class="editorContent editContentFormArea">
                                        <!--搜尋Form-->
                                        <form id="searchForm">
                                            @include($viewRoute.'.search')
                                        </form>

                                        <!--基本內容Form-->
                                        @foreach ($menuList as $menukey => $menuname)
                                            <form id= {{$menukey}}></form>
                                        @endforeach

                                    </div>
                                </div>
                                <!--menu-->
                                <div class="editorNav">
                                    <ul class="editContentMenu" data-route="{{ $viewRoute }}">
                                        <li data-form="searchForm">
                                            <a href="javascript:void(0);">
                                            <p class="editorNavName">資料搜尋</p>
                                            </a>
                                        </li>

                                        {{-- Menu-Content select --}}
                                        @foreach ($menuList as $menukey => $menuname)
                                            <li data-form={{$menukey}}>
                                                <a href="javascript:void(0);">
                                                    <p class="menu_listName">{{$menuname}}</p>
                                                </a>
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="content-scrollbox">
                        <div class="content-wrap main-table index-table-div" data-tableid="new_cms_table">
                            @include($viewRoute.'.table')
                        </div>
                    </div>
                @endif
                <!-- 下面列表 -->
                <!-- 下面列表END -->
            </div>
            <!-- 右邊 inner-content -->
        </div>
    </div>
    <!-- 內容 CONTENT -->
</div>
<!-- cms主要內容區 -->

<!-- cms DeatilEditor -->
@if ($isContent!=1)
    <div class="hiddenArea editContentArea cms_hiddenArea cmsDetailAjaxArea" data-id="" data-model="" data-mod="" data-page="{{ $pageKey }}" data-route="{{ $viewRoute }}" data-need_review="{{$need_Review}}" data-can_review="{{$can_Review}}">
        <div class="hiddenArea_frame ajaxItem cms">
            <!--表格-->
                <!--表格內容-->
                <div class="detailEditor">
                    <!--Body-->
                    <div class="editorBody">
                        <!--Header-->
                        <div class="editorHeader">
                            <div class="info">
                                <div class="title">
                                    <p class="editTypeTitle"></p>
                                </div>
                                <h3 class="dataEditTitle"></h3>
                            </div>

                            <div class="control">
                                <ul class="btnGroup">
                                {{-- <li class="check editSentBtn">
                                    <a href="javascript:void(0)">
                                    <span class="fa fa-check"></span>
                                    </a>
                                </li> --}}
                                @if($isDelete == 1)
                                    {{-- <li class="trash cms-delete-btn">
                                    <a href="javascript:void(0)">
                                        <span class="fa fa-trash"></span>
                                    </a>
                                    </li> --}}
                                @endif
                                @if($isCreate == 1)
                                    {{-- <li class="file">
                                    <a href="javascript:void(0)">
                                        <span class="fa fa-files-o"></span>
                                    </a>
                                    </li> --}}
                                @endif
                                {{-- <li class="remove">
                                    <a href="javascript:void(0)" class="close_btn">
                                    <span class="fa fa-remove"></span>
                                    </a>
                                </li> --}}
                                </ul>
                            </div>
                        </div>

                        <!--editorContent-->
                        <div class="editorContent editContentFormArea">
                            <!--搜尋Form-->
                            <form id="searchForm">
                                @include($viewRoute.'.search')
                            </form>

                            <!--基本內容Form-->
                            @foreach ($menuList as $menukey => $menuname)
                                <form id= {{$menukey}}></form>
                            @endforeach

                        </div>
                    </div>
                    <!--menu-->
                    <div class="editorNav">
                        <div class="control">
                            <ul class="btnGroup">
                                <li class="check editSentBtn">
                                    <a href="javascript:;">
                                        <span class="fa fa-check"></span>
                                    </a>
                                </li>
                                @if($isDelete == 1)
                                <li class="trash cms-delete-btn">
                                    <a href="javascript:;">
                                        <span class="fa fa-trash"></span>
                                    </a>
                                </li>
                                @endif
                                @if($isCreate == 1)
                                {{-- <li class="file">
                                    <a href="javascript:;">
                                        <span class="fa fa-files-o"></span>
                                    </a>
                                </li> --}}
                                @endif
                                <li class="remove">
                                    <a href="javascript:;" class="close_btn">
                                        <span class="fa fa-remove"></span>
                                    </a>
                                </li>
                            </ul>
                            <p class="sub_title">MANAGEMENT OPTIONS</p>
                        </div>
                        <ul class="editContentMenu navGroup" data-route="{{ $viewRoute }}">
                            <li data-form="searchForm">
                                <a href="javascript:void(0);">
                                <p class="editorNavName">資料搜尋</p>
                                </a>
                            </li>

                            {{-- Menu-Content select --}}
                            @foreach ($menuList as $menukey => $menuname)
                                <li data-form={{$menukey}}>
                                    <a href="javascript:void(0);">
                                        <p class="menu_listName">{{$menuname}}</p>
                                    </a>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            

            <!--區塊功能按鈕-->
            <div class="hiddenArea_frame_controlBtn">
                <ul class="btnGroup">

                    <li class="check editSentBtn">
                        <a href="javascript:void(0)">
                        <span class="fa fa-check"></span>
                        <p>Setting</p>
                        </a>
                    </li>

                    @if($isDelete == 1)
                        <li class="trash cms-delete-btn">
                        <a href="javascript:void(0)">
                            <span class="fa fa-trash"></span>
                            <p>Delete</p>
                        </a>
                        </li>
                    @endif

                    <li class="remove">
                        <a href="javascript:void(0)" class="close_btn">
                        <span class="fa fa-remove"></span>
                        <p>Cancel</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endif