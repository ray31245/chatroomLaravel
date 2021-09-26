@if($search===true)
<li class="inventory row_style card_search_input" data-search_type="datePicker" data-search_field="{{$search_field}}">
@else
<li class="inventory row_style">
@endif

    <div class="title">
        <p class="subtitle">{{$title}}</p>
    </div>

    <div class="inner">
        @if(!empty($disabled) AND $disabled == 'disabled')        
            <input type="text" class="normal_input" value="{{$value}}" name="{{$name}}" {{$disabled}}>        
        @else        
            <input type="text" class="normal_input datepicker-input" value="{{$value}}" name="{{$name}}">
        @endif

        @if(!empty($tip))        
            <div class="tips">
                <span class="title">TIPS</span>
                    <p>{!!$tip!!}</p>
            </div>
        @endif
    </div>
</li>