@extends('template')
@section('css')
    {{-- <!--獨立CSS--> --}}
		<link rel="stylesheet" href="{{asset('dist/assets/css/product.css?v='.BaseFunction::getV())}}"/>
@stop

@section('bodyClass', 'product')
@section('bodyDataPage', 'product_series')
@section('content')
  @include('Front.layout.navbar')
    @include('Front.layout.menu')
    <!-- 主要內容-->
    <main>
      <section class="productseries_hd">
        <!-- 電腦 1920*750 // 平板 1200*700 // 手機 600*825 // 換圖結構在下面-->
        <div class="productseries_bg" style="background-image: url({{basefunction::RealFiles($nowcategory->banner)}})"></div>
        <div class="bn_title waypoint">
          <h1 class="title_head">{{$nowcategory->banner_title}}</h1>
          <p>{{$nowcategory->banner_sub_title}}</p>
        </div>
      </section>
      <section class="productseries_ct">
        <div class="common_wrap container">
          <div class="ct_title waypoint">
            <div class="title_head">{{$Setting->bak_title_1}}</div>
            <p>{{$Setting->bak_title_2}}</p>
          </div>
          <div catelist class="pd_list">
            @include('Front.Product.ajax.series_list')
          </div>
          @include('Front.Product.ajax.paginationBar',['total_page'=>$sub_category->lastPage(),'nowcate'=>basefunction::processTitleToUrl($nowcategory->url_title),'pagetype'=>'sub_cate'])
        </div>
      </section>
    </main>
    <style type="text/css">
      @media only screen and (max-width: 1200px){
        .productseries_bg{
          background-image: url('{{basefunction::RealFiles($nowcategory->banner_pad)}}') !important
        }
      }
      @media only screen and (max-width: 767px){
        .productseries_bg{
          background-image: url('{{basefunction::RealFiles($nowcategory->banner_rwd)}}') !important
        }
      }
      
      
      
    </style>
    @include('Front.layout.footer')
    @section('script')
    <script src="/assets/js/plus/product.js?v={{BaseFunction::getV()}}"></script>  
    @stop
    @stop