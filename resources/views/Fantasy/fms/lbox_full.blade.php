        <!-- 內容 CONTENT -->
            <div class="content">
                <!-- 左邊 SECONDARY SIDEBAR MENU-->
                <nav class="content-sidebar">
                    @include('Fantasy.fms.sidebar')
                </nav>
                <div class="quill_sidebarWall close"></div>
                    <!-- 左邊 SECONDARY SIDEBAR MENU -->
                    <!-- 右邊 PAGE CONTENT -->
                    <div class="inner-content">
                    <!-- 上面區塊 (佈告欄)-->
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
                                        {{-- <li class="breadcrumb-item"><a href="#">品牌總覽</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">第一層</li> --}}
                                        </ol>
                                    </nav>
                                </div>
                                <div class="total">
                                    <p>
                                        <span class="text">Total Data</span>
                                        <span class="num">&nbsp;123</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 上面區塊 (佈告欄) -->
                    <!-- search_bar -->
                    {{-- <div class="search_area">
                        <div class="frame">
                        <div class="title">
                            <span class="fa fa-search"></span>
                            <p>SEARCH FILTER</p>
                        </div>
                        <div class="bar"></div>
                        <div class="close_search_btn">
                            <span class="fa fa-remove"></span>
                        </div>
                        </div>
                    </div> --}}
                    <!-- search_bar -->
                    <!-- 下面列表 -->
                    <!-- no_left 是針對這個table沒有 fixedColumns:left 的時候的checkbox數字順序計算 -->
                    <div class="container-fluid bg-white content-scrollbox">
                        <div class="table-box card card-transparent main-table no_left" data-tableID="fms_table" style="position: relative;">
                        <div class="card-header">
                            <div class="subtitle">
                            <!--按鈕群-->
                            <ul class="btn-group">
                                <li style="background-color: #464646;" class="fms_bulider_upload">
                                <a href="javascript:void(0)" title="檔案上傳">
                                    <!--上傳檔案中的時候 就顯示input結構 然後執行 total_circle_progress(name,total,goal)-->
                                    <!--沒在上傳的時候就顯示 <span class="fa fa-cloud-upload"></span>-->
                                    <span class="fa fa-cloud-upload"></span>
                                    {{-- <div class="mini_circle_pace"></div> --}}
                                </a>
                                </li>
                                {{-- <li style="background-color: #464646;"> --}}
                                {{--<a href="javascript:void(0)">
                                    <span class="fa fa-files-o"></span>
                                </a>
                                </li> --}}
                                {{--<li style="background-color: #464646;">
                                <a href="javascript:void(0)">
                                    <span class="fa fa-exchange"></span>
                                </a>
                                </li> --}}
                                {{--<li style="background-color: #464646;">
                                <a href="javascript:void(0)">
                                    <span class="fa fa-lock"></span>
                                </a>
                                </li> --}}
                                <li style="background-color: #464646;" class="localeToDeleteFiles">
                                <a href="javascript:void(0)">
                                    <span class="fa fa-trash"></span>
                                </a>
                                </li>
                                <li style="background-color: #464646;" class="localeToDownloadFiles">
                                <a href="javascript:void(0)">
                                    <span class="pg-download"></span>
                                </a>
                                </li>
                                {{--<li class="open_search_btn" style="background-color: #000000;">
                                <a href="javascript:void(0)">
                                    <span class="fa fa-search"></span>
                                </a>
                                </li> --}}
                                <li style="background-color: #775bc2;" class="fms_bulider_new">
                                    <a href="javascript:void(0)" title="新增資料夾">
                                        <span class="fa fa-folder"></span>
                                    </a>
                                </li>
                                <li style="background-color: #765347;display:none;" class="fms_select_all_hello">
                                    <a href="javascript:void(0)" title="選擇全部">
                                        <span class="fa fa-list"></span>
                                    </a>
                                </li>
                                {{-- <li style="background-color: #775bc2;" class="fms_bulider_name">
                                <a href="javascript:void(0)" title="修改資料夾名稱">
                                    <span class="fa fa-font"></span>
                                </a>
                                </li> --}}
                                {{-- <li style="background-color: #775bc2;" class="localeToDeleteFolder">
                                <a href="javascript:void(0)" title="刪除資料夾">
                                    <span class="fa fa-trash"></span>
                                </a>
                                </li> --}}
                            </ul>
                            <!--顯示模式-->
                            <div class="arrow-group">
                                <!--grid_sort 只在 view MODE:Grid 的時後顯示-->
                                <div class="grid_sort" style="display: none;">
                                <div class="quill_select">
                                    <div class="select_object">
                                    <p class="title">Sort by :  檔案類型</p>
                                    <span class="arrow pg-arrow_minimize"></span>
                                    </div>
                                    <div class="select_wrapper">
                                    <ul class="select_list fms_gd_select_list">
                                        <p class="category">SELECT A SORT ITEM</p>
                                        <li class="option" data-title="title"><p>資料夾/檔案名稱</p></li>
                                        <li class="option" data-title="type"><p>檔案格式</p></li>
                                        <li class="option" data-title="file_type"><p>檔案類型</p></li>
                                        <li class="option" data-title="size"><p>檔案容量</p></li>
                                        <li class="option" data-title="resolution"><p>檔案尺寸</p></li>
                                        <li class="option" data-title="updated_at"><p>最後異動時間</p></li>
                                        <li class="option" data-title="created_at"><p>檔案建立時間</p></li>
                                        <li class="option" data-title="create_id"><p>擁有者</p></li>
                                    </ul>
                                    </div>
                                </div>
                                </div>
                                <div class="text">
                                <p>VIEW MODE</p>
                                </div>
                                <div class="arrow">
                                {{-- <span class="mode_btn fa fa-th-large" mode-id="gd_mode"></span> --}}
                                <span class="mode_btn fa fa-list-ul open" mode-id="lp_mode"></span>
                                {{-- <span class="mode_btn pg-leftalign " mode-id="lt_mode"></span> --}}
                                </div>
                            </div>
                            </div>
                        </div>
                        {{-- <div class="card-block table_mode lt_mode  fms_lt_datatb">
                            <!--view MODE:List-->
                            <table class="table table-hover">
                            <thead>
                                <tr>
                                <th style="width:20px" class="text-center">
                                    <button class="btn btn-link">
                                    <i class="pg-unordered_list"></i>
                                    </button>
                                </th>
                                <th style="width:33%">資料夾/檔案名稱</th>
                                <th style="width:10%">檔案格式</th>
                                <th style="width:10%">檔案類型</th>
                                <th style="width:10%">檔案容量</th>
                                <th style="width:11%">檔案尺寸</th>
                                <th style="width:12%">最後異動時間</th>
                                <th style="width:10%">檔案擁有者</th>
                                </tr>
                            </thead>
                            <tbody class="{{ $one_class }} fms_lbox_lt_tbody">
                            </tbody>
                            </table>
                        </div> --}}
                        <div class="card-block table_mode lp_mode open fms_lp_datatb">
                            <!--view MODE:List + Pic-->
                            <table class="table table-hover">
                            </table>
                        </div>
                        {{-- <div class="card-block table_mode gd_mode fms_gd_datatb">
                            <!--view MODE:Grid-->
                            <!--有分lock跟unlock-->
                            <article class="grid_mode {{ $one_class }}">
                            <ul class="frame fms_lbox_gd_tbody">
                            </ul>
                            </article>
                        </div> --}}
                        </div>
                    </div>
                    <!-- 下面列表 -->
                </div>
                <!-- 右邊 PAGE CONTENT -->
            </div>
        <!-- 內容 CONTENT -->