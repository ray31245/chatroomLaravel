@extends('template')
@section('css')
    {{-- <!--獨立CSS--> --}}
		<link rel="stylesheet" href="{{asset('dist/assets/css/product.css?v='.BaseFunction::getV())}}"/>
@stop

@section('bodyClass', 'product')
@section('bodyDataPage', 'product_search_list')
@section('content')
  @include('Front.layout.navbar')
    @include('Front.layout.menu')
    {{-- <!-- 主要內容--> --}}
    <main>
      <section class="productsearch_hd">
        <div class="bn_title waypoint">
          <h1 class="title_head">{{$Setting->bak_title_24}}</h1>
          <p>{{$Setting->bak_title_25}}</p>
        </div>
        <div class="pdlist_model">
          <div class="top">
            <div class="dropdown">
              <div class="dropdown_click">
                <div class="dropdown_title">{{$Setting->bak_title_26}}</div>
                <div class="icon-arrow_right"></div>
              </div>
              <div class="dropdown_select">
                <div class="dropdown_opt scroll scrollbar-inner theme-black">
                  <ul>
                    @foreach ($all_product_cate as $key => $value)
                    <li searCate={{$value->id}} onclick="searchPageSelectcate(this)">{!!nl2br($value->title)!!}</li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
            <div class="dropdown">
              <div class="dropdown_click">
                <div class="dropdown_title">{{$Setting->bak_title_27}}</div>
                <div class="icon-arrow_right"></div>
              </div>
              <div class="dropdown_select">
                <div class="dropdown_opt scroll scrollbar-inner theme-black">
                  <ul searchSubCateList>
                    @if ($all_product_cate->count())
                      @foreach ($all_product_subCate->where('parent_id',$all_product_cate[0]->id) as $key => $value)
                        <li searchSubCate={{basefunction::processTitleToUrl($value->url_title)}} searchSubCateId={{$value->id}} onclick="searchPageSelectSubCate(this)" searchSubCateTitle>{{$value->title}}</li>
                      @endforeach
                    @endif
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="bottom"><a class="btn_model btn_filter" href="javascript:;"><span class="icon-search"></span>
              <p>{{$Setting->bak_title_28}}</p></a></div>
        </div>
      </section>
      <section class="productsearch_ct">
        <div class="common_wrap container">
          <div class="pd_list" catelist now_model="{{$now_model}}">
            @include('Front.Product.ajax.item_list')
          </div>
          @include('Front.Product.ajax.paginationBar',['total_page'=>$itemList->lastPage(),'nowcate'=>$nowSub_category?basefunction::processTitleToUrl($nowSub_category->url_title):'','pagetype'=>'item'])
        </div>
      </section>
    </main>
    {{-- <!-- 頁尾--> --}}
    @include('Front.layout.footer')
    @section('script')
    <script src="/assets/js/plus/product.js?v={{BaseFunction::getV()}}"></script>  
    @stop
    @stop