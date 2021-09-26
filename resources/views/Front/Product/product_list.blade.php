@extends('template')
@section('css')
    {{-- <!--獨立CSS--> --}}
		<link rel="stylesheet" href="{{asset('dist/assets/css/product.css?v='.BaseFunction::getV())}}"/>
@stop

@section('bodyClass', 'product')
@section('bodyDataPage', 'product_list')
@section('content')
  @include('Front.layout.navbar')
    @include('Front.layout.menu')
    <!-- 主要內容-->
    <main>
      <section class="productlist_hd">
        <!-- 電腦 1920*750 // 平板 1200*700 // 手機 600*825 // 換圖結構在下面-->
        <div class="productlist_bg" style="background-image: url('{{basefunction::RealFiles($nowSub_category->banner)}}')"></div>
        <div class="bn_title waypoint">
          <h1 class="title_head">{{$nowSub_category->banner_title}}</h1>
          <p>{{$nowSub_category->banner_sub_title}}</p>
        </div>
      </section>
      <section class="productlist_ct">
        <div class="common_wrap container">
          <div class="ct_title waypoint">
            <div class="title_head">{{$Setting->bak_title_3}}</div>
            <p>{{$Setting->bak_title_4}}</p>
          </div>
          <div class="pdlist_model"><a class="btn_model" href="javascript:;"><span class="icon-search"></span>
              <p>{{$Setting->bak_title_5}}</p></a></div>
          <div catelist class="pd_list">
            @include('Front.Product.ajax.item_list')
          </div>
          @include('Front.Product.ajax.paginationBar',['total_page'=>$itemList->lastPage(),'nowcate'=>basefunction::processTitleToUrl($nowSub_category->url_title),'pagetype'=>'item'])
        </div>
      </section>
      <div class="lb_model">
        <div class="lb_wrap"><a class="lb_close btn_close" href="javascript:;">CLOSE</a>
          <div class="ct_title waypoint">
            <div class="title_head">{{$Setting->bak_title_6}}</div>
            <p>{{$Setting->bak_title_7}}</p>
          </div>
          <div class="lb_main scroll scrollbar-inner theme-black">
            <!-- 品牌圖片 130*130-->
            <div class="type_select one_select brand">
              <ul class="type_item">
                @foreach ($barnd as $key => $value)
                <li brand={{$value->id}} {{$loop->index==0?'class=select':''}}>
                  <div class="type_li">
                    <div class="type_pic"><img src="{{array_search($value->img,$imageAry)}}" alt=""/><img src="{{array_search($value->img2,$imageAry)}}" alt="{{$value->title}}"/></div>
                  </div>
                </li>
                @endforeach
              </ul>
            </div>
            <div class="type_select more_select">
              <ul modelslist class="type_item">
                @foreach ($model->where('parent_id',$barnd[0]->id) as $key => $value)
                <li model_id={{$value->id}} {{$loop->index==0?'modelfirst':''}}>
                  <div class="type_li">
                    <div class="type_pic"><img src="{{array_search($value->img2,$imageAry)}}" alt="{{$value->title}}"/></div>
                    <div class="type_name" modeltitle>{{$value->title}}</div>
                  </div>
                </li>
                @endforeach
              </ul>
            </div>
          </div>
          <div class="lb_btn"><a search_reset class="czbtn reset" href="javascript:;" data-text="{{$Setting->bak_title_10}}">{{$Setting->bak_title_10}}</a><a search_submit emptymodel="尚未選擇機型" class="czbtn" href="javascript:;" data-text="{{$Setting->bak_title_8}}">{{$Setting->bak_title_8}}</a></div>
          <div class="lb_btn_rwd"><a search_reset class="btn reset" href="javascript:;">{{$Setting->bak_title_11}}</a><a class="btn" search_submit href="javascript:;">{{$Setting->bak_title_9}}</a></div>
        </div>
      </div>
    </main>
    <style type="text/css">
      @media only screen and (max-width: 1200px){
        .productlist_bg{
          background-image: url('{{basefunction::RealFiles($nowSub_category->banner_pad)}}') !important
        }
      }
      @media only screen and (max-width: 767px){
        .productlist_bg{
          background-image: url('{{basefunction::RealFiles($nowSub_category->banner_rwd)}}') !important
        }
      }
      
    </style>
    @include('Front.layout.footer')
    @section('script')
    <script src="/assets/js/plus/product.js?v={{BaseFunction::getV()}}"></script>  
    @stop
    @stop