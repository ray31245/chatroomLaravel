//////////////////////////////////////
// FantasyJS Setting 
// version: 2.0 
// Update: 2019.10.02 
// Last Coding: Wade, 2019.10.02 
// 
// JS Guide:
// #00.checkfunction
// #01.ui_contral   
// #02.Component DataTableV2 
// #03.Components
// #04.Component ScrollBar
// #05.Component Summernote
// #06.ajaxdata
// #07.fms function call
// #08.detail test
// #09.Ready Function Call
//
//////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////////////////////
//
//checkfunction相關
var checkfunction = {
    objectlength: function(object) {
        (!object.length);
        // return console.log("no object");
    },
    //檢查callback是不是function
    callbacklength: function(callback) {
        if (typeof callback === 'function') {
            callback();
            return true
        } else {
            // console.log("no callbock");
            return false
        }
    }
}

///////////////////////////////////////////////////////////////////////////////////////////////
//
//#01.ui_contral相關
var ui_contral = {
    //mainnav
    mainnav: function(object) {
        object.on('mouseenter', function() {
            object.addClass('open');
        });
        object.on('mouseleave', function() {
            object.removeClass('open');
        });

    },

    //level-sidebar
    sidebar: function(object) {
        // console.log("sidebarLevel OK!!")
        checkfunction.objectlength(object);

        if (object.find('.level_list').hasClass('open')) {
            object.find('.level_list.open > .sub-menu').slideDown(200);
        }

        object.on('click', "li > a", function() {
            var levellist = $(this).parent();
            var levellist_All = $(this).parent().parent().find('li');
            var submenu = $(this).next('ul');
            var submenu_LV1 = $(this).parent().find('ul');
            var submenu_LV2 = $(this).parent().parent().find('ul');
            var submenu_All = object.find('li ul');

            if (submenu.length) {

                if (levellist.hasClass('level-1') && levellist.hasClass('open')) {
                    // console.log("level-1 close");
                    levellist.removeClass('open active');
                    submenu_LV1.slideUp(200);

                } else if (levellist.hasClass('level-1')) {
                    // console.log("level-1 open");
                    levellist_All.removeClass('open active');
                    submenu_All.slideUp(200);
                    levellist.addClass('open active');
                    submenu.slideDown(200);

                } else if (levellist.hasClass('level-2') && levellist.hasClass('open')) {
                    // console.log("level-2 close");
                    levellist.removeClass('open active');
                    submenu.slideUp(200);


                } else if (levellist.hasClass('level-2')) {
                    // console.log("level-2 open");
                    levellist_All.removeClass('open active');
                    levellist.addClass('open active');
                    submenu_LV2.slideUp(200);
                    submenu.slideDown(200);


                } else if (levellist.hasClass('open')) {
                    // console.log("level-3 close");
                    levellist.removeClass('open active');
                    submenu.slideUp(200);

                } else {
                    // console.log("level-3 open");
                    levellist.addClass('open active');
                    submenu.slideDown(200);
                }
            }
        });
    },

    //控制區塊選單content-sidebar展開&關閉
    ui_rwd_switch: function() {
        $('.jumbotron .inner').on('click', '.switch-menu', function() {
            $('.page-content-wrapper').toggleClass('content-sidebar-open');

            // console.log("content-sidebar avtive");

            var uiv2_into = $('body').hasClass('uiv2');

            if (uiv2_into) {
                //呼叫uiv2 content-sidebar 展開&關閉相關元素
                $('body.uiv2').toggleClass('header-blockcover-open');
            }
        })
    },

    //切換暗黑模式
    ui_dark_switch: function() {

        $('.header .blockCover').off().click(function() {

            if ($(this).parents('body').hasClass('dark_theme')) {
                $(this).parents('body').removeClass('dark_theme');
                // console.log("dark theme remove ");

            } else {
                $(this).parents('body').removeClass('dark_theme');
                $(this).parents('body').addClass('dark_theme');

                // console.log("dark theme change");
            }
        })
    },


    //detailEditorScrollBT暫放
    detailEditor_fixedHeader: function() {
        var scrollAfter = 0;
        var scrollBefore = 0;


        $('.editorBody').on('scroll', function(e) {
            scrollBefore = $(this).scrollTop();
            var cover_H = $(this).height();
            var object_H = $(this).find('.editorContent').height();
            var scrollHeight = object_H - scrollBefore + 150;

            //視窗到頂部
            if (scrollBefore == 0) {
                // console.log("Stop Up");
            }
            //視窗到底部
            if (scrollHeight == cover_H) {
                // console.log("Stop Bottom");
            }
            //視窗往下滾
            if (scrollAfter < scrollBefore) {
                $(".editorHeader").fadeOut();
                // console.log("ScrollDown");

            } else {
                //視窗往上滾
                $(".editorHeader").fadeIn();
                // console.log("ScrollUp");
            }
            setTimeout(function() {
                scrollAfter = scrollBefore
            }, 0)

            // console.log("cover_H : " + cover_H + ", scrollBefore : " + scrollBefore + ", object_H : " + object_H);
        })
    },

    allready: function() {
        ui_contral.mainnav($('.mainNav'));
        ui_contral.sidebar($('.head-bar'));
        ui_contral.sidebar($('.body-list'));
        ui_contral.ui_rwd_switch();
        ui_contral.ui_dark_switch();
        // ui_contral.detailEditor_fixedHeader();

    }
}

