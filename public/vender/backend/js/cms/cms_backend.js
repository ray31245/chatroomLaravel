// wade 2020/01/22最後更新

//中間主區塊 列表項點擊 開啟右邊滑動隱藏區塊
function open_wrapper() {

    var cms = $('.cms_theme'); //wade
    var fms = $('.fms_theme'); //wade

    // DataTable打開編輯畫面 #adam	//wade
    cms.on('click', '.open_builder', function() {
        var _this = $(this),
            _this_id = _this.data('id'),
            _this_model = _this.data('model');
        if (_this.hasClass('clicked')) {
            return false;
        } else {
            _this.addClass('clicked');
            $('.editTypeTitle').text('Edit 編輯資訊');

            $.ajax({
                    url: $('.base-url').val() + '/Ajax/data-info/' + _this_model + '/' + _this_id,
                    type: 'GET',
                })
                .done(function(data) {

                    $('.dataEditTitle').text(data.title);
                    $('.dataEditTitle').css('min-height', '33px');
                    $('.editContentArea').data('id', _this_id);
                    $('.editContentArea').data('model', _this_model);
                    $('li.cms-delete-btn').attr('data-id', _this_id);
                    $('.editContentArea').attr('data-mod', 'update');
                    $('ul.editContentMenu li:first').hide().removeClass('active opened wait-sent'); //隱藏右側列表的搜尋
                    $('ul.editContentMenu li:nth-child(n+2)').show(); //顯示右側列表除了搜尋外的項目
                    $('ul.editContentMenu li:nth-child(2)').click();
                    $('#editSentBtn').text('setting');
                    if ($('.cms-index_table').data('delete') == '1') {
                        $('li.cms-delete-btn').show();
                    }
                    cms.find('.cms_hiddenArea.cmsDetailAjaxArea').addClass('active');
                    cms.find('.cms_hiddenArea.cmsDetailAjaxArea .ajaxItem').addClass('active');

                    setTimeout(function() {
                        cms.find('.cms_hiddenArea.cmsDetailAjaxArea').addClass('open').removeClass('active');
                        cms.find('.cms_hiddenArea.cmsDetailAjaxArea .ajaxItem').addClass('open').removeClass('active');
                    }, 400)

                    _this.removeClass('clicked');
                })
                .fail(function() {
                    console.log("open_builder error");
                })
        }

    });



    // DataTable打開新增畫面 #adam //wade
    cms.on('click', '.createBtn', function() {
        var _this = $(this),
            _this_model = _this.data('model');

        if (_this.hasClass('clicked')) {
            return false;
        } else {
            $('.editTypeTitle').text('Create 新增資訊');
            $('.dataEditTitle').text('-');
            $('.editContentArea').data('id', '0');
            $('.editContentArea').data('model', _this_model);
            $('.editContentArea').attr('data-mod', 'create');
            $('ul.editContentMenu li:first').hide().removeClass('active opened wait-sent'); //隱藏右側列表的搜尋
            $('ul.editContentMenu li:nth-child(n+2)').show(); //顯示右側列表除了搜尋外的項目
            $('ul.editContentMenu li:nth-child(2)').click();
            $('#editSentBtn').text('setting');
            $('li.cms-delete-btn').css('display', 'none');

            cms.find('.cms_hiddenArea.cmsDetailAjaxArea').addClass('active');
            cms.find('.cms_hiddenArea.cmsDetailAjaxArea .ajaxItem').addClass('active');

            setTimeout(function() {
                cms.find('.cms_hiddenArea.cmsDetailAjaxArea').addClass('open').removeClass('active');
                cms.find('.cms_hiddenArea.cmsDetailAjaxArea .ajaxItem').addClass('open').removeClass('active');
            }, 400)

            _this.removeClass('clicked');
        }
    });


    // DataTable打開搜尋畫面 #adam	
    cms.on('click', '.searchBtn', function() {
        var _this = $(this),
            _this_model = _this.data('model');

        if (_this.hasClass('clicked')) {
            return false;
        } else {
            $('.editTypeTitle').text('Search 資料搜尋');
            $('.editFormName').text('資料搜尋');
            $('.dataEditTitle').text('-');
            $('.editContentArea').data('id', '0');
            $('.editContentArea').data('model', _this_model);
            $('.editContentArea').attr('data-mod', 'search');
            $('ul.editContentMenu li:first').show().addClass('active opened wait-sent'); //顯示右側列表的搜尋
            $('ul.editContentMenu li:nth-child(n+2)').hide(); //隱藏右側列表除了搜尋外的項目
            $('#editSentBtn').text('search');
            $('li.cms-delete-btn').css('display', 'none');
            $('.backEnd_quill').css('display', 'none'); //隱藏除了搜尋之外的form
            $('#searchForm').css('display', ''); //顯示搜尋的form
            components.select2($(".____select2"));

            //wade
            cms.find('.cms_hiddenArea.cmsDetailAjaxArea').addClass('active');
            cms.find('.cms_hiddenArea.cmsDetailAjaxArea .ajaxItem').addClass('active');

            setTimeout(function() {
                cms.find('.cms_hiddenArea.cmsDetailAjaxArea').addClass('open').removeClass('active');
                cms.find('.cms_hiddenArea.cmsDetailAjaxArea .ajaxItem').addClass('open').removeClass('active');
            }, 400)

            _this.removeClass('clicked');
        }
    });


    // FMS打開上傳畫面 #adam //wade
    fms.on('click', '.fms_bulider_upload', function() {

        $('.fmsDetailAjaxArea.uploadArea').addClass('active');
        $('.fmsDetailAjaxArea.uploadArea .ajaxItem').addClass('active');
        $('.fmsDetailAjaxArea.uploadArea .ajaxItem .fmsUpload').addClass('active');

        setTimeout(function() {
            $('.fmsDetailAjaxArea.uploadArea').addClass('open').removeClass('active');
            $('.fmsDetailAjaxArea.uploadArea .ajaxItem').addClass('open').removeClass('active');
            $('.fmsDetailAjaxArea.uploadArea .ajaxItem .fmsUpload').addClass('open').removeClass('active');

            // 20200129 wade
            // $('.new_files_form').hide();
        }, 400)

        $('.editorBody').scrollbar();


    });

    // FMS打開新增資料夾畫面 #adam //wade
    fms.on('click', '.fms_bulider_new', function() {
        var _this = $(this);
        var _area = $('input.fileAreaSupportSet');
        var _area_zero = _area.data('type');
        var _area_first = _area.data('first');
        var _area_second = _area.data('second');
        var _area_third = _area.data('third');
        var _area_branch = _area.data('branch');

        console.log(_area_zero, _area_first, _area_second, _area_third, );

        var level = 0;
        var now_id = 0;

        if (_area_first != 0) {
            level = 1;
            now_id = _area_first;
        } else if (_area_second != 0) {
            level = 2;
            now_id = _area_second;
        } else if (_area_third != 0) {
            level = 3;
            now_id = _area_third;
        } else {
            level = 0;
            now_id = _area_zero;
        }

        if (_this.hasClass('clicked')) {
            return false;
        } else {
            _this.addClass('clicked');

            $.ajax({
                    url: $('.base-url').val() + '/Ajax/folder-add/' + level + '/' + now_id,
                    type: 'GET',
                })
                .done(function(data) {

                    $('.fmsDetailAjaxArea.uploadArea .ajaxItem .fmsFolder_add').html(data);

                    $('.fmsDetailAjaxArea.uploadArea').addClass('active');
                    $('.fmsDetailAjaxArea.uploadArea .ajaxItem').addClass('active');
                    $('.fmsDetailAjaxArea.uploadArea .ajaxItem .fmsFolder_add').addClass('active');

                    setTimeout(function() {
                        $('.fmsDetailAjaxArea.uploadArea').addClass('open').removeClass('active');
                        $('.fmsDetailAjaxArea.uploadArea .ajaxItem').addClass('open').removeClass('active');
                        $('.fmsDetailAjaxArea.uploadArea .ajaxItem .fmsFolder_add').addClass('open').removeClass('active');
                    }, 400)

                    $('.editorBody').scrollbar();


                    // $('.fmsUpload,.fmsUpload_ing,.fmsUpload_done').hide();
                    // $('.locale_folder_new,.locale_folder_name,.locale_file_edit').hide();
                    // $('.fmsFolder_add').show().addClass('active');

                    close_wrapper();
                    quill_select();
                    filePathSelect();
                    _this.removeClass('clicked');

                    $('input[name="fms[folder_level]"]').val(level)
                    $('input[name="fms[folder_id]"]').val(now_id)

                })
                .fail(function() {
                    console.log("fms_bulider_new error");
                })
        }
    });

    //FMS 新增資料夾 wade
    fms.on('click', '.fms_bulider_name', function() {

        $('.fmsDetailAjaxArea.uploadArea').addClass('open');

        // 20200129 wade
        // $('.fmsUpload,.fmsUpload_ing,.fmsUpload_done').hide();
        // $('.locale_folder_new').hide();
        // $('.locale_folder_name').show();

        var newName = $('.open2>a .title').html();
        $('input[name="nameFolder"]').val(newName);
    });

    //#FMS打開內容視窗#adam //wade
    fms.on('click', '.open_fms_detail', function() {

        var _this = $(this),
            _this_id = _this.parents('.fms_list').find('input').data('id');
        if (_this.hasClass('clicked')) {
            return false;
        } else {
            _this.addClass('clicked');

            $.ajax({
                    url: $('.base-url').val() + '/Ajax/file-detail/' + _this_id,
                    type: 'GET',
                })
                .done(function(data) {
                    if (data == 0) {
                        alert('檔案不存在');
                    } else {
                        $('.fmsDetailAjaxArea.uploadArea .ajaxItem .fmsDetail').html(data);

                        $('.fmsDetailAjaxArea.uploadArea').addClass('active');
                        $('.fmsDetailAjaxArea.uploadArea .ajaxItem').addClass('active');
                        $('.fmsDetailAjaxArea.uploadArea .ajaxItem .fmsDetail').addClass('active');

                        setTimeout(function() {
                            $('.fmsDetailAjaxArea.uploadArea').addClass('open').removeClass('active');
                            $('.fmsDetailAjaxArea.uploadArea .ajaxItem').addClass('open').removeClass('active');
                            $('.fmsDetailAjaxArea.uploadArea .ajaxItem .fmsDetail').addClass('open').removeClass('active');
                        }, 400)

                        $('.editorBody').scrollbar();

                        // 20200129 wade
                        // $('.fmsUpload,.fmsUpload_ing,.fmsUpload_done').hide();
                        // $('.locale_folder_new,.locale_folder_name,.locale_file_edit').hide();
                        // $('.fmsDetail').show().addClass('active');
                    }
                    close_wrapper();
                    _this.removeClass('clicked');
                })
                .fail(function() {
                    console.log("open_fms_detail error");
                })
        }

    });


    //FMS編輯檔案 wade
    fms.on('click', '.open_file_edit', function() {
        var _this = $(this),
            _this_id = _this.parents('.fms_list').find('input').data('id');

        if (_this_id == undefined) {
            _this_id = $('input[name="for_edit_id"]').val();
        }
        if (_this.hasClass('clicked')) {
            return false;
        } else {
            _this.addClass('clicked');

            $.ajax({
                    url: $('.base-url').val() + '/Ajax/file-edit/' + _this_id,
                    type: 'GET',
                })
                .done(function(data) {
                    if (data == 0) {
                        alert('檔案不存在');
                    } else if (data == 'not_user') {
                        alert('失敗\n您沒有權限編輯該檔案');
                    } else {
                        $('.fmsDetailAjaxArea.uploadArea .ajaxItem .fmsDetail_edit').html(data);
                        $('.fmsDetailAjaxArea.uploadArea .ajaxItem .fmsDetail').removeClass('open');
                        $('.fmsDetailAjaxArea.uploadArea .ajaxItem .fmsDetail').empty();

                        $('.fmsDetailAjaxArea.uploadArea').addClass('active');
                        $('.fmsDetailAjaxArea.uploadArea .ajaxItem').addClass('active');
                        $('.fmsDetailAjaxArea.uploadArea .ajaxItem .fmsDetail_edit').addClass('active');

                        setTimeout(function() {
                            $('.fmsDetailAjaxArea.uploadArea').addClass('open').removeClass('active');
                            $('.fmsDetailAjaxArea.uploadArea .ajaxItem').addClass('open').removeClass('active');
                            $('.fmsDetailAjaxArea.uploadArea .ajaxItem .fmsDetail_edit').addClass('open').removeClass('active');
                        }, 400)

                        $('.editorBody').scrollbar();


                        // 20200129 wade
                        $('input[name="fms[edit_id]"]').val(_this_id);
                        // $('.fmsUpload,.fmsUpload_ing,.fmsUpload_done').hide();
                        // $('.locale_folder_new,.locale_folder_name,.locale_file_edit').hide();
                        // $('.fmsDetail_edit').show().addClass('active');
                        // $('.fmsDetail.active').hide()
                    }
                    close_wrapper();
                    filePathSelect();
                    quill_select();
                    _this.removeClass('clicked');
                })
                .fail(function() {
                    console.log("open_file_edit error");
                })
        }

    })

    //FMS檢視資料夾詳細內容//wade
    fms.on('click', '.open_folder_detail', function() {
        var _this = $(this);
        var _this_id = _this.parents('.fms_list_folder_btn').data('id');

        if (_this.parents('.fms_list_folder_btn').hasClass('second')) {
            var _this_folder = 2;
        } else if (_this.parents('.fms_list_folder_btn').hasClass('third')) {
            var _this_folder = 3;
        } else {
            var _this_folder = 1; //第一層資料夾, 也許以後會用到? 
        }

        if (_this.hasClass('clicked')) {
            return false;
        } else {
            _this.addClass('clicked');

            $.ajax({
                    url: $('.base-url').val() + '/Ajax/folder-detail/' + _this_folder + '/' + _this_id,
                    type: 'GET',
                })
                .done(function(data) {
                    if (data == 0) {
                        alert('資料夾不存在');
                    } else {
                        $('.fmsDetailAjaxArea.uploadArea .ajaxItem .fmsFolderDetail').html(data);

                        $('.fmsDetailAjaxArea.uploadArea').addClass('active');
                        $('.fmsDetailAjaxArea.uploadArea .ajaxItem').addClass('active');
                        $('.fmsDetailAjaxArea.uploadArea .ajaxItem .fmsFolderDetail').addClass('active');

                        setTimeout(function() {
                            $('.fmsDetailAjaxArea.uploadArea').addClass('open').removeClass('active');
                            $('.fmsDetailAjaxArea.uploadArea .ajaxItem').addClass('open').removeClass('active');
                            $('.fmsDetailAjaxArea.uploadArea .ajaxItem .fmsFolderDetail').addClass('open').removeClass('active');
                        }, 400)

                        $('.editorBody').scrollbar();


                        // 20200129 wade
                        // $('.fmsUpload,.fmsUpload_ing,.fmsUpload_done').hide();
                        // $('.locale_folder_new,.locale_folder_name').hide();
                        // $('.fmsFolder_add').show().addClass('active');
                    }
                    close_wrapper();
                    filePathSelect();
                    quill_select();
                    _this.removeClass('clicked');
                })
                .fail(function() {
                    console.log("open_folder_detail error");
                })
        }

    })

    //FMS編輯資料夾 wade
    fms.on('click', '.open_folder_edit', function() {
        var _this = $(this);
        var _this_id = _this.parents('.fms_list_folder_btn').data('id');

        if (_this.parents('.fms_list_folder_btn').hasClass('second')) {
            var _this_folder = 2;
        } else if (_this.parents('.fms_list_folder_btn').hasClass('third')) {
            var _this_folder = 3;
        } else {
            var _this_folder = 1; //第一層資料夾, 也許以後會用到? 
        }

        if (_this_id == undefined) {
            var _this_id = $('input[name="for_edit_id"]').val();
            var _this_folder = $('input[name="for_edit_folder_level"]').val();
        }

        if (_this.hasClass('clicked')) {
            return false;
        } else {
            _this.addClass('clicked');

            $.ajax({
                    url: $('.base-url').val() + '/Ajax/folder-edit/' + _this_folder + '/' + _this_id,
                    type: 'GET',
                })
                .done(function(data) {
                    if (data == 0) {
                        alert('資料夾不存在');
                    } else if (data == 'not_user') {
                        alert('開啟失敗\n您沒有權限編輯該檔案');
                    } else {
                        $('.fmsDetailAjaxArea.uploadArea .ajaxItem .fmsFolder_edit').html(data);
                        $('.fmsDetailAjaxArea.uploadArea .ajaxItem .fmsFolderDetail').removeClass('open');
                        $('.fmsDetailAjaxArea.uploadArea .ajaxItem .fmsFolderDetail').empty();


                        $('.fmsDetailAjaxArea.uploadArea').addClass('active');
                        $('.fmsDetailAjaxArea.uploadArea .ajaxItem').addClass('active');
                        $('.fmsDetailAjaxArea.uploadArea .ajaxItem .fmsFolder_edit').addClass('active');

                        setTimeout(function() {
                            $('.fmsDetailAjaxArea.uploadArea').addClass('open').removeClass('active');
                            $('.fmsDetailAjaxArea.uploadArea .ajaxItem').addClass('open').removeClass('active');
                            $('.fmsDetailAjaxArea.uploadArea .ajaxItem .fmsFolder_edit').addClass('open').removeClass('active');
                        }, 400)

                        $('.editorBody').scrollbar();


                        // 20200129 wade
                        // $('.fmsFolder_add').hide()
                        // $('.fmsUpload,.fmsUpload_ing,.fmsUpload_done').hide();
                        // $('.locale_folder_new,.locale_folder_name,.locale_file_edit').hide();
                        // $('.fmsFolder_edit').show().addClass('active');

                    }
                    close_wrapper();
                    filePathSelect();
                    quill_select();
                    _this.removeClass('clicked');
                })
                .fail(function() {
                    console.log("open_folder_edit error");
                })
        }

    })
};

