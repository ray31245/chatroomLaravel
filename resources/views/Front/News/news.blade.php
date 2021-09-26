@extends('template')
@section('css')
    {{-- <!--獨立CSS--> --}}
		<link rel="stylesheet" href="{{asset('dist/assets/css/news.css?v='.BaseFunction::getV())}}"/>
@stop

@section('bodyClass', 'news')
@section('bodyDataPage', 'news')
@section('content')
  @include('Front.layout.navbar')
    @include('Front.layout.menu')
    <!-- 主要內容-->
    <main>
      <section class="news_bn">
        {{-- <!-- 電腦 1920*450 // 平板 1200*400 // 手機 600*600 // 換圖結構在下面--> --}}
        <div class="news_bg" style="background-image: url({{basefunction::RealFiles($Setting->banner)}})"></div>
        <div class="bn_title waypoint">
          <h1 class="title_head">{{$Setting->banner_title}}</h1>
          <p>{{$Setting->banner_sub_title}}</p>
        </div>
      </section>
      <section class="news_ct">
        <div class="common_wrap">
          <div class="news_sort">
            <div class="news_sort_ul">
              <a catechange="0" class="news_sort_li {{in_array($category_url,['','ALL','all',isset($category_url->url_title)?$category_url->url_title:''])?'active':''}}" href="javascript:;">ALL</a>
              @foreach ($allCategory->where('is_all','1') as $key => $value)
              @endforeach
              @foreach ($allCategory->where('is_all','!=','1') as $key => $value)
                <a catechange="{{$value->id}}" class="news_sort_li {{in_array($category_url,[isset($value->url_title)?$value->url_title:true])?'active':''}}" href="javascript:;">{{$value->title}}</a>
              @endforeach
            </div>
            <div class="dropdown">
              <div class="dropdown_click">
                <div class="dropdown_title">{{$Setting->bak_title_1}}</div>
                <div class="icon-arrow_right"></div>
              </div>
              <div class="dropdown_select">
                <div class="dropdown_opt scroll scrollbar-inner theme-yellow">
                  <ul>
                    @foreach ($allCategory->where('is_all','1') as $key => $value)
                      <li catechange="0">{{$value->title}}</li>
                    @endforeach
                    @foreach ($allCategory->where('is_all','!=','1') as $key => $value)
                      <li catechange="{{$value->id}}">{{$value->title}}</li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="news_main container">
            <div class="ct_title waypoint">
              <div class="title_head">{{$Setting->view_title}}</div>
              <p>{{$Setting->view_title_sub}}</p>
            </div>
            <div newslist class="news_ul">
              @include('Front.News.ajax.list')
            </div>
            @include('Front.News.ajax.paginationBar')
          </div>
        </div>
      </section>
    </main>
    <style type="text/css">
      @media only screen and (max-width: 1200px){
        .news_bg{
          background-image: url('{{basefunction::RealFiles($Setting->banner_pad)}}') !important
        }
      }
      @media only screen and (max-width: 767px){
        .news_bg{
          background-image: url('{{basefunction::RealFiles($Setting->banner_rwd)}}') !important
        }
      }
      
    </style>
    @include('Front.layout.footer')
    @section('script')
    <script src="/assets/js/plus/news.js?v={{BaseFunction::getV()}}"></script>  
    @stop
    @stop