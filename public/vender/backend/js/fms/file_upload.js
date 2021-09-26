/*將檔案設為全域變數*/
var fantasy_files_uploads = [];
var fantasy_files_keys = [];
var fantasy_files_count = 1;
/*Input檔案(用按的)*/

$('input.fileInputClick').change(function (e) {
    var files = e.currentTarget.files;
    /*顯示圖片在區塊上*/
    for (var i = 0; i < files.length; i++) {
        var randKey = randomWord(false, 3) + fantasy_files_count;
        fantasy_files_uploads[fantasy_files_count] = files[i];
        fantasy_files_keys[fantasy_files_count] = randKey;
        fantasy_files_count++;

        showFilesInHtml(files[i], randKey);
    }
});

$('body').on('click', '.fileUploadClick', function () {
    $('.fileInputClick').click();
});

$('body').on('click', '.localeToServer', function () {
    //Leon
    if ($('body').attr('data-l1') == 0 && $('body').attr('data-l2') == 0 && $('body').attr('data-l3') == 0) {
        alert('根目錄不支援檔案上傳；若無子目錄，請先新增子目錄後於指定目錄上傳');
        return false;
    }
    /*計算能上傳檔案的數量*/
    var file_array = [];
    $('.upload_file_list').children('li.list').each(function (index, el) {
        var _this = $(this),
            _this_key = _this.data('key');
        file_array.push(_this_key);
    });

    if (file_array.length < 1) {
        alert('未新增檔案');
    } else {
        for (var i = 0; i < fantasy_files_uploads.length; i++) {
            var className = '.circle_' + fantasy_files_keys[i];
            $(className).quillCircleBar({
                type: 'normal'
            });

        }
        $('.total_pace').quillCircleBar({
            type: 'total'
        });

        $('.total_pace').quillCircleBar({
            type: 'total',
            number: 0,
            baseNumber: file_array.length
        });

        //20200129 wade
        // $('form.fmsUpload').css('display', 'none');
        // $('form.fmsUpload_ing').css('display', '').addClass('active');

        $('form.fmsUpload').removeClass('open active');
        $('form.fmsUpload_ing').addClass('open');
        checkWhatFileNotUpload();
    }
});

//關閉上傳完成視窗
$('.fmsUpload_done .close_btn').click(function () {
    $('.uploaded_files').empty();
})

// 新增資料夾
$('body').on('click', '.localeToNewFolder', function () {

    var _area = $('input.fileAreaSupportSet');
    var _area_zero = _area.data('zero');
    var _area_first = _area.data('first');
    var _area_second = _area.data('second');
    var _area_third = _area.data('third');
    var _area_branch = _area.data('branch');
    var newFolder = $('.normal_input[name="newFolder"]').val();
    var sidebar_0 = $('.fms_menu_change.active').data('id');
    var sidebar_1st = $('.fms_lbox .level-1.open a').eq(0).data('first');
    var sidebar_2nd = $('.fms_lbox .level-2.open a').eq(0).data('second');
    var sidebar_3rd = $('.fms_lbox .level-3.open2 a').eq(0).data('third');

    $.ajax({
        type: "POST",
        url: $('.base-url').val() + '/Ajax/post-new-folder',
        data: {
            '_token': $('._token').val(),
            'area_zero': _area_zero,
            'area_first': _area_first,
            'area_second': _area_second,
            'area_third': _area_third,
            'area_branch': _area_branch,
            'newFolder': newFolder,
        },
    }).done(function (data) {
        if (data['an']) {
            // $('.fms_lbox_current_close,.uploadArea .close_btn').trigger('click');
            alert('新增成功')
            //reload FMS lbox
            change_fms_file_sidebar(sidebar_0, sidebar_1st, sidebar_2nd, sidebar_3rd);
            change_fms_file_route();

            var list_mod = $('.mode_btn.open').attr('mode-id');
            if (list_mod == 'lt_mode') {
                change_fms_file_lt_table(_area_zero, _area_first, _area_second, _area_third, _area_branch);
                $('.grid_sort').hide();
            } else if (list_mod == 'lp_mode') {
                change_fms_file_lp_table(_area_zero, _area_first, _area_second, _area_third, _area_branch);
                $('.grid_sort').hide();
            } else if (list_mod == 'gd_mode') {
                change_fms_file_gd_table(_area_zero, _area_first, _area_second, _area_third, _area_branch);
                $('.grid_sort').show();
                quill_select();
            }
        } else {
            alert(data['message'])
        }
    }).always(function (data) {

    })

});

