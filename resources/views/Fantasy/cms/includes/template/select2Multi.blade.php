<?php
$explanation = (!empty($explanation)) ? $explanation : '-';
foreach($options as $val){if($value == $val['key']){$explanation = $val['title'];break;}}
$value = (is_array($value)) ? $value : [];
?>
<li class="inventory {!! $sontable===false?'row_style':'' !!} {{ ($search===true)? 'card_search_input':''}}" {!! ($search===true)?'data-search_type="single_select" data-search_field="'.$search_field.'"':'' !!}>
    {!! $sontable===false?'<div class="title">':'' !!}
        <p class="subtitle">{{ $title }}</p>
    {!! $sontable===false?'</div>':'' !!}
    <div class="inner">
		<select class="____select2" name="{{ $name }}[]" multiple="multiple">
		    <optgroup label="已選擇選項為">
                @if( isset($value) && !empty($value))
                    @foreach ($value as $item)
                        @if(isset($options[$item]))
                            <option value="{{$item}}" selected>{{$options[$item]['title']}}</option>                        
                        @endif
                    @endforeach
                @endif
            </optgroup>

            {{-- {!! $empty == 'yes'?'<option value="0">-</option>':'' !!} --}}
            <optgroup label="未選擇下列選項">
                @foreach ($options as $key => $row)
                    @if(!in_array($row['key'],$value))		  
                    <option value="{{ $row['key'] }}">{{ $row['title'] }}</option>
                    @endif
                @endforeach
            </optgroup>
		</select>

        @if(!empty($tip))
            <div class="tips">
                <span class="title">TIPS</span>
                    <p>{{ $tip }}</p>
            </div>
        @endif
        {{-- <input type="hidden" value="0" name="{{ $name }}[]"> --}}
    </div>
</li>