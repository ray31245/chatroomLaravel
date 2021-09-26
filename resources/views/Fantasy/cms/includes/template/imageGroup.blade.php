<li class="inventory row_style productImage">
    <div class="title">
        <p class="subtitle">{{$title}}</p>
    </div>

    <div class="inner">
        <div class="picture_box">

        @foreach($image_array as $key_img => $value_img)
            @php
                $length = 19;
                $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
                $charactersLength = strlen($characters);
                $randomWord = '';
                for ($i = 0; $i < $length; $i++) 
                {
                    $randomWord .= $characters[rand(0, $charactersLength - 1)];
                }

                if(isset($fileInformationArray[ $value_img['value'] ]) AND !empty($fileInformationArray[ $value_img['value'] ]))
                {
                    $imgClass = 'has_img';
                    $imgSrc = $fileInformationArray[ $value_img['value'] ]['real_route'];
                    $folder_level = BaseFunction::get_folder_level($fileInformationArray[ $value_img['value'] ]['zero_id'], $fileInformationArray[ $value_img['value'] ]['first_id'], $fileInformationArray[ $value_img['value'] ]['second_id'], $fileInformationArray[ $value_img['value'] ]['third_id']);
                }
                else
                {
                    $imgClass = '';
                    $imgSrc = 'javascript:void(0);';
                }

                if($value_img['set_size'] == 'yes')
                {
                    $width = ($value_img['width']/$value_img['height'])*100;
                    $width .= 'px;';
                    $img_style = '';
                }
                else
                {
                    $width = 'auto;';
                    $img_style = 'height:auto;max-width: 200px;min-height: 100px;';
                }

                if(isset($value_img['disabled']) AND $value_img['disabled'] == 'disabled')
                {
                    $lbox_fms_open = '';
                }
                else
                {
                    $lbox_fms_open = 'lbox_fms_open';
                }
            @endphp

            <div class="frame open_fms_lightbox {{$imgClass}}">

                <div class="box" style="width:{{$width}} ;height:auto;">
                    <img src="{{$imgSrc}}" style="{{$img_style}}" class="img_{{$randomWord}}">
                    <input type="hidden" name="{{$value_img['name']}}" value="{{$value_img['value']}}" class="value_{{$randomWord}}">
                    <span class="icon fa fa-plus {{$lbox_fms_open}}" data-key="{{$randomWord}}" data-type="img"></span>

                    <div class="tool">
                        <span class="t_icon fa fa-folder file_detail_btn"></span>
                        <span class="t_icon fa fa-pencil {{$lbox_fms_open}}" data-key="{{$randomWord}}" data-type="img" @if(isset($fileInformationArray[ $value_img['value'] ]) AND !empty($fileInformationArray[ $value_img['value'] ])) data-l0="{{$fileInformationArray[ $value_img['value'] ]['zero_id']}}" data-l1="{{$fileInformationArray[ $value_img['value'] ]['first_id']}}" data-l2="{{$fileInformationArray[ $value_img['value'] ]['second_id']}}" data-l3="{{$fileInformationArray[ $value_img['value'] ]['third_id']}}" data-s0="{{$folder_level[0]}}" data-s1="{{$folder_level[1]}}" data-s2="{{$folder_level[2]}}" data-s3="{{$folder_level[3]}}" @endif></span>

                        @if($value_img['value']!="0")
                            <span class="t_icon fa fa-trash image_remove" data-key="{{$randomWord}}" data-type="img"></span>
                        @endif
                    </div>
            </div>

            <div class="info">
                <p>{{$value_img['title']}}</p>
            </div>

            @if(isset($fileInformationArray[ $value_img['value'] ]) AND !empty($fileInformationArray[ $value_img['value'] ]))
            
                @php
                    $_this_file_path = BaseFunction::get_file_path($fileInformationArray[ $value_img['value'] ]);
                @endphp

                <div class="file_detail_box">
                    <div class="info_detail">
                        <p class="file_{{$randomWord}}"><span>FILE</span>{{$fileInformationArray[ $value_img['value'] ]['title']}}.{{$fileInformationArray[ $value_img['value'] ]['type']}}</p>
                        <p class="folder_{{$randomWord}}"><span>FOLDER</span>{{$_this_file_path}}</p>
                        <p class="type_{{$randomWord}}"><span>TYPE</span>{{$fileInformationArray[ $value_img['value'] ]['type']}}</p>
                        <p class="size_{{$randomWord}}"><span>SIZE</span>{{$fileInformationArray[ $value_img['value'] ]['resolution']}}</p>
                    </div>
                </div>
            @else
                <div class="file_detail_box">
                    <div class="info_detail">
                        <p class="file_{{$randomWord}}"><span>FILE</span></p>
                        <p class="folder_{{$randomWord}}"><span>FOLDER</span></p>
                        <p class="type_{{$randomWord}}"><span>TYPE</span></p>
                        <p class="size_{{$randomWord}}"><span>SIZE</span></p>
                    </div>
                </div>
            @endif
            </div>
        @endforeach
        </div>


        @if(!empty($tip))
            <div class="tips">
                <span class="title">TIPS</span>
                    <p>{!!$tip!!}</p>
            </div>
        @endif
    </div>
</li>