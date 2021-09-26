<!-- 導覽列-->
<nav class="navbar show">
  <div class="container">
    <div class="logo"><a href="{{basefunction::b_url('/')}}">CHANGE i</a></div>
    <ul class="list">
      @foreach ($nav as $key => $value)
      @if ($value->title)
      <li class="{{preg_match("/product/i",$value->title2)?'fast':''}}"><a href="{{$value->title2?:'javascript:void(0)'}}">{{$value->title}}</a></li>
      @endif
      @endforeach
    </ul>
    <div class="right"><a class="btn_filter" href="javascript:void(0)"><span class="icon-search"></span></a>
      <ul class="control">
        <!-- 購物車請先隱藏-->
        {{-- <li><a href="javascript:void(0)"><span class="icon-cart"></span></a></li> --}}
        <li><a href="{{basefunction::b_url('Member/Center')}}"><span class="icon-member"></span></a></li>
        <li><a class="repair" href="{{basefunction::b_url('Service')}}">{{$viewids['Nav']->bak_title_1}}</a></li>
      </ul>
      <div class="hamburger"><span></span><span></span><span></span></div>
    </div>
  </div>
  <div class="fastest">
    <div class="wrap">
      <div class="wrap-title">
        <p class="title">{{$viewids['NavExtend']->bak_title_1}}</p>
        <p class="text">{{$viewids['NavExtend']->bak_title_2}}</p><a class="czbtn" href="{{basefunction::b_url('Product')}}" data-text="{{$viewids['NavExtend']->bak_title_3}}">{{$viewids['NavExtend']->bak_title_3}}</a>
      </div>
      <div class="wrap-content">
        <div class="scroll scrollbar-inner theme-yellow">
          @foreach ($navExtend as $key => $value)
          <div class="block"><a class="block-wrap" href="{{basefunction::b_url('Product/'.basefunction::processTitleToUrl($value->product->url_title))}}">
              <!-- 圖片尺寸 120*120(px), png-->
              <div class="photo"><img src="{{array_search($value->img,$front_imageAry)}}" alt="{{$value->product->title}}"/></div>
              <p>{{$value->product->title}}</p></a></div>
          @endforeach
        </div>
      </div>
      <div class="wrap-ad">
        <div class="fastest-swiper swiper-container swiper4" data-swiper-id="" data-swiper-num="1" data-swiper-arrow="off" data-swiper-nav="off" data-swiper-autoplay="on" data-swiper-breakpoints="{320: {autoplay: {delay: 5000,}, speed: 1000}}">
          <!-- 圖片尺寸 475*665(px)-->
          <div class="swiper-wrapper">
            @foreach ($navExtendBanner as $key => $value)
            <div class="swiper-slide">
              <div class="photo"><img src="{{array_search($value->img,$front_imageAry)}}" alt="{{$value->title}}"/></div><a class="info" href="{{$value->title2?:'javascript:void(0)'}}">
                <p>{{$value->title}}</p><span class="icon-right"></span></a>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div><svg xmlns="http://www.w3.org/2000/svg" width="0px" height="0px">
<clipPath id="btn" clipPathUnits="objectBoundingBox">
<path transform="scale(0.0071428, 0.02)" d="M22.102,50.008L22.102,50.008c-0.229,0-5.591-0.035-11.02-3.115C6.049,44.036,0.049,37.938,0.049,25.109	c0-24.792,21.832-25.078,22.052-25.078l95.656,0.016c0.001,0,0.001,0,0.002,0c0.249,0,5.648,0.039,11.115,3.132	c5.079,2.874,11.133,9.011,11.133,21.931c0,24.607-22.027,24.891-22.25,24.891L22.102,50.008L22.102,50.008z M22.102,2.031 C21.284,2.033,2.049,2.34,2.049,25.109c0,22.592,19.234,22.897,20.053,22.899L117.758,48c0.826-0.002,20.25-0.304,20.25-22.891 c0-22.764-19.424-23.061-20.251-23.063L22.102,2.031z"/>
</clipPath>
</svg>
</nav>