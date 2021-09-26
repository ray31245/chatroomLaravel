//輸入就顯示在列表上
jQuery(function () {
    $(document).on('keyup blur', '.AutoSet', function (event) {
        //alert("x");
        $(this).parents(".stack_state").find('.' + $(this).data("autosetup")).html($(this).val());
        // console.log($(this).parents(".stack_state").find('.' + $(this).data("autosetup")).html());
    });

    $(document).on('select2:select', '.AutoSetSelect', function (e) {
        var _this = $(this);
        // Do something
        _this.parents(".stack_state").find('.' + _this.data("autosetup")).html(e.params.data.text);
        if (_this.data("autosetup") == 'AutoSet_article_style') {
            _this.parents(".stack_state").find('.' + _this.data("autosetup")).parent().find('img').attr('src', e.params.data.element.dataset.img);
        }
    });

});

//關聯式選單refresh
function relate_select_renew_next(parent_ul, parent_id) 
{
	var this_ul = $('#relsel_' + parent_ul.data('next')),
		this_p = $('#relselo_' + parent_ul.data('next'));

	$.ajax({
			url: $('.base-url').val() + '/Ajax/relate-select/' + parent_ul.data('model') + '/' + this_ul.data('model') + '/' + parent_id,
			type: 'GET',
			data: {
				option_text: this_ul.data('option_text'),
			},
		})
	.done(function (response) {

		this_ul.find('li').remove();
		var html = '',
			_this_option_text = '-',
			_this_val = 0;

		if (this_ul.data('empty') == 'yes') 
		{
			html += '<li class="option relate_select_fantasy" data-id="0"><p>-</p></li>';
		}

		$.each(response, function (k, v) 
		{
			html += '<li class="option relate_select_fantasy" data-id="' + v.id + '"><p>' + v.option_text + '</p></li>';
		});

		if (response.length > 0) 
		{
			_this_option_text = response[0].option_text
			_this_val = response[0].id;
		}

		this_p.html(_this_option_text);
		this_ul.prepend(html);

		if (this_ul.data('next') != '') 
		{
			relate_select_renew_next(this_ul, _this_val)
		} 
		else 
		{
			this_ul.find("input[type='hidden']").val(_this_val).trigger('change');
			quill_select();
			temp_loading();
		}
	})
	.fail(function () {
		console.log("relate select renew error");
	})
}

// 多選將已選擇項目json塞入input #adam
function changeMultiSelectValue($key) 
{
	var _this_ul = $('ul.multi_sselect_list_' + $key),
		_this_input = $('.multi_select_' + $key);
	var ids = [];
	
	_this_ul.children('li').each(function (index, el) {
		if ($(this).hasClass('on') && $(this).data('id') != 'all') {
			ids.push(String($(this).data('id')));
		}
	});
	var current_value = ids.length > 0 ? JSON.stringify(ids) : '';
	_this_input.val(current_value);
}
//輸入就顯示在列表上
jQuery(function () {
	$(document).on('keyup blur', '.AutoSet', function (event) {
		//alert("x");
		$(this).parents(".stack_state").find('.' + $(this).data("autosetup")).html($(this).val());
		// console.log($(this).parents(".stack_state").find('.' + $(this).data("autosetup")).html());
	});
});
// 編輯頁切換radio_btn
$('body').on('click','.radio_btn_switch',function()
{
	var _this = $(this),
		_this_input = _this.children('input');

	if(_this.hasClass('on'))
	{
		_this.removeClass('on');
		_this_input.val(0);
	}
	else
	{
		_this.addClass('on');
		_this_input.val(1);
	}
});

// select 單選JS
$('body').on('click','li.single_select_fantasy',function()
{
	var _this = $(this),
		_this_id = _this.data('id'),
		_this_input = _this.parent('ul').children('input');
	_this_input.attr('value',_this_id);
	if (_this.parent('ul').children('input').hasClass("AutoSetSelect")) {
		_this.parent('ul').children('input').parents(".stack_state").find('.' + _this.parent('ul').children('input').data("autosetup")).html(_this.html());
	}
});