// 資料夾更名
$('body').on('click', '.localeToNameFolder', function () {

    var _area = $('input.fileAreaSupportSet');
    var _area_zero = _area.data('zero');
    var _area_first = _area.data('first');
    var _area_second = _area.data('second');
    var _area_third = _area.data('third');
    var _area_branch = _area.data('branch');
    var nameFolder = $('.normal_input[name="nameFolder"]').val();
    var sidebar_0 = $('.fms_menu_change.active').data('id');
    var sidebar_1st = $('.fms_lbox .level-1.open a').eq(0).data('first');
    var sidebar_2nd = $('.fms_lbox .level-2.open a').eq(0).data('second');
    var sidebar_3rd = $('.fms_lbox .level-3.open2 a').eq(0).data('third');

    $.ajax({
        type: "POST",
        url: $('.base-url').val() + '/Ajax/post-name-folder',
        data: {
            '_token': $('._token').val(),
            'area_zero': _area_zero,
            'area_first': _area_first,
            'area_second': _area_second,
            'area_third': _area_third,
            'area_branch': _area_branch,
            'nameFolder': nameFolder,
        },
    }).done(function (data) {
        if (data['an']) {
            // $('.fms_lbox_current_close,.uploadArea .close_btn').trigger('click');
            alert('修改成功');
            //reload FMS lbox
            change_fms_file_sidebar(sidebar_0, sidebar_1st, sidebar_2nd, sidebar_3rd);
            change_fms_file_route();

            var list_mod = $('.mode_btn.open').attr('mode-id');
            if (list_mod == 'lt_mode') {
                change_fms_file_lt_table(_area_zero, _area_first, _area_second, _area_third, _area_branch);
                $('.grid_sort').hide();
            } else if (list_mod == 'lp_mode') {
                change_fms_file_lp_table(_area_zero, _area_first, _area_second, _area_third, _area_branch);
                $('.grid_sort').hide();
            } else if (list_mod == 'gd_mode') {
                change_fms_file_gd_table(_area_zero, _area_first, _area_second, _area_third, _area_branch);
                $('.grid_sort').show();
                quill_select();
            }
        } else {
            alert(data['message'])
        }
    }).always(function (data) {

    })

});

// 刪除資料夾
$('body').on('click', '.localeToDeleteFolder', function () {

    var newName = $('.open2>a .title').html();
    var sidebar_0 = $('.fms_menu_change.active').data('id');
    var sidebar_1st = $('.fms_lbox .level-1.open a').eq(0).data('first');
    var sidebar_2nd = $('.fms_lbox .level-2.open a').eq(0).data('second');
    var sidebar_3rd = $('.fms_lbox .level-3.open2 a').eq(0).data('third');

    if (confirm('你確定要刪除 "' + newName + '" 資料夾')) {
        var _area = $('input.fileAreaSupportSet');
        var _area_zero = _area.data('zero');
        var _area_first = _area.data('first');
        var _area_second = _area.data('second');
        var _area_third = _area.data('third');
        var _area_branch = _area.data('branch');

        $.ajax({
            type: "POST",
            url: $('.base-url').val() + '/Ajax/post-delete-folder',
            data: {
                '_token': $('._token').val(),
                'area_zero': _area_zero,
                'area_first': _area_first,
                'area_second': _area_second,
                'area_third': _area_third,
                'area_branch': _area_branch,
            },
        }).done(function (data) {
            if (data['an']) {
                // $('.fms_lbox_current_close,.uploadArea .close_btn').trigger('click');

                alert('刪除成功');
                //reload FMS lbox
                change_fms_file_sidebar(sidebar_0, sidebar_1st, sidebar_2nd, sidebar_3rd);
                change_fms_file_route();

                var list_mod = $('.mode_btn.open').attr('mode-id');
                if (list_mod == 'lt_mode') {
                    change_fms_file_lt_table(_area_zero, _area_first, _area_second, _area_third, _area_branch);
                    $('.grid_sort').hide();
                } else if (list_mod == 'lp_mode') {
                    change_fms_file_lp_table(_area_zero, _area_first, _area_second, _area_third, _area_branch);
                    $('.grid_sort').hide();
                } else if (list_mod == 'gd_mode') {
                    change_fms_file_gd_table(_area_zero, _area_first, _area_second, _area_third, _area_branch);
                    $('.grid_sort').show();
                    quill_select();
                }
            } else {


                alert('刪除失敗\n' + data['message']);
            }
        }).always(function (data) {})
    }

});

$('body').on('click', '.file_edit_delete', function () {

    var _val_src = '';
    var _val_id = '';
    var _val_title = '';

    var _area = $('input.fileAreaSupportSet'),
        _area_zero = _area.data('zero'),
        _area_first = _area.data('first'),
        _area_second = _area.data('second'),
        _area_third = _area.data('third'),
        _area_branch = _area.data('branch');


    _val_src = $('.img_box img').attr('src');
    _val_id = $('input[name="fms[edit_id]"]').val();
    _val_title = $('input[name="fms[title]"]').val();

    if (_val_src == '') {

        alert('刪除失敗\n您沒有選擇檔案');
        return false;
    } else {

        if (confirm('你確定要刪除 "' + _val_title + '" 檔案')) {
            $.ajax({
                type: "POST",
                url: $('.base-url').val() + '/Ajax/post-delete-files',
                data: {
                    '_token': $('._token').val(),
                    'id': _val_id,
                    'src': _val_src,
                },
            }).done(function (data) {
                if (data['an']) {

                    alert('刪除成功');
                    $('.fms_hiddenArea').removeClass('open');

                    var list_mod = $('.mode_btn.open').attr('mode-id');
                    if (list_mod == 'lt_mode') {
                        change_fms_file_lt_table(_area_zero, _area_first, _area_second, _area_third, _area_branch);
                    } else if (list_mod == 'lp_mode') {
                        change_fms_file_lp_table(_area_zero, _area_first, _area_second, _area_third, _area_branch);
                    } else if (list_mod == 'gd_mode') {
                        change_fms_file_gd_table(_area_zero, _area_first, _area_second, _area_third, _area_branch);
                        $('.grid_sort').show();
                        quill_select();
                    }

                } else {

                    alert('刪除失敗\n' + data['message']);
                }
            }).always(function (data) {})
        }
    }
});