//中間主區塊 列表項點擊 關閉右邊滑動隱藏區塊
function close_wrapper() {

    // cms關閉按鈕 //wade
    $('.cms_theme .cms_hiddenArea.cmsDetailAjaxArea').on('click', '.close_btn', function() {

        $('.cms_theme .cms_hiddenArea.cmsDetailAjaxArea .ajaxItem').addClass('remove');

        setTimeout(function() {
            $('.cms_theme .cms_hiddenArea.cmsDetailAjaxArea .ajaxItem').removeClass('open remove');
            $('.cms_theme .cms_hiddenArea.cmsDetailAjaxArea').addClass('remove');
        }, 500);

        setTimeout(function() {
            $('.cms_theme .cms_hiddenArea.cmsDetailAjaxArea').removeClass('open remove');
            $('.editContentFormArea form:nth-child(n+2)').empty();
            $('.editFormName').text('-');
            $('ul.editContentMenu').children('li').removeClass('opened');
            $('ul.editContentMenu').children('li').removeClass('active');
            $('ul.editContentMenu').children('li').removeClass('wait-sent');
            $('ul.editContentMenu').children('li').removeClass('clicked');
            $('.dataEditTitle').text('');
            $('.editContentArea').data('id', '');
            $('.editContentArea').data('model', '');
            $('.editContentArea').attr('data-mod', '');
            $('.sp-container').remove();
            $('li.cms-delete-btn').attr('data-id', '0');
        }, 950)

    });

    // fms關閉按鈕 //wade
    $('.fms_theme .ajaxContainer').on('click', '.close_btn', function() {
        // $(this).parents('form').removeClass('active');
        // $('.fmsDetailAjaxArea.uploadArea').removeClass('open');

        $('.fmsDetailAjaxArea.uploadArea .ajaxItem').addClass('remove');
        $('.fmsDetailAjaxArea.uploadArea .ajaxItem .ajaxContainer').addClass('remove');

        setTimeout(function() {
            $('.fmsDetailAjaxArea.uploadArea .ajaxItem').removeClass('open remove');
            $('.fmsDetailAjaxArea.uploadArea .ajaxItem .ajaxContainer').removeClass('open remove');
            $('.fmsDetailAjaxArea.uploadArea').addClass('remove');

        }, 500)

        setTimeout(function() {
            $('.fmsDetailAjaxArea.uploadArea').removeClass('open remove');
        }, 650)

        if (!$('.ajaxContainer').hasClass('fmsUpload') && !$('.ajaxContainer').hasClass('fmsUpload_ing') && !$('.ajaxContainer').hasClass('fmsUpload_done')) {
            $('.fmsDetailAjaxArea.uploadArea .ajaxItem .ajaxContainer').empty();
        }
    });
    // end wade


    var object2 = $('.inforArea');
    var close_btn2 = $('.inforArea_frame .close_btn');
    close_btn2.click(function() {
        $(this).parents('form').removeClass('active');
        object2.removeClass('open');
    });

    //FMS右側開啟的區塊
    var object_fms = $('.fms_hiddenArea');
    var close_btn_fms = $('.fileDetail_frame .close_btn');
    close_btn_fms.click(function() {
        $(this).parents('form').removeClass('active');
        object_fms.removeClass('open');
    });

}

//創立一筆新資料
function sentFormDateByCreate() {
    var model_name = $('.editContentArea').data('model');
    //var auth = checkUserSessionIsActiveOrNot();
    //if(auth == 'true')
    //{
    $.ajax({
            url: $('.base-url').val() + '/Ajax/add-new/' + model_name,
            type: 'GET',
            // dataType: 'html',
        })
        .done(function(data) {
            // var response = JSON.parse(data);
            $('.editTypeTitle').text('Edit 編輯資訊');
            $('.editContentArea').data('id', data.id);
            $('.editContentDataId').val(data.id);
            $('li.cms-delete-btn').css('display', '');
            $('li.cms-delete-btn').attr('data-id', data.id);
            $('.editContentArea').attr('data-mod', 'update');
            checkFormSendorNot();
        })
        .fail(function() {
            console.log("create new data error");
        })
        //}
}