//select 關聯式選單JS
$('body').on('click','li.relate_select_fantasy',function()
{
	var _this = $(this),
		_this_id = _this.data('id'),
		_this_ul = _this.parent('ul');
	_this_ul.children('input').val(_this_id);
	
	/*更新選單*/
	if(_this_ul.data('next')!=''){
		temp_loading();
		relate_select_renew_next(_this_ul, _this_id)
	}
});

//add value In SonTable
$('body').on('click','li.addValueInTable',function()
{
	var _this = $(this),
		_this_table = _this.data('table'),
		_this_content = _this.data('content');
	if(_this.hasClass('clicked'))
	{
		return false;
	}
	else
	{
		_this.addClass('clicked');
		$('.tabulation_body_'+_this_table).append(_this_content);
		$('.tabulation_head_'+_this_table).css('display','');
		$('.emptyContent_'+_this_table).remove();
		var randKey = randomWord(false,5);
		$('.addKeyClass').addClass('cms_new_'+randKey);
		$('.addkeyFrame').addClass('list_frame_'+randKey);
		$('.addDataKey').attr('data-key',randKey);
		$('.addKeyValue').val(randKey);

		if($('.cms_new_'+randKey).find('.addInThirdTb')){
			var thirdRandKey = randomWord(false,9);
			$('.cms_new_'+randKey).find('.addInThirdTb').attr('data-table', thirdRandKey);
			$('.cms_new_'+randKey).find('.deleteThirdTableDataGroup').attr('data-table', thirdRandKey);
			$('.cms_new_'+randKey).find('.rankThirdUp').attr('data-table', thirdRandKey);
			$('.cms_new_'+randKey).find('.rankThirdDown').attr('data-table', thirdRandKey);
			$('.cms_new_'+randKey).find('.quill_partImg').addClass('thirdTbNew_'+thirdRandKey);

		}

		$('.addImgClass').each(function(index, el) 
		{
			var keyClass = $(this).data('key');
			$(this).addClass('img_'+keyClass+randKey+keyClass);
		});
		$('.addFileClass').each(function(index, el) 
		{
			var keyClass = $(this).parents('.open_fms_lightbox').find('img').data('key');
			$(this).addClass('file_'+keyClass+randKey+keyClass);
		});
		$('.addFolderClass').each(function(index, el) 
		{
			var keyClass = $(this).parents('.open_fms_lightbox').find('img').data('key');
			$(this).addClass('folder_'+keyClass+randKey+keyClass);
		});
		$('.addTypeClass').each(function(index, el) 
		{
			var keyClass = $(this).parents('.open_fms_lightbox').find('img').data('key');
			$(this).addClass('type_'+keyClass+randKey+keyClass);
		});
		$('.addSizeClass').each(function(index, el) 
		{
			var keyClass = $(this).parents('.open_fms_lightbox').find('img').data('key');
			$(this).addClass('size_'+keyClass+randKey+keyClass);
		});
		$('.addImgValClass').each(function(index, el) 
		{
			var keyClass = $(this).data('key');
			$(this).addClass('value_'+keyClass+randKey+keyClass);
		});
		$('.addMulitSelectClass').each(function(index, el) 
		{
			var keyClass = $(this).data('key');
			$(this).addClass('multi_select_'+keyClass+randKey+'multi');
		});
		$('.addMulitListClass').each(function(index, el) 
		{
			var keyClass = $(this).data('key');
			$(this).addClass('multi_sselect_list_'+keyClass+randKey+'multi');
		});
		$('.addSelectGroup').each(function(index, el) 
		{
			var model = $(this).data('model'),
				next =  $(this).data('next'),
				_this_p = $(this).parent().parent().parent().find('p.addSelectGroupP');
			$(this).attr('id', 'relsel_'+randKey+'_'+model);
			if($(this).data('next')!='') $(this).data('next', randKey+'_'+next);
			_this_p.attr('id', 'relselo_'+randKey+'_'+model);
		});
		$('.addImgKey').each(function(index, el) 
		{
			var keyClass = $(this).data('key');
			$(this).attr('data-key',keyClass+randKey+keyClass);
		});
		$('.addMultiKey').each(function(index, el) 
		{
			var keyClass = $(this).data('key');
			$(this).attr('data-key',keyClass+randKey+'multi');
		});

		$('.filepicker_input_key').each(function(index, el) 
		{
			var keyClass = $(this).data('key');
			$(this).addClass('filepicker_input_'+keyClass+randKey+'file');
		});
		$('.filepicker_src_key').each(function(index, el) 
		{
			var keyClass = $(this).data('key');
			$(this).addClass('filepicker_src_'+keyClass+randKey+'file');
		});
		$('.filepicker_title_key').each(function(index, el) 
		{
			var keyClass = $(this).data('key');
			$(this).addClass('filepicker_title_'+keyClass+randKey+'file');
		});
		$('.filepicker_value_key').each(function(index, el) 
		{
			var keyClass = $(this).data('key');
			$(this).addClass('filepicker_value_'+keyClass+randKey+'file');
		});
		$('.filepicker_change_key').each(function(index, el) 
		{
			var keyClass = $(this).data('key');
			$(this).attr('data-key',keyClass+randKey+'file');
		});

		$('.addKeyClass').removeClass('addKeyClass');
		$('.addkeyFrame').removeClass('addkeyFrame');
		$('.addDataKey').removeClass('addDataKey');
		$('.addKeyValue').removeClass('addKeyValue');
		$('.addImgClass').removeClass('addImgClass');
		$('.addFileClass').removeClass('addFileClass');
		$('.addFolderClass').removeClass('addFolderClass');
		$('.addTypeClass').removeClass('addTypeClass');
		$('.addSizeClass').removeClass('addSizeClass');
		$('.addImgValClass').removeClass('addImgValClass');
		$('.addImgKey').removeClass('addImgKey');
		$('.addMulitSelectClass').removeClass('addMulitSelectClass');
		$('.addMulitListClass').removeClass('addMulitListClass');
		$('.addSelectGroup').removeClass('addSelectGroup');
		$('.addSelectGroupP').removeClass('addSelectGroupP');
		$('.addMultiKey').removeClass('addMultiKey');
		$('.filepicker_input_key').removeClass('filepicker_input_key');
		$('.filepicker_src_key').removeClass('filepicker_src_key');
		$('.filepicker_title_key').removeClass('filepicker_title_key');
		$('.filepicker_value_key').removeClass('filepicker_value_key');
		$('.filepicker_change_key').removeClass('filepicker_change_key');

		var count = $('.tabulation_body_'+_this_table).children('div.stack_state').length;
		var newDiv  = $('.tabulation_body_'+_this_table).children('div.stack_state').eq(count-1);
		newDiv.attr('data-rank',count);
		var rankDiv = newDiv.children('div').children('div.sort_number');
		rankDiv.children('p').text(count);
		rankDiv.children('input').val(count);

		_this.removeClass('clicked');
		quill_select();
		wade_datepicker();
		baseContentEdit_color_picker();
		item_file_detail('file_detail_btn');
	}
});