// 刪除檔案/資料夾
$('body').on('click', '.localeToDeleteFiles', function () {

    var _val_src = '';
    var _val_id = '';
    var _val_title = '';
    var _val_level = '';

    var _area = $('input.fileAreaSupportSet'),
        _area_zero = _area.data('zero'),
        _area_first = _area.data('first'),
        _area_second = _area.data('second'),
        _area_third = _area.data('third'),
        _area_branch = _area.data('branch');

    var tableMode = $('.table_mode.open tbody') //單選或多選

    // 單選刪除
    if (tableMode.hasClass('one_shot')) {
        var isFolder = false
        var _mode = $('.mode_btn.open');

        if (_mode.attr('mode-id') == 'lt_mode' || _mode.attr('mode-id') == 'lp_mode') {
            $('input.fms_lbox_file_select_checkbox').each(function (index, el) {
                if ($(this).prop('checked') === true) {

                    if ($(this).data('type') == 'folder') {
                        isFolder = true
                        _val_level = $(this).data('level')
                        _val_id = $(this).data('id')
                        _val_title = $(this).data('title');
                    } else {
                        _val_src = $(this).data('src');
                        _val_id = $(this).data('id');
                        _val_title = $(this).data('title');
                    }

                }
            });
        }
        if (_mode.attr('mode-id') == 'gd_mode') {
            // if ($(this).data('id')) {
            //     _val_src = $(this).data('src');
            //     _val_id = $(this).data('id');
            //     _val_title = $(this).data('title');
            // } else {
            //     $('.fms_lbox_gd_file_select_checkbox input').each(function (index, el) {
            //         if ($(this).prop('checked') === true) {
            //             _val_src = $(this).data('src');
            //             _val_id = $(this).data('id');
            //             _val_title = $(this).data('title');
            //         }
            //     });
            // }
            $('.fms_lbox_gd_file_select_checkbox input').each(function (index, el) {
                if ($(this).prop('checked') === true) {

                    if ($(this).data('type') == 'folder') {
                        isFolder = true
                        _val_level = $(this).data('level')
                        _val_id = $(this).data('id')
                        _val_title = $(this).data('title');
                    } else {
                        _val_src = $(this).data('src');
                        _val_id = $(this).data('id');
                        _val_title = $(this).data('title');
                    }
                }
            });
        }

        if (isFolder == true) {

            if (confirm('你確定要刪除 "' + _val_title + '" 資料夾')) {

                var _area_first = 0
                var _area_second = 0
                var _area_third = 0
                var _area_branch = 0

                switch (_val_level) {
                    case 'first':
                        _area_first = _val_id
                        break;
                    case 'second':
                        _area_second = _val_id
                        break;
                    case 'third':
                        _area_third = _val_id
                        break;
                }

                $.ajax({
                    type: "POST",
                    url: $('.base-url').val() + '/Ajax/post-delete-folder',
                    data: {
                        '_token': $('._token').val(),
                        'area_zero': _area_zero,
                        'area_first': _area_first,
                        'area_second': _area_second,
                        'area_third': _area_third,
                        'area_branch': _area_branch,
                        'fms_shot': 'one_shot',
                    },
                }).done(function (data) {
                    if (data['an']) {
                        // $('.fms_lbox_current_close,.uploadArea .close_btn').trigger('click');

                        alert('刪除成功');
                        //reload FMS lbox
                        var sidebar_0 = $('.fms_menu_change.active').data('id');
                        var sidebar_1st = $('.fms_lbox .level-1.open a').eq(0).data('first');
                        var sidebar_2nd = $('.fms_lbox .level-2.open a').eq(0).data('second');
                        var sidebar_3rd = $('.fms_lbox .level-3.open2 a').eq(0).data('third');
                        change_fms_file_sidebar(sidebar_0, sidebar_1st, sidebar_2nd, sidebar_3rd);
                        change_fms_file_route();

                        var list_mod = $('.mode_btn.open').attr('mode-id');
                        if (list_mod == 'lt_mode') {
                            change_fms_file_lt_table(_area_zero, _area_first, _area_second, _area_third, _area_branch);
                            $('.grid_sort').hide();
                        } else if (list_mod == 'lp_mode') {
                            change_fms_file_lp_table(_area_zero, _area_first, _area_second, _area_third, _area_branch);
                            $('.grid_sort').hide();
                        } else if (list_mod == 'gd_mode') {
                            change_fms_file_gd_table(_area_zero, _area_first, _area_second, _area_third, _area_branch);
                            $('.grid_sort').show();
                            quill_select();
                        }
                    } else {


                        alert('刪除失敗\n' + data['message']);
                    }
                }).always(function (data) {})
            }

        } else {
            if (_val_src == '') {
                alert('刪除失敗\n您沒有選擇檔案');
                return false;
            } else {

                if (confirm('你確定要刪除 "' + _val_title + '" 檔案')) {
                    $.ajax({
                        type: "POST",
                        url: $('.base-url').val() + '/Ajax/post-delete-files',
                        data: {
                            '_token': $('._token').val(),
                            'id': _val_id,
                            'src': _val_src,
                            'type': 'one'
                        },
                    }).done(function (data) {
                        if (data['an']) {

                            alert('刪除成功');

                            var list_mod = $('.mode_btn.open').attr('mode-id');
                            if (list_mod == 'lt_mode') {
                                change_fms_file_lt_table(_area_zero, _area_first, _area_second, _area_third, _area_branch);
                            } else if (list_mod == 'lp_mode') {
                                change_fms_file_lp_table(_area_zero, _area_first, _area_second, _area_third, _area_branch);
                            } else if (list_mod == 'gd_mode') {
                                change_fms_file_gd_table(_area_zero, _area_first, _area_second, _area_third, _area_branch);
                                $('.grid_sort').show();
                                quill_select();
                            }

                        } else {

                            alert('刪除失敗\n' + data['message']);
                        }
                    }).always(function (data) {})
                }
            }
        }

    }

    // 多選刪除
    if (tableMode.hasClass('multi_shot')) {
        var _mode = $('.mode_btn.open');

        _val_id = new Array()
        _val_src = new Array()

        _folder_id = new Array()
        _folder_level = new Array()

        if (_mode.attr('mode-id') == 'lt_mode' || _mode.attr('mode-id') == 'lp_mode') {
            $('input.fms_lbox_file_select_checkbox').each(function (index, el) {
                if ($(this).prop('checked') === true) {

                    if ($(this).data('type') == 'folder') {
                        _folder_level.push($(this).data('level'));
                        _folder_id.push($(this).data('id'));
                    } else {
                        _val_src.push($(this).data('src'));
                        _val_id.push($(this).data('id'));
                    }
                }
            });
        }

        if (_mode.attr('mode-id') == 'gd_mode') {
            // if ($(this).data('id')) {
            //     _val_src.push($(this).data('src'));
            //     _val_id.push($(this).data('id'));
            //     _val_title.push($(this).data('title'));  
            // } else {
            //     $('.fms_lbox_gd_file_select_checkbox input').each(function (index, el) {
            //         if ($(this).prop('checked') === true) {
            //             _val_src.push($(this).data('src'));
            //             _val_id.push($(this).data('id'));
            //         }
            //     });
            // }
            $('.fms_lbox_gd_file_select_checkbox input').each(function (index, el) {
                if ($(this).prop('checked') === true) {

                    if ($(this).data('type') == 'folder') {
                        _folder_level.push($(this).data('level'));
                        _folder_id.push($(this).data('id'));
                    } else {
                        _val_src.push($(this).data('src'));
                        _val_id.push($(this).data('id'));
                    }
                }
            });
        }



        if (_val_id.length == 0 && _folder_id.length == 0) {
            alert('刪除失敗\n您沒有選擇檔案');
            return false;
        }

        if (_folder_id.length > 0) {

            if (confirm('你確定要刪除 "' + _folder_id.length + '" 個資料夾')) {

                $.ajax({
                    type: "POST",
                    url: $('.base-url').val() + '/Ajax/post-delete-folder',
                    data: {
                        '_token': $('._token').val(),
                        'folder_id': _folder_id,
                        'folder_level': _folder_level,
                        'fms_shot': 'multi_shot',
                    },
                }).done(function (data) {
                    if (data['an']) {
                        // $('.fms_lbox_current_close,.uploadArea .close_btn').trigger('click');
                        if (_val_id.length == 0) {
                            alert('刪除成功');
                        }
                        //reload FMS lbox
                        var sidebar_0 = $('.fms_menu_change.active').data('id');
                        var sidebar_1st = $('.fms_lbox .level-1.open a').eq(0).data('first');
                        var sidebar_2nd = $('.fms_lbox .level-2.open a').eq(0).data('second');
                        var sidebar_3rd = $('.fms_lbox .level-3.open2 a').eq(0).data('third');
                        change_fms_file_sidebar(sidebar_0, sidebar_1st, sidebar_2nd, sidebar_3rd);
                        change_fms_file_route();

                        var list_mod = $('.mode_btn.open').attr('mode-id');
                        if (list_mod == 'lt_mode') {
                            change_fms_file_lt_table(_area_zero, _area_first, _area_second, _area_third, _area_branch);
                            $('.grid_sort').hide();
                        } else if (list_mod == 'lp_mode') {
                            change_fms_file_lp_table(_area_zero, _area_first, _area_second, _area_third, _area_branch);
                            $('.grid_sort').hide();
                        } else if (list_mod == 'gd_mode') {
                            change_fms_file_gd_table(_area_zero, _area_first, _area_second, _area_third, _area_branch);
                            $('.grid_sort').show();
                            quill_select();
                        }
                    } else {
                        alert('刪除失敗\n' + data['message']);
                    }
                }).always(function (data) {})
            }


        }

        if (_val_id.length > 0) {

            if (confirm('你確定要刪除 ' + _val_id.length + ' 個檔案')) {
                $.ajax({
                    type: "POST",
                    url: $('.base-url').val() + '/Ajax/post-delete-files',
                    data: {
                        '_token': $('._token').val(),
                        'id': _val_id,
                        'src': _val_src,
                        'type': 'multi'
                    },
                }).done(function (data) {
                    if (data['an']) {

                        alert('刪除成功');

                        var list_mod = $('.mode_btn.open').attr('mode-id');
                        if (list_mod == 'lt_mode') {
                            change_fms_file_lt_table(_area_zero, _area_first, _area_second, _area_third, _area_branch);
                        } else if (list_mod == 'lp_mode') {
                            change_fms_file_lp_table(_area_zero, _area_first, _area_second, _area_third, _area_branch);
                        } else if (list_mod == 'gd_mode') {
                            change_fms_file_gd_table(_area_zero, _area_first, _area_second, _area_third, _area_branch);
                            $('.grid_sort').show();
                            quill_select();
                        }

                    } else {

                        alert('刪除失敗\n' + data['message']);
                    }
                }).always(function (data) {})
            }

        }


    }

});

