@foreach ($itemList as $key => $value)
<div cateitem class="pd_item waypoint"><a class="item" href="{{basefunction::b_url('Product/'.basefunction::processTitleToUrl($value->cate_url_title).'/'.basefunction::processTitleToUrl($value->sub_cate_url_title).'/'.basefunction::processTitleToUrl($value->url_title))}}">
    <div class="item_pic"><img src="{{array_search($value->img,$imageAry)}}" alt="{{$value->title}}"/></div>
    <div class="item_sort">{{$value->cate_index_sub_title}}</div>
    <h2 class="item_title">{{$value->title}}</h2>
    <div class="item_btn">
        <div class="czbtn" data-text="view">view</div>
    </div></a></div>
@endforeach