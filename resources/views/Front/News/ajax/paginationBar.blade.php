<div class="page" pagecount="{{$news_total_page}}" currentpage="{{!empty($_GET['page'])?$_GET['page']:'1'}}">
    <a class="page_icon icon-arrow_left prev" jumpbtn="backstep" href="javascript:;"></a>
    <div class="page_ul">
    @for($i=1;$i<=$news_total_page;$i++)
    <a class="page_li active" pageindex={{$i}} href="javascript:;"></a>
    @endfor
    </div>
    <a class="page_icon icon-arrow_right next" jumpbtn="nextstep" href="javascript:;"></a>
</div>