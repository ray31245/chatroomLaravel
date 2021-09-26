{{-- {{dd($data)}} --}}
<table>
    <thead>
    <tr>
        <th colspan="{{count($data['columns'])}}">{{$data['title']}}</th>
    </tr>
    <tr>
    @foreach($data['columns'] as $val)
        {{-- @if(!in_array($val['title'],['密碼','編號','排序','審核','預覽','顯示','分館','建立者',''])) --}}
        <th>{{$val['title']}}</th>
        {{-- @endif --}}
	@endforeach
    </tr>
    </thead>
    <tbody>
      @foreach($data['data'] as $key => $val)
        @php
          $count_max = $data['relate_arr']->map(function($item)use($val){
            $item['count'] = count($val[$item['name']]);
            return $item;
          })->max('count');
          if ($count_max<1) {
            $count_max = 1;
          }
          // dump($count_max);
        @endphp
        @for ($i = 0; $i < $count_max; $i++)
          <tr @if($loop->index%2==0) style="background-color: darkorange;"@endif>
            @foreach($data['columns'] as $key2 => $val2)
              @if ($val2['layer']==0)
                @if ($i==0)
                  @if ($val2['column'] == $data['option_arr']->where('table',$val2['table'])->where('column',$val2['column'])->first()['column'])
                    @php
                    $option_arr = $data['option_arr']->where('table',$val2['table'])->where('column',$val2['column'])->first();
                    $table = $option_arr['name'];
                    $title = $option_arr['title'];
                    @endphp
                    <td>{{(($data['options']->$table->where('id',$val[$val2['column']]))->first()?:collect([$title=>'']))[$title]}}</td>
                  @else   
                    <td>{{$val[$val2['column']]}}</td>
                  @endif
                @else
                  <td></td>
                @endif
              @elseif($val2['layer']==1)
                @if (isset($val[$val2['table']][$i]))
                  @if ($val2['column'] == $data['relation_option_arr']->where('table',$val2['table'])->where('column',$val2['column'])->first()['column'])
                    @php
                    $relation_option_arr = $data['relation_option_arr']->where('table',$val2['table'])->where('column',$val2['column'])->first();
                    $table = $relation_option_arr['name'];
                    $title = $relation_option_arr['title'];
                    @endphp
                    <td>{{(($data['options']->$table->where('id',$val[$val2['table']][$i][$val2['column']]))->first()?:collect([$title=>'']))[$title]}}</td>
                  @else
                    <td>{{$val[$val2['table']][$i][$val2['column']]}}</td>
                  @endif
                @else
                <td></td>
                @endif
              @endif
			      @endforeach
          </tr>
        @endfor
      @endforeach
	{{-- @foreach($data['data'] as $key => $val)
        <tr>
            @foreach($data['columns'] as $key2 => $val2)
              @if ($val2['layer']==0)
              @php
                  $count_max = $data['relate_arr']->map(function($item)use($val){
                    $item['count'] = count($val[$item['name']]);
                    return $item;
                  })->max('count');
              @endphp
                @if ($val2['column'] == $data['option_arr']->where('table',$val2['table'])->first()['column'])
                  @php
                  $option_arr = $data['option_arr']->where('table',$val2['table'])->first();
                  $table = $option_arr['name'];
                  $title = $option_arr['title'];
                  @endphp
                  <td @if($count_max>=1) rowspan="{{$count_max}}" @endif>{{($data['options']->$table->where('id',$val[$val2['column']]))->first()->$title}}</td>
                @else   
                  <td @if($count_max>=1) rowspan="{{$count_max}}" @endif>{{$val[$val2['column']]}}</td>
                @endif
              @elseif($val2['layer']==1)
                @foreach ($val[$val2['table']] as $key3 => $val3)
                <td>{{$val3[$val2['column']]}}</td>
                @endforeach
              @endif
			      @endforeach
        </tr>
	@endforeach --}}
    </tbody>
</table>
{{-- {{dd('123')}} --}}

{{-- <table >
    <tr>
      <th colspan="3">物资详情说明</th>
    </tr>
    <tr>
      <td colspan="2">数量(支)</td>
      <td rowspan="2">重量(吨)</td>
    </tr>
    <tr>
      <td>实发数</td>    
      <td>实收数</td>
    </tr>
    <tr>
      <td>12</td>    
      <td>10</td>
      <td>100.00</td>
    </tr>
</table> --}}
{{-- {{dd('222')}} --}}