@extends('template')
@section('css')
    {{-- <!--獨立CSS--> --}}
		<link rel="stylesheet" href="{{asset('dist/assets/css/news.css?v='.BaseFunction::getV())}}"/>
@stop

@section('bodyClass', 'news')
@section('bodyDataPage', 'news_detail')
@section('content')
  @include('Front.layout.navbar')
  @include('Front.layout.menu')
    <!-- 主要內容-->
    <main>
      <div class="newsdt_hd">
        <div class="news_date waypoint"><span>{{date("Y-m-d",strtotime($news->news_date))}}</span>
          <p>{{$nowCategory->title}}</p>
        </div>
        <h1 class="news_title waypoint">{{$news->inner_title}}</h1>
        <div class="share">
          <p>{{$Setting->bak_title_2}}</p>
          <div class="share_icon"><a class="icon-share shareWebBtn" href="javascript:;"></a><a class="icon-fb shareWebBtn Facebook" href="javascript:;"></a><a class="icon-line shareWebBtn Line" href="javascript:;"></a><a class="icon-ig shareWebBtn Instagram " href="javascript:;"></a><a class="icon-twitter shareWebBtn Twitter" href="javascript:;"></a></div>
        </div>
      </div>
      <section class="newsdt_ct">
        <section class="_articleBlock">
          @include('article_v2',['three'=>'img','data'=>$news->content])
        </section>
      </section>
      @if ($relateProduct->count())
      <section class="newsdt_relate waypoint">
        <div class="ct_title waypoint">
          <div class="title_head">{{$Setting->bak_title_3}}</div>
          <p>{{$Setting->bak_title_4}}</p>
        </div>
        <div class="swiper-container swiper4 relate_main" data-swiper-id="" data-swiper-numgroup="1" data-swiper-num="1" data-swiper-arrow="off" data-swiper-autoplay="off" data-swiper-loop="on" data-swiper-breakpoints="{320: { slidesPerGroup: 1, slidesPerView: 1, spaceBetween: 5 },768: { slidesPerGroup: 2, slidesPerView: 2, spaceBetween: 10 },993: { slidesPerGroup: 3, slidesPerView: 3, spaceBetween: 10 },1367: { slidesPerGroup: 4, slidesPerView: 4, spaceBetween: 10 }}">
          <div class="swiper-wrapper">
            @foreach ($relateProduct as $key => $value)
            <div class="swiper-slide"><a class="item" href="{{basefunction::b_url('Product/'.basefunction::processTitleToUrl($value->cate_url_title).'/'.basefunction::processTitleToUrl($value->sub_cate_url_title).'/'.basefunction::processTitleToUrl($value->url_title))}}">
                <div class="item_pic"><img src="{{array_search($value->img,$imageAry)}}" alt="{{$value->title}}"/></div>
                <div class="item_sort">{{$value->cate_index_sub_title}}</div>
                <div class="item_title">{{$value->title}}</div>
                <div class="item_btn">
                  <div class="czbtn" data-text="view">view</div>
                </div></a></div>
            @endforeach
          </div>
        </div>
      </section>
      @endif
      <section class="newsdt_more">
        <div class="swiper-container swiper4" data-swiper-id="news_sw" data-swiper-num="1" data-swiper-arrow="on" data-swiper-arrow-name=".news_sw" data-swiper-nav="off" data-swiper-autoplay="off" data-swiper-loop="on">
          <div class="swiper-wrapper">
            @foreach ($nextAndPrev as $key => $value)
            <div class="swiper-slide"><a class="news_li waypoint" href="{{BaseFunction::b_url('News/'.$allCategory->where('id',$value->cate_id)->first()->url_title.'/'.$value->url_title)}}">
                <div class="news_pic">
                  <div class="news_picfx"><img src="{{array_search($value->img,$imageAry)}}" alt="{{$value->title}}"/></div>
                </div>
                <div class="news_word">
                  <div class="news_word_wrap">
                    <div class="news_date"><span>{{date("Y-m-d",strtotime($value->news_date))}}</span>
                      <p>{{$allCategory->where('id',$value->cate_id)->first()->title}}</p>
                    </div>
                    <div class="news_title">{{$value->index_title}}</div>
                    <div class="p">{{$value->index_sub_title}}</div>
                    <div class="czbtn" data-text="read more">read more</div>
                  </div>
                </div></a></div>
            @endforeach
          </div>
        </div>
        <div class="news_sw-Next news_sw icon-arrow_right"></div>
        <div class="news_sw-Prev news_sw icon-arrow_left"></div>
      </section>
    </main>
    @include('Front.layout.footer')
    @section('script')
    <script src="/assets/js/plus/news.js?v={{BaseFunction::getV()}}"></script>  
    @stop
    @stop