///////////////////////////////////////////////////////////////////////////////////////////////
//
//#02.Component DataTableV2相關
var component_datatableV2 = {

    //搜尋按鈕展開&關閉
    seach_switch: function() {
        $('.btn-item.searchbar').click(function() {
            $(this).find('.search-data').addClass('active')
            $('.search-data').focus();
        })
    },

    //表頭條件過濾箭頭icon控制
    sort_arrow: function() {
        $('.datatable .tables thead').on('click', '.fake-th', function() {

            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
            } else {
                $('.datatable .tables thead .fake-th').removeClass('active');
                $(this).addClass('active');
            }
        })
    },

    //選取tr狀態設定
    selected_tr: function() {
        $('tbody .select-item').off().on('click', 'input', function() {
            if ($(this).prop('checked')) {
                $(this).parents('tr').addClass('selected');
            } else {
                $(this).parents('tr').removeClass('selected');
            }
        })
    },

    allready: function() {
        component_datatableV2.seach_switch();
        component_datatableV2.sort_arrow();
        component_datatableV2.selected_tr();
    }
}


///////////////////////////////////////////////////////////////////////////////////////////////
//
//#03.Components相關
var components = {

    live_input: function(inputObject, titleObject) {
        // 這是在輸入文字框同時賦予標題欄位值得程式，#wade為輸入框，#wadeh3是賦予hrml值的對象
        //要分兩隻寫，input & select，switch不用，因為放在列表
        var liveInput = inputObject;
        var liveTitle = titleObject;
        var liveTitleHtml = titleObject.html();
        var liveTitleContent = "<span class='original_LiveTitle'>" + liveTitleHtml + "</span>";

        liveInput.bind('input propertychange', function() {
            if (liveInput.val() == "") {
                var liveInputVal = liveInput.val();
                // liveInputVal = liveInputVal.replace(/[~'!<>@#$%^&*()- _=:]/g, ""); //過濾不需要的符號
                // console.log(liveInputVal);
                liveInput.val(liveInputVal);
                liveTitle.html(liveTitleHtml);
            } else {
                var liveTitleNew = liveTitleContent + liveInput.val();

                liveTitle.html(liveTitleNew);
            }
        });

    },

    // 未完成的功能
    // liveSelect: function() {
    //     // 這是在輸入文字框同時賦予標題欄位值得程式，#wade為輸入框，#wadeh3是賦予hrml值的對象
    //     //要分兩隻寫，input & select，switch不用，因為放在列表
    //     var liveSelect2 = $('____select2[data-live-input] +.select2 .select2-selection__rendered[title]')
    //     var liveInputVal = liveSelect2.val();
    //     var liveTitle = $('.subtitle[data-live-input]')


    //     liveInput.bind('input propertychange', function() {
    //         var inputContent = liveinput.val()
    //         inputContent = inputContent.replace(/[~'!<>@#$%^&*()- _=:]/g, ""); //過濾不需要的符號
    //         console.log(inputContent);
    //         liveTitle.html(inputContent);
    //     });
    // },


    /*scroll_bar*/
    scrollBar: function(object) {

        //檢查物件是否存在
        checkfunction.objectlength(object);
        object.scrollbar();
    },

    //ToolTip
    tooltip: function(object) {
        checkfunction.objectlength(object);
        object.tooltip();
    },

    /*WYSIWYG Editor 編輯器*/
    summernote: function(object) {

        //檢查物件是否存在
        checkfunction.objectlength(object);
        object.summernote();
    },

    /*select2 下拉選單*/
    select2: function(object) {

        // https://codepen.io/martinsanne/pen/zdZLrd拖曳選項的範例

        //檢查物件是否存在
        checkfunction.objectlength(object);
        object.select2({
            //https://blog.csdn.net/WuLex/article/details/79322332
            placeholder: "Please Select Option",
            //必须添加placeholderOption: "first"属性，否则allowClear不生效
            placeholderOption: "first",
            //開啟清除按鈕按鈕
            allowClear: true,
            width: '100%',
        });
    },

    /*tagsinput 標籤輸入*/
    tagsinput: function(object) {

        //檢查物件是否存在
        checkfunction.objectlength(object);
        object.tagsinput({
            //输入框输入标签时通过什么按键来输出标签。默认为[13, 188]，代表回车和comma键
            confirmKeys: [13, 188],
            //如果设置为true，会自动删除标签首尾的空白。默认为false
            trimValue: true,
            //当输入框获得焦点时，参数指定的class会被应用到容器上
            // focusClass: 'onfocus',
        });

    },

    /*ios_switch 按鈕*/
    ios_switch: function(object) {

        //檢查物件是否存在
        checkfunction.objectlength(object);
        object.on('click', function() {
            $(this).toggleClass('on');
        })
    },

    datepicker: function(object) {

        //檢查物件是否存在
        checkfunction.objectlength(object);
        object.datepicker({
            maxViewMode: 2,
            todayBtn: true,
            clearBtn: true,
            language: "zh-TW",
            orientation: "top left",
            calendarWeeks: true,
            autoclose: true,
            todayHighlight: true,
            beforeShowDay: function(date) {
                if (date.getMonth() == (new Date()).getMonth())
                    switch (date.getDate()) {
                        case 4:
                            return {
                                tooltip: 'Example tooltip',
                                classes: 'active'
                            };
                        case 8:
                            return false;
                        case 12:
                            return "green";
                    }
            },
            beforeShowMonth: function(date) {
                if (date.getMonth() == 8) {
                    return false;
                }
            },
            beforeShowYear: function(date) {
                if (date.getFullYear() == 2007) {
                    return false;
                }
            },
            datesDisabled: ['09/06/2019', '09/21/2019'],
            defaultViewDate: { year: 1977, month: 04, day: 25 }
        });
    },

    daterangepicker: function(object) {

        //檢查物件是否存在
        checkfunction.objectlength(object);
        object.datePicker({
            hasShortcut: true,
            isRange: true,
            shortcutOptions: [{
                name: '昨天',
                day: '-1,-1',
                time: '00:00:00,23:59:59'
            }, {
                name: '最近一周',
                day: '-7,0',
                time: '00:00:00,'
            }, {
                name: '最近一个月',
                day: '-30,0',
                time: '00:00:00,'
            }, {
                name: '最近三个月',
                day: '-90, 0',
                time: '00:00:00,'
            }]
        });
        return true
    },
    daterangepicker2: function(object, callback) {

        //檢查物件是否存在
        checkfunction.objectlength(object);
        object.datePicker({
            hasShortcut: true,
            isRange: true,
            shortcutOptions: [{
                name: '昨天',
                day: '-3,-3',
                time: '00:00:00,23:59:59'
            }, {
                name: '最近一周',
                day: '-7,0',
                time: '00:00:00,'
            }, {
                name: '最近一个月',
                day: '-30,0',
                time: '00:00:00,'
            }, {
                name: '最近三个月',
                day: '-90, 0',
                time: '00:00:00,'
            }]
        });

    },

    //ajax載入後呼叫物件綁定事件
    loaded: function(objectCover, callback) {

        if (objectCover.length) {
            var tooltip = objectCover.find('[data-toggle="tooltip"]');
            var select2 = objectCover.find('.____select2');
            var ios_switch = objectCover.find('.____ios_switch')
            var tagsinput = objectCover.find('.____tagsinput');
            var datepicker = objectCover.find('.____datepicker');
            var daterangepicker = objectCover.find('.J-datepicker-range');
            var live_input = objectCover.find('.____input input[data-live-input]');
            var live_title = objectCover.find('h3[data-live-input]');

            components.tooltip(tooltip);
            components.select2(select2);
            components.ios_switch(ios_switch)
            components.tagsinput(tagsinput);
            // components.datepicker(datepicker);
            // components.daterangepicker(daterangepicker);
            // components.live_input(live_input, live_title);
            // console.log("loaded active");

            //檢查callback是不是function，同時執行callback
            checkfunction.callbacklength(callback);

        } else {
            return console.log("loaded no object!");
        }

    },

    callBacktest: function() {
        // console.log("callbacktest active");
    }
}