// 下載檔案
$('body').on('click', '.localeToDownloadFiles', function () {

    var _val_src = '';
    var _val_id = '';
    var _val_title = '';

    var _mode = $('.mode_btn.open');

    if (_mode.attr('mode-id') == 'lt_mode' || _mode.attr('mode-id') == 'lp_mode') {
        $('input.fms_lbox_file_select_checkbox').each(function (index, el) {
            if ($(this).prop('checked') === true) {
                _val_src = $(this).data('src');
                _val_id = $(this).data('id');
                _val_title = $(this).data('title');
            }
        });
    }
    if (_mode.attr('mode-id') == 'gd_mode') {
        $('.fms_lbox_gd_file_select_checkbox input').each(function (index, el) {
            if ($(this).prop('checked') === true) {
                _val_src = $(this).data('src');
                _val_id = $(this).data('id');
                _val_title = $(this).data('title');
            }
        });
    }

    if (_val_src == '') {
        alert('您沒有選擇檔案喔');
        return false;
    } else {

        if (confirm('你要下載 "' + _val_title + '" 檔案嗎')) {
            $.ajax({
                type: "POST",
                url: $('.base-url').val() + '/Ajax/post-download-files',
                data: {
                    '_token': $('._token').val(),
                    'id': _val_id,
                    'src': _val_src,
                },
            }).done(function (data) {
                if (data['an']) {
                    $('body').append('<a class="phpComeXfiles" href="' + data['src'] + '" download></a>')
                    setTimeout(function () {
                        $('.phpComeXfiles').get(0).click();
                        $('.phpComeXfiles').remove();
                    }, 0)

                } else {
                    alert(data['message'])
                }
            }).always(function (data) {})
        }
    }

});

