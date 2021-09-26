{{-- $embed_html = htmlentities($third_html0 . $embed_html0 . $third_html1 . $embed_html1 . $third_html2 . $embed_html2 . $third_html3); --}}

<li class="item photo addKeyClass" partImg-id="" data-rank="">
    <div class="check_box" style="position: relative;">
        <input type="checkbox" class="content_input">
        <label class="content_inputBox"></label>
    </div>

    <div class="sort_number">
        <p></p>
        <input type="hidden" name="{{$son_son_db}}[rank][]">
    </div>

    <div class="text">
        <p class="type">Video</p>
        <p>
            <input type="text" name="{{$son_son_db}}[title][]" >
            <input type="hidden" name="{{$son_son_db}}[id][]" class="addThirdId">
            <input type="hidden" name="{{$son_son_db}}[quillSonFantasyKey][]" class="addFantasyKey">
            <input type="hidden" name="{{$son_son_db}}[second_id][]" value="" class="addThirdSid">
        </p>
    </div>

    @if (!empty($is_add) && $is_add != "yes")
        <div class="edit_thumbnail photo">
            <div class="base">
                <img src="/vender/assets/img/none-pic.jpg" alt="" class="addImgClass">
                <input type="hidden" name="{{$son_son_db}}[image][]" class="addImgValClass">
                <input type="hidden" name="{{$son_son_db}}[type][]" value="3">
            </div>

            <div class="upper addImgKey" data-type="embed">
                <div class="play_btn open_preview addVideoKey" data-url="https://www.youtube.com/embed/" data-type="embed" data-place="請輸入YouTube影片代碼">
                    <span></span>
                </div>

                <div class="click_btn">
                    <p class="green lbox_fms_open addVideoKey" data-type="img">Cover</p>
                    <p class="gray open_preview addVideoKey" data-url="https://www.youtube.com/embed/" data-type="embed" data-place="請輸入YouTube影片代碼">Embed</p>
                    <input type="hidden" name="{{$son_son_db}}[video][]" class="addVideoClass">
                </div>
            </div>
        </div>
                       
    @else
        <input type="hidden" name="{{$son_son_db}}[type][]" value="0">
    @endif
    <div class="edit">
        <span class="fa fa-trash deleteThirdTableData" data-id="" data-key="" data-model="{{$son_son_db}}"></span>
        <span class="fa fa-gear open_preview addVideoKey" data-url="https://www.youtube.com/embed/" data-type="embed" data-place="請輸入YouTube影片代碼">
    </div> 
</li>