//儲存Data
function sendFormDataTo($type, $form_name) {
    //var auth = checkUserSessionIsActiveOrNot();
    //if(auth == 'true')
    //{	
    var form = document.getElementById($form_name);
    var ajax = new XMLHttpRequest();

    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var response = JSON.parse(ajax.responseText);

            if (response.result == true) {
                $('ul.editContentMenu').children('li.wait-sent').each(function() {
                    // 移除此次儲存form #adam
                    if ($(this).data('form') == $form_name) {
                        $(this).removeClass('wait-sent');
                    }
                });

                if (typeof response.change_id !== "undefined") {

                    for (var i = 0; i < response.change_id.length; i++) {
                        // 儲存完第二層資料把id塞回去#adam
                        $('.cms_new_' + response.change_id[i]['key']).attr('value', response.change_id[i]['id']);
                        $('.cms_new_' + response.change_id[i]['key']).attr('data-id', response.change_id[i]['id']);

                        if (response.change_id[i].hasOwnProperty('son')) {
                            for (var j = 0; j < response.change_id[i]['son'].length; j++) {
                                // 儲存完第三層資料把id,rank,secondid塞回去#adam
                                $('.cms_new_' + response.change_id[i]['key']).find('.quill_partImg li').eq(j).attr('partimg-id', response.change_id[i]['son'][j]);
                                $('.cms_new_' + response.change_id[i]['key']).find('.quill_partImg li').eq(j).find('input.addThirdId').val(response.change_id[i]['son'][j]);
                                $('.cms_new_' + response.change_id[i]['key']).find('.quill_partImg li').eq(j).find('.deleteThirdTableData').attr('data-id', response.change_id[i]['son'][j]);
                                $('.cms_new_' + response.change_id[i]['key']).find('.quill_partImg li').eq(j).find('input.addThirdSid').val(response.change_id[i]['id']);
                            }
                        }
                    }
                }
                //再次確認form是否已經送過			    
                checkFormSendorNot();
            }
        }
    };
    ajax.open("POST", $('.base-url').val() + '/Ajax/' + $type, true);
    ajax.send(new FormData(form));
    //}

};

//確認此form是否已經送過
function checkFormSendorNot() {
    var form_array = [];
    // 判斷有多少form要送#adam
    $('ul.editContentMenu').children('li.wait-sent').each(function() {
        form_array.push($(this).data('form'));
    });

    if (form_array.length > 0) {
        var mod = $('.editContentArea').attr('data-mod');
        var form_name = form_array[0];
        sendFormDataTo(mod, form_name);
    } else {
        if ($('.cms-index_table').length != 0) {
            datatableReset();
        }
        $('.block_out').removeClass('show');
        $('ul.editContentMenu').children('li.active').addClass('wait-sent');
    }
};

//搜尋
function sendSearch() {

    var main_div = $('.index-table-div');
    main_div.children('input.searchRulesSet[data-type!="sort"]').remove();

    $.each($('#searchForm li.card_search_input'), function() {
        var search_type = $(this).data('search_type'),
            search_field = $(this).data('search_field'),
            search_value;

        switch (search_type) {
            case 'text':
            case 'datePicker':
            case 'single_select':
                search_value = $("[name='search_" + search_field + "']").val();
                break;
            case 'radio':
                search_value = $(this).children('div.inner').children('div.ios_switch.radio_btn_switch').hasClass('on') ? 't' : 'f';
                break;
            case 'dateRange':
                search_value = $(this).find('input').eq(0).val() + ',' + $(this).find('input').eq(1).val();
                break;
            default:
                search_value = '';
                break;
        }

        if (search_field != '' && search_value != '') {
            main_div.prepend('<input type="hidden" class="searchRulesSet" data-type="' + search_type + '" data-name="' + search_field + '" data-value="' + search_value + '">');
        }
    });

    datatableReset();
    $('.cms_hiddenArea .hiddenArea_frame .close_btn').click();
    temp_loading();
}

// 刪除單筆資料 #adam
function deleteDataByModelAndId(id_array, model_name, btn_class) {
    var r = confirm("是否決定刪除資料？");
    if (r == true) {
        $.ajax({
                url: $('.base-url').val() + '/Ajax/delete-array/' + model_name,
                type: 'GET',
                data: {
                    ids: id_array
                }
            })
            .done(function(data) {

                datatableReset();
                $(btn_class).removeClass('clicked');
                $('.block_out').removeClass('show');
                $('.hiddenArea_frame .close_btn').click();

            })
            .fail(function() {
                console.log("delete data error");
            })
    } else {
        $(btn_class).removeClass('clicked');
        $('.block_out').removeClass('show');
    }
};

// 刪除多筆資料 #adam
function deleteTableDataByModelAndId(id_array, model_name, btn_class) {
    $.ajax({
            url: $('.base-url').val() + '/Ajax/delete-array/' + model_name,
            type: 'GET',
            data: {
                ids: id_array
            }
        })
        .done(function(data) {
            datatableReset();
            $(btn_class).removeClass('clicked');
            $('.block_out').removeClass('show');
        })
        .fail(function() {
            console.log("delete data error");
        })
};

//複製data
function cloneDataByModelAndId(id_array, model_name, btn_class) {
    var r = confirm("是否決定複製資料？");
    if (r == true) {
        $.ajax({
                url: $('.base-url').val() + '/Ajax/clone-array/' + model_name,
                type: 'GET',
                data: {
                    clone_id: id_array
                }
            })
            .done(function(data) {
                datatableReset();
                $(btn_class).removeClass('clicked');
                $('.block_out').removeClass('show');
                $('.hiddenArea_frame .close_btn').click();
            })
            .fail(function() {
                console.log("clone data error");
            })
    } else {
        $(btn_class).removeClass('clicked');
        $('.block_out').removeClass('show');
    }
};

//舊的 狀態列radio按鈕直接更新資料 應該用不到惹 #adam
function re_switch_ajax() {

    $('ul.radio_group').on('click', 'li', function() {
        var _this = $(this),
            _this_model = _this.data('model'),
            _this_column = _this.data('column'),
            _this_id = _this.data('id');

        if (_this.hasClass('clicked')) {
            return false;
        } else {
            _this_value = _this.hasClass('ch') ? 0 : 1;
            // var auth = checkUserSessionIsActiveOrNot();
            // if(auth == 'true'){
            $.ajax({
                    url: $('.base-url').val() + '/Ajax/radio-switch/' + _this_model + '/' + _this_id,
                    type: 'GET',
                    data: {
                        column: _this_column,
                        item: _this_value
                    },
                })
                .done(function(data) {
                    if (data.result == true) {
                        _this.toggleClass('ch');
                    } else if (data.result == false) {
                        // alert(data.error_msg);
                    }
                })
                .fail(function() {
                    console.log("radio switch error");
                })
                // }
        }

    });
}

//狀態列radio按鈕直接更新資料 #adam
function re_switch_ajax_new() {
    $('body').on('click', 'label.reSwitchBtn', function() {

        var _this = $(this);
        var _this_model = _this.data('model');
        var _this_column = _this.data('column');
        var _this_id = _this.data('id');
        var btnstate = _this.find('input').prop('checked');

        if (_this.hasClass('clicked')) {
            return false;
        } else {
            _this.addClass('clicked')
            var _this_value = btnstate ? 0 : 1
                // var auth = checkUserSessionIsActiveOrNot();
                // if(auth == 'true'){
            $.ajax({
                    url: $('.base-url').val() + '/Ajax/radio-switch/' + _this_model + '/' + _this_id,
                    type: 'GET',
                    data: {
                        column: _this_column,
                        item: _this_value
                    },
                })
                .done(function(data) {
                    if (data.result == true) {

                        if (btnstate) {
                            _this.find('input').prop('checked', false)
                        } else {
                            _this.find('input').prop('checked', true)
                        }

                    } else if (data.result == false) {
                        // alert(data.error_msg);
                    }
                })
                .fail(function() {
                    console.log("radio switch error");
                })
                // }

            setTimeout(() => {
                _this.removeClass('clicked')
            }, 0);
        }
    })
}

//DataTable Reset
function datatableReset() {
    var _table = $('.cms-index_table'),
        _table_model = _table.data('model'),
        _table_page = _table.data('page'),
        _table_edit = _table.data('edit'),
        _table_delete = _table.data('delete'),
        _table_create = _table.data('create'),
        _table_key = $('.editContentArea').data('page'),
        _table_route = $('.editContentArea').data('route'),
        _table_search = {};

    _table_auth = _table.data('auth'),
        _table_pagetitle = _table.data('pagetitle'),

        /*串搜尋條件*/
        $.each($('input.searchRulesSet'), function() {
            _table_search[$(this).data('name')] = {
                'type': $(this).data('type'),
                'value': $(this).data('value')
            };

        });

    _table_search = JSON.stringify(_table_search); //轉成json字串

    //var auth = checkUserSessionIsActiveOrNot();
    //if(auth == 'true')
    //{
    $.ajax({
            url: $('.base-url').val() + '/Ajax/table-reset/' + _table_model + '/' + _table_page,
            type: 'GET',
            data: {
                _table_edit: _table_edit,
                _table_delete: _table_delete,
                _table_create: _table_create,
                _table_key: _table_key,
                _table_route: _table_route,
                _table_search: _table_search,
                _table_auth: _table_auth,
                _table_pagetitle: _table_pagetitle,
            }
        })
        .done(function(data) {
            $('.index-table-div').empty();
            $('.index-table-div').append(data.view);
            card_table($('.main-table').attr('data-tableID'));

            $('.datatable .tables thead').on('click', '.fake-th', function() {
                $(this).toggleClass('active');
            })
            $('.content-scrollbox').scrollbar({})

            //匯出加上條件
				bf_href = $('.ExportBtn').attr('href');
				new_href = bf_href + '?search=' + _table_search;
				// console.log(new_href);

				$('.ExportBtnSrh').attr('href', new_href);
				$('.ExportBtnSrh').attr('target', '_blank');
        })
        .fail(function() {
            console.log("DataTable Reset error");
        })
        //}
};

// 看起來像判斷後台帳戶有效性(?) #adam
function checkUserSessionIsActiveOrNot(callback) {
    var responseData = "no";
    $.ajax({
            url: $('.base-url').val() + "/Ajax/check-auth",
            type: 'GET',
        })
        .done(function(data) {
            // var response = JSON.parse(data);
            if (data.user == '0') {
                alert('帳號時效已過,請重新登入');
                window.location.href = $('.base-url-plus').val() + '/Fantasy';
            } else {
                responseData = "yes";
            }
        })
    return responseData;
}

