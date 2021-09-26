<!-- 頁尾-->
<footer class="footer">
    <div class="footer-contact">
      <p>{{$viewids['Footer']->bak_title_1}}<br>{{$viewids['Footer']->bak_title_2}}</p>
      <div>
        <p>{{$viewids['Footer']->bak_title_3}}</p><a class="nocg" href="tel:+{{$viewids['Footer']->bak_title_4}}">{{$viewids['Footer']->bak_title_4}}</a>
      </div>
      <ul>
        @if ($viewids['Footer']->bak_title_5)
        <li><a class="nocg icon-fb" href="{{$viewids['Footer']->bak_title_5?:'javascript:void(0)'}}"></a></li>
        @endif
        @if ($viewids['Footer']->bak_title_6)
        <li><a class="nocg icon-ig" href="{{$viewids['Footer']->bak_title_6?:'javascript:void(0)'}}"></a></li>
        @endif
        @if ($viewids['Footer']->bak_title_7)
        <li><a class="nocg icon-line" href="{{$viewids['Footer']->bak_title_7?:'javascript:void(0)'}}"></a></li>
        @endif
        @if ($viewids['Footer']->bak_title_8)
        <li><a class="nocg icon-twitter" href="{{$viewids['Footer']->bak_title_8?:'javascript:void(0)'}}"></a></li>
        @endif
        @if ($viewids['Footer']->bak_title_9)
        <li><a class="nocg icon-wechat" href="{{$viewids['Footer']->bak_title_9?:'javascript:void(0)'}}"></a></li>
        @endif
        @if ($viewids['Footer']->bak_title_10)
        <li><a class="nocg icon-youtube" href="{{$viewids['Footer']->bak_title_10?:'javascript:void(0)'}}"></a></li>
        @endif
      </ul>
      <div class="gotop"><span class="icon-top"></span></div>
    </div>
    <div class="footer-navbar">
      <ul>
        @foreach ($footer as $key => $value)
        <li><a href="{{$value->title2?:'javascript:void(0)'}}">{{$value->title}}</a></li>
        @endforeach
      </ul>
      <p>{{$viewids['Footer']->bak_title_11}}</p>
    </div>
</footer>