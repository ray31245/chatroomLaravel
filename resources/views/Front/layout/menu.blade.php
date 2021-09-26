<section class="bottom_btn">
  <ul class="control">
    <!-- 購物車請先隱藏-->
    {{-- <li><a href="javascript:void(0)"><span class="icon-cart"></span></a></li> --}}
    <li><a href="{{basefunction::b_url('Member')}}"><span class="icon-member"></span></a></li>
    <li><a class="repair" href="{{basefunction::b_url('Service')}}">{{$viewids['Nav']->bak_title_1}}</a></li>
  </ul>
</section>
<section class="menu">
  <div class="menu-scroll">
    <div class="square-close"><span></span><span></span></div>
    <div class="menu-wrap">
      <div class="container">
        <div class="list">
          <ul>
            @foreach ($menu as $key => $value)
            <li><a href="{{$value->title3?:'javascript:void(0)'}}"><span></span>
                <p data-text="{{$value->title2}}">{{$value->title}}</p></a></li>
            @if ($loop->index==3)
            </ul>
            <ul>      
            @endif
            @endforeach
          </ul>
        </div>
        <div class="menu-swiper">
          <div class="swiper-container swiper4" data-swiper-id="menu-swiper-container" data-swiper-num="1" data-swiper-arrow="off" data-swiper-autoplay="off" data-swiper-nav="on" data-swiper-nav-name=".menu-swiper-pagination">
            <div class="swiper-wrapper">
              @foreach ($menuBanner as $key => $value)
              <!-- data-color 字體顏色黑白兩色 white black-->
              <div class="swiper-slide">
                <div class="menu-adblock">
                  <div class="photo"><img src="{{array_search($value->img,$front_imageAry)}}" alt=""/></div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
          <div class="menu-swiper-pagination menu-swiper-container">
            <div class="menu-swiper-pagination-bullet"></div>
          </div>
        </div>
      </div>
      <div class="infobar">
        <ul>
          <!-- 購物車請先隱藏-->
          {{-- <li><a class="icon-cart" href="javascript:void(0)"></a><a href="javascript:void(0)">Cart</a></li> --}}
          <li><a class="icon-member" href="{{basefunction::b_url('Member')}}"></a>@if ($membersessiondata)<a href="javascript:void(0)">{{$viewids['Menu']->bak_title_1}}{{$membersessiondata['name']}}</a>@else<a class="logout" href="javascript:void(0)" global_login>{{$viewids['Menu']->bak_title_2}}</a>@endif</li>
          <li>@if ($membersessiondata)<a class="logout" href="javascript:void(0)" logoutact>{{$viewids['Menu']->bak_title_3}}</a>@endif</li>
        </ul>
      </div>
    </div>
  </div>