// clear file_picker
$('body').on('click','#onlyfileremove',function()
{
	$(this).prev().prev().prev().attr('value', '');//清除顯示的檔名
	$(this).prev().attr('data-src', '').attr('data-title', '');//清除下載鈕
	$(this).next().attr('value', '');//清除hidden裡存的值
});

// remove image
$('body').on('click','.image_remove',function()
{
	var div_tool = $(this).parent();
	div_tool.parent().parent().removeClass('has_img');//移掉"代表有圖片"的class
	div_tool.prev().prev().prev().attr('src', 'javascript:;');//清除圖片的src(不能放空值，不然會變破圖)
	div_tool.prev().prev().attr('value', '');//清除hidden裡存的值
});

// delete Son TableDate
$('body').on('click','span.deleteSonTableData',function()
{
    
	var _this = $(this),
		_this_key = _this.data('key'),
		_this_id = _this.data('id'),
        _this_model = _this.data('model'),
        _this_form = $(this).parents('.tabulation_body.contnetParagraph'),
        btn_class = ('span.deleteSonTableData');
        
        
        
	if(_this.hasClass('clicked'))
	{
		return false;
	}
	else
	{
		_this.addClass('clicked');
		$('div.stack_state').each(function(index, el) 
		{
			if($(this).data('key') == _this_key)
			{
				$(this).remove();
			}
			
		});
		if(_this_id != '')
		{
			var id_array = [];
			id_array.push( _this_id );
			$('.block_out').addClass('show');
			deleteTableDataByModelAndId(id_array,_this_model,btn_class);
		}
		else
		{
			_this.removeClass('clicked');
        }
        
        resetSontableRank(_this_form);
	}
});