///////////////////////////////////////////////////////////////////////////////////////////////
//
//#04.Component ScrollBar相關
var component_scrollbar = {

    /*綁定scroll_bar*/
    /*ajax呼叫結構進來後 可以綁scroll_bar*/
    /*例: active_scrollBar( $('.normal .quill_select .select_list') )*/
    active_scrollBar: function(object) {
        object.scrollbar();
    },

    mainbody_sideBar: function() {

        if ($('body').hasClass('photos_theme')) {

            return;

        } else {
            component_scrollbar.active_scrollBar($('.mainContent .inner-content .content-scrollbox'));
            component_scrollbar.active_scrollBar($('.mainContent .content-sidebar .body-list'));
        }

    },

    ceditorNav_sideBar: function() {
        component_scrollbar.active_scrollBar($('.hiddenArea .editorNav'));
        component_scrollbar.active_scrollBar($('.hiddenArea .editorBody'));

    }

}

///////////////////////////////////////////////////////////////////////////////////////////////
//
//#05.Component Summernote相關
var component_summernote = {

    /*綁定summernote*/
    /*ajax呼叫結構進來後 可以綁Ｓummernote*/
    /*例: active_summernote( $('#summernote') )*/
    active_summernote: function(object) {
        object.summernote();
    }
}


///////////////////////////////////////////////////////////////////////////////////////////////
//
//#06.ajaxdata呼叫Ajax視窗
var ajaxdata = {
    allready: function() {}
}