// 後台表單驗證測試 #adam
function form_valid(element) {
    _form = element.data('form')
    _target = document.getElementById(_form);

    $(_target).validate({
        onsubmit: false,
        onkeyup: function(e) {
            $(e).valid();
        },
    })
}

//表頭上下箭頭排序 #adam
$('body').on('click', '.theadSortBtn', function() {

    var search_column = $(this).data('column')

    var main_div = $('.index-table-div');
    // 移除原排序條件 #adam
    main_div.children('input.searchRulesSet[data-type="sort"]').remove();

    // 從小排到大#adam
    if ($(this).parent().hasClass('active')) {
        main_div.find('.cms-index_table').before('<input type="hidden" class="searchRulesSet" data-type="sort" data-name="' + search_column + '" data-value="asc">');
        $(this).parent().removeClass('active')
    }
    // 從大排到小#adam
    else {
        main_div.find('.cms-index_table').before('<input type="hidden" class="searchRulesSet" data-type="sort" data-name="' + search_column + '" data-value="desc">');
        $(this).parent().addClass('active')
    }
    // datatable refresh #adam
    datatableReset();
});

// 快速搜尋 #adam
$('body').on('click', '.quickSearchBtn', function() {
    // 要快速搜尋的值 #adam
    var search_value = $(this).siblings('input').val();
    // 要快速搜尋的欄位 #adam
    var search_field = $(this).parent().data('quick');

    if (search_value != '') {
        var main_div = $('.index-table-div');
        main_div.children('input.searchRulesSet[data-type!="sort"]').remove();
        main_div.prepend('<input type="hidden" class="searchRulesSet" data-type="qtext" data-name="qs_' + search_field + '" data-value="' + search_value + '">');

        // datatable refresh #adam
        datatableReset();
    }

});
// 在快速搜尋欄位按Enter送出 #adam
$('body').on("keydown", '.search-data.active', function(e) {
    if (e.which == 13) {
        $('.quickSearchBtn').first().click();
    }
});

//點全選 全部打勾 #adam
$('body').on('click', '.check-circle.icon-check:first', function() {
    // 第一個input #adam
    var allBtn = $(this)
        // 是否已全選 #adam
    var isAll = $(this).siblings().prop('checked')

    if (isAll) {
        // 取消全選 #adam
        $('.check-circle.icon-check:gt(0)').siblings('input').prop('checked', false)
    } else {
        // 全選 #adam
        $('.check-circle.icon-check:gt(0)').siblings('input').prop('checked', true)
    }
})

//點選其中一個input 取消全選 #adam
$('body').on('click', '.check-circle.icon-check:gt(0)', function() {

    var thisBtn = $(this)
    var btnState = $(this).siblings().prop('checked')
    var isAll = $('.check-circle.icon-check:first').siblings('input').prop('checked')

    // 若是已勾選狀態 && 全選狀態　-> 取消全選 #adam
    if (btnState && isAll) {
        $('.check-circle.icon-check:first').siblings('input').prop('checked', false)
    }
})

// CMS存檔按鈕
$('.editContentArea').on('click', '.editSentBtn', function() {
    var _this = $(this),
        mod = $('.editContentArea').attr('data-mod');

    if (_this.hasClass('clicked')) {
        return false;
    } else {
        $('ul.editContentMenu').children('li.wait-sent').each(function() {
            var _this_form = $(this).data('form');
            var _real_form = document.getElementById(_this_form);
            var _side_form = $('li[data-form="' + _this_form + '"]');

            // if (!$(_real_form).valid()){
            // 	_side_form.click();
            // 	var _side_form_name = _side_form.find('p').html();
            // 	alert(_side_form_name + ' 中尚有欄位錯誤。')
            // 	return;
            // }

        });

        $('.block_out').addClass('show');
        // 更新
        if (mod == 'update') {
            checkFormSendorNot();
        }
        // 建新資料
        else if (mod == 'create') {

            sentFormDateByCreate();
        }
        // 搜尋
        else if (mod == 'search') {
            sendSearch();
        }
    }
});

// cms編輯裡面的側邊欄的側邊，第一筆是搜尋，所以點了無功能
$('ul.editContentMenu li:nth-child(n+2)').on('click', function() {
    $('form').fadeOut();
    var _this = $(this),
        model_name = $('.editContentArea').data('model'),
        now_id = $('.editContentArea').data('id'),
        page = $('.editContentArea').data('page'),
        need_review = $('.editContentArea').data('need_review'),
        can_review = $('.editContentArea').data('can_review'),
        _this_content = _this.data('form'),
        view_route = _this.parent('ul').data('route');

    if (!_this.hasClass('clicked')) {
        _this.addClass('clicked');
        if (_this.hasClass('opened')) {
            $('.backEnd_quill').css('display', 'none');
            _this.addClass('wait-sent');
            $('form[id="' + _this_content + '"]').children('.backEnd_quill').css('display', '');
            // $('form[id="' + _this_content + '"]').show().css('opacity', '1');
            $('form[id="' + _this_content + '"]').fadeIn();
            _this.removeClass('clicked');
            components.select2($(".____select2"));
        } else {
            //var authSession = checkUserSessionIsActiveOrNot();
            //if(authSession == 'yes')
            //{
            $('#searchForm').css('display', 'none'); //隱藏搜尋的form
            $.ajax({
                    url: $('.base-url').val() + '/Ajax/edit-content/' + model_name + '/' + now_id,
                    type: 'GET',
                    // dataType: 'html',
                    data: {
                        form: _this_content,
                        route: view_route,
                        page: page,
                        need_review: need_review,
                        can_review: can_review,
                    },
                })
                .done(function(data) {
                    // var response = JSON.parse(data);
                    _this.addClass('opened');
                    _this.addClass('wait-sent');
                    $('.backEnd_quill').css('display', 'none');
                    $('form[id="' + _this_content + '"]').append(data.view);
                    $('form[id="' + _this_content + '"]').append('<input type="hidden" value="' + page + '" name="page">');
                    $('form[id="' + _this_content + '"]').children('.backEnd_quill').css('display', '');
                    $('form[id="' + _this_content + '"]').fadeIn();
                    quill_select();
                    wade_datepicker();
                    baseContentEdit_color_picker();
                    _this.removeClass('clicked');
                    item_file_detail('file_detail_btn');
                    baseContentEdit_color_picker();
                    // btn_db_lightbox();

                    $('.summernote').summernote();
                    components.select2($(".____select2"));

                    // components.loaded($('form[id="' + _this_content + '"]'))
                    // form_valid(_this);

                })
                .fail(function() {
                    console.log("edit Content Menu error");
                })
                //}
        }
        $('ul.editContentMenu').children('li').removeClass('active');
        _this.addClass('active');
        $('.editFormName').text(_this.text());

    }
    $('.editorContent.editContentFormArea.scroll-content.scroll-scrolly_visible').animate({
        scrollTop: 0
    }, 333);
});

//清單選取方塊的selected
$('body').on('click', '.input_number', function() {
    $(this).closest('td').toggleClass('selected');
});

// cms index 上方刪除按鈕
$('body').on('click', '.remove-data-btn', function() {
    var _this = $(this),
        model_name = _this.data('model'),
        id_array = [],
        btn_class = '.remove-data-btn';

    if (_this.hasClass('clicked')) {
        return false;
    } else {
        _this.addClass('clicked');

        $('.check-circle.icon-check:gt(0)').each(function() {
            if ($(this).siblings('input').prop('checked') == true) {
                id_array.push($(this).siblings('input').data('id'));
            }
        })

        if (id_array.length > 0) {
            $('.block_out').addClass('show');
            deleteDataByModelAndId(id_array, model_name, btn_class);
        } else {
            _this.removeClass('clicked');
        }

        if ($('.cms-index_table').length != 0) {
            datatableReset();
        }
    }
});

// 在編輯畫面刪除檔案 #adam
$('body').on('click', 'li.cms-delete-btn', function() {
    var _this = $(this),
        _this_id = _this.data('id'),
        id_array = [],
        model_name = $('.remove-data-btn').data('model'),
        _btn_class = '.cms-delete-btn';

    if (_this.hasClass('clicked')) {
        return false;
    } else {
        _this.addClass('clicked');

        id_array.push(_this_id);

        if (id_array.length > 0) {
            $('.block_out').addClass('show');
            deleteDataByModelAndId(id_array, model_name, _btn_class);
        } else {
            _this.removeClass('clicked');
        }
    }
});

// cms index 上方複製按鈕
$('body').on('click', '.cloneBtn', function() {
    var _this = $(this),
        model_name = _this.data('model'),
        id_array = [],
        btn_class = '.cloneBtn';

    if (_this.hasClass('clicked')) {
        return false;
    } else {
        _this.addClass('clicked');

        $('.check-circle.icon-check:gt(0)').each(function() {
            if ($(this).siblings('input').prop('checked') == true) {
                id_array.push($(this).siblings('input').data('id'));
            }
        })

        if (id_array.length > 0) {
            $('.block_out').addClass('show');
            cloneDataByModelAndId(id_array, model_name, btn_class);
        } else {
            _this.removeClass('clicked');
        }

        if ($('.cms-index_table').length != 0) {
            datatableReset();
        }
    }
});

//頁碼切換 #adam
$('body').on('click', '.pn_btn', function() {

    var _this = $(this),
        _this_type = _this.data('type'),
        _table_page = $('.cms-index_table').data('page');

    // 上一頁 #adam
    if (_this_type == 'last') {
        _table_page = _table_page - 1;
    }
    // 上十頁 #adam
    else if (_this_type == 'last10') {
        _table_page = _table_page - 10;
    }
    // 下一頁 #adam
    else if (_this_type == 'next') {
        _table_page = _table_page + 1;
    }
    // 下十頁 #adam
    else if (_this_type == 'next10') {
        _table_page = _table_page + 10;
    }
    // 特定頁數 #adam
    else if (_this_type == 'page') {
        _table_page = _this.data('page');
    }
    $('.cms-index_table').data('page', _table_page);
    datatableReset();
});


