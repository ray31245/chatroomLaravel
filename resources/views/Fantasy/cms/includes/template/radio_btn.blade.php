<li class="inventory sortStatusSet {{ $search===true?'card_search_input':'' }}" {!! $search===true?'data-search_type="radio" data-search_field="'.$search_field.'"':'' !!}>
  
  {!! $sontable===false?'<div class="title">':'' !!}
    <p class="subtitle">{{ $title }}</p>
  {!! $sontable===false?'</div>':'' !!}
  
  {!! $sontable===false?'<div class="inner">':'' !!}
    <div class="ios_switch {{$disabled=='disabled'?'':'radio_btn_switch'}} {{$value=='1'?'on':''}}">
      <input type="text" name="{{ $name }}" value="{{ $value }}">
      <div class="box">
        <span class="ball"></span>
      </div>
    </div>

    @if($tip!='')
      <div class="tips">
        <span class="title">TIPS</span>
        <p>{{ $tip }}</p>
      </div>
    @endif
  {!! $sontable===false?'</div>':'' !!}

</li>