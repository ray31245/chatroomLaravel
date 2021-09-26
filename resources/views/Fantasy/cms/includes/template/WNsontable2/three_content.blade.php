@foreach ($three['three_content'] as $item)        
    @switch($item['type'])
        @case('textInput')
            <div class="_a_textInput">
                <p class="type">{{$item['title']}}</p>

                    <p>
                        <input class="normal_input" type="text" value="{{!empty($value_son)?$value_son[$item['value']]:''}}" name="{{$son_son_db}}[{{$item['value']}}][]">
                    </p>

                @if(isset($item['tip']))
                <div class="tips">
                    <span class="title">TIPS</span>
                    <p>{!!$item['tip']!!}</p>
                </div>
                @endif
            </div>
            @break     

        @case('textArea')
            <div class="_a_textArea">
                <p class="type">{{$item['title']}}</p>
                    <p>
                        <textarea type="text" name="{{$son_son_db}}[{{$item['value']}}][]">{{!empty($value_son)?$value_son[$item['value']]:''}}</textarea>
                    </p>

                @if(isset($item['tip']))
                <div class="tips">
                    <span class="title">TIPS</span>
                    <p>{!!$item['tip']!!}</p>
                </div>
                @endif
            </div>
            @break              

        @case('radio_btn')         
            <div class="_a_radio_btn item switch_btn ios_switch radio_btn_switch {{!empty($value_son)? $value_son[$item['value']]=='1'?'on':'' :''}}">
                <input type="text" name="{{$son_son_db}}[{{$item['value']}}][]" value="{{!empty($value_son)?$value_son[$item['value']] : ''}}">{{$item['title']}}
                <div class="box">
                    <span class="ball"></span>
                </div>

                @if(isset($item['tip']))
                <div class="tips">
                    <span class="title">TIPS</span>
                    <p>{!!$item['tip']!!}</p>
                </div>
                @endif
            </div>  
            @break

        @case('select2')  

            @php
                $temp_options = (!empty($item['options'])) ? $item['options'] : [];
            @endphp
            <div class="_a_select2">
            <div class="title">
                    <p class="subtitle">{{$item['title']}}</p>
            </div>
                <div class="inner">
                    <select class="form-control ____select2" name="{{$son_son_db}}[{{$item['value']}}][]">

                        <optgroup label="目前選項為">
                            @if(!empty($value_son))
                                @if($value_son[$item['value']] == 0 || empty($value_son[$item['value']]))
                                <option value="0"></option>
                                @else
                                <option value="0">{{$temp_options[$value_son[$item['value']]]['title']}}</option>
                                @endif
                            @else
                                <option value="0"></option>
                            @endif
                        </optgroup>
                        
                        <optgroup label="可選擇下列選項">                                                                                            
                            
                            @foreach ($temp_options as $key => $temp_options_row)
                                @if(!empty($value_son))		
                                    <option value="{{ $temp_options_row['key'] }}" {{$value_son[$item['value']] == $temp_options_row['key'] ? 'selected' : ''}}> {{ $temp_options_row['title'] }}</option>
                                @else
                                    <option value="{{ $temp_options_row['key'] }}"> {{ $temp_options_row['title'] }}</option>
                                @endif
                            @endforeach
                        </optgroup>
                        
                    </select>

                    @if(isset($item['tip']))
                    <div class="tips">
                        <span class="title">TIPS</span>
                        <p>{!!$item['tip']!!}</p>
                    </div>
                    @endif
                </div>
            </div>
            @break

        @case('selectBydata')

            @php
                $temp_options = (!empty($item['options'])) ? $item['options'] : [];
            @endphp

            <div class="_a_selectByData open_db_lightbox">                    
                <p class="subtitle">{{$item['title']}}</p>     

                <div class="inner">
                    <div class="quill_select active_select open">
                        <div class="select_object ajax_open one_shot" data-model="{{$item['model']}}" data-cls="sontable" data-empty="no">
                            <span class="fa fa-warning h_icon"></span>     
                            @if( !empty($value_son) && $value_son[$item['value']] != 0 )           
                            <p class="title">{{$temp_options[$value_son[$item['value']]]['title']}}</p>
                            @else
                            <p class="title"> - </p>
                            @endif
                            <span class="arrow pg-arrow_down"></span>
                            <input type="hidden" name="{{$son_son_db}}[{{$item['value']}}][]" value="{{!empty($value_son) ? $value_son[$item['value']] : '0'}}">
                        </div>
                        
                    </div>

                    @if(isset($item['tip']))
                    <div class="tips">
                        <span class="title">TIPS</span>
                        <p>{!!$item['tip']!!}</p>
                    </div>
                    @endif
                </div>
            </div>
            @break  

        @case('image_group')
            @if(!empty($value_son))
                @php
                    $fileInformationArray = [];
                    $fileIds = [];
                    foreach ($item['image_array'] as $key_img => $value_img) 
                    {
                        array_push($fileIds, $value_son[$value_img['value']]);
                    }
                    if(!empty($fileIds))
                    {
                        $fileInformationArray = BaseFunction::getFilesArray($fileIds);
                    }
                @endphp
            @endif

            <div class="_a_image_group productImage">

                <div class="title">
                    <p class="subtitle">{{$item['title']}}</p>
                </div>

                <div class="inner">
                    <div class="picture_box">

                    @foreach($item['image_array'] as $key_img => $value_img)
                        @php
                            $randomWord = \Illuminate\Support\Str::random(19);

                            $imgClass = '';
                            $imgSrc = 'javascript:void(0);';  
                            if(!empty($value_son)){
                                if(isset($fileInformationArray[ $value_son[$value_img['value']] ]) AND !empty($fileInformationArray[ $value_son[$value_img['value']] ]))
                                {
                                    $imgClass = 'has_img';
                                    $imgSrc = $fileInformationArray[ $value_son[$value_img['value']] ]['real_route'];
                                    $folder_level = BaseFunction::get_folder_level(
                                        $fileInformationArray[ $value_son[$value_img['value']] ]['zero_id'], $fileInformationArray[ $value_son[$value_img['value']] ]['first_id'], $fileInformationArray[ $value_son[$value_img['value']] ]['second_id'], $fileInformationArray[ $value_son[$value_img['value']] ]['third_id']);
                                }
                            }
                            

                            $width = 'auto;';
                            $img_style = 'height:100px;';
                            if($value_img['set_size'] == 'yes')
                            {
                                $width = ($value_img['width']/$value_img['height'])*100;
                                $width .= 'px;';
                                $img_style = '';
                            }

                            $lbox_fms_open = 'lbox_fms_open';
                            if(isset($value_img['disabled']) AND $value_img['disabled'] == 'disabled')
                            {
                                $lbox_fms_open = '';
                            }
                        @endphp

                        <div class="frame open_fms_lightbox {{$imgClass}}">

                            <div class="box" style="width:{{$width}}">
                                <img src="{{$imgSrc}}" style="{{$img_style}}" class="img_{{$randomWord}}">
                                <input type="hidden" name="{{$son_son_db}}[{{$value_img['value']}}][]" value="{{!empty($value_son) ?$value_son[$value_img['value']] : "0"}}" class="value_{{$randomWord}}">
                                <span class="icon fa fa-plus {{$lbox_fms_open}}" data-key="{{$randomWord}}" data-type="img"></span>

                                <div class="tool">
                                    <span class="t_icon fa fa-folder file_detail_btn"></span>
                                    <span class="t_icon fa fa-pencil {{$lbox_fms_open}}" data-key="{{$randomWord}}" data-type="img"
                                    @if(!empty($value_son))
                                        @if(isset($fileInformationArray[ $value_son[$value_img['value']] ]) AND !empty($fileInformationArray[ $value_son[$value_img['value']] ])) 
                                            data-l0="{{$fileInformationArray[ $value_son[$value_img['value']] ]['zero_id']}}" 
                                            data-l1="{{$fileInformationArray[ $value_son[$value_img['value']] ]['first_id']}}" 
                                            data-l2="{{$fileInformationArray[ $value_son[$value_img['value']] ]['second_id']}}" 
                                            data-l3="{{$fileInformationArray[ $value_son[$value_img['value']] ]['third_id']}}" 
                                            data-s0="{{$folder_level[0]}}" 
                                            data-s1="{{$folder_level[1]}}" 
                                            data-s2="{{$folder_level[2]}}" 
                                            data-s3="{{$folder_level[3]}}" 
                                        @endif
                                    @endif
                                    ></span>
                                    
                                    @if(!empty($value_son) && $value_son[$value_img['value']]!="0")
                                        <span class="t_icon fa fa-trash image_remove" data-key="{{$randomWord}}" data-type="img"></span>
                                    @endif
                                </div>
                        </div>

                        <div class="info">
                            <p>{{$value_img['title']}}</p>
                        </div>

                        @if(!empty($value_son) && isset($fileInformationArray[ $value_son[$value_img['value']] ]) AND !empty($fileInformationArray[ $value_son[$value_img['value']] ]))
                        
                            @php
                                $_this_file_path = BaseFunction::get_file_path($fileInformationArray[ $value_son[$value_img['value']] ]);
                            @endphp

                            <div class="file_detail_box">
                                <div class="info_detail">
                                    <p class="file_{{$randomWord}}"><span>FILE</span>{{$fileInformationArray[ $value_son[$value_img['value']] ]['title']}}.{{$fileInformationArray[ $value_son[$value_img['value']] ]['type']}}</p>
                                    <p class="folder_{{$randomWord}}"><span>FOLDER</span>{{$_this_file_path}}</p>
                                    <p class="type_{{$randomWord}}"><span>TYPE</span>{{$fileInformationArray[ $value_son[$value_img['value']] ]['type']}}</p>
                                    <p class="size_{{$randomWord}}"><span>SIZE</span>{{$fileInformationArray[ $value_son[$value_img['value']] ]['resolution']}}</p>
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

                    @if(isset($item['tip']))
                    <div class="tips">
                        <span class="title">TIPS</span>
                        <p>{!!$item['tip']!!}</p>
                    </div>
                    @endif
                </div>
            </div>
            @break

        @case('filePicker')

            @php
                $fileInformationArray = [];
                $fileIds = [];
                if(!empty($value_son)){                        
                    array_push($fileIds, $value_son[$item['value']]);
                    if(!empty($fileIds)){
                        $fileInformationArray = BaseFunction::getFilesArray($fileIds);
                    }
                }
                $randomWord = \Illuminate\Support\Str::random(23);
            @endphp

            <div class="_a_filePicker">
                <div class="title">
                    <p class="subtitle">{{$item['title']}}</p>
                </div>

                <div class="inner">
                    @php
                        $fileData = '';
                        $fileRoute = '';
                        if(!empty($value_son)){
                            if(isset($fileInformationArray[ $value_son[$item['value']] ]) AND !empty($fileInformationArray[ $value_son[$item['value']] ])){
                                $fileData = $fileInformationArray[ $value_son[$item['value']] ]['title'].'.'.$fileInformationArray[ $value_son[$item['value']] ]['type'];
                                $fileRoute = $fileInformationArray[ $value_son[$item['value']] ]['real_route'];
                            }
                        }
                    @endphp

                    <input class="normal_input filepicker_input_{{$randomWord}}" type="text" value="{{$fileData}}" style="width:70%;" disabled>
                    <input class="normal_input lbox_fms_open" type="button" value="..." style="width:5%;cursor: pointer;" data-key="{{$randomWord}}" data-type="file">

                    @if($fileData!="")
                        <input class="normal_input file_fantasy_download filepicker_src_{{$randomWord}} filepicker_title_{{$randomWord}}" type="button" value="⇩" style="width:5%;cursor: pointer;" data-src="{{$fileRoute}}" data-title="{{$fileData}}">
                        <input id="onlyfileremove" class="normal_input fa-remove" type="button" value="X" style="width:5%;cursor: pointer;" >
                    @endif
                    <input type="hidden" value="{{!empty($value_son)?$value_son[$item['value']]:0}}" name="{{$son_son_db}}[{{$item['value']}}][]" class="filepicker_value_{{$randomWord}}">

                    @if(!empty($tip))        
                        <div class="tips">
                            <span class="title">TIPS</span>
                                <p>{!!$tip!!}</p>
                        </div>
                    @endif
                </div>
            </div>
            @break
    @endswitch
@endforeach