// --------------以下為FMS燈箱事件--------------
//打開Fms燈箱(open_fms_lightbox)
function btn_fms_lightbox() {

    var open_btn = $('.open_fms_lightbox'),
        sup_input = $('input.fileAreaSupportSet'),
        lbox_frame = $('.fms_lbox');

    $('body').on('click', '.lbox_fms_open', function() {
        var _this_type = $(this).attr('data-type'),
            _this_key = $(this).attr('data-key'),
            _this_input = 'input.value_' + _this_key;
        var _this_value = $(_this_input).val() != '' ? $(_this_input).val() : '0';

        var pre_level0 = ($(this).data('l0') != undefined) ? $(this).data('l0') : $('body').attr('data-l0')
        var pre_level1 = ($(this).data('l1') != undefined) ? $(this).data('l1') : $('body').attr('data-l1')
        var pre_level2 = ($(this).data('l2') != undefined) ? $(this).data('l2') : $('body').attr('data-l2')
        var pre_level3 = ($(this).data('l3') != undefined) ? $(this).data('l3') : $('body').attr('data-l3')
        var pre_ltyle = $('body').attr('data-ltype')
        var pre_lmode = $('body').attr('data-lmode')
        var pre_s0 = ($(this).data('s0') != undefined) ? $(this).data('s0') : $('body').attr('data-s0')
        var pre_s1 = ($(this).data('s1') != undefined) ? $(this).data('s1') : $('body').attr('data-s1')
        var pre_s2 = ($(this).data('s2') != undefined) ? $(this).data('s2') : $('body').attr('data-s2')
        var pre_s3 = ($(this).data('s3') != undefined) ? $(this).data('s3') : $('body').attr('data-s3')

        $(".fms_lbox .frame").first().load($('.base-url').val() + "/Ajax/fms-lbox/" + _this_type + '/' + _this_key + '/' + _this_value, function () {

            //需啟動的JS
            fms_lightbox();

            setTimeout(function() {
                lbox_frame.addClass('go_animation');
                // $('.fms_lbox .content-sidebar .sidebar-menu').scrollbar();
                // content_sidebar();
            }, 1000);

            change_fms_file_sidebar(pre_s0, pre_s1, pre_s2, pre_s3)

            if (pre_level1 != undefined && pre_level2 != undefined && pre_level3 != undefined) {
                switch (pre_lmode) {
                    case 'lt':
                        change_fms_file_lt_table(pre_level0, pre_level1, pre_level2, pre_level3, pre_ltyle)
                        break;
                    case 'lp':
                        change_fms_file_lp_table(pre_level0, pre_level1, pre_level2, pre_level3, pre_ltyle)
                        break;
                    case 'gd':
                        change_fms_file_gd_table(pre_level0, pre_level1, pre_level2, pre_level3, pre_ltyle)
                        break;
                    default:
                        change_fms_file_lp_table(pre_level0, pre_level1, pre_level2, pre_level3, pre_ltyle)
                        break;
                }
            } else {
                change_fms_file_sidebar(pre_s0, 0, 0, 0);
                change_fms_file_lp_table(pre_level0, 0, 0, 0, pre_ltyle);
            }
            setTimeout(function() {
                // change_fms_file_route();
                sup_input.data('zero', pre_level0);
                sup_input.data('first', pre_level1);
                sup_input.data('second', pre_level2);
                sup_input.data('third', pre_level3);
                sup_input.data('type', 1);
            }, 500);

            if (_this_type == 'sontable') {
                sontable_collect_array();
                sontable_select_all_hello();
                $('.fms_select_all_hello').show();
            }
        });

        $('.fmsAjaxArea.fms_lbox').addClass('active');
        $('.fmsAjaxArea.fms_lbox .ajaxItem').addClass('active');
        $('.fmsAjaxArea.fms_lbox .ajaxItem .fms_container ').addClass('active');

        setTimeout(function() {
            $('.fmsAjaxArea.fms_lbox').addClass('open').removeClass('active');
            $('.fmsAjaxArea.fms_lbox .ajaxItem').addClass('open').removeClass('active');
            $('.fmsAjaxArea.fms_lbox .ajaxItem .fms_container ').addClass('open').removeClass('active');
        }, 400)


    });

}

// 打開Fms燈箱要執行的事件
function fms_lightbox() {

    //close_btn
    close_wrapper($('.ajax_fms .hiddenArea'));

    //close_ajax_btn
    close_ajax_btn();

    //dataTable
    card_table('fms_table');

    //view MODE:Grid
    grid_mode();

    //table view mode event
    table_view_mode();

    //open light_box_img 燈箱圖片
    // open_fms_light_box();

    //scroll bar
    // var target = $('.fms_lbox .hiddenArea_frame_box .detailEditor');//wade
    // var target = $('.fms_lbox .detailEditor');//wade

    // target.scrollbar({});//wade
    // $('.uploadArea .hiddenArea_frame_box .detailEditor').scrollbar({});//wade
    // $('.uploadArea .detailEditor').scrollbar({});//wade

}

// 關閉Fms燈箱
function close_ajax_btn() {

    var close_btn = $('.close_ajax_btn'),
        lbox_frame = $('.lbox_frame');

    close_btn.on('click', function() {

        lbox_frame.addClass('remove');

        setTimeout(function() {

            lbox_frame.removeClass('open go_animation remove')
            lbox_frame.find('.ajax_temp').remove();

        }, 1000);

    });

}

// Fms左側選單切換
function fms_lbox_folder_change() {
    var f_btn = '.fms_lbox_folder_btn';

    $('body').on('click', f_btn, function() {

        var _this = $(this);
        var _this_type = _this.data('type');
        var _this_rank = _this.data('folder');
        var _this_title = '';
        var sup_input = $('input.fileAreaSupportSet');

        // 如果已開啟就收合
        if (_this.parent().hasClass('open2')) {

            _this.siblings('.sub-menu').hide();
            _this.parent().removeClass('open2');

        } else {

            var _this_zero = _this.parents('.level-1').find('a').first().data('zero');
            var _this_first = '0';
            var _this_second = '0';
            var _this_third = '0';

            if (_this_rank == 0) {
                $('.level-1.open2').removeClass('open2');
                $('.level-2.open2').removeClass('open2');
                $('.level-3.open2').removeClass('open2');
                $('.level-4.open2').removeClass('open2');
            } else if (_this_rank == 1) {
                _this_first = _this.data('first');
                $('.level-2.open2').removeClass('open2');
                $('.level-3.open2').removeClass('open2');
                $('.level-4.open2').removeClass('open2');
            } else if (_this_rank == 2) {
                _this_second = _this.data('second');
                $('.level-3.open2').removeClass('open2');
                $('.level-4.open2').removeClass('open2');
                // $('li.lv3').removeClass('open2 open active');
            } else if (_this_rank == 3) {
                _this_third = _this.data('third');
                $('.level-4.open2').removeClass('open2');		
            }

            // 目前資料夾 +open
            _this.parent('li').addClass('open2');
            // 同層資料夾 -open
            _this.parent().siblings('li').removeClass('open2');

            // 目前子目錄打開
            _this.siblings('.sub-menu').show();
            // 其他子目錄關閉
            _this.parent().siblings('li').find('.sub-menu').hide();
            _this_title = _this.children('span.title').text();

            sup_input.attr('data-zero', _this_zero);
            sup_input.attr('data-first', _this_first);
            sup_input.attr('data-second', _this_second);
            sup_input.attr('data-third', _this_third);
            sup_input.attr('data-type', _this_type);
            sup_input.data('zero', _this_zero);
            sup_input.data('first', _this_first);
            sup_input.data('second', _this_second);
            sup_input.data('third', _this_third);
            sup_input.data('type', _this_type);

            $('.fms_area_name').html('<span class="icon fa fa-folder"></span>' + _this_title);

            var list_mod = $('.mode_btn.open').attr('mode-id');

            if (list_mod == 'lt_mode') {
                change_fms_file_lt_table(_this_zero, _this_first, _this_second, _this_third, _this_type);
                $('.grid_sort').hide();
            } else if (list_mod == 'lp_mode') {
                change_fms_file_lp_table(_this_zero, _this_first, _this_second, _this_third, _this_type);
                $('.grid_sort').hide();
            } else if (list_mod == 'gd_mode') {
                change_fms_file_gd_table(_this_zero, _this_first, _this_second, _this_third, _this_type);
                $('.grid_sort').show();
                quill_select();
            }

            change_fms_file_route();
        }
    });


    $('.fms_list_folder_btn .tool_ctrl .head_icon')
    $('.fms_list_folder_btn .tool_ctrl .head_img')
    $('.fms_list_folder_btn .tool_ctrl .bold')
    $('.fms_list_folder_btn .img')
    //點列表的資料夾=>點側邊按鈕
    $('body').on('click', '.fms_list_folder_btn .tool_ctrl .head_icon, .fms_list_folder_btn .tool_ctrl .head_img, .fms_list_folder_btn .tool_ctrl .bold, .fms_list_folder_btn .img', function() {
        var _this = $(this).parents('.fms_list_folder_btn');
        var this_id = _this.data('id');

        if (_this.hasClass('first')) {
            $(f_btn).each(function () {
                if ($(this).data('first') == this_id) {
                    $(this).click();
                }
            })
        } else if (_this.hasClass('second')) {
            $(f_btn).each(function() {
                if ($(this).data('second') == this_id) {
                    $(this).click();
                }
            })
        } else if (_this.hasClass('third')) {
            $(f_btn).each(function() {
                if ($(this).data('third') == this_id) {
                    $(this).click();
                }
            })
        }

    })
};

// FMS左側根目錄更換，新版之後應該沒用惹 #adam
function fms_menu_change() {
    var m_btn = '.fms_menu_change';

    $('body').on('click', m_btn, function() {
        var _this = $(this),
            _this_type = _this.data('type'),
            _this_zero = _this.data('id'),
            sup_input = $('input.fileAreaSupportSet'),
            _this_title = _this.children('span.title').text();
        var _this_first = _this_second = _this_third = 0;

        _this.parents('.sub-menu').siblings('.display-title').find('.title').text(_this_title);

        sup_input.attr('data-zero', _this_zero);
        sup_input.attr('data-first', _this_first);
        sup_input.attr('data-second', _this_second);
        sup_input.attr('data-third', _this_third);
        sup_input.attr('data-type', _this_type);
        sup_input.data('zero', _this_zero);
        sup_input.data('first', _this_first);
        sup_input.data('second', _this_second);
        sup_input.data('third', _this_third);
        sup_input.data('type', _this_type);


        var list_mod = $('.mode_btn.open').attr('mode-id');

        if (list_mod == 'lt_mode') {
            change_fms_file_lt_table(_this_zero, _this_first, _this_second, _this_third, _this_type);
            $('.grid_sort').hide();
        } else if (list_mod == 'lp_mode') {
            change_fms_file_lp_table(_this_zero, _this_first, _this_second, _this_third, _this_type);
            $('.grid_sort').hide();
        } else if (list_mod == 'gd_mode') {
            change_fms_file_gd_table(_this_zero, _this_first, _this_second, _this_third, _this_type);
            $('.grid_sort').show();
            quill_select();
        }
        change_fms_file_sidebar(_this_zero, _this_first, _this_second, _this_third);
        change_fms_file_route();
    });
}

