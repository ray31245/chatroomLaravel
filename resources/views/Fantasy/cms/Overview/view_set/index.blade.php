@php
  $menuList = [
    'aForm'=>'基本內容設定',
    'bForm'=>'基本內容設定二',
    'cForm'=>'基本內容設定三',
    'dForm'=>'基本內容設定四',
    'eForm'=>'基本內容設定五',
  ]
@endphp

@if(config('cms.New') == false)
@php
    // $menuList ='';
    // $viewRoute ='';
    // $pageKey ='';
    // $need_Review ='';
    // $can_Review ='';
@endphp
@endif

@extends('Fantasy.template')

    @section('bodySetting', 'fixed-header cms_theme uiv2')

        @section('css')
            <link href="/vender/assets/css/cms_style.css" rel="stylesheet" type="text/css">
        @stop

        @section('css_back')
        @stop

        @section('content')

        <!-- mainNav 系統主選單 -->
        @include('Fantasy.includes.sidebar')
        <!-- mainNav 系統主選單 -->
    
        @include('Fantasy.cms.includes.cms_index_content',['isDelete'=> 0 ])        

        <!-- 圖片 / 影片管理 燈箱 -->
        @include('Fantasy.cms.includes.partImg_lightbox')
        <!-- 圖片 / 影片管理 燈箱 -->


        @section('script')
            <script type="text/javascript" src="/vender/backend/js/cms/cms.js"></script>
        @stop

        @section('script_back')
            <script type="text/javascript" src="/vender/backend/js/cms/cms_backend.js?v={{BaseFunction::getV()}}"></script>
            <script type="text/javascript" src="/vender/backend/js/cms/cms_unit.js"></script>
            @if ($isContent==1)
                <script>
                    $('ul.editContentMenu li:nth-child(2)').click();
                    $('.editContentArea').attr('data-mod','update');
                </script>
            @endif
                
    @stop
@stop