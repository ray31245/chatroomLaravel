<?php
$explanation = (!empty($explanation)) ? $explanation : '-';
$is_tableData = (!empty($tableData)) ? 'is_tableData' : '';
// $tableData = (isset($tableData['model'])) ? $tableData : [];
// $tableData['model'] = (isset($tableData['model'])) ? $tableData['model'] : '';
// $tableData['table'] = (isset($tableData['model'])) ? $tableData['table'] : '';
// $tableData['for'] = (isset($tableData['model'])) ? $tableData['for'] : '';
$article4_class = ($article4) ? 'article4':'';
foreach($options as $val){if($value == $val['key']){$explanation = $val['title'];break;}}
?>
<li class="inventory {!! $sontable===false?'row_style':'' !!} {{ ($search===true)? 'card_search_input':''}}" @if($search===true && $search_multi===true) data-search_type="multi_select" data-search_field="{{ $search_field }}" @elseif($search===true) data-search_type="single_select" data-search_field="{{ $search_field }}" @endif>
    {!! $sontable===false?'<div class="title">':'' !!}
        <p class="subtitle">{{ $title }}</p>
    {!! $sontable===false?'</div>':'' !!}
    <div class="inner">
        <select class="____select2 {{$article4_class}} {{$auto}} {{$is_tableData}}" name="{{ $name }}" data-model="{{$tableData['model']}}" data-for="{{$tableData['for']}}" data-table="{{$tableData['table']}}" data-autosetup="{{$autosetup}}" {{($disabled) ? 'disabled' : ''}}>
		    
            @if(findkey($options,'key',$value) !== null)
                <optgroup label="目前選項為">
                @if($article4)
                <option data-img="/vender/assets/img/article4/{{ $value }}.jpg" value="{{ $value }}" selected>{{$options[findkey($options,'key',$value)]['title']}}</option>
                @else
                    <option value="{{$value}}" selected>{{$options[findkey($options,'key',$value)]['title']}}</option>
            @endif
                </optgroup>
            @endif
            
            {!! $empty == 'yes'?'<option value="0">-</option>':'' !!}
            <optgroup label="可選擇下列選項">
                @foreach ($options as $key => $row)
        @if($article4)
                    <option data-img="/vender/assets/img/article4/{{ $row['key'] }}.jpg" value="{{ $row['key'] }}" {{($value!='' && $value!='0' && $value == $row['key'])? 'selected':''}}>{{ $row['title'] }}</option>
        @else
                        <option value="{{ $row['key'] }}">{{ $row['title'] }}</option>
                    @endif
                @endforeach
            </optgroup>
            </select>

        @if(!empty($tip))
            <div class="tips">
                <span class="title">TIPS</span>
                    <p>{!! $tip !!}</p>
            </div>
        @endif


    </div>
</li>