///////////////////////////////////////////////////////////////////////////////////////////////
//
//#07.fms function call
var fms_function = {

    grid_mode: function() {
        var grid = $('.grid_mode'),
            list = grid.find('.list'),
            unlock = grid.find('.unlock'),
            icon_unlock = unlock.find('.icon_unlock');

        //unlock check event
        unlock.on('click', '.icon_unlock', function() {

            if ($(this).closest(list).hasClass('check') == false) {
                $(this).closest(list).addClass('check');
            } else {
                $(this).closest(list).removeClass('check');
            }
        });

        // console.log(this + "go")
    },

    calculate_grid: function() {
        var _innerContent = $('.fms_theme .inner-content'),
            _innerHeight = _innerContent.height(),
            _jumbotronHeight = _innerContent.find('.jumbotron').outerHeight(),
            _cardHeaderHeight = _innerContent.find('.card-header').outerHeight(),
            _frameHeight = _innerHeight - (_jumbotronHeight + _cardHeaderHeight),
            _gridMode = $('.grid_mode'),
            _frame = $('.grid_mode .frame');
        _frame.css('height', _frameHeight);
    },


    //table view mode event
    table_view_mode: function() {
        var _mode_btn = $('.card-header .mode_btn'),
            _table_mode = $('.table_mode');
        _mode_btn.on('click', function() {
            var a = $(this).attr('mode-id');
            var target = '.' + a;
            $(target).addClass('open').siblings('.table_mode').removeClass('open');
            $(this).addClass('open').siblings('.mode_btn').removeClass('open');
            //
            if (a == 'gd_mode') {

                $('.grid_mode .frame').scrollbar({});
                calculate_grid();
                $(window).resize(function() {
                    calculate_grid();
                });
            }
        });
    },



    //light_box_img 燈箱圖片
    open_fms_light_box: function() {
        var open_btn = $('.open_img_box'),
            close_btn = $('.light_box_img .close_btn');
        light_box = $('.light_box_img');

        open_btn.on('click', function() {
            light_box.addClass('open');
        });

        close_btn.on('click', function() {
            light_box.addClass('close');
            setTimeout(function() {
                light_box.removeClass('open').removeClass('close');
            }, 500);
        });
    },


    //content_sidebar_click
    content_sidebar_click: function() {
        var target = $('.level_list');
        target.on('click', 'a', function() {
            var _this_father = $(this).closest('.level_list'),
                _this_grand_father = $(this).closest('.body-list');
            var li = _this_father.find('.level_list'),
                sub = _this_father.find('.sub-menu'),
                arrow = _this_father.find('.arrow');

            //關閉所點擊的分支截點
            if (_this_father.hasClass('open active')) {
                arrow.removeClass("open active");
                sub.slideUp(200, function() {
                    li.removeClass("open active");
                });
            }


            //當點擊另一個 level-1 的時候 除了會打開另一個的 level-1 

            //同時還會把現在這個 level-1 以及她抵下的所有被打開的分支都關上
            if (_this_grand_father.children('.level_list.open').hasClass('open active')) {
                _this_grand_father.children('.level_list.open').siblings().find('.sub-menu').slideUp(200, function() {
                    $(this).find('.level_list').removeClass('open active');
                });
            }
        });
    }

}


