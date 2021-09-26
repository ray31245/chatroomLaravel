@php
    if(!empty($disabled) AND $disabled == 'disabled'){
        $openClass = '';
    }
    else{
        $openClass = 'lbox_fms_open';
    }

    $fileInformationArray = [];
    $fileIds = [];

    array_push($fileIds, $value);
    if(!empty($fileIds)){
        $fileInformationArray = BaseFunction::getFilesArray($fileIds);
    }

    $length = 23;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomWord = '';
    for ($i = 0; $i < $length; $i++) {
        $randomWord .= $characters[rand(0, $charactersLength - 1)];
    }
@endphp

<li class="inventory row_style">
    <div class="title">
        <p class="subtitle">{{$title}}</p>
    </div>

    <div class="inner">
        @php
        if(isset($fileInformationArray[ $value ]) AND !empty($fileInformationArray[ $value ])){
            $fileData = $fileInformationArray[ $value ]['title'].'.'.$fileInformationArray[ $value ]['type'];
            $fileRoute = $fileInformationArray[ $value ]['real_route'];
        }
        else{
            $fileData = '';
            $fileRoute = '';
        }
        @endphp

        <input class="normal_input filepicker_input_{{$randomWord}}" type="text" value="{{$fileData}}" style="width:70%;" disabled>
        <input class="normal_input {{$openClass}}" type="button" value="..." style="width:5%;cursor: pointer;" data-key="{{$randomWord}}" data-type="file">

        @if($fileData!="")
            <input class="normal_input file_fantasy_download filepicker_src_{{$randomWord}} filepicker_title_{{$randomWord}}" type="button" value="⇩" style="width:5%;cursor: pointer;" data-src="{{$fileRoute}}" data-title="{{$fileData}}">
            <input id="onlyfileremove" class="normal_input fa-remove" type="button" value="X" style="width:5%;cursor: pointer;" >
        @endif
        <input type="hidden" value="{{$value}}" name="{{$name}}" class="filepicker_value_{{$randomWord}}">

        @if(!empty($tip))        
            <div class="tips">
                <span class="title">TIPS</span>
                    <p>{!!$tip!!}</p>
            </div>
        @endif
    </div>
</li>