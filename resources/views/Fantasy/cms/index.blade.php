@extends('Fantasy.template')

@section('bodySetting', 'fixed-header cms_theme uiv2')

  @section('css')
    <link href="{{ asset('/vender/assets/css/cms_style.css') }}" rel="stylesheet" type="text/css">
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

    <div class="page-content-wrapper mainContent full-height">
      <div class="content full-height">
        <!-- 左邊 SECONDARY SIDEBAR MENU-->
        <nav class="content-sidebar">

          <div class="sidebar-menu">

            @include('Fantasy.cms.includes.list')

            <div class="clearfix"></div>
          </div>

        </nav>
        <!-- 左邊 SECONDARY SIDEBAR MENU -->
        <div class="inner-content">
            <div class="jumbotron">
                <div class="container-fluid">
                    <div class="inner">
                        <div class="inner-left">
                            <div class="switch-menu">
                                <span class="bar"></span>
                                <span class="bar"></span>
                                <span class="bar"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 右邊 PAGE CONTENT -->
      </div>
    </div>
    <!-- 內容 CONTENT -->
  </div>
  <!-- 中間主區塊 -->

  @section('script')
    <script type="text/javascript" src="{{ asset('/vender/backend/js/cms/cms.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vender/backend/js/cms/cms_backend.js') }}"></script>
  @stop

  @section('script_back')

  @stop
@stop