</section>
<section class="pdfilter_lb">
  <div class="lb_wrap"><a class="lb_close btn_close" href="javascript:;">CLOSE</a>
    <div class="ct_title waypoint">
      <div class="title_head">{{$viewids['Search']->bak_title_1}}</div>
      <p>{{$viewids['Search']->bak_title_2}}</p>
    </div>
    <div class="lb_select scroll scrollbar-inner theme-black">
      <div class="type_select one_select circle">
        <div class="type_list">
          <div class="type_title">{{$viewids['Search']->bak_title_3}}</div><span></span>
        </div>
        <ul class="type_item">
          @foreach ($all_product_cate as $key => $value)
          <li allCate={{$value->id}}>
            <div class="type_li">
              <div class="type_pic"><img src="{{array_search($value->img_search,$allImageAry)}}" alt="{{$value->index_sub_title}}"/></div>
              <div class="type_name">{{$value->index_sub_title}}</div>
            </div>
          </li>
          @endforeach
        </ul>
        <div class="type_icon"><span></span></div>
      </div>
      <div class="type_select one_select">
        <div class="type_list">
          <div class="type_title">{{$viewids['Search']->bak_title_4}}</div><span></span>
        </div>
        <ul allSubCateList class="type_item">
          @if ($all_product_cate->count())
            @foreach ($all_product_subCate->where('parent_id',$all_product_cate[0]->id) as $key => $value)
            <li allSubCate={{$value->id}}>
              <div class="type_li">
                <div class="type_pic"><img src="{{array_search($value->img_search,$allImageAry)}}" alt="{{$value->title}}"/></div>
                <div class="type_name" subCatetitle>{{$value->title}}</div>
              </div>
            </li>
            @endforeach
          @endif
        </ul>
        <div class="type_icon"><span></span></div>
      </div>
      <div class="type_select one_select brand">
        <div class="type_list">
          <div class="type_title">{{$viewids['Search']->bak_title_5}}</div><span></span>
        </div>
        <ul class="type_item">
          @foreach ($all_product_barnd as $key => $value)
          <li allBrand={{$value->id}}>
            <div class="type_li">
              <div class="type_pic"><img src="{{array_search($value->img,$allImageAry)}}" alt=""/></div>
              <div class="type_name">{{$value->title}}</div>
            </div>
          </li>
          @endforeach
        </ul>
        <div class="type_icon"><span></span></div>
      </div>
      <div class="type_select more_select">
        <div class="type_list">
          <div class="type_title">{{$viewids['Search']->bak_title_6}}</div>
          <div class="select_num">
            <p class="num">0</p>
            <p>selected</p>
          </div><span></span>
        </div>
        <ul class="type_item" allModelList>
          @foreach ($all_product_model->where('parent_id',$all_product_barnd[0]->id) as $key => $value)
          <li allModel_id={{$value->id}}>
            <div class="type_li">
              <div class="type_pic"><img src="{{array_search($value->img,$allImageAry)}}" alt="{{$value->title}}"/></div>
              <div class="type_name" allModelTitle>{{$value->title}}</div>
            </div>
          </li>
          @endforeach
        </ul>
        <div class="type_icon"><span></span></div>
      </div>
    </div>
    <div class="lb_btn"><a class="czbtn reset" href="javascript:;" data-text="{{$viewids['Search']->bak_title_7}}">{{$viewids['Search']->bak_title_7}}</a><a class="czbtn" href="javascript:;" onclick="allSearchPostForm(this)" cantsearch="請至少選擇一樣次分類或是機型" data-text="{{$viewids['Search']->bak_title_9}}">{{$viewids['Search']->bak_title_9}}</a></div>
    <div class="lb_btn_rwd"><a class="btn reset" href="javascript:;">{{$viewids['Search']->bak_title_8}}</a><a class="btn" href="javascript:;" onclick="allSearchPostForm(this)">{{$viewids['Search']->bak_title_10}}</a></div>
  </div>
</section>
<section class="lightbox_trans step">
  <div class="lightbox_wrap">
    <div class="svg">
      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="100px" height="100px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
        <g>
          <path class="a" fill="none" stroke="#fff" stroke-width="8" stroke-miterlimit="10" d="M53.834,31.333h37.833v57.833H53.834 M45.5,31.333 H26.833V50.5H45.5"></path>
          <path class="a" fill="none" stroke="#fff" stroke-width="8" stroke-miterlimit="10" d="M45.5,69.667H8V11.333h37.5 M53.834,69.667h18.999 V50.5H53.834"></path>
        </g>
        <g>
          <path fill="none" stroke="#fff" stroke-width="1" stroke-miterlimit="10" d="M45.5,73.667H3.833V7.833H45.5v8H11.833v49.834H45.5V73.667z M45.5,54.5H22.667V27.333   H45.5v8H30.667V46.5H45.5V54.5z M95.5,93.168H53.834v-8H87.5V35.333H53.834v-8H95.5V93.168z M76.667,73.668H53.834v-8h14.833 V54.502H53.834v-8h22.833V73.668z"></path>
        </g>
      </svg>
    </div>
  </div>
</section>
<script backgroundDeleted>
  allSubCateArr = {!!$all_product_subCate_cookie!!};
  allModelArr = {!!$all_product_model_cookie!!};
</script>