///////////////////////////////////////////////////////////////////////////////////////////////
//fms function call



///////////////////////////////////////////////////////////////////////////////////////////////
//
//以下區域內JS未整理 wade
//未整理
function wade_datepicker() {
    $('.datepicker-input').each(function(index, el) {
        var _this = $(this);
        if (!_this.hasClass('active_date')) {
            _this.datepicker({

                todayHighlight: true,
                autoclose: true,
                language: 'zh-TW',
                format: 'yyyy/mm/dd',
                startDate: '+0d',
            });
            _this.addClass('active_date');
        }
    });
}
//未整理wade
// function open_wrapper() {
//     var a = $('.open_builder'),
//         bg = $('.hiddenArea');
//     //

//     a.on('click', function(e) {
//         // 2019.02.15 新增 contentObj
//         // Alex 要鎖 Tab 用的
//         var contentObj = $('ul.frame').find('li.inventory')
//         var content = $('.hiddenArea .hiddenArea_frame_box .detailEditor');
//         var a = $('.editorHeader').outerHeight(),
//             b = $('.hiddenArea_frame_controlBtn').outerHeight();
//         c = a + b;

//         if ($(this).hasClass('open_builder') == true) {
//             bg.addClass('open');

//             // if ( content.hasClass('scroll-wrapper') == false && bg.hasClass('wade刪除了這個css，先註解這段jscms_hiddenArea') == false ) {
//             if (content.hasClass('scroll-wrapper') == false && bg.hasClass('cms_hiddenArea') == false) {
//                 content.scrollbar({});
//                 // bg.find('.hiddenArea_frame_box .scroll-wrapper.detailEditor').css('max-height', 'calc(100% - ' + b + 'px)');
//             } else {
//                 content.find('.editorContent').scrollbar({});
//                 // bg.find('.hiddenArea_frame_box .scroll-wrapper.menu_content').css('max-height', 'calc(100% - ' + b + 'px)');
//                 // contentObj.find('.tab_content').scrollbar({})
//             }
//         }
//     });
// }
//未整理
//中間主區塊 列表項點擊 關閉右邊滑動隱藏區塊
function close_wrapper(target) {
    var object = target;
    var close_btn = target.find('.hiddenArea_frame .close_btn');

    close_btn.click(function() {

        //暫時的關閉功能
        object.addClass('remove');
        setTimeout(function() {
            object.removeClass('open').removeClass('remove');
            //wade
            close_btn.parents('form').removeClass('active');
        }, 1000);
    });
}

//wade
function change_wrapper(target) {
    var object = target;
    var change_btn = target.find('.hiddenArea_frame [data-fms-change]');

    change_btn.click(function() {

        var change_btn_attr = change_btn.attr('data-fms-change');

        object.addClass('change');
        object.find('form').removeClass('active');
        object.find('.' + change_btn_attr).addClass('active');
        object.removeClass('change');



    });
}
//未整理
//中間主區塊
//右邊滑動隱藏區塊
//關閉提醒視窗
function close_notifyScreen() {
    var object = 'quickview-wrapper';
    $('.notify-screen').on('click', '.btn', function() {
        setTimeout(function() {
            $('.' + object + '').css('left', 'calc(100%)');
        }, 450);
    });
}

//共用
/*綁定scroll_bar*/
/*ajax呼叫結構進來後 可以綁scroll_bar*/
/*例: active_scrollBar( $('.normal .quill_select .select_list') )*/
/*這樣就可以把 normal 下的所有下拉選單的select_list 綁scroll_bar*/

function active_scrollBar(object) {
    object.scrollbar();
}

///////////////////////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////////////////////////////
//
//#08.detail test相關
var testfunction = {
        load: function(fileName) {
                var newscript = document.createElement('script');
                newscript.setAttribute('type', 'text/javascript');
                newscript.setAttribute('src', fileName);
                var head = document.getElementsByTagName('head')[0];
                head.appendChild(newscript);
    }
}