// 重製table排序#adam
function resetSontableRank(_theForm){
    let adamStack = _theForm.find('.stack_state');

    adamStack.each(function(index,element){
        let adamRank = index+1;

        $(element).attr('data-rank', adamRank);
        $(element).find('.sort_number p').text(adamRank);
        $(element).find('.sort_number input').val(adamRank);
    })    
}

//delete Son TableDate Array
$('body').on('click','li.deleteSonTableDataGroup',function()
{
	var _this = $(this),
		_this_key = _this.data('key'),
		_this_model = _this.data('model'),
		_this_table = _this.data('table'),
		id_array = [],
		btn_class = ('li.deleteSonTableDataGroup');
	if(_this.hasClass('clicked'))
	{
		return false;
	}
	else
	{
		_this.addClass('clicked')
		$('.tabulation_body_'+_this_table).children('div.stack_state').each(function(index, el) 
		{
			if($(this).hasClass('chosen'))
			{
				if($(this).data('id') != '')
				{
					id_array.push( $(this).data('id') );
				}
				$(this).remove();
			}
		});

		if(id_array.length>0)
		{
			$('.block_out').addClass('show');
			deleteTableDataByModelAndId(id_array,_this_model,btn_class);
		}
		else
		{
			_this.removeClass('clicked');
		}

	}
});

//select 多選JS
$('body').on('click','li.multi_select_fantasy',function()
{
	var _this = $(this),
		_this_key = _this.parent('ul').attr('data-key');
	changeMultiSelectValue(_this_key);
});

//SonTable Sort up 
$('body').on('click','li.rankSonTableUp',function()
{
	var _this = $(this),
		_this_table = _this.data('table'),
		_this_val = '',
		_this_div = '';
	$('.tabulation_body_'+_this_table).children('div.stack_state').each(function(index, el) 
	{
		if($(this).hasClass('chosen'))
		{
			_this_div = $(this),
			_this_rank = $(this).children('div').children('.sort_number').children('p').text();
		}
	});
	if(_this_rank != 1)
	{
		var _current_div = $('.tabulation_body_'+_this_table).children('div.stack_state').eq(_this_rank-1),
			_exchange_div = $('.tabulation_body_'+_this_table).children('div.stack_state').eq(_this_rank-2);

		_current_div.children('div').children('.sort_number').children('p').text(_this_rank-1);
		_exchange_div.children('div').children('.sort_number').children('p').text(_this_rank);

		_current_div.children('div').children('.sort_number').children('input').attr('value',_this_rank-1);
		_exchange_div.children('div').children('.sort_number').children('input').attr('value',_this_rank);

		_current_div.insertBefore(_exchange_div);//更換順序
	}
	else
	{
		alert('排序已最高,謝謝!');
	}
});

//SonTable Sort down
$('body').on('click','li.rankSonTableDown',function()
{
	var _this = $(this),
		_this_table = _this.data('table'),
		_this_val = '',
		_this_div = '',
		_div_array = [];
	$('.tabulation_body_'+_this_table).children('div.stack_state').each(function(index, el) 
	{
		_div_array.push('fuck');
		if($(this).hasClass('chosen'))
		{
			_this_div = $(this),
			_this_rank = $(this).children('div').children('.sort_number').children('p').text();
		}
	});
	if(_this_rank != _div_array.length)
	{
		var _current_div = $('.tabulation_body_'+_this_table).children('div.stack_state').eq(_this_rank-1),
			_exchange_div = $('.tabulation_body_'+_this_table).children('div.stack_state').eq(_this_rank);

		var _this_rank_1 =  parseInt(_this_rank)+1;

		_current_div.children('div').children('.sort_number').children('p').text(_this_rank_1);
		_exchange_div.children('div').children('.sort_number').children('p').text(_this_rank);

		_current_div.children('div').children('.sort_number').children('input').attr('value',_this_rank_1);
		_exchange_div.children('div').children('.sort_number').children('input').attr('value',_this_rank);

		_current_div.insertAfter(_exchange_div);//更換順序
	}
	else
	{
		alert('排序已最後,謝謝!');
	}
});