// lt_mode
function change_fms_file_lt_table(zero, first, second, third, type) {
    $.ajax({
            url: $('.base-url').val() + "/Ajax/file-lbox-table/lt_mode/" + first + "/" + second + "/" + third + "/" + type + "?zero=" + zero,
            type: 'GET',
        })
        .done(function(data) {
            $('.fms_lt_datatb').empty().append(data);
            var get_type = $('.fms_lbox_current_btn').data('type');
            if (get_type == 'img') {
                one_cls = 'one_shot';
            } else if (get_type == 'file') {
                one_cls = 'one_shot';
            } else {
                one_cls = 'multi_shot';
            }
            $('.fms_lbox_lt_tbody').addClass(one_cls);
            card_table('fms_table');

            var collectArray = $('.fms_lbox_current_btn').attr('data-array');
            if (get_type == 'sontable' && collectArray != undefined) {
                JSON.parse(collectArray).forEach(function(e) {
                    var picc = $('input[data-id=' + e + ']')

                    // if (picc.prop('checked') == false) {
                    picc.prop('checked', true)
                        // }
                })
            }
            $('body').attr('data-l0', zero)
            $('body').attr('data-l1', first)
            $('body').attr('data-l2', second)
            $('body').attr('data-l3', third)
            $('body').attr('data-ltype', type)
            $('body').attr('data-lmode', 'lt')
                // var sidebar_0 = $('.fms_menu_change.active').data('id');
                // var sidebar_1st = $('.fms_lbox .level-1.open a').eq(0).data('first');
                // var sidebar_2nd = $('.fms_lbox .level-2.open2 a').eq(0).data('second');
                // var sidebar_3rd = $('.fms_lbox .level-3.open2 a').eq(0).data('third');
            var sidebar_0 = $('.fms_lbox .level-1.open a').eq(0).data('zero');
            var sidebar_1st = $('.fms_lbox .level-2.open a').eq(0).data('first');
            var sidebar_2nd = $('.fms_lbox .level-3.open2 a').eq(0).data('second');
            var sidebar_3rd = $('.fms_lbox .level-4.open2 a').eq(0).data('third');
            $('body').attr('data-s0', sidebar_0)
            $('body').attr('data-s1', sidebar_1st)
            $('body').attr('data-s2', sidebar_2nd)
            $('body').attr('data-s3', sidebar_3rd)
            if ($('body').hasClass('cms_theme')) {
                $('.fms_lbox .total .num').html('&nbsp;' + $('#countFile').val())
            } else {
                $('.total .num').html('&nbsp;' + $('#countFile').val())
            }
        })
        .fail(function() {
            console.log("ltmode error");
        })
}

// lp_mode
function change_fms_file_lp_table(zero, first, second, third, type) {
    $.ajax({
            url: $('.base-url').val() + "/Ajax/file-lbox-table/lp_mode/" + first + "/" + second + "/" + third + "/" + type + "?zero=" + zero,
            type: 'GET',
        })
        .done(function(data) {
            $('.fms_lp_datatb').empty().append(data);

            var get_type = $('.fms_lbox_current_btn').data('type');
            if (get_type == 'img') {
                one_cls = 'one_shot';
            } else if (get_type == 'file') {
                one_cls = 'one_shot';
            } else {
                one_cls = 'multi_shot';
            }
            $('.fms_lbox_lp_tbody').addClass(one_cls);
            card_table('fms_table');

            var collectArray = $('.fms_lbox_current_btn').attr('data-array');
            if (get_type == 'sontable' && collectArray != undefined) {
                JSON.parse(collectArray).forEach(function(e) {
                    var picc = $('input[data-id=' + e + ']')
                        // if (picc.prop('checked') == false) {
                    picc.prop('checked', true)
                        // }			
                })
            }
            $('body').attr('data-l0', zero)
            $('body').attr('data-l1', first)
            $('body').attr('data-l2', second)
            $('body').attr('data-l3', third)
            $('body').attr('data-ltype', type)
            $('body').attr('data-lmode', 'lp')
                // var sidebar_0 = $('.fms_menu_change.active').data('id');
                // var sidebar_1st = $('.fms_lbox .level-1.open a').eq(0).data('first');
                // var sidebar_2nd = $('.fms_lbox .level-2.open2 a').eq(0).data('second');
                // var sidebar_3rd = $('.fms_lbox .level-3.open2 a').eq(0).data('third');
            var sidebar_0 = $('.fms_lbox .level-1.open a').eq(0).data('zero');
            var sidebar_1st = $('.fms_lbox .level-2.open a').eq(0).data('first');
            var sidebar_2nd = $('.fms_lbox .level-3.open2 a').eq(0).data('second');
            var sidebar_3rd = $('.fms_lbox .level-4.open2 a').eq(0).data('third');
            $('body').attr('data-s0', sidebar_0)
            $('body').attr('data-s1', sidebar_1st)
            $('body').attr('data-s2', sidebar_2nd)
            $('body').attr('data-s3', sidebar_3rd)
            if ($('body').hasClass('cms_theme')) {
                $('.fms_lbox .total .num').html('&nbsp;' + $('#countFile').val())
            } else {
                $('.total .num').html('&nbsp;' + $('#countFile').val())
            }
            $('.fms_lp_datatb').find('.dataTables_scrollBody').scrollbar(); //wade
        })
        .fail(function() {
            console.log("lpmode error");
        })
}

// gd_mode
function change_fms_file_gd_table(zero, first, second, third, type) {
    $.ajax({
            url: $('.base-url').val() + "/Ajax/file-lbox-table/gd_mode/" + first + "/" + second + "/" + third + "/" + type + "?zero=" + zero,
            data: {
                'rank': $('.quill_select .select_list li.checked').data('title'),
            },
            type: 'GET',
        })
        .done(function(data) {
            $('ul.fms_lbox_gd_tbody').html(data);
            var get_type = $('.fms_lbox_current_btn').data('type');
            if (get_type == 'img') {
                one_cls = 'one_shot';
            } else if (get_type == 'file') {
                one_cls = 'one_shot';
            } else {
                one_cls = 'multi_shot';
            }
            $('.grid_mode').addClass(one_cls);
            card_table('fms_table');

            var collectArray = $('.fms_lbox_current_btn').attr('data-array');
            if (get_type == 'sontable' && collectArray != undefined) {
                JSON.parse(collectArray).forEach(function(e) {
                    var picc = $('input[data-id=' + e + ']').parents('li')
                    if (picc.hasClass("check") == false) {
                        picc.addClass('check')
                    }
                })
            }
            $('body').attr('data-l0', zero)
            $('body').attr('data-l1', first)
            $('body').attr('data-l2', second)
            $('body').attr('data-l3', third)
            $('body').attr('data-ltype', type)
            $('body').attr('data-lmode', 'gd')
                // var sidebar_0 = $('.fms_menu_change.active').data('id');
                // var sidebar_1st = $('.fms_lbox .level-1.open a').eq(0).data('first');
                // var sidebar_2nd = $('.fms_lbox .level-2.open2 a').eq(0).data('second');
                // var sidebar_3rd = $('.fms_lbox .level-3.open2 a').eq(0).data('third');
            var sidebar_0 = $('.fms_lbox .level-1.open a').eq(0).data('zero');
            var sidebar_1st = $('.fms_lbox .level-2.open a').eq(0).data('first');
            var sidebar_2nd = $('.fms_lbox .level-3.open2 a').eq(0).data('second');
            var sidebar_3rd = $('.fms_lbox .level-4.open2 a').eq(0).data('third');
            $('body').attr('data-s0', sidebar_0)
            $('body').attr('data-s1', sidebar_1st)
            $('body').attr('data-s2', sidebar_2nd)
            $('body').attr('data-s3', sidebar_3rd)
            if ($('body').hasClass('cms_theme')) {
                $('.fms_lbox .total .num').html('&nbsp;' + $('#countFile').val())
            } else {
                $('.total .num').html('&nbsp;' + $('#countFile').val())
            }
        })
        .fail(function() {
            console.log("gdmode error");
        })
}

//刷新FMS lbox sidebar
function change_fms_file_sidebar(zero, first, second, third) {
    $.ajax({
            url: $('.base-url').val() + "/Ajax/file-lbox-sidebar/" + first + "/" + second + "/" + third + "?zero=" + zero,
            type: 'GET',
        })
        .done(function(data) {
            if ($('body').hasClass('cms_theme')) { //CMS
                $('.fms_lbox .content-sidebar').html(data);
            } else if ($('body').hasClass('fms_theme')) { //FMS
                $('.content-sidebar').html(data);
            }
            content_sidebar()
            change_fms_file_route()
        })
        .fail(function() {
            console.log("fms sidebar error");
        })
}

//改變上方顯示目前路徑 #adam
function change_fms_file_route() {
    //顯示資料夾路徑
    setTimeout(function() {

        var breadcrumb = $('ol.breadcrumb') //欄位
        breadcrumb.children().remove() //清空

        var file_path = ''

        //CMS開fms燈箱
        if ($('body').hasClass('cms_theme')) { 
            var level0 = $('.fms_lbox .level-1.open2 .title').html()
            var level1 = $('.fms_lbox .level-2.open2 .title').html()
            var level2 = $('.fms_lbox .level-3.open2 .title').html()
            var level3 = $('.fms_lbox .level-4.open2 .title').html()
            var level0_id = $('.fms_lbox .level-1.open2 .title').parent().data('zero')
            var level1_id = $('.fms_lbox .level-2.open2 .title').parent().data('first')
            var level2_id = $('.fms_lbox .level-3.open2 .title').parent().data('second')
        } 
        //FMS大單元
        else if ($('body').hasClass('fms_theme')) { 
            var level0 = $('.level-1.open2 .title').html()
            var level1 = $('.level-2.open2 .title').html()
            var level2 = $('.level-3.open2 .title').html()
            var level3 = $('.level-4.open2 .title').html()
            var level0_id = $('.level-1.open2 .title').parent().data('zero')
            var level1_id = $('.level-2.open2 .title').parent().data('first')
            var level2_id = $('.level-3.open2 .title').parent().data('second')
        }

        if (level3 != undefined) {
            breadcrumb.append('<li class="breadcrumb-item"><a href="javascript:void(0);" onclick="sreClk(0,'+level0_id+')">' + level0 + '</a></li>')
            breadcrumb.append('<li class="breadcrumb-item"><a href="javascript:void(0);" onclick="sreClk(1,' + level1_id + ')">' + level1 + '</a></li>')
            breadcrumb.append('<li class="breadcrumb-item"><a href="javascript:void(0);" onclick="sreClk(2,' + level2_id + ')">' + level2 + '</a></li>')
            breadcrumb.append('<li class="breadcrumb-item active">' + level3 + '</li>')
            file_path = level0 + ' > ' + level1 + ' > ' + level2 + ' > ' + level3;

        } else {

            if (level2 != undefined) {
                breadcrumb.append('<li class="breadcrumb-item"><a href="javascript:void(0);" onclick="sreClk(0,' + level0_id + ')">' + level0 + '</a></li>')
                breadcrumb.append('<li class="breadcrumb-item"><a href="javascript:void(0);" onclick="sreClk(1,' + level1_id + ')">' + level1 + '</a></li>')
                breadcrumb.append('<li class="breadcrumb-item active">' + level2 + '</li>')
                file_path = level0 + ' > ' + level1 + ' > ' + level2;

            } else {

                if (level1 != undefined) {
                    breadcrumb.append('<li class="breadcrumb-item"><a href="javascript:void(0);" onclick="sreClk(0,' + level0_id + ')">' + level0 + '</a></li>')
                    breadcrumb.append('<li class="breadcrumb-item active">' + level1 + '</li>')
                    file_path = level0 + ' > ' + level1;

                } else {

                    breadcrumb.append('<li class="breadcrumb-item active">' + level0 + '</li>')
                    file_path = level0;
                }
            }
        }
        $('.fms_area_name').html('<span class="icon fa fa-folder"></span>' + file_path);
    }, 500);
}

