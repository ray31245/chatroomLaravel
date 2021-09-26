<li class="inventory row_style">
    <div class="title">
        <p class="subtitle">{{$title}}</p>
    </div>

    <div class="inner">
        <textarea class="____normal_textarea"type="text" name="{{$name}}" {{$disabled}}>{{$value}}</textarea>
        @if(!empty($tip))        
            <div class="tips">
                <span class="title">TIPS</span>
                    <p>{!!$tip!!}</p>
            </div>
        @endif
    </div>
</li>