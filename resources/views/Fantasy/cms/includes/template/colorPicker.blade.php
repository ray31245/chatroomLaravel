@if(!empty($disabled) AND $disabled == 'disabled')

    <li class="inventory row_style">
        <div class="title">
            <p class="subtitle">{{$title}}</p>
        </div>

        <div class="inner">
            <div class="color_picker">
                <div class="sp-replacer sp-light">
                    <div class="sp-preview">
                        <div class="sp-preview-inner" style="background-color: {{$value}};"></div>
                    </div>
                </div>

                <div class="ticket_field" style="">
                    <p>{{$value}}</p>
                </div>
            </div>

            @if(!empty($tip))
                <div class="tips">
                    <span class="title">TIPS</span>
                        <p>{!!$tip!!}</p>
                </div>
            @endif
        </div>
    </li>

@else

    <li class="inventory row_style">
        <div class="title">
            <p class="subtitle">{{$title}}</p>
        </div>

        <div class="inner">
            <div class="color_picker">
                <input type="text" class="palette" value="{{$value}}" name="{{$name}}"/>
            </div>

            @if(!empty($tip))
                <div class="tips">
                    <span class="title">TIPS</span>
                        <p>{!!$tip!!}</p>
                </div>
            @endif
        </div>
    </li>
@endif