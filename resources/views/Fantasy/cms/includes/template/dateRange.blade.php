<li class="inventory{{ $sontable===false?' row_style':'' }} {{ $search===true?'card_search_input':'' }}" {!! $search===true?'data-search_type="dateRange" data-search_field="'.$search_field.'"':'' !!}>
    {!! $sontable===false?'<div class="title">':'' !!}
        <p class="subtitle">{{ $title }}</p>
    {!! $sontable===false?'</div>':'' !!}

    {!! $sontable===false?'<div class="inner">':'' !!}
        <div class="input-daterange input-group datepicker-range">
            @if(!empty($disabled) AND $disabled == 'disabled')
                <input type="text" class="input-sm form-control" name="{{ $name }}" value="{{ $value }}" {{ $disabled }}>
            @else
                <input type="text" class="input-sm form-control datepicker-input" name="{{ $name }}" value="{{ $value }}">
            @endif

            <div class="input-group-addon"><span>to</span></div>
            @if(!empty($disabled) AND $disabled == 'disabled')
                <input type="text" class="input-sm form-control" name="{{ $name2 }}" value="{{ $value2 }}" {{ $disabled }}>
            @else
                <input type="text" class="input-sm form-control datepicker-input" name="{{ $name2 }}" value="{{ $value2 }}">
            @endif
        </div>
        @if(!empty($tip))
            <div class="tips">
                <span class="title">TIPS</span>
                <p>{{ $tip }}</p>
            </div>
        @endif
    {!! $sontable===false?'</div>':'' !!}
</li>