//Add Third
$('body').on('click','.addInThirdTb',function()
{
	var _this = $(this),
		_this_table = _this.data('table'),
        _this_content = _this.data('content');

    //Leon 更改圖片KEY
    var doc = $.parseHTML(_this_content);    
    $(doc).find('.productImage').each(function () {
        let OldKey = $(this).find('.fa-plus').data('key');
        let NewKey = randomWord(false, 11);
        $(this).find('.fa-plus').attr('data-key', Date.now());
        $(this).find("span.lbox_fms_open").attr('data-key', NewKey);
        $(this).find('.img_' + OldKey).removeClass('img_' + OldKey).addClass('img_' + NewKey);
        $(this).find('.value_' + OldKey).removeClass('value_' + OldKey).addClass('value_' + NewKey);
        $(this).find('.file_' + OldKey).removeClass('file_' + OldKey).addClass('file_' + NewKey);
        $(this).find('.folder_' + OldKey).removeClass('folder_' + OldKey).addClass('folder_' + NewKey);
        $(this).find('.type_' + OldKey).removeClass('type_' + OldKey).addClass('type_' + NewKey);
        $(this).find('.size_' + OldKey).removeClass('size_' + OldKey).addClass('size_' + NewKey);
        // console.log(OldKey);
    });
    $(doc).find('._a_filePicker').each(function () {
        let OldKey = $(this).find('.lbox_fms_open').data('key');
        let NewKey = "LeonFileKey_" + Date.now();
        $(this).find('.lbox_fms_open').attr('data-key', NewKey);
        $(this).find('.filepicker_input_' + OldKey).removeClass('filepicker_input_' + OldKey).addClass('filepicker_input_' + NewKey);
        $(this).find('.filepicker_value_' + OldKey).removeClass('filepicker_value_' + OldKey).addClass('filepicker_value_' + NewKey);
    });

	if(_this.hasClass('clicked'))
	{
		return false;
	}
	else
	{
		_this.addClass('clicked');
		$('.thirdTbNew_' + _this_table).append(doc);
		// console.log(_this_content);
		var randKey = randomWord(false,5);
		var data_key = _this.closest('.stack_state').data('key');
		console.log(_this.closest('.stack_state').data('key'));
		$('.addKeyClass').addClass('new_'+randKey);
		$('.addImgClass').addClass('img_'+randKey);
		$('.addImgValClass').addClass('value_'+randKey);
		$('.addImgKey').attr('data-key',randKey);
		$('.addVideoKey').attr('data-key',randKey);
		$('.addVideoClass').addClass('video_'+randKey);
		$('.addFantasyKey').val(data_key);

		$('.addKeyClass').removeClass('addKeyClass');
		$('.addImgClass').removeClass('addImgClass');
		$('.addImgValClass').removeClass('addImgValClass');
		$('.addImgKey').removeClass('addImgKey');
		$('.addVideoKey').removeClass('addVideoKey');
		$('.addVideoClass').removeClass('addVideoClass');
		$('.addFantasyKey').removeClass('addFantasyKey');

		var count = $('.list_frame_'+data_key).find('.quill_partImg li').length;
		$('.new_'+randKey).find('.sort_number p').text(count);
		$('.new_'+randKey).find('.sort_number input').val(count);

		components.select2($(".____select2"));
		wade_datepicker();
		_this.removeClass('clicked');
	}
})

