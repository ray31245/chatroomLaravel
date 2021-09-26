@if($search===true)
<li class="inventory row_style card_search_input" data-search_type="text" data-search_field="{{$search_field}}">
@else
<li class="inventory row_style">
@endif
    <div class="title">
        <p class="subtitle">{{$title}}</p>
    </div>

    <div class="inner">
        <input class="normal_input" type="text" value="{{$value}}" name="{{$name}}" {{$disabled}} @if(isset($set['required']) && $set['required'] == true)required @endif>
		@if(!empty($tip))		
			<div class="tips">
                <span class="title">TIPS</span>
                    <p>{!!$tip!!}</p>
            </div>
		@endif
    </div>
</li>