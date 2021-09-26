@extends('template')
@section('css')
    {{-- <!--獨立CSS--> --}}
		<link rel="stylesheet" href="{{asset('dist/assets/css/index.css?v='.BaseFunction::getV())}}"/>
@stop

@section('bodyClass', 'home')
@section('bodyDataPage', 'home')
@section('content')
  @include('Front.layout.navbar')
    @include('Front.layout.menu')
    {{-- <!-- 主要內容--> --}}
    <main>
      <div class="hero waypoint">
        <div class="hero-wrap">
          <div class="hero-swiper swiper-container swiper4" data-swiper-direction="horizontal"
          data-swiper-id=""
          data-swiper-num="1"
          data-swiper-arrow="off"
          data-swiper-effect="fade"
          data-swiper-breakpoints="{320: {autoplay: {delay: 5000,}, speed: 1000},1200: {autoplay: {delay: 5000,}, speed: 1000,direction: 'vertical'}}"
          data-swiper-autoplay="on">
            <div class="swiper-wrapper">
              @foreach ($Banner_list as $key => $value)
                {{-- <!-- banner 圖片尺寸 PC 1920*1080(px) / RWD  700*1245(px)--> --}}
                <div class="swiper-slide">
                  <div class="hero-banner">
                    <picture>
                      <source media="(max-width: 767px)" srcset="{{array_search($value->img2,$imageAry)}}"/><img src="{{array_search($value->img,$imageAry)}}" alt="{{$value->title}}"/>
                    </picture>
                    <!-- 文字可選黑白兩色-->
                    <div class="detail" data-color="white">
                      <h2>{{$value->title}}</h2>
                      <p>{{$value->title2}}</p>
                      {{-- <!-- 可以新增按鈕, 至多兩個--> --}}
                      {{-- <!-- 按鈕自訂文字、連結--> --}}
                      <div>@if ($value->title3)<a class="czbtn" href="{{$value->title4?:'javascript:void(0)'}}" data-text="{{$value->title3}}">{{$value->title3}}</a>@endif @if($value->title5)<a class="czbtn" href="{{$value->title6?:'javascript:void(0)'}}" data-text="{{$value->title5}}">{{$value->title5}}</a>@endif</div>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
      @if ($topNews)
      <section class="event waypoint">
        <div class="event-wrap">
          <div class="event-date">
            <p>{{date('M. d',strtotime($topNews->news_date))}}</p>
            <p>{{$topNews->cate->title}}</p>
          </div>
          <div class="event-text">
            <p>{{$topNews->index_title}}</p>
            <p>{{$topNews->index_sub_title}}</p>
          </div><a class="event-button" href={{BaseFunction::b_url('News/'.basefunction::processTitleToUrl($topNews->cate->url_title).'/'.basefunction::processTitleToUrl($topNews->url_title))}} data-text="more">more</a>
        </div>
      </section>
      @endif
      <article class="container">
        <section class="adblock">
          <!-- 廣告區塊樣式-->
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
          <!-- two_samll, one_big 按鈕至多兩顆 / half_big 按鈕至多一顆-->
          @foreach ($viewitem as $key => $value)
            <div class="adblock-wrap waypoint" data-type="{{config('options.imgtype')[array_key_exists($value->opt,config('options.imgtype'))?$value->opt:'1']['data_type']}}" data-text-align="{{config('options.textalign')[array_key_exists($value->opt_1,config('options.textalign'))?$value->opt_1:'1']['text_align']}}" data-float="{{config('options.datafloat')[array_key_exists($value->opt_2,config('options.datafloat'))?$value->opt_2:'1']['data_float']}}" data-color="{{config('options.datacolor')[array_key_exists($value->opt_3,config('options.datacolor'))?$value->opt_3:'1']['data_color']}}">
              <div class="photo">
                <!-- 圖片尺寸 PC 890*645(px) / RWD  700*935(px) -->
                <picture style="background-color: {{$value->color}}">
                  <source media="(max-width: 1260px)" srcset="{{array_search($value->img2,$imageAry)}}"/><img src="{{array_search($value->img,$imageAry)}}" alt=""/>
                </picture>
              </div>
              @if ($value->opt==3)
                <div class="photo">
                  <!-- 圖片尺寸 PC 890*645(px) / RWD  700*935(px) -->
                  <picture style="background-color: {{$value->color2}}">
                    <source media="(max-width: 1260px)" srcset="{{array_search($value->img4,$imageAry)}}"/><img src="{{array_search($value->img3,$imageAry)}}" alt=""/>
                  </picture>
                </div>
              @endif
              <div class="content">
                <div class="content-wrap">
                  <h3 class="title">{{$value->title}}</h3>
                  <p class="subtitle">{{$value->title2}}</p>
                  <!-- 按鈕自訂文字、連結-->
                  <div class="btn-group"><a class="czbtn" href="{{$value->title3?:'javascript:void(0)'}}" data-text="more">more</a></div>
                </div>
              </div>
            </div>
          @endforeach
        </section>
        <div class="recruit waypoint">
          <div class="recruit-wrap">
            <div class="recruit-swiper swiper-container swiper4 swiper-no-swiping" data-swiper-direction="horizontal" data-swiper-id="" data-swiper-num="1" data-swiper-nav="off" data-swiper-arrow="off" data-swiper-loop="on" data-swiper-autoplay="on">
              <!-- 圖片尺寸 385*385(px)-->
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                  <div class="recruit-photo" style="background-image: url('{{basefunction::RealFiles($Setting->img)}}')"></div>
                </div>
                <div class="swiper-slide">
                  <div class="recruit-photo" style="background-image: url('{{basefunction::RealFiles($Setting->img2)}}')"></div>
                </div>
              </div>
            </div>
            <div class="recruit-content">
              <p class="title">{{$Setting->bak_title_1}}</p>
              <p class="subtitle">{{$Setting->bak_title_2}}</p>
              <div class="btn-group"><a class="czbtn" href="{{$Setting->bak_title_3?:'javascript:void(0)'}}" data-text="more">more</a></div>
            </div>
          </div>
        </div>
      </article>
    </main>
    {{-- <!-- 頁尾--> --}}
    @include('Front.layout.footer')
    @section('script')
    {{-- <script src="/assets/js/plus/home.js?v={{BaseFunction::getV()}}"></script>   --}}
    @stop
    @stop