//Third - Sort up
$('body').on('click','div.rankThirdUp',function()
{
	var _this = $(this),
		_this_table = _this.data('table'),
		_this_val = '',
		_this_li = '';
	$('.thirdTbNew_'+_this_table).children('li').each(function(index, el) 
	{
		if($(this).find('.check_box').hasClass('show'))
		{
			_this_li = $(this),
			_this_rank = $(this).children('.sort_number').children('p').text();
		}
	});
	console.log(_this_rank);
	if(_this_rank != 1)
	{
		var _current_li = $('.thirdTbNew_'+_this_table).children('li.item').eq(_this_rank-1),
			_exchange_li = $('.thirdTbNew_'+_this_table).children('li.item').eq(_this_rank-2);

		_current_li.children('.sort_number').children('p').text(_this_rank-1);
		_exchange_li.children('.sort_number').children('p').text(_this_rank);

		_current_li.children('.sort_number').children('input').attr('value',_this_rank-1);
		_exchange_li.children('.sort_number').children('input').attr('value',_this_rank);

		_current_li.insertBefore(_exchange_li);//更換順序
	}
	else
	{
		alert('排序已最高,謝謝!');
	}
});

//Third - Sort down
$('body').on('click','div.rankThirdDown',function(){
	var _this = $(this),
		_this_table = _this.data('table'),
		_this_val = '',
		_this_li = '',
		_li_array = [];
	$('.thirdTbNew_'+_this_table).children('li').each(function(index, el) 
	{
		_li_array.push('1');
		if($(this).find('.check_box').hasClass('show'))
		{
			_this_li = $(this),
			_this_rank = $(this).children('.sort_number').children('p').text();
		}
	});
	console.log(_this_rank);
	if(_this_rank != _li_array.length)
	{
		var _current_li = $('.thirdTbNew_'+_this_table).children('li.item').eq(_this_rank-1),
			_exchange_li = $('.thirdTbNew_'+_this_table).children('li.item').eq(_this_rank);

		var _this_rank_1 =  parseInt(_this_rank)+1;

		_current_li.children('.sort_number').children('p').text(_this_rank_1);
		_exchange_li.children('.sort_number').children('p').text(_this_rank);

		_current_li.children('.sort_number').children('input').attr('value',_this_rank_1);
		_exchange_li.children('.sort_number').children('input').attr('value',_this_rank);

		_current_li.insertAfter(_exchange_li);//更換順序
	}
	else
	{
		alert('排序已最後,謝謝!');
	}
});

//Delete Third TableDate
$('body').on('click','span.deleteThirdTableData',function(){
	var _this = $(this),
		_this_key = _this.data('key'),
		_this_id = _this.data('id'),
		_this_model = _this.data('model'),
		btn_class = ('span.deleteThirdTableData');
	if(_this.hasClass('clicked'))
	{
		return false;
	}
	else
	{
		_this.addClass('clicked');
		if( confirm('你確定要刪除?') ){
			$(_this).parent().parent().remove();
			/*$('quill_partImg li').each(function(index, el) 
			{
				if($(this).data('key') == _this_key)
				{
					$(this).remove();
				}
				
			});*/
			if(_this_id != '')
			{
				var id_array = [];
				id_array.push( _this_id );
				$('.block_out').addClass('show');
				deleteTableDataByModelAndId(id_array,_this_model,btn_class);
			}
			else
			{
				_this.removeClass('clicked');
			}
		}
	}
});

//delete Third TableDate Array
$('body').on('click','div.deleteThirdTableDataGroup',function(){
	var _this = $(this),
		_this_key = _this.data('key'),
		_this_model = _this.data('model'),
		_this_table = _this.data('table'),
		id_array = [],
		btn_class = ('div.deleteThirdTableDataGroup');
	if(_this.hasClass('clicked'))
	{
		return false;
	}
	else
	{
		_this.addClass('clicked')
		if( confirm('你確定要刪除?') ){
			$('.thirdTbNew_'+_this_table).children('li').each(function(index, el) 
			{
				if($(this).find('.check_box').hasClass('show'))
				{
					if($(this).attr('partimg-id') != '')
					{
						id_array.push( $(this).attr('partimg-id') );
					}
					$(this).remove();
				}
			});

			if(id_array.length>0)
			{
				$('.block_out').addClass('show');
				deleteTableDataByModelAndId(id_array,_this_model,btn_class);
			}
			else
			{
				_this.removeClass('clicked');
			}
		}else{
			_this.removeClass('clicked');
		}

	}
});

// ????
$('body').on('click', '.determine', function () {
	// console.log('1233');
});