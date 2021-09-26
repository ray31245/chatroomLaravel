@extends('template')
@section('css')
    {{-- <!--獨立CSS--> --}}
		<link rel="stylesheet" href="{{asset('dist/assets/css/product.css?v='.BaseFunction::getV())}}"/>
@stop

@section('bodyClass', 'product')
@section('bodyDataPage', 'product')
@section('content')
  @include('Front.layout.navbar')
    @include('Front.layout.menu')
    <!-- 主要內容-->
    <main>
      <section class="product_hd">
        <!-- 電腦 1920*750 // 平板 1200*700 // 手機 600*825 // 換圖結構在下面-->
        <div class="product_bg" style="background-image: url('{{basefunction::RealFiles($Setting->banner)}}')"></div>
        <div class="bn_title waypoint">
          <h1 class="title_head">{{$Setting->banner_title}}</h1>
          <p>{{$Setting->banner_sub_title}}</p>
        </div>
      </section>
      <section class="product_ct">
        <div class="ct_head">
          <div class="ct_title waypoint">
            <div class="title_head">{{$Setting->view_title}}</div>
            <p>{{$Setting->view_title_sub}}</p>
          </div>
        </div>
        <div class="adblock">
          {{-- <!-- 廣告區塊樣式-->
          <!-- 樣式 data-type：兩小塊 two_samll, 一大塊 one_big, 一大塊兩小圖 half_big-->
          <!-- 文字對齊 data-text-align: left, right, center-->
          <!-- 區塊位置 data-float: left, right, center-->
          <!-- 文字顏色 data-color: white, black-->
          <!-- two_samll：data-float, data-text-align 不需設定-->
          <!---->
          <!-- 每個樣式如需共用請注意 picture source(media) 尺寸及建議圖片尺寸 !-->
          <!-- half_big 無文字敘述欄位 (p.text)-->
          <!-- half_big：可上圖片, 可選背景色, 背景預設白色-->
          <!-- two_samll, one_big 必上圖片 -->
          <!-- two_samll, one_big 按鈕至多兩顆 / half_big 按鈕至多一顆--> --}}
          @foreach ($product_cate as $key=> $value)
            <div class="adblock-wrap waypoint" data-type="{{config('options.imgtype')[array_key_exists($value->img_type,config('options.imgtype'))?$value->img_type:'1']['data_type']}}" data-text-align="{{config('options.textalign')[array_key_exists($value->text_align,config('options.textalign'))?$value->text_align:'1']['text_align']}}" data-float="{{config('options.datafloat')[array_key_exists($value->text_float,config('options.datafloat'))?$value->text_float:'1']['data_float']}}" data-color="{{config('options.datacolor')[array_key_exists($value->text_color,config('options.datacolor'))?$value->text_color:'1']['data_color']}}">
              <div class="photo">
                <picture style="background-color: {{$value->l_bg_color}}">
                  <source @if(array_search($value->img_rwd,$imageAry))media="(max-width: {{config('options.imgtype')[array_key_exists($value->img_type,config('options.imgtype'))?$value->img_type:'1']['img1rwd']}}px)" srcset="{{array_search($value->img_rwd,$imageAry)}}"@endif/>@if(array_search($value->img,$imageAry))<img src="{{array_search($value->img,$imageAry)}}" alt="{{$value->title}}"/>@endif
                </picture>
              </div>
              @if ($value->img_type==3)
              <div class="photo">
                <picture style="background-color: {{$value->r_bg_color}}">
                  <source @if(array_search($value->img_rwd2,$imageAry))media="(max-width: 1024px)" srcset="{{array_search($value->img_rwd2,$imageAry)}}"@endif/>@if(array_search($value->img2,$imageAry))<img src="{{array_search($value->img2,$imageAry)}}" alt="{{$value->title}}"/>@endif
                </picture>
              </div>
              @endif
              <div class="content">
                <div class="content-wrap">
                  <h2 class="title">{!!nl2br($value->title)!!}</h2>
                  <p class="subtitle">{{$value->index_sub_title}}</p>
                  @if ($value->img_type!=3)<p class="text">{{$value->index_intro}}</p>@endif
                  <!-- 按鈕自訂文字、連結-->
                  <div class="btn-group"><a class="czbtn" href="{{basefunction::b_url('Product/'.basefunction::processTitleToUrl($value->url_title))}}" data-text="more">more</a></div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </section>
    </main>
    <style type="text/css">
      @media only screen and (max-width: 1200px){
        .product_bg{
          background-image: url('{{basefunction::RealFiles($Setting->banner_pad)}}') !important
        }
      }
      @media only screen and (max-width: 767px){
        .product_bg{
          background-image: url('{{basefunction::RealFiles($Setting->banner_rwd)}}') !important
        }
      }
      
      
    </style>
    @include('Front.layout.footer')
    @section('script')
    {{-- <script src="/assets/js/plus/product.js?v={{BaseFunction::getV()}}"></script>   --}}
    @stop
    @stop