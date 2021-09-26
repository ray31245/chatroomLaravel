{{-- <!--圖右 加.pic_r--> --}}
@foreach ($news as $key => $value)
<a newsitem class="news_li waypoint {{$value->index_type=='2'?'pic_r':''}}" href="{{BaseFunction::b_url('News/'.$allCategory->where('id',$value->cate_id)->first()->url_title.'/'.$value->url_title)}}">
  <div class="news_pic">
    <div class="news_picfx"><img src="{{array_search($value->img,$imageAry)}}" alt="{{$value->title}}"/></div>
  </div>
  <div class="news_word">
    <div class="news_word_wrap">
      <div class="news_date"><span>{{date("Y-m-d",strtotime($value->news_date))}}</span>
        <p>{{$allCategory->where('id',$value->cate_id)->first()->title}}</p>
      </div>
      <h2 class="news_title">{{$value->index_title}}</h2>
      <div class="p">{{$value->index_sub_title}}</div>
      <div class="czbtn" data-text="read more">read more</div>
    </div>
  </div></a>
@endforeach