//編輯檔案 
$('body').on('click', '.file_edit_upload', function () {

    var this_form = $(".ajaxContainer.open");
    var _val_id = this_form.find('input[name="fms[edit_id]"]').val();
    var folder_level = this_form.find('input[name="fms[folder_level]"]').val();
    var folder_id = this_form.find('input[name="fms[folder_id]"]').val();
    var title = this_form.find('input[name="fms[title]"]').val();
    var note = this_form.find('textarea[name="fms[note]"]').val();
    var share_group = this_form.find('input[name="fms[share_group]"]').val();
    var _area = $('input.fileAreaSupportSet'),
        _area_zero = _area.data('zero'),
        _area_first = _area.data('first'),
        _area_second = _area.data('second'),
        _area_third = _area.data('third'),
        _area_branch = _area.data('branch');

    if (_val_id == undefined) {
        alert('您沒有選擇檔案喔');
        return false;
    } else {
        console.log(_val_id);
        $.ajax({
            type: "POST",
            url: $('.base-url').val() + '/Ajax/post-edit-files',
            data: {
                '_token': $('._token').val(),
                'id': _val_id,
                // 'data': form_data,
                'folder_level': folder_level,
                'folder_id': folder_id,
                'title': title,
                'note': note,
                'share_group': share_group
            },
        }).done(function (data) {
            if (data['an']) {

                alert('編輯成功');

                var list_mod = $('.mode_btn.open').attr('mode-id');
                if (list_mod == 'lt_mode') {
                    change_fms_file_lt_table(_area_zero, _area_first, _area_second, _area_third, _area_branch);
                } else if (list_mod == 'lp_mode') {
                    change_fms_file_lp_table(_area_zero, _area_first, _area_second, _area_third, _area_branch);
                } else if (list_mod == 'gd_mode') {
                    change_fms_file_gd_table(_area_zero, _area_first, _area_second, _area_third, _area_branch);
                    $('.grid_sort').show();
                    quill_select();
                }

            } else {

                alert('編輯失敗\n' + data['message']);

            }
        }).always(function (data) {})

    }
});

