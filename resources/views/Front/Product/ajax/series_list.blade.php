{{-- {{var_dump($sub_category)}}
@php

@endphp --}}
@foreach ($sub_category as $key => $value)
<div cateitem class="pd_item waypoint" data-size="{{config('options.imgtype2')[array_key_exists($value->img_type,config('options.imgtype2'))?$value->img_type:'1']['data_size']}}"><a class="item" href="{{basefunction::b_url('Product/'.basefunction::processTitleToUrl($value->cate_url_title).'/'.basefunction::processTitleToUrl($value->url_title))}}">
    <div class="item_pic"><img src="{{array_search($value->img,$imageAry)}}" alt=""/></div>
    <div class="item_sort">{{$value->cate_index_sub_title}}</div>
    <h2 class="item_title">{{$value->title}}</h2>
    <div class="item_btn">
        <div class="czbtn" data-text="view">view</div>
    </div></a></div>
@endforeach