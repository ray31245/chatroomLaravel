@extends('Fantasy.template')
@section('bodySetting', 'fixed-header')
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
  </div>
  @section('script')
  @stop
  @section('script_back')
  @stop
@stop