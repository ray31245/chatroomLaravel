<!DOCTYPE html>
<html>

<head>
    <meta name="robots" content="noindex">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>Fantasy - {{ $unitTitle }}</title>

    <!--============  Meta宣告  ============-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link rel="apple-touch-icon" href="{{ asset('/vender/pages/ico/60.png') }}" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/vender/pages/ico/76.png') }}" />
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('/vender/pages/ico/120.png') }}" />
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('/vender/pages/ico/152.png') }}" />
    <link rel="icon" type="image/x-icon" href="{{ asset('/favicon.ico?v=20171314') }}" />

    <!--============  引入外掛css  ============-->
    <link href="{{ asset('/vender/assets/plugins/pace/pace-theme-flash.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/vender/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/vender/assets/plugins/font-awesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/vender/assets/plugins/jquery-scrollbar/jquery.scrollbar.css') }}" rel="stylesheet" type="text/css" media="screen" />
    <link href="{{ asset('/vender/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" media="screen" />
    <link href="{{ asset('/vender/assets/plugins/switchery/css/switchery.min.css') }}" rel="stylesheet" type="text/css" media="screen" />

    <!--模仿ios開關按鈕-->
    <link href="{{ asset('/vender/assets/plugins/summernote/0.8.12/summernote.css') }}" rel="stylesheet">
    <link href="{{ asset('/vender/assets/plugins/bootstrap-datepicker/css/datepicker3.css') }}" rel="stylesheet" type="text/css" media="screen" />
    <link href="{{ asset('/vender/assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet" type="text/css" media="screen" />
    <link href="{{ asset('/vender/assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css" media="screen" />
    <link href="/vender/pages/css/pages-icons.css" rel="stylesheet" type="text/css" />
    <link class="main-stylesheet" href="/vender/pages/css/pages.css" rel="stylesheet" type="text/css" />

    <!--datatable-->
    <link type="text/css" rel="stylesheet" href="{{ asset('/vender/assets/plugins/jquery-datatable/media/css/jquery.dataTables.css' )}}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('/vender/assets/plugins/jquery-datatable/extensions/FixedColumns/css/dataTables.fixedColumns.min.css' )}}" />
    <link media="screen" type="text/css" rel="stylesheet" href="{{ asset('/vender/assets/plugins/datatables-responsive/css/datatables.responsive.css' )}}" />

    <!--color-picker(2018/4/3 引入)-->
    <link type="text/css" rel="stylesheet" href="{{ asset('/vender/assets/js/spectrum/spectrum.css') }}" />

    <!--icomoon(2019/7/25 引入) -->
    <link type="text/css" rel="stylesheet" href="{{ asset('/vender/assets/font/icomoon/style.css') }}" />

    <!--============  頁面JS  ============-->
    <script type="text/javascript">
        window.onload = function () {
            // fix for windows 8
            if (navigator.appVersion.indexOf("Windows NT 6.2") != -1)
                document.head.innerHTML += '<link rel="stylesheet" type="text/css" href="{{ asset(' / vender / pages / css / windows.chrome.fix .css ') }}" />'
        }
    </script>

    <!-- 非共用的Css -->
    @yield('css')

    <!-- 非共用的Css(絕對後面那種) -->
    @yield('css_back')    
    <!--============  引入FantasyAllcss  ============-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/vender/assets/css/FantasyAllcss.css?v=').BaseFunction::getV()}}" />
</head>