///////////////////////////////////////////////////////////////////////////////////////////////
//
//#09.Ready Function Call
$(document).ready(function() {

    //test
    // testfunction.load('./assets/js/test.js');

    // readyfunction.checkfunction();
    ui_contral.allready();
    component_datatableV2.allready();

    // language_category();wade 20190922

    //Contentscrollbox
    component_scrollbar.mainbody_sideBar();
    component_scrollbar.ceditorNav_sideBar();


    //以下區域內未整理 wade////////////////////////////////////////
    close_wrapper($('.hiddenArea')); //js_builder.js
    change_wrapper($('.hiddenArea')); //js_builder.js

    close_notifyScreen();
    wade_datepicker();


    if ($('body').hasClass('cms_theme')) {
        // console.log("cms_theme")
        components.tooltip($('[data-toggle="tooltip"]'));
        //cms
        // card_table($('.main-table').attr('data-tableID')); wade先註解，因為執行頁面會噴錯

        //file_detail產品 / 商品圖片
        item_file_detail('file_detail_btn'); //js_builder.js

        //search_bar
        // search_event();wade找不到程式位置

        //打開fms lightbox(open_fms_lightbox)
        btn_fms_lightbox(); //js_builder.js

        //打開db lightbox(open_db_lightbox)
        btn_db_lightbox(); //js_builder.js

        //打開full preview(open_paragraph_preview)
        // btn_preview_lightbox(); //js_builder.js

        return

    } else if ($('body').hasClass('fms_theme')) {
        components.tooltip($('[data-toggle="tooltip"]'));

        // console.log("fms_theme")
            //fms
            //view MODE:Grid
        fms_function.grid_mode();

        //search_bar
        // search_event();wade找不到程式位置

        //table view mode event
        fms_function.table_view_mode();

        //open light_box_img 燈箱圖片
        fms_function.open_fms_light_box();

        //content_sidebar_click
        fms_function.content_sidebar_click();

        return


    } else if ($('body').hasClass('ams_theme')) {
        components.tooltip($('[data-toggle="tooltip"]'));

        // console.log("ams_theme")
            //ams
            // card_table('ams_table');wade先註解，因為執行頁面會噴錯

        //search_bar
        // search_event();wade找不到程式位置

        //打開ams lightbox(open_ams_lightbox)
        // btn_ams_lightbox(); //js_builder.js

        //打開fms lightbox(open_fms_lightbox)
        // btn_fms_lightbox(); //js_builder.js

        return

    }

    

    ////////////////////////////////////////
});



//以下區域為整理 wade
///////////////////////////////////////////////////////////////////////////////////////////////
//
// var component_dataeditor = {
//     //日期選單的datepicker , daterangepicker , timepicker 的啟動function都放在form_element.js裡
//     //想要看使用範例可以去看form_element.js
//     //Date Pickers
//     wade_datepicker: function() {
//         $('.datepicker-input').each(function(index, el) {
//             var _this = $(this);
//             if (!_this.hasClass('active_date')) {
//                 _this.datepicker({

//                     todayHighlight: true,
//                     autoclose: true,
//                     language: 'zh-TW',
//                     format: 'yyyy/mm/dd',
//                     startDate: '+0d',
//                 });
//                 _this.addClass('active_date');
//             }
//         });
//     }
// }
///////////////////////////////////////////////////////////////////////////////////////////////
//
// var readyfunction = {
//     checkfunction : function () {

//         readyfunction.commo();

//         var functionname =  $('body').attr('id');
//         eval("readyfunction."+ functionname +"()");

//     },
//     commo : function () {


//         layoutfunction.headerload();
//         layoutfunction.footerload();


//         ahrefsetting();
//     },
//     home : function () {
//         objectanimatefunction.indexcover();
//         objectanimatefunction.indexfootor();


//         blazyfunction.home();
//     },
//     works : function () {
//         objectanimatefunction.works();


//         blazyfunction.works();
//     },
//     worksdetail : function () {
//         objectanimatefunction.worksdetail();


//         blazyfunction.works();
//         blazyfunction.worksdetail();


//         scrollmenu.scrollback();


//         videoscrollplay();



//     },
//     profile : function () {

//         blazyfunction.profile();
//     },
//     recruitment : function () {
//         objectanimatefunction.recruitment();


//         jobnavclickfunction.setclick();
//     },
//     contact : function () {
//         objectanimatefunction.contact();
//     },
// };