// 麵包屑切換
function sreClk(folder,id){
    let target = folder == 0 && $('.fms_lbox_folder_btn[data-folder=0][data-zero=' + id + ']') || 
                 folder == 1 && $('.fms_lbox_folder_btn[data-folder=1][data-first=' + id + ']') ||
                 folder == 2 && $('.fms_lbox_folder_btn[data-folder=2][data-second=' + id + ']');
    if (target.length>0){
        target.click();
        target.click();
    }
}

//light_box_img 燈箱圖片
function open_fms_light_box() {

    var open_btn = '.open_img_box',
        close_btn = '.chImgLightBox .close_btn',
        light_box = $('.chImgLightBox');

    if (bd.data('fms').open_img_box) {

    } else {
        $('body').on('click', '.open_img_box', function() {
            var _this_src = $(this).data('src');

            $('img.img_show_lbox').attr('src', _this_src);
            setTimeout(function() {
                $('.chImgLightBox').addClass('open');
            }, 500);

        });
        bd.data('fms')['open_img_box'] = true;
    }
    if (bd.data('fms').close_img_box) {

    } else {

        $('body').on('click', '.close_img_box', function() {

            $('.chImgLightBox').addClass('close');

            setTimeout(function() {
                $('.chImgLightBox').removeClass('open').removeClass('close');
            }, 500);

            setTimeout(function() {
                $('.chImgLightBox').find('img').attr('src', '');
            }, 950);

        });
        bd.data('fms')['close_img_box'] = true;
    }
}

// sontable 多選時將圖ID記在按鈕上 #adam
function sontable_collect_array() {

    var select_id = new Array();

    $('.fms_theme.ajax_fms.ajax_temp').on('click', '.icon_unlock', function() {
        var Types = $(this).data('type')

        if (!Types == 'folder') {
            if ($(this).closest('.list').hasClass('check') == false) {
                $(this).closest('.list').addClass('check');
            } else {
                $(this).closest('.list').removeClass('check');
            }
        }

    });
    // lt lp mode
    $('.fms_theme.ajax_fms.ajax_temp').on('click', 'div.checkbox.text-center', function() {
        var _this = $(this).find('input');
        var checkedd = _this.prop('checked');
        var Types = _this.data('type')

        console.log(checkedd);

        if (checkedd == true) {
            _this.prop('checked', false);
        } else if (checkedd == false) {
            _this.prop('checked', true);
        }

        if (Types == 'folder') {
            alert('請勿選擇資料夾。')
            _this.prop('checked', false)
        } else {

            var IDs = _this.data('id')
            if (select_id.indexOf(IDs) == '-1') {
                select_id.push(IDs)
            } else {
                select_id.splice(select_id.indexOf(IDs), 1);
            }
            $('.fms_lbox_current_btn').attr('data-array', JSON.stringify(select_id))

            var select = '<p>YOU SELECTED <span class="number">' + select_id.length + '</span> FILES</p>'
            $('.ajax_control_btn .selected').html(select)

        }
    })

    // gd mode
    $('.fms_theme.ajax_fms.ajax_temp').on('click', '.fms_lbox_gd_file_select_checkbox .icon_unlock', function() {
        var Types = $(this).data('type')

        if (Types == 'folder') {

            alert('請勿選擇資料夾。')

        } else {

            var IDs = $(this).data('id')
            if (select_id.indexOf(IDs) == '-1') {
                select_id.push(IDs)
            } else {
                select_id.splice(select_id.indexOf(IDs), 1);
            }
            $('.fms_lbox_current_btn').attr('data-array', JSON.stringify(select_id))
            var select = '<p>YOU SELECTED <span class="number">' + select_id.length + '</span> FILES</p>'
            $('.ajax_control_btn .selected').html(select)

        }
    })
}

function sontable_select_all_hello() {
    $('.fms_select_all_hello').on('click', function() {
        check_all();
    });

    function check_all() {
        $('.tbody_tick.fms_list').each(function(index, element) {

            let _this = $(element).find('input');
            let checkedd = _this.prop('checked');
            let IDs = _this.data('id')

            _this.prop('checked', true);

            let array_on_btn = $('.fms_lbox_current_btn').attr('data-array');
            let array_now = array_on_btn == undefined ? new Array() : JSON.parse(array_on_btn);

            if (array_now.indexOf(IDs) == '-1') {
                array_now.push(IDs)
            }
            $('.fms_lbox_current_btn').attr('data-array', JSON.stringify(array_now))

            var select = '<p>YOU SELECTED <span class="number">' + array_now.length + '</span> FILES</p>'
            $('.ajax_control_btn .selected').html(select)
        })
    }
}

// 於fms lt lp列表，單選時若選擇B,A取消勾選 
$('body').on('click', '.fms_lbox_file_select_checkbox', function() {
    var _this = $(this),
        _this_tb = _this.parent('div').parent('td').parent('tr').parent('tbody');

    if (_this_tb.hasClass('one_shot')) {
        $('input.fms_lbox_file_select_checkbox').prop('checked', false);
        _this.prop('checked', true);
    }
});
// 於fms lt lp列表，單選時若選擇B,A取消勾選 
$('body').on('click', '.no-padding.no-margin', function() {
    var _this = $(this).siblings('input'),
        _this_tb = _this.parent('div').parent('td').parent('tr').parent('tbody');

    if (_this_tb.hasClass('one_shot')) {
        $('input.fms_lbox_file_select_checkbox').prop('checked', false)
        $('.fms_list.selected').removeClass('selected');
        _this.prop('checked', true);
        _this.parents('.fms_list').addClass('selected');
    }
});
// 於fms gd列表，單選時若選擇B,A取消勾選 
$('body').on('click', '.fms_lbox_gd_file_select_checkbox', function() {
    var _this = $(this);
    _this_tb = _this.parent('ul').parent('div').parent('article');

    if (_this_tb.hasClass('one_shot')) {
        if (_this.hasClass('check')) {
            $('.fms_lbox_gd_file_select_checkbox input').prop('checked', false);
            _this.removeClass('check');
        } else {
            $('.fms_lbox_gd_file_select_checkbox').removeClass('check');
            $('.fms_lbox_gd_file_select_checkbox input').prop('checked', false);
            _this.addClass('check');
            _this.find('input').prop('checked', true);
        }
    }
    else {
        if (_this.prop('checked')) {
            _this.prop('checked', false);
            _this.parents('.fms_list').removeClass('selected');
        } else {
            _this.prop('checked', true);
            _this.parents('.fms_list').addClass('selected');
        }
    }
});