<body class="@yield('bodySetting')">
    <!--阻擋視窗 想要阻擋視窗出現 就在 block_out 後面再加ㄧ個 show-->
    <div id="temp_div_blockout" class="block_out">
        <div class="box">
            <div class="progress-circle-indeterminate"></div>
        </div>
    </div>

    <!-- 乾淨der網址 -->
    <input type="hidden" class="base-url-plus" value="{{ url('/') }}">
    <input type="hidden" class="base-url" value="{{ BaseFunction::f_url('/') }}">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" class="_token">

    @yield('content')

    @include('Fantasy.load.file_upload')

    {{-- cms上傳視窗 --}}
    <article class="fms_lbox lbox_frame hiddenArea  fmsAjaxArea">
        <div class="ajaxItem fms">
            <div class="ajaxContainer fms_container open">
                <div class="detailEditor">
                    <div class="frame editorBody">
                    </div>
                </div>
            </div>
        </div>
    </article>

    {{-- ams選帳號視窗 --}}
    <article class="ams_lbox lbox_frame">
        <div class="frame">
        </div>
    </article>

    <article id="fantasy_alert_box" class="submit_lbox lbox_frame" style="z-index:13;">
        <div class="frame">
            <div class="message">
                <div class="topBar"></div>
                <div class="content">
                    <i class="fa fa-remove closeBtn"></i>
                    <div class="logoImg">
                        <img src="{{ asset('vender/assets/img/Main-Icon.jpg') }}" alt="logo" class="brand">
                        <h2>fantasy</h2>
                    </div>
                    <hr>
                    <h3></h3>
                    <p></p>
                    <hr>
                    <div class="buttonBox">
                        <button type="button" class="checkBtn success" style="text-align: center">
                            OK
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </article>

    <article id="fantasy_confirm_box" class="submit_lbox lbox_frame">
        <div class="frame">
            <div class="message">
                <div class="topBar"></div>
                <div class="content">
                    <i class="fa fa-remove closeBtn"></i>
                    <div class="logoImg">
                        <img src="{{ asset('vender/assets/img/Main-Icon.jpg') }}" alt="logo" class="brand">
                        <h2>fantasy</h2>
                    </div>
                    <hr>
                    <h3></h3>
                    <p></p>
                    <hr>
                    <div class="buttonBox">
                        <button type="button" class="checkBtn success" style="text-align: center">
                            <i class="fa fa-check"></i> CONFIRM
                        </button>
                        <button type="button" class="checkBtn null" style="text-align: center">
                            <i class="fa fa-remove"></i> CANCEL
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </article>

    <!--JS-->
    <script type="text/javascript" src="{{ asset('/vender/assets/plugins/pace/pace.min.js') }}"></script>

    <!--載入進度條插件-->
    <script type="text/javascript" src="{{ asset('/vender/assets/plugins/jquery/jquery-3.4.1.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vender/assets/plugins/modernizr.custom.js') }}"></script>

    <!--判斷各類型瀏覽器對CSS3某些屬性的支不支持-->
    <script type="text/javascript" src="{{ asset('/vender/assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vender/assets/plugins/tether/js/tether.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vender/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vender/assets/plugins/jquery/jquery-easy.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vender/assets/plugins/jquery-unveil/jquery.unveil.min.js') }}"></script>

    <!--lazy load img-->
    <script type="text/javascript" src="{{ asset('/vender/assets/plugins/jquery-ios-list/jquery.ioslist.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vender/assets/plugins/jquery-actual/jquery.actual.min.js') }}"></script>
    
    <!--一個即使物件display:none 也還是可以抓到寬高的插件-->
    <script type="text/javascript" src="{{ asset('/vender/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

    <!--scroll bar-->
    <script type="text/javascript" src="{{ asset('/vender/assets/plugins/select2/js/select2.full.min.js') }}"></script>

    <!--下拉選單-->
    <script type="text/javascript" src="{{ asset('/vender/assets/plugins/classie/classie.js') }}"></script>

    <!--也是下拉選單-->
    <script type="text/javascript" src="{{ asset('/vender/assets/plugins/switchery/js/switchery.min.js') }}"></script>

    <!--editors文字編輯器-->
    <script type="text/javascript" src="{{ asset('/vender/assets/plugins/summernote/0.8.12/summernote.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vender/assets/plugins/bootstrap-tag/bootstrap-tagsinput.min.js') }}"></script>

    <!--input裡有tag的插件-->
    <script type="text/javascript" src="{{ asset('/vender/assets/plugins/moment/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vender/assets/plugins/bootstrap-daterangepicker/zh-tw.js') }}"></script>
    <script type="text/javascript"src="{{ asset('/vender/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script type="text/javascript"src="{{ asset('/vender/assets/plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.zh-TW.js') }}"></script>
    <script type="text/javascript"src="{{ asset('/vender/assets/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script type="text/javascript"src="{{ asset('/vender/assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js') }}"></script>
    {{-- <script type="text/javascript" src="{{ asset('/vender/pages/js/pages.js') }}"></script> --}}
    <!--模板(template)js-->

    <!--============  引入JS  ============-->
    <!--datatable-->
    <script type="text/javascript" src="{{ asset('/vender/assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vender/assets/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vender/assets/plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js') }}"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>
    <script type="text/javascript" src="{{ asset('/vender/assets/plugins/jquery-datatable/extensions/FixedColumns/js/dataTables.fixedColumns.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vender/assets/plugins/jquery-datatable/extensions/FixedHeader/js/dataTables.fixedHeader.min.js') }}"></script>

    <!--color-picker(2018/4/3 引入)-->
    <script type="text/javascript" src="{{ asset('/vender/assets/js/spectrum/spectrum.js') }}"></script>
    <!--==========  引入JS End  ==========-->
    <!--QuillCircleProgram.js(2018/5/14 引入)-->
    <script type="text/javascript" src="{{ asset('/vender/backend/js/QuillCircleProgram/QuillCircleProgram.js') }}"></script>

    {{-- 僅在上傳檔案時fms有使用#HondaDebug --}}
    <script type="text/javascript" src="{{ asset('/vender/backend/js/custom.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vender/backend/js/js_builder.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vender/assets/js/fantasy_main.js?v=').BaseFunction::getV()}}"></script>

    <!--==========  後端用JS  ==========-->
    {{-- 非共用的JS區塊 --}}
    @yield('script')
    {{-- <script type="text/javascript" src="{{ asset('/vender/backend/js/fms/fms.js') }}"></script>
    只需要grid_mode()和table_view_mode()兩個功能#Honda --}}
    {{-- 非共用的JS區塊(更後面) --}}
    @yield('script_back')
    <script type="text/javascript" src="{{ asset('/vender/backend/js/fms/file_upload.js') }}"></script>
    {{-- 表單驗證 --}}
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.19.1/jquery.validate.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.19.1/localization/messages_zh_tw.js"></script>
</body>

</html>
<script>
    /**
     * 
     * 若原本阻擋視窗是關閉，則開啟阻擋視窗，反之則關閉阻擋視窗
     * 
     */
    function temp_loading() {
        $('#temp_div_blockout').toggleClass('show');
    }
    /**
     * 開啟alert
     * @augments
     * content(array) { 'title': 訊息視窗標題, 'msg': 訊息內容 }
     * btn_setting(array) { 'confirm': 按下確認要執行的功能, 'confirm_txt': 確認鈕文字 }
     * */
    function temp_alert_box(content, btn_setting) {
        $('#fantasy_alert_box').addClass('open');
        $('#fantasy_alert_box h3').text(content['title']);
        $('#fantasy_alert_box p').text(content['msg']);
        $('#fantasy_alert_box button.checkBtn.success').html(btn_setting['confirm_txt'] != undefined ? btn_setting[
            'confirm_txt'] : 'OK');
        $('#fantasy_alert_box button.checkBtn.success').off('click').click(function () {
            if (btn_setting['confirm'] != undefined) btn_setting['confirm']();
            $('#fantasy_alert_box').removeClass('open');
        });
    }
    /**
     * 開啟confirm
     * @augments
     * content(array) { 'title': 訊息視窗標題, 'msg': 訊息內容 }
     * btn_setting(array) { 'confirm': 按下確認要執行的功能,  'confirm_txt': 確認鈕文字, 'cancel': 按下取消要執行的功能, 'cancel_txt': 取消鈕文字 }
     * */
    function temp_confirm_box(content, btn_setting) {
        $('#fantasy_confirm_box').addClass('open');
        $('#fantasy_confirm_box h3').text(content['title']);
        $('#fantasy_confirm_box p').text(content['msg']);
        $('#fantasy_confirm_box button.checkBtn.success').html('<i class="fa fa-check"></i>' + (btn_setting[
            'confirm_txt'] != undefined ? btn_setting['confirm_txt'] : 'CONFIRM'));
        $('#fantasy_confirm_box button.checkBtn.null').html('<i class="fa fa-remove"></i>' + (btn_setting[
            'cancel_txt'] != undefined ? btn_setting['cancel_txt'] : 'CANCEL'));
        $('#fantasy_confirm_box button.checkBtn.success').off('click').click(function () {
            if (btn_setting['confirm'] != undefined) btn_setting['confirm']();
            $('#fantasy_confirm_box').removeClass('open');
        });
        $('#fantasy_confirm_box button.checkBtn.null').off('click').click(function () {
            if (btn_setting['cancel'] != undefined) btn_setting['cancel']();
            $('#fantasy_confirm_box').removeClass('open');
        });
    }
</script>