$('body').on('click', '.folder_edit_delete', function () {

    // var _val_id = $('input[name="fms[edit_id]"]').val();
    var folder_level = $('input[name="fms[folder_level]"]').val();
    var this_id = $('input[name="fms[this_id]"]').val();
    var sidebar_0 = $('.fms_menu_change.active').data('id');
    var sidebar_1st = $('.fms_lbox .level-1.open a').eq(0).data('first');
    var sidebar_2nd = $('.fms_lbox .level-2.open a').eq(0).data('second');
    var sidebar_3rd = $('.fms_lbox .level-3.open2 a').eq(0).data('third');


    var _area = $('input.fileAreaSupportSet'),
        _area_zero = _area.data('zero'),
        _area_first = _area.data('first'),
        _area_second = _area.data('second'),
        _area_third = _area.data('third'),
        _area_branch = _area.data('branch');
    var _val_title = $('input[name="fms[title]"]').val()
    if (confirm('你確定要刪除 "' + _val_title + '" 檔案')) {
        $.ajax({
            type: "POST",
            url: $('.base-url').val() + '/Ajax/post-edit-folder-delete',
            data: {
                '_token': $('._token').val(),

                'folder_level': folder_level,
                'this_id': this_id,

            },
        }).done(function (data) {
            if (data['an']) {


                alert('刪除成功');
                $('.fms_hiddenArea').removeClass('open');

                var list_mod = $('.mode_btn.open').attr('mode-id');
                if (list_mod == 'lt_mode') {
                    change_fms_file_lt_table(_area_zero, _area_first, _area_second, _area_third, _area_branch);
                } else if (list_mod == 'lp_mode') {
                    change_fms_file_lp_table(_area_zero, _area_first, _area_second, _area_third, _area_branch);
                } else if (list_mod == 'gd_mode') {
                    change_fms_file_gd_table(_area_zero, _area_first, _area_second, _area_third, _area_branch);
                    $('.grid_sort').show();
                    quill_select();
                }
                change_fms_file_sidebar(sidebar_0, sidebar_1st, sidebar_2nd, sidebar_3rd);

            } else {


                alert('刪除失敗\n' + data['message']);
            }
        }).always(function (data) {})
    }

});

$('body').on('click', '.folder_edit_upload', function () {

    // var _val_id = $('input[name="fms[edit_id]"]').val();
    var this_form = $(".ajaxContainer.open");
    var origin_folder_level = this_form.find('input[name="fms[origin_folder_level]"]').val();
    var folder_level = this_form.find('input[name="fms[folder_level]"]').val();
    var folder_id = this_form.find('input[name="fms[folder_id]"]').val();
    var this_id = this_form.find('input[name="fms[this_id]"]').val();
    var this_folder_id = 0;
    var title = this_form.find('input[name="fms[title]"]').val();
    var note = this_form.find('textarea[name="fms[note]"]').val();
    var share_group = this_form.find('input[name="fms[share_group]"]').val();

    var sidebar_0 = $('.fms_menu_change.active').data('id');
    var sidebar_1st = $('.fms_lbox .level-1.open a').eq(0).data('first');
    var sidebar_2nd = $('.fms_lbox .level-2.open a').eq(0).data('second');
    var sidebar_3rd = $('.fms_lbox .level-3.open2 a').eq(0).data('third');

    var _area = $('input.fileAreaSupportSet'),
        _area_zero = _area.data('zero'),
        _area_first = _area.data('first'),
        _area_second = _area.data('second'),
        _area_third = _area.data('third'),
        _area_branch = _area.data('branch');

    if (_area_first != 0) {
        this_folder_id = _area_first;
    } else if (_area_second != 0) {
        this_folder_id = _area_second;
    } else if (_area_third != 0) {
        this_folder_id = _area_third;
    } else {
        this_folder_id = 0;
    }


    if (this_id == undefined) {
        alert('您沒有選擇檔案喔');
        return false;
    } else {

        $.ajax({
            type: "POST",
            url: $('.base-url').val() + '/Ajax/post-edit-folder',
            data: {
                '_token': $('._token').val(),
                'id': this_id,
                // 'data': form_data,
                'origin_folder_level': origin_folder_level,
                'folder_id': folder_id,
                'folder_level': folder_level,
                'this_folder_id': this_folder_id,

                'title': title,
                'note': note,
                'share_group': share_group
            },
        }).done(function (data) {
            if (data['an']) {
                alert('編輯成功');
                var list_mod = $('.mode_btn.open').attr('mode-id');
                if (list_mod == 'lt_mode') {
                    change_fms_file_lt_table(_area_zero, _area_first, _area_second, _area_third, _area_branch);
                } else if (list_mod == 'lp_mode') {
                    change_fms_file_lp_table(_area_zero, _area_first, _area_second, _area_third, _area_branch);
                } else if (list_mod == 'gd_mode') {
                    change_fms_file_gd_table(_area_zero, _area_first, _area_second, _area_third, _area_branch);
                    $('.grid_sort').show();
                    quill_select();
                }
                change_fms_file_sidebar(sidebar_0, sidebar_1st, sidebar_2nd, sidebar_3rd);
                $('.fms_lbox .content-sidebar .sidebar-menu').scrollbar();
                this_form.eq(0).find('a.close_btn').eq(0).click()
                
            } else {
                alert('編輯失敗\n' + data['message']);
            }
        }).always(function (data) {})

    }
});

//編輯頁面的資料夾SLEECT
$('body').on('click', '.fmsFolder_edit ul.folder_list li', function () {
    var id = $(this).data('id');
    var level = $(this).data('level');

    $('input[name="fms[folder_level]"]').val(level);
    $('input[name="fms[folder_id]"]').val(id);

});

//取消當前檔案上傳資格
$('body').on('click', 'span.upload_list_delete', function () {
    var _this = $(this),
        _this_parent_li = _this.parent('div').parent('li'),
        _this_key = _this_parent_li.data('key');

    _this_parent_li.remove();

    $('.upload_file_list').children('li.list').each(function (index, el) {
        var _this_list = $(this),
            _this_list_key = _this_list.data('key');

        if (_this_list_key == _this_key) {
            _this_list.remove();
        }
    });
});

