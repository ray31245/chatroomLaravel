{{-- $add_html = htmlentities($third_html0 . $add_html0 . $third_html1 . $third_html2 . $third_html3); --}}

<li class="item photo addKeyClass" partImg-id="" data-rank="">
    <div class="check_box" style="position: relative;">
        <input type="checkbox" class="content_input">
        <label class="content_inputBox"></label>
        <input type="hidden" name="{{$son_son_db}}[id][]" class="addThirdId">
        <input type="hidden" name="{{$son_son_db}}[quillSonFantasyKey][]" class="addFantasyKey">
        <input type="hidden" name="{{$son_son_db}}[{{$three['SecondIdColumn']}}][]" value="" class="addThirdSid">
    </div>

    <div class="sort_number">
        <p></p>
        <input type="hidden" name="{{$son_son_db}}[rank][]">
    </div>

    <div class="ThreeContent" style="width:100%">
        @include('Fantasy.cms.includes.template.WNsontable.three_content',[
                'value_son' => [],
                ])
    </div>    
    
    <div class="edit">
        <span class="fa fa-trash deleteThirdTableData" data-id="" data-key="" data-model="{{$son_son_db}}"></span>
    </div>
</li>