// fms中間區塊下面的存檔按鈕
$('body').on('click', '.fms_lbox_current_btn', function() {
    var _this = $(this),
        _this_key = _this.data('key'),
        _this_type = _this.data('type');

    var _val_src = '',
        _val_id = 0,
        _val_title = '',
        _val_type = '',
        _val_size = '',
        _val_folder = $('.fms_lbox .breadcrumb p').text();


    var choose_folder = false

    if (_this_type == 'img') {
        var _mode = $('.mode_btn.open');
        if (_mode.attr('mode-id') == 'lt_mode' || _mode.attr('mode-id') == 'lp_mode') {

            $('input.fms_lbox_file_select_checkbox').each(function(index, el) {
                if ($(this).prop('checked') === true) {

                    if ($(this).data('type') == 'folder') {
                        choose_folder = true
                    } else {
                        _val_src = $(this).data('src');
                        _val_id = $(this).data('id');
                        _val_title = $(this).data('title');
                        _val_type = $(this).data('type');
                        _val_size = $(this).parents('.fms_list').find('td').eq(5).find('p').text();
                    }
                }
            });
        }

        if (_mode.attr('mode-id') == 'gd_mode') {

            $('.fms_lbox_gd_file_select_checkbox input').each(function(index, el) {
                if ($(this).prop('checked') === true) {

                    if ($(this).data('type') == 'folder') {
                        choose_folder = true
                    } else {
                        _val_src = $(this).data('src');
                        _val_id = $(this).data('id');
                        _val_title = $(this).data('title');
                        _val_type = $(this).data('type');
                        _val_size = $(this).parent().find('.size').text();
                    }
                }
            });
        }

        if (choose_folder == true) {

            alert('請勿選擇資料夾。');
            return false;

        } else {

            if (_val_src == '') {
                alert('您沒有進行圖片選擇喔');
                return false;
            }

            $('.img_' + _this_key).attr('src', _val_src);
            $('.value_' + _this_key).attr('value', _val_id);
            $('.file_' + _this_key).html('<span>FILE</span>' + _val_title + '.' + _val_type);
            $('.folder_' + _this_key).html('<span>FOLDER</span>' + _val_folder);
            $('.type_' + _this_key).html('<span>TYPE</span>' + _val_type);
            $('.size_' + _this_key).html('<span>SIZE</span>' + _val_size);
            $('.img_' + _this_key).parent('div').parent('div').addClass('has_img');

        }

    } else if (_this_type == 'file') {
        var _mode = $('.mode_btn.open');
        if (_mode.attr('mode-id') == 'lt_mode' || _mode.attr('mode-id') == 'lp_mode') {

            $('input.fms_lbox_file_select_checkbox').each(function(index, el) {

                if ($(this).prop('checked') === true) {

                    if ($(this).data('type') == 'folder') {
                        choose_folder = true
                    } else {
                        _val_src = $(this).data('src');
                        _val_id = $(this).data('id');
                        _val_title = $(this).data('title');
                        _val_type = $(this).data('type');
                    }
                }
            });
        }

        if (_mode.attr('mode-id') == 'gd_mode') {

            $('.fms_lbox_gd_file_select_checkbox input').each(function(index, el) {

                if ($(this).prop('checked') === true) {

                    if ($(this).data('type') == 'folder') {
                        choose_folder = true
                    } else {
                        _val_src = $(this).data('src');
                        _val_id = $(this).data('id');
                        _val_title = $(this).data('title');
                        _val_type = $(this).data('type');
                    }
                }
            });
        }

        if (choose_folder == true) {

            alert('請勿選擇資料夾。');
            return false;

        } else {

            if (_val_src == '') {
                alert('您沒有進行選擇喔');
                return false;
            }
            $('.filepicker_input_' + _this_key).attr('value', _val_title + '.' + _val_type);
            $('.filepicker_src_' + _this_key).attr('data-src', _val_src);
            $('.filepicker_title_' + _this_key).attr('data-title', _val_title + '.' + _val_type);
            $('.filepicker_value_' + _this_key).attr('value', _val_id);

        }

    } else if (_this_type == 'sontable') {

        var mod_name = $('li[data-table="' + _this_key + '"]').data('model');
        var data_file = $('li[data-table="' + _this_key + '"]').data('set');

        var select_id = $(this).data('array')

        if (select_id.length == 0) {
            alert('您沒有進行圖片選擇喔');
            return false;
        }

        var tableKey = $(this).data('key')
        var addBtn = $('li[data-key="' + tableKey + '"]')
        var tableModel = addBtn.data('model') //預設model
        var tableColumn = addBtn.data('column') //預設欄位
        var theField = tableModel + '[' + tableColumn + '][]'

        $.ajax({
                url: $('.base-url').val() + "/Ajax/getSontableMultiImage",
                type: 'POST',
                data: {
                    file_id: JSON.stringify(select_id.filter(Boolean)),
                    model: mod_name,
                    data_file: data_file,
                    table_key: tableKey,
                    _token: $('._token').val()
                },
            })
            .done(function(data) {
                // empty value
                var newlist = addBtn.data('content')

                data.file.forEach(function(element) {

                    $('.backEnd_quill ul.frame .tabulation_body').append(newlist);
                    $('.addKeyClass').addClass('cms_new_' + element.randomCode);
                    $('.addkeyFrame').addClass('list_frame_' + element.randomCode);
                    $('.addDataKey').attr('data-key', element.randomCode);
                    $('.addKeyValue').val(element.randomCode);

                    $('.addImgClass').each(function(index, el) {
                        var keyClass = $(this).data('key');
                        $(this).addClass('img_' + keyClass + element.randomCode + keyClass);
                    });
                    $('.addImgValClass').each(function(index, el) {
                        var keyClass = $(this).data('key');
                        $(this).addClass('value_' + keyClass + element.randomCode + keyClass);

                        if ($(this).attr('name') == theField) {
                            $(this).val(element.id)
                            $(this).siblings('img').attr('src', element.real_route)
                            $(this).parent().parent().addClass('has_img')
                        }
                    });
                    $('.addFileClass').each(function(index, el) {
                        var keyClass = $(this).parents('.open_fms_lightbox').find('img').data('key');
                        $(this).addClass('file_' + keyClass + element.randomCode + keyClass);
                        if ($(this).parents('.open_fms_lightbox').hasClass('has_img')) {
                            $(this).append(element.title + '.' + element.type)
                        }
                    });
                    $('.addFolderClass').each(function(index, el) {
                        var keyClass = $(this).parents('.open_fms_lightbox').find('img').data('key');
                        $(this).addClass('folder_' + keyClass + element.randomCode + keyClass);
                        if ($(this).parents('.open_fms_lightbox').hasClass('has_img')) {
                            $(this).append(element.this_file_path)
                                // if (element.fms_first != null) {
                                // 	$(this).append(element.fms_first.title)
                                // }
                                // if (element.fms_second != null) {
                                // 	$(this).append('/' + element.fms_second.title)
                                // }
                                // if (element.fms_third != null) {
                                // 	$(this).append('/' + element.fms_third.title)
                                // }
                        }
                    });
                    $('.addTypeClass').each(function(index, el) {
                        var keyClass = $(this).parents('.open_fms_lightbox').find('img').data('key');
                        $(this).addClass('type_' + keyClass + element.randomCode + keyClass);
                        if ($(this).parents('.open_fms_lightbox').hasClass('has_img')) {
                            $(this).append(element.type)
                        }
                    });
                    $('.addSizeClass').each(function(index, el) {
                        var keyClass = $(this).parents('.open_fms_lightbox').find('img').data('key');
                        $(this).addClass('size_' + keyClass + element.randomCode + keyClass);
                        if ($(this).parents('.open_fms_lightbox').hasClass('has_img')) {
                            $(this).append(element.resolution)
                        }
                    });
                    $('.addMulitSelectClass').each(function(index, el) {
                        var keyClass = $(this).data('key');
                        $(this).addClass('multi_select_' + keyClass + element.randomCode + 'multi');
                    });
                    $('.addMulitListClass').each(function(index, el) {
                        var keyClass = $(this).data('key');
                        $(this).addClass('multi_sselect_list_' + keyClass + element.randomCode + 'multi');
                    });
                    $('.addSelectGroup').each(function(index, el) {
                        var model = $(this).data('model'),
                            next = $(this).data('next'),
                            _this_p = $(this).parent().parent().parent().find('p.addSelectGroupP');
                        $(this).attr('id', 'relsel_' + element.randomCode + '_' + model);
                        if ($(this).data('next') != '') $(this).data('next', element.randomCode + '_' + next);
                        _this_p.attr('id', 'relselo_' + element.randomCode + '_' + model);
                    });
                    $('.addImgKey').each(function(index, el) {
                        var keyClass = $(this).data('key');
                        $(this).attr('data-key', keyClass + element.randomCode + keyClass);
                    });
                    $('.addMultiKey').each(function(index, el) {
                        var keyClass = $(this).data('key');
                        $(this).attr('data-key', keyClass + element.randomCode + 'multi');
                    });
                    $('.filepicker_input_key').each(function(index, el) {
                        var keyClass = $(this).data('key');
                        $(this).addClass('filepicker_input_' + keyClass + element.randomCode + 'file');
                    });
                    $('.filepicker_src_key').each(function(index, el) {
                        var keyClass = $(this).data('key');
                        $(this).addClass('filepicker_src_' + keyClass + element.randomCode + 'file');
                    });
                    $('.filepicker_title_key').each(function(index, el) {
                        var keyClass = $(this).data('key');
                        $(this).addClass('filepicker_title_' + keyClass + element.randomCode + 'file');
                    });
                    $('.filepicker_value_key').each(function(index, el) {
                        var keyClass = $(this).data('key');
                        $(this).addClass('filepicker_value_' + keyClass + element.randomCode + 'file');
                    });
                    $('.filepicker_change_key').each(function(index, el) {
                        var keyClass = $(this).data('key');
                        $(this).attr('data-key', keyClass + element.randomCode + 'file');
                    });

                    var allList = $('.list.stack_state[data-key=' + element.randomCode + ']')
                    allList.find('.btn_ctable .s_img img').attr('src', element.real_route)
                    if (allList.length > 0) {
                        allList.find('.btn_ctable  p').html(element.title + '.' + element.type)
                    }

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

                    var count = $('.tabulation_body_' + data.data.table_key).children('div.stack_state').length;
                    var newDiv = $('.tabulation_body_' + data.data.table_key).children('div.stack_state').eq(count - 1);
                    newDiv.attr('data-rank', count);
                    var rankDiv = newDiv.children('div').children('div.sort_number');
                    rankDiv.children('p').text(count);
                    rankDiv.children('input').val(count);

                    _this.removeClass('clicked');
                    quill_select();
                    wade_datepicker();
                    baseContentEdit_color_picker();
                    item_file_detail('file_detail_btn');
                });

                $('div.no_content').remove();

            })
            .fail(function() {
                console.log("fms send error");
            })

    }

    setTimeout(function() {
        $('.fms_lbox_current_close').trigger('click');
    }, 500);
});

// fms檔案編輯下載檔案
$('body').on('click', '.file_fantasy_download', function() {
    var _this = $(this),
        _this_src = _this.attr('data-src'),
        _this_title = _this.attr('data-title');

    var a = document.createElement('a');

    a.href = _this_src;
    a.download = _this_title;
    a.target = "_blank";
    a.click();
});

// ???
$('body').on('click', '.fms_lbox_delete_file', function() {
    var _this = $(this),
        _this_type = _this.data('type');

    var _val_src = '',
        _val_id = 0,
        _val_title = '',
        _val_type = '',
        _val_key = '',
        _val_array = [],
        _title_array = [];

    if (_this_type == 'img') {

        $('input.fms_lbox_file_select_checkbox').each(function(index, el) {
            if ($(this).prop('checked') === true) {
                _val_title = $(this).data('title');
                _val_key = $(this).data('key');
                _val_array.push(_val_key);
                _title_array.push(_val_title);
            }
        });


        if (_val_array == '') {
            return false;
        } else {
            var r = confirm('是否決定刪除"' + _title_array + '"？');
            if (r == true) {
                $.ajax({
                        url: $('.base-url').val() + "/Ajax/fms-file-delete",
                        type: 'POST',
                        data: {
                            fileKeys: _val_array,
                            _token: $('._token').val()
                        },
                    })
                    .done(function() {
                        $('input.fms_lbox_file_select_checkbox').each(function(index, el) {
                            if ($(this).prop('checked') === true) {
                                $(this).closest('tr.tbody_tick').remove();
                            }
                        });
                        alert('刪除成功');
                    })
                    .fail(function() {
                        console.log("error");
                    })
            } else {
                return false;
            }
        }
    } else if (_this_type == 'file') {
        $('input.fms_lbox_file_select_checkbox').each(function(index, el) {
            if ($(this).prop('checked') === true) {
                _val_title = $(this).data('title');
                _val_key = $(this).data('key');
                _val_array.push(_val_key);
                _title_array.push(_val_title);
            }
        });


        if (_val_array == '') {
            return false;
        } else {
            var r = confirm('是否決定刪除"' + _title_array + '"？');
            if (r == true) {
                $.ajax({
                        url: $('.base-url').val() + "/Ajax/fms-file-delete",
                        type: 'POST',
                        data: {
                            fileKeys: _val_array,
                            _token: $('._token').val()
                        },
                    })
                    .done(function() {
                        $('input.fms_lbox_file_select_checkbox').each(function(index, el) {
                            if ($(this).prop('checked') === true) {
                                $(this).closest('tr.tbody_tick').remove();
                            }
                        });
                        alert('刪除成功');
                    })
                    .fail(function() {
                        console.log("error");
                    })
            } else {
                return false;
            }
        }
    }
});

// ???
$('body').on('click', '.fms_lbox_download_file', function() {
    var _this = $(this),
        _this_type = _this.data('type');

    var _val_src = '',
        _val_id = 0,
        _val_title = '',
        _val_type = '',
        _val_key = '',
        _val_array = [],
        _title_array = [],
        _src_array = [];


    $('input.fms_lbox_file_select_checkbox').each(function(index, el) {
        if ($(this).prop('checked') === true) {
            _src_array.push($(this).data('src'));
            _title_array.push($(this).data('title'));
        }
    });

    for (var i = _src_array.length - 1; i >= 0; i--) {
        var a = document.createElement('a');
        a.href = _src_array[i];
        a.download = _title_array[i];
        a.target = "_blank";
        a.click();
    }
});

open_wrapper();
close_wrapper();
re_switch_ajax();
re_switch_ajax_new();
fms_lbox_folder_change();
fms_menu_change();
btn_fms_lightbox();
open_fms_light_box();