// ???
$('body').on('click', 'span.upload_list_delete', function () {

});

function checkWhatFileNotUpload() {
    var _area = $('input.fileAreaSupportSet'),
        _area_zero = _area.data('zero'),
        _area_first = _area.data('first'),
        _area_second = _area.data('second'),
        _area_third = _area.data('third'),
        _area_branch = _area.data('branch');

    /*計算能上傳檔案的數量*/
    var file_array = [];
    $('.upload_file_list').children('li.list').each(function (index, el) {
        var _this_list = $(this),
            _this_list_key = _this_list.data('key');
        file_array.push(_this_list_key);
    });

    var okFiles = [];
    var current_i = 0;
    $('.upload_file_list').children('li.list').each(function (index, el) {
        var _this = $(this),
            _this_key = _this.data('key');

        if (_this_key != '') {
            if (!_this.hasClass('upload_ok')) {
                if (current_i == 0) {
                    for (var i = fantasy_files_uploads.length; i > 0; i--) {
                        if (_this_key == fantasy_files_keys[i]) {
                            current_i = i;
                        }
                    }

                }
            } else {
                okFiles.push(_this_key);
            }

            $('.total_pace').quillCircleBar({
                type: 'total',
                number: okFiles.length,
                baseNumber: file_array.length
            });
        }
    });

    if (current_i != 0) {
        postFilesToServer(fantasy_files_uploads[current_i], fantasy_files_keys[current_i]);
    } else {
        fantasy_files_uploads = [];
        fantasy_files_keys = [];
        fantasy_files_count = 1;
        $('.upload_file_list').empty();
        $('.locale_file_list').empty();
        // $('form.fmsUpload_ing').css('display', 'none');20200129 wade
        $('form.fmsUpload_ing').removeClass('open active');
        // $('form.fmsUpload_done').css('display', '').addClass('active'); 20200129 wade
        $('form.fmsUpload_done').addClass('open');

        var list_mod = $('.mode_btn.open').attr('mode-id');

        if (list_mod == 'lt_mode') {
            change_fms_file_lt_table(_area_zero, _area_first, _area_second, _area_third, _area_branch);
            $('.grid_sort').hide();
        } else if (list_mod == 'lp_mode') {
            change_fms_file_lp_table(_area_zero, _area_first, _area_second, _area_third, _area_branch);
            $('.grid_sort').hide();
        } else if (list_mod == 'gd_mode') {
            change_fms_file_gd_table(_area_zero, _area_first, _area_second, _area_third, _area_branch);
            $('.grid_sort').show();
            quill_select();
        }

    }
}

//上傳檔案
function postFilesToServer(file, key) {
    var objXhr = new XMLHttpRequest(),
        objForm = new FormData(),
        _area = $('input.fileAreaSupportSet'),
        _area_first = _area.data('first'),
        _area_second = _area.data('second'),
        _area_third = _area.data('third'),
        _area_branch = _area.data('branch');


    objXhr.upload.onprogress = function (e) {
        if (e.lengthComputable) {
            var className = '.circle_' + key;
            var intComplete = (e.loaded / e.total) * 100 | 0;
            // console.log(intComplete);
            $(className).quillCircleBar({
                type: 'normal',
                number: intComplete
            });
        }
    }

    objXhr.onreadystatechange = function () {
        if (objXhr.readyState == 4 && objXhr.status == 200) {

            $('.upload_file_list').children('li.list').each(function (index, el) {
                var _this = $(this),
                    _this_key = _this.data('key');
                var _this_html = '<li class="list upload_ok"><div class="list_title option"><div class="list_img">';
                if (key == _this_key) {
                    for (var i = fantasy_files_uploads.length; i > 0; i--) {
                        if (_this_key == fantasy_files_keys[i]) {
                            _this.addClass('upload_ok');
                            _this.children('div.list_tool').empty();
                            _this.children('div.list_tool').append('<span class="icon fa fa-check"></span>');
                            //補上清單
                            _this_html += '<img src="' + _this.find('div.list_title .list_img img').attr('src') + '" alt="">';
                            _this_html += '</div>';
                            _this_html += '<p>' + _this.children('div.list_title').text() + '</p>';
                            _this_html += '</div>';
                            _this_html += '<div class="list_capacity option">';
                            _this_html += '<p>' + _this.children('div.list_capacity').text() + '</p>';
                            _this_html += '</div>';
                            _this_html += '<div class="list_tool option">';
                            _this_html += '<span class="icon fa fa-check"></span>';
                            _this_html += '</div>';
                            _this_html += '</li>';
                            $('.uploaded_files').append(_this_html);
                        }
                    }
                }
            });
            checkWhatFileNotUpload();
        }
    }


    objXhr.open('POST', $('.base-url').val() + '/Ajax/post-files-fms');
    // console.log(file);
    objForm.append('file', file);
    objForm.append('key', key);
    objForm.append('first', _area_first);
    objForm.append('second', _area_second);
    objForm.append('third', _area_third);
    objForm.append('branch', _area_branch);
    objForm.append('_token', $('._token').val());
    // console.log(objForm);

    objXhr.send(objForm);
}

