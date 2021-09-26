@extends('template')
@section('css')
    {{-- <!--獨立CSS--> --}}
		<link rel="stylesheet" href="{{asset('dist/assets/css/service.css?v='.BaseFunction::getV())}}"/>
@stop

@section('bodyClass', 'service')
@section('bodyDataPage', 'service')
@section('content')
  @include('Front.layout.navbar')
    @include('Front.layout.menu')
    <!-- 主要內容-->
    <main>
      <section class="service_hd">
        <!-- 電腦 1920*980 // 平板 1200*700 // 手機 600*825 // 換圖結構在下面-->
        <div class="service_bg" style="background-image: url({{basefunction::RealFiles($Setting->banner)}})">
          <div class="hd_wrap waypoint">
            <div class="bn_title">
              <div class="title_head">{{$Setting->banner_title}}</div>
              <p>{{$Setting->banner_sub_title}}</p>
            </div>
            <ul class="hd_feature">
              @foreach ($item as $key => $value)
              <li>
                <div class="bg"></div><span>{{$value->title}}</span>
                <p>{{$value->title2}}</p>
              </li>
              @endforeach
            </ul>
            <div class="hd_btn"><a class="czbtn" href="{{$Setting->bak_title_16?:'javascript:;'}}" data-text="{{$Setting->bak_title_15}}">{{$Setting->bak_title_15}}</a><a class="czbtn" href="{{$tabArr[1]}}" data-text="{{$Setting->bak_title_17}}">{{$Setting->bak_title_17}}</a></div>
          </div>
        </div>
        <div class="hd_rwd waypoint">
          <ul class="hd_feature">
            @foreach ($item as $key => $value)
            <li>
              <div class="bg"></div><span>{{$value->title}}</span>
              <p>{{$value->title2}}</p>
            </li>
            @endforeach
          </ul>
          <div class="hd_btn"><a class="czbtn" href="{{$Setting->bak_title_16?:'javascript:;'}}" data-text="{{$Setting->bak_title_15}}">{{$Setting->bak_title_15}}</a><a class="czbtn" href="{{$tabArr[1]}}" data-text="{{$Setting->bak_title_17}}">{{$Setting->bak_title_17}}</a></div>
        </div>
      </section>
      <section class="service_ct">
        <div class="common_wrap">
          <div class="ct_title waypoint">
            <div class="title_head">{{$Setting->bak_title_18}}</div>
            <p>{{$Setting->bak_title_19}}</p>
          </div>
          <div class="ct_pic waypoint" word-loc="right_bottom">
            <picture>
              <source media="(max-width: 767px)" srcset="{{basefunction::RealFiles($Setting->banner_rwd2)}}"/><img src="{{basefunction::RealFiles($Setting->banner2)}}" alt=""/>
            </picture>
            <div class="ct_word">
              <div class="word_title">{!!nl2br($Setting->bak_intro_1)!!}</div>
            </div>
          </div>
          <div class="feature_ul">
            @foreach ($item as $key => $value)
            <div class="feature_li waypoint">
              <div class="feature_icon">
                <div class="bg"></div><span>{{$value->title}}</span>
                <p>{{$value->title2}}</p>
              </div>
              <div class="feature_word">
                <div class="feature_title">{{$value->title3}}</div>
                <p>{!!nl2br($value->intro)!!}</p>
              </div>
            </div>
            @endforeach
          </div>
          <div class="ad_pic waypoint">
            <picture>
              <source media="(max-width: 767px)" srcset="{{basefunction::RealFiles($Setting->banner_rwd3)}}"/>
              <source media="(max-width: 1200px)" srcset="{{basefunction::RealFiles($Setting->banner_pad3)}}"/><img src="{{basefunction::RealFiles($Setting->banner3)}}" alt=""/>
            </picture>
            <div class="ad_word">
              <div class="word_subtitle">{!!nl2br($Setting->bak_intro_2)!!}</div>
              <div class="word_btn"><a class="czbtn" href="{{$Setting->bak_title_16?:'javascript:;'}}" data-text="{{$Setting->bak_title_15}}">{{$Setting->bak_title_15}}</a><a class="czbtn" href="{{$tabArr[1]}}" data-text="{{$Setting->bak_title_17}}">{{$Setting->bak_title_17}}</a></div>
            </div>
          </div>
        </div>
      </section>
    </main>
    <style type="text/css">
      @media only screen and (max-width: 1200px){
        .service_bg{
          background-image: url('{{basefunction::RealFiles($Setting->banner_pad)}}') !important
        }
      }
      @media only screen and (max-width: 767px){
        .service_bg{
          background-image: url('{{basefunction::RealFiles($Setting->banner_rwd)}}') !important
        }
      }
      
    </style>
    @include('Front.layout.footer')
    @section('script')
    <script src="/assets/js/plus/service.js?v={{BaseFunction::getV()}}"></script>  
    @stop
    @stop