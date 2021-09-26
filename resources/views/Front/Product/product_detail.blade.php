@extends('template')
@section('css')
    {{-- <!--獨立CSS--> --}}
		<link rel="stylesheet" href="{{asset('dist/assets/css/product.css?v='.BaseFunction::getV())}}"/>
@stop

@section('bodyClass', 'product')
@section('bodyDataPage', 'product_detail')
@section('content')
  @include('Front.layout.navbar')
    @include('Front.layout.menu')
    <!-- 主要內容-->
    <main>
      <div class="fixed_btn">
        <div class="common_wrap">
          <ul>
            <li class="active"><a href="javascript:;" data-anchor-target=".productdt_ct" data-anchor-margintop="20" data-anchor-easing="swing" data-anchor="data-anchor">{{$Setting->bak_title_12}}</a></li>
            <li><a href="javascript:;" data-anchor-target=".productdt_spec" data-anchor-margintop="20" data-anchor-easing="swing" data-anchor="data-anchor">{{$Setting->bak_title_13}}</a></li>
            <li><a href="javascript:;" data-anchor-target=".productdt_relate" data-anchor-margintop="20" data-anchor-easing="swing" data-anchor="data-anchor">{{$Setting->bak_title_14}}</a></li>
          </ul>
          <div class="btn_box"><a class="btn" href="javascript:;">
              <p>{{$Setting->bak_title_15}}</p><span class="icon-cart"></span></a><a productDetailShare class="btn" href="javascript:;">
              <p>{{$Setting->bak_title_16}}</p><span class="icon-share"></span></a></div>
        </div>
      </div>
      <section class="productdt_bn">
        <div class="swiper-container swiper4" data-swiper-direction="horizontal"
        data-swiper-id=""
        data-swiper-num="1"
        data-swiper-arrow="off"
        data-swiper-effect="fade"
        data-swiper-breakpoints="{320: {autoplay: {delay: 5000,}, speed: 1000},1200: {autoplay: {delay: 5000,}, speed: 1000,direction: 'vertical'}}"
        data-swiper-autoplay="on">
          <div class="swiper-wrapper">
            {{-- <!-- banner 圖片尺寸 PC 1920*1080(px) / RWD  600*720(px)--> --}}
            @foreach ($Banner_list as $key => $value)
            <div class="swiper-slide">
              <div class="hero-banner">
                <picture>
                  <source media="(max-width: 767px)" srcset="{{array_search($value->banner_rwd,$imageAry)}}"/><img src="{{array_search($value->banner,$imageAry)}}" alt="banner"/>
                </picture>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </section>
      <section class="productdt_name waypoint">
        <div class="common_wrap">
          <div class="left">
            <h1 class="pd_name">{{$nowItem->banner_title}}</h1>
            <div class="pd_p">{!!nl2br($nowItem->banner_sub_title)!!}</div>
          </div>
          <div class="right">
            <div class="pd_price">{{$nowItem->price}}</div>
            <div class="pd_p">{{$nowItem->price_script}}</div>
            <div class="pd_color">
              <div class="dropdown_in">
                <div class="dropdown_click">
                  <div class="dropdown_title">{{$Setting->bak_title_17}}</div>
                  <div class="icon-arrow_right"></div>
                </div>
                <div class="dropdown_select">
                  <div class="dropdown_opt scroll scrollbar-inner theme-black">
                    <ul>
                      @foreach ($Color_list as $key => $value)
                      <li data-bgcolor="{{$value->color}}" word-color="{{config('options.datacolor')[array_key_exists($value->txt_BH,config('options.datacolor'))?$value->txt_BH:'1']['data_color']}}">{{$value->title}}</li>
                      @endforeach
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="pd_btn"><a class="czbtn_jq" href="javascript:;" data-text="Buy now">
                <p>{{$Setting->bak_title_15}}</p><span class="icon-cart"></span></a><a productDetailShare class="czbtn_jq" href="javascript:;" data-text="share to">
                <p>{{$Setting->bak_title_16}}</p><span class="icon-share"></span></a></div>
          </div>
        </div>
      </section>
      <section class="productdt_ct">
        <div class="ct_title waypoint">
          <h2 class="title_head">{{$Setting->bak_title_18}}</h2>
          <p>{{$Setting->bak_title_19}}</p>
        </div>
        <div class="common_wrap">
          {{-- <!-- 文字排版方式有6種-->
          <!-- 左上left_top、左中left_center、左下left_bottom-->
          <!-- 右上right_top、右中right_center、右下right_bottom-->
          <!-- 圖片大小 PC RWD-600*1050--> --}}
          @foreach ($Img_list as $key => $value)
          <div class="ct_pic waypoint" word-loc="{{config('options.txtlocale')[array_key_exists($value->txt_locale,config('options.txtlocale'))?$value->txt_locale:'1']['word_loc']}}">
            <picture>
              <source media="(max-width: 767px)" srcset="{{array_search($value->img_rwd,$imageAry)}}"/><img src="{{array_search($value->img,$imageAry)}}" alt=""/>
            </picture>
            <div class="ct_word">
              <div class="word_title">{!!nl2br($value->intro)!!}</div>
              <div class="word_p">{!!nl2br($value->intro2)!!}</div>
            </div>
          </div>
          @endforeach
          <section class="_articleBlock">
            @include('article_v2',['three'=>'img','data'=>$content])
          </section>
        </div>
      </section>
      <section class="productdt_spec">
        <div class="ct_title waypoint">
          <h2 class="title_head">{{$Setting->bak_title_20}}</h2>
          <p>{{$Setting->bak_title_21}}</p>
        </div>
        <div class="spec_block waypoint">
          @foreach ($spec as $key => $value)
          <div class="spec_list">
            <div class="spec_title">
              <p>{{$value->title}}</p>
            </div>
            <div class="spec_p">{{$value->content}}</div>
          </div>
          @endforeach
        </div>
      </section>
      {{-- @if ($relateItem->count()>0) --}}
      <section {{!($relateItem->count()>0)?'style=display:none;':''}} class="productdt_relate waypoint">
        <div class="ct_title waypoint">
          <h2 class="title_head">{{$Setting->bak_title_22}}</h2>
          <p>{{$Setting->bak_title_23}}</p>
        </div>
        <div class="common_wrap">
          <div class="swiper-container swiper4" data-swiper-id="" data-swiper-numgroup="1" data-swiper-num="1" data-swiper-arrow="off" data-swiper-autoplay="off" data-swiper-loop="on" data-swiper-breakpoints="{320: { slidesPerGroup: 1, slidesPerView: 1, spaceBetween: 5 },768: { slidesPerGroup: 2, slidesPerView: 2, spaceBetween: 10 },993: { slidesPerGroup: 3, slidesPerView: 3, spaceBetween: 10 },1367: { slidesPerGroup: 4, slidesPerView: 4, spaceBetween: 10 }}">
            <div class="swiper-wrapper">
              @foreach ($relateItem as $key => $value) 
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
        </div>
      </section>
      {{-- @endif --}}
    </main>
    <!-- 頁尾-->
    @include('Front.layout.footer')
    @section('script')
    <script src="/assets/js/plus/product.js?v={{BaseFunction::getV()}}"></script>  
    @stop
    @stop