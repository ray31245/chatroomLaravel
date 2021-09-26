@extends('Fantasy.template')
    @section('bodySetting', 'fixed-header fms_theme uiv2')
        @section('css')
            <link href="/vender/assets/css/fms_style.css" rel="stylesheet" type="text/css">
        @stop
        @section('css_back')
        @stop
        @section('content')
        <!-- 左邊滑動的 sidebar -->
        @include('Fantasy.includes.sidebar')
        <!-- 左邊滑動的 sidebar -->
        <!-- 中間主區塊 -->
        <div class="mainBody page-container extract-block">
            <!-- 最上面的 header bar -->
            @include('Fantasy.includes.header')
            <!-- 最上面的 header bar -->
            <!-- 內容 CONTENT -->
            <div class="page-content-wrapper mainContent">
            </div>
            <!-- 內容 CONTENT -->
        </div>
        <!-- 中間主區塊 -->
        <!-- 右邊滑動的 隱藏區塊 -->
        <article class="hiddenArea inforArea">
        </article>
        <!-- 燈箱圖片 -->  
        <!-- 燈箱圖片 -->
        @section('script')
            <script type="text/javascript" src="/vender/backend/js/fms/fms.js"></script>
        @stop
        @section('script_back')
        <script>
            $( ".page-content-wrapper" ).load( $('.base-url').val() + "/Ajax/fms-lbox-full/0/0/0?table=true",function(){
                //需啟動的JS
                change_fms_file_lp_table(1,0,0,0,1);
                fms_lightbox();
            });
        </script>
        <script type="text/javascript" src="/vender/backend/js/cms/cms_backend.js?v={{BaseFunction::getV()}}"></script>
        {{-- <script type="text/javascript" src="/vender/backend/js/fms/file_upload.js"></script> --}}
    @stop
@stop