function drop_image(e) {
    e.preventDefault();
    var files = e.dataTransfer.files;
    // console.log(files);
    /*顯示圖片在區塊上*/
    for (var i = 0; i < files.length; i++) {
        var randKey = randomWord(false, 3) + fantasy_files_count;
        fantasy_files_uploads[fantasy_files_count] = files[i];
        fantasy_files_keys[fantasy_files_count] = randKey;
        fantasy_files_count++;

        showFilesInHtml(files[i], randKey);
    }
}

/*擋住直接開圖片*/
function dragHandler(e) {
    e.preventDefault();
}

/*未上傳*/
function showFilesInHtml(file, key) {
    console.log(file.type);
    
    var reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = function (e) {
        if (file.size > 1048576 * 64) {
            var num = file.size / 1048576,
                _this_size = num.toFixed(2) + ' MB';

            var html = '<li class="list" data-key="' + key + '">';
            html += '<div class="list_title option">';
            html += '<div class="list_img">';
            html += '<img src="" alt="">';
            html += '</div>';
            html += '<p>' + file.name + ',檔案超過限制大小</p>';
            html += '</div>';
            html += '<div class="list_capacity option">';
            html += '<p>' + _this_size + '</p>';
            html += '</div>';
            html += '<div class="list_tool option">';
            // html += '<span class="icon fa fa-pencil-square-o"></span>';
            html += '<span class="icon fa fa-trash upload_list_delete"></span>';
            html += '</div>';
            html += '</li>';
            $('.locale_file_list').append(html);

            return false;
        } else if (file.size > 1048576) {
            var num = file.size / 1048576,
                _this_size = num.toFixed(2) + ' MB';
        } else {
            var num = file.size / 1024,
                _this_size = num.toFixed(2) + ' KB';
        }

        if (file.type.match('image')) {
            var _this_image = e.target.result;
        } else if (file.type.match('pdf')) {
            var _this_image = '/vender/assets/img/icon/pdf.jpg';
        } else if (file.type.match('wordprocessingml.document')) {
            var _this_image = '/vender/assets/img/icon/doc.jpg';
        } else if (file.type.match('msword')) {
            var _this_image = '/vender/assets/img/icon/doc.jpg';
        } else if (file.type.match('ms-powerpoint')) {
            var _this_image = '/vender/assets/img/icon/ppt.jpg';
        } else if (file.type.match('presentationml.presentation')) {
            var _this_image = '/vender/assets/img/icon/ppt.jpg';
        } else if (file.type.match('ms-excel')) {
            var _this_image = '/vender/assets/img/icon/xls.jpg';
        } else if (file.type.match('spreadsheetml.sheet')) {
            var _this_image = '/vender/assets/img/icon/xls.jpg';
        } else if (file.type.match('text/plain')) {
            var _this_image = '/vender/assets/img/icon/txt.jpg';
        } else if (file.type.match('zip')) {
            var _this_image = '/vender/assets/img/icon/zip.jpg';
        } else if (file.type.match('video')) {
            var _this_image = '/vender/assets/img/icon/video.jpg';
        } else {
            var html = '<li class="list" data-key="' + key + '">';
            html += '<div class="list_title option">';
            html += '<div class="list_img">';
            html += '<img src="" alt="">';
            html += '</div>';
            html += '<p>' + file.name + ',此檔案不符合規定類型</p>';
            html += '</div>';
            html += '<div class="list_capacity option">';
            html += '<p>' + _this_size + '</p>';
            html += '</div>';
            html += '<div class="list_tool option">';
            // html += '<span class="icon fa fa-pencil-square-o"></span>';
            html += '<span class="icon fa fa-trash upload_list_delete"></span>';
            html += '</div>';
            html += '</li>';
            $('.locale_file_list').append(html);

            return false;
        }

        var html = '<li class="list" data-key="' + key + '">';
        html += '<div class="list_title option">';
        html += '<div class="list_img">';
        html += '<img src="' + _this_image + '" alt="">';
        html += '</div>';
        html += '<p>' + file.name + '</p>';
        html += '</div>';
        html += '<div class="list_capacity option">';
        html += '<p>' + _this_size + '</p>';
        html += '</div>';
        html += '<div class="list_tool option">';
        // html += '<span class="icon fa fa-pencil-square-o"></span>';
        html += '<span class="icon fa fa-trash upload_list_delete"></span>';
        html += '</div>';
        html += '</li>';
        $('.locale_file_list').append(html);

        var html_uploading = '<li class="list" data-key="' + key + '">';
        html_uploading += '<div class="list_title option">';
        html_uploading += '<div class="list_img">';
        html_uploading += '<img src="' + _this_image + '" alt="">';
        html_uploading += '</div>';
        html_uploading += '<p>' + file.name + '</p>';
        html_uploading += '</div>';
        html_uploading += '<div class="list_capacity option">';
        html_uploading += '<p>' + _this_size + '</p>';
        html_uploading += '</div>';
        html_uploading += '<div class="list_tool option">';
        html_uploading += '<div class="circle_pace circle_' + key + '"></div>';
        html_uploading += '</div>';
        html_uploading += '</li>';
        $('.upload_file_list').append(html_uploading);
    }
}

// ???
function resetFilesUploadStatue() {

}