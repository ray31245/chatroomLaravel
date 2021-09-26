/* ============================================================
 * 客製化js
 * ============================================================ */


$(document).ready( function(){

    /*============================================================
                            左邊slideBar
    ============================================================*/

        left_slideBar();

    /*============================================================
                            左邊slideBar
    ============================================================*/



    /*============================================================
                            右邊滑動隱藏區塊
    ============================================================*/

        /*================================================*/
        //右邊隱藏區塊
        close_wrapper( $('.hiddenArea') );
        close_notifyScreen();
        
        wade_datepicker();

    /*============================================================
                            右邊滑動隱藏區塊
    ============================================================*/
    




    /*============================================================
                            中間主區塊
    ============================================================*/    

        //小畫面JS
        small_screen();

        /*================================================*/
        //左邊sideBar
        static_sideBar();

        language_category();


    /*============================================================
                            中間主區塊
    ============================================================*/


});







/*============================================================
                            共用
============================================================*/

/*綁定scroll_bar*/
/*ajax呼叫結構進來後 可以綁scroll_bar*/
/*例: active_scrollBar( $('.normal .quill_select .select_list') )*/
/*這樣就可以把 normal 下的所有下拉選單的select_list 綁scroll_bar*/
function active_scrollBar(object){

    object.scrollbar();

}



//日期選單的datepicker , daterangepicker , timepicker 的啟動function都放在form_element.js裡
//想要看使用範例可以去看form_element.js
//Date Pickers
function wade_datepicker(){
    $('.datepicker-input').each(function(index, el) 
    {
        var _this = $(this);
        if(!_this.hasClass('active_date'))
        {
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



//小畫面的JS(1366px)
function small_screen(){

    var window_w = $(window).width();

    if ( window_w < 1366 ) {

        //小畫面的content-sidebar
        small_content_sidebar();
        
    }

    $(window).resize(function(){

        var window_w = $(window).width();

        if ( window_w < 1366 ) {

            //小畫面的content-sidebar
            small_content_sidebar();
            
        }

    });

}
function small_content_sidebar(){

    var side_bar = $('.content-sidebar'),
        window_w = $(window).width();

    //打開
    side_bar.on('click',function(){

        if ( window_w < 1366 && side_bar.hasClass('open_bar') == false ) {

            $(this).parent().addClass('open_bar');
            
        }

    });

    //關閉
    $(document).on('click',function(e){

        // console.log(e.target.className);

        if ( window_w < 1366 && $('.content-sidebar').has(e.target).length > 0 || e.target.className == 'content-sidebar' ) {

            return;

        }else {

            side_bar.parent().removeClass('open_bar');

        }

    });

}

/*============================================================
                            共用
============================================================*/











/*============================================================
                        table執行
============================================================*/
/*================================================*/
// sPaginationType: "bootstrap", //頁腳 換頁按鈕的樣式
// oLanguage: { //頁腳 顯示筆數樣式
//     sLengthMenu: "_MENU_ ",
//     sInfo: "Showing <b>_START_ to _END_</b> of _TOTAL_ entries"
// },
// iDisplayLength: '10', //表格欲顯示筆數
function card_table(target) {
    
    
    var targetTable = $('[data-tableID="' + target + '"]');

    var settings = {
        sDom: "<'table-responsive't><'row'<p i>>", //在html上增加結構
        paging:   false,
        ordering: true,
        info:     false,
        destroy:        true, //摧毀表格
        scrollY:        false,
        scrollX:        '100%',
        scrollCollapse: true,
        autoWidth: false,
        aoColumnDefs: [{ //把第一格也就是checkbox那格的排序功能取消
            bSortable: false,
            aTargets: [0]
        }],
    };

    switch(target) {
        case 'cms_table':
            cms_card_table(targetTable, settings);
            break;
        case 'fms_table':
            fms_card_table(targetTable, settings);
            break;
        case 'ams_table':
            ams_card_table(targetTable, settings);
            break;
        case 'ams_ajax_table':
            ams_ajax_card_table(targetTable, settings);
            break;
        default:
            console.log('目標table不存在');
    }

}
function cms_card_table(targetTable, settings){

    // settings.fixedColumns = { 
    //     leftColumns: 2 
    // };

    settings.initComplete = function () {

        $(this).closest('.card-block').addClass('open');

        //左右按鈕 滑動table
        Table_scrollBtn();

        //打開右邊隱藏選單
        open_wrapper();

        //table menu-list下拉選單
        table_dropdown();

        //計算有幾個可以勾的checkbox
        dataTable_tickCount();
        
    },

    settings.fnPreDrawCallback = function( oSettings ) {

        $('.main-table .dataTables_scrollBody tbody tr.selected').removeClass('selected');

    }

    var Q_table = targetTable.find('table').DataTable(settings);

    //給datatable高度 讓scrollbar可以滑到底
    calculate_data_table_height(targetTable);
    
    // 2019.02.21 Alex 加上
    hoistingTableHeader()

    //套scrollbar
    // targetTable.find('.dataTables_scrollBody').scrollbar({});

    //input點擊事件
    click_event();

    //頁腳切換頁面事件
    // pagination_event();

    //左邊固定bar 選單類別切換事件
    // sideBar_list(Q_table)


}
function fms_card_table(targetTable, settings){

    settings.initComplete = function () {

        $('.card-block').eq(0).addClass('open');

        //打開右邊隱藏選單
        open_wrapper();

        //計算有幾個可以勾的checkbox
        dataTable_tickCount();
        
    },

    settings.fnPreDrawCallback = function( oSettings ) {

        $('.main-table .dataTables_scrollBody tbody tr.selected').removeClass('selected');

    }

    var Q_table = targetTable.find('table').DataTable(settings);

    //給datatable高度 讓scrollbar可以滑到底
    calculate_data_table_height( targetTable );

    //input點擊事件
    click_event();

    //頁腳切換頁面事件
    // pagination_event();

}
function ams_card_table(targetTable, settings){

    settings.initComplete = function () {

        $(this).closest('.card-block').addClass('open');

        //打開右邊隱藏選單
        open_wrapper();

        //計算有幾個可以勾的checkbox
        dataTable_tickCount();
        
    },

    settings.fnPreDrawCallback = function( oSettings ) {

        $('.main-table .dataTables_scrollBody tbody tr.selected').removeClass('selected');

    }

    var Q_table = targetTable.find('table').DataTable(settings);

    //給datatable高度 讓scrollbar可以滑到底
    calculate_data_table_height( targetTable );


    //input點擊事件
    click_event();

    //頁腳切換頁面事件
    // pagination_event();

}
function ams_ajax_card_table(targetTable, settings){

    settings.initComplete = function () {

        $(this).closest('.card-block').addClass('open');

        //計算有幾個可以勾的checkbox
        dataTable_tickCount();
        
    },

    settings.fnPreDrawCallback = function( oSettings ) {

        $('.main-table .dataTables_scrollBody tbody tr.selected').removeClass('selected');

    }

    var Q_table = targetTable.find('table').DataTable(settings);

    //給datatable高度 讓scrollbar可以滑到底
    calculate_data_table_height( targetTable );


    //input點擊事件
    click_event();

}


//計算每個dataTable的初始高度
function calculate_data_table_height(table) {
    

    var frame                 = $(table).closest('.page-container'),
        frame_height          = frame.height(),
        jumbotron_height      = frame.find('.jumbotron').outerHeight(), //佈告欄的高
        header_height         = frame.find('.header').outerHeight(), //最上面的高
        card_head_height      = frame.find('.card-header').outerHeight(), //表格上面的按鈕那塊的高
        table_head_height     = frame.find('.dataTables_scrollHead').outerHeight(), //表頭高
        page_foot_height      = frame.find('.page_foot').outerHeight(), //頁腳高
        scroll_wrapper = '',
        container_height  = '';

    
    // container_height = frame_height - jumbotron_height - header_height - card_head_height - table_head_height - page_foot_height - 60;
    // container_height = '80vh'
        
    container_height = (frame.length? frame_height - jumbotron_height - header_height - card_head_height - table_head_height - page_foot_height - 60 : '80vh');

    scroll_wrapper = container_height + table_head_height;

    table.find('.dataTables_scrollBody').css('max-height', container_height);

}

// 2019.02.21 新增
// 強迫 tableHeader 硬是拉到比較高的層級
function hoistingTableHeader() {
    document.querySelector('.dataTables_scrollHead').setAttribute('style', [
        'border: none',
        'position: relative',
        'border: 0',
        'z-index: 1',
    ].join(';'))
}


//table menu-list下拉選單
function table_dropdown(){
    $('table .dropdown .dropdown-menu').css({
        'min-width':'150px',
        'width':'100%',
    });
    $('table .dropdown .btn').css('width','100%');
}

//左右按鈕 滑動table
function Table_scrollBtn(){

    //因為可能會因為"ajax呼叫後"或"多表格" 發生再次綁定
    //所以每次被呼叫就先解綁再綁定，很蠢(先頂著用)
    $('.table-box .arrow-group .arrow').unbind();

    // var x = 0, //初始值
    //     distance = 200; //移動距離

    $('.table-box .arrow-group .arrow').on('click','span',function() {

        var box = $(this).closest('.table-box').find('.dataTables_scroll .dataTables_scrollBody'),
            box_head = $(this).closest('.table-box').find('.dataTables_scroll .dataTables_scrollHead'),
            table = box.find('.table'),
            move_length = table.width() - box.width(); //全部可移動寬度 ( clientWidth )

            console.log( table.width() +'ppp' );
            console.log( box.width() +'ppp' );


        if ($(this).hasClass('right')) {

            x = ((box.width() / 4)) + box.scrollLeft();  //box.scrollLeft(); 可以放入數值

            box.animate({
                scrollLeft: x,
            });

            // console.log(x);
            // console.log(distance);
            // console.log(move_length);

            //如果有套scroll 就執行這個
            // if ( x < distance - 1 ) {
            //     //往右走時 先判斷 x 是否小於移動距離
            //     //若小於移動距離就把 x 還原成 0 ， 避免往左走 走到底時的 x 不等於0 ， 進而影響往右走的 x 數值
            //     x = 0;
            // }

            // if ( x + distance < move_length ) {
            //     //如果 x + 移動距離 小於 可移動寬度 便執行
            //     x = x + distance;

            //     box_head.find('.table').css({
            //         'transform': 'translateX(-'+ x +'px)',
            //         '-webkit-transform': 'translateX(-'+ x +'px)',
            //         '-moz-transform': 'translateX(-'+ x +'px)',
            //         '-ms-transform': 'translateX(-'+ x +'px)',
            //         '-o-transform': 'translateX(-'+ x +'px)',
            //     });
            //     box.find('.table').css({
            //         'transform': 'translateX(-'+ x +'px)',
            //         '-webkit-transform': 'translateX(-'+ x +'px)',
            //         '-moz-transform': 'translateX(-'+ x +'px)',
            //         '-ms-transform': 'translateX(-'+ x +'px)',
            //         '-o-transform': 'translateX(-'+ x +'px)',
            //     });
                
            // }else {
            //     //如果 x + 移動距離 大於 可移動寬度 ， 表示以經到底了 移動距離 大於 可移動寬度
            //     //所以 最後一步的移動數值 就是 可移動寬度 ， 這樣就可以移動到底
            //     x = move_length;
                
            //     box_head.find('.table').css({
            //         'transform': 'translateX(-'+ move_length +'px)',
            //         '-webkit-transform': 'translateX(-'+ move_length +'px)',
            //         '-moz-transform': 'translateX(-'+ move_length +'px)',
            //         '-ms-transform': 'translateX(-'+ move_length +'px)',
            //         '-o-transform': 'translateX(-'+ move_length +'px)',
            //     });
            //     box.find('.table').css({
            //         'transform': 'translateX(-'+ move_length +'px)',
            //         '-webkit-transform': 'translateX(-'+ move_length +'px)',
            //         '-moz-transform': 'translateX(-'+ move_length +'px)',
            //         '-ms-transform': 'translateX(-'+ move_length +'px)',
            //         '-o-transform': 'translateX(-'+ move_length +'px)',
            //     });

            // }
            

        } else {

            x = ((box.width() / 4)) - box.scrollLeft();  //box.scrollLeft(); 可以放入數值

            box.animate({
                scrollLeft: -x,
            });

            // console.log(x);
            // console.log(distance);
            // console.log(move_length);

            //如果有套scroll 就執行這個
            // if ( x == 0 ) {
            //     // x == 0 表示 在最左邊了 不用做任何動作
            //     return;

            // } 
            // else if ( x - distance < 0 ) {
            //     // x - distance < 0 表示為負值 代表這次移動會超過最左邊的 0px (會跑版) ， 所以就讓它移動到最左邊的 0px
            //     box_head.find('.table').css({
            //         'transform': 'translateX(0px)',
            //         '-webkit-transform': 'translateX(0px)',
            //         '-moz-transform': 'translateX(0px)',
            //         '-ms-transform': 'translateX(0px)',
            //         '-o-transform': 'translateX(0px)',
            //     });
            //     box.find('.table').css({
            //         'transform': 'translateX(0px)',
            //         '-webkit-transform': 'translateX(0px)',
            //         '-moz-transform': 'translateX(0px)',
            //         '-ms-transform': 'translateX(0px)',
            //         '-o-transform': 'translateX(0px)',
            //     });
                
            // }
            // else if ( x - distance < move_length ) {
            //     // x - distance < move_length 表示 x < 可移動寬度 ， 所以就正常的往左移動
            //     x = x - distance;

            //     box_head.find('.table').css({
            //         'transform': 'translateX(-'+ x +'px)',
            //         '-webkit-transform': 'translateX(-'+ x +'px)',
            //         '-moz-transform': 'translateX(-'+ x +'px)',
            //         '-ms-transform': 'translateX(-'+ x +'px)',
            //         '-o-transform': 'translateX(-'+ x +'px)',
            //     });
            //     box.find('.table').css({
            //         'transform': 'translateX(-'+ x +'px)',
            //         '-webkit-transform': 'translateX(-'+ x +'px)',
            //         '-moz-transform': 'translateX(-'+ x +'px)',
            //         '-ms-transform': 'translateX(-'+ x +'px)',
            //         '-o-transform': 'translateX(-'+ x +'px)',
            //     });
                
            // }

        }

    })
    
}


//計算有幾個可以勾的checkbox
function dataTable_tickCount(){
    var tick = $('.dataTables_scrollBody .tbody_tick');
    for (var a = 0; a < tick.length; a++) {
        tick.eq(a).attr('tick-id',a);
        var box_id = a + 1;
        tick.eq(a).find('.checkbox input').addClass('container_checkBox'+ box_id);
    }
}

//點擊事件
function click_event(){

    var count_number = [];

    $('.main-table tbody tr .checkbox').on('click', function () {
    

        $(this).closest('tr').toggleClass('selected');

        var b = ($(this).closest('tr').attr('tick-id')) / 1 + 1; 

        var scrollBody_inputCheckbox = $(this).closest('.table-box').find('.dataTables_scrollBody tbody tr .container_checkBox' + b),
            scrollBody_tr            = scrollBody_inputCheckbox.closest('tr'),
            scrollLeft_tr            = $(this).closest('tr');

        var main_table = $('.main-table');


        //判斷table有沒有fixedColumns:left
        if ( main_table.hasClass('no_left') == false ) {

            scrollBody_tr.toggleClass('selected');

        }

        //每次點擊都會被啟動的"順序計算器"
        checkbox_number(scrollBody_tr,scrollLeft_tr,count_number,main_table);
        

    });

}
//checkbox點擊顯示數字
function checkbox_number(tr,left_tr,count_number,main_table){

    if ( tr.hasClass('selected') == true ) {

        if ( main_table.hasClass('no_left') == true ) {

            var target = tr;
            
        }else {

            var target = left_tr;

        }
    
        //現在的陣列長度，用來看現在順序到哪
        var base_id = count_number.length;

        //在tr上面放一個順序的數字
        target.attr('sort-id', base_id);

        //這個是顯示出順序的數字
        target.find('label span').html(base_id + 1);


        //把 順序 放入陣列裡
        count_number[base_id] = [base_id];


        // console.log(count_number);
        
    }else {
        //取消選取時
        //先把現在這個被取消的 順序數字放入a
        if ( main_table.hasClass('no_left') == true ) {

            var a = tr.attr('sort-id') / 1;

            var target = tr;
            
        }else {

            var a = left_tr.attr('sort-id') / 1;

            var target = left_tr;

        }

        //把被取消的順序數字刪除
        target.attr('sort-id','');

        //把顯示出的順序數字也刪除
        target.find('label span').html('');

        
        //從陣列裡把被取消的那列給刪除
        count_number.splice(a, 1);

        //用迴圈把所有的順序重跑一次
        for (var index = 0; index < count_number.length; index++) {

            //取出每條的順序數字
            var b = target.siblings('.selected').eq(index).attr('sort-id');

            //將 順序數字 與 刪除的那列 做比較
            //當順序數字 大於或等於 刪除的數字時 才做順序數字的更新(因為每次只能點擊一個 所以順序數字只要固定的-1)
            if ( b >= a ) {

                target.siblings('.selected').eq(index).attr('sort-id', b - 1);

                target.siblings('.selected').eq(index).find('label span').html(b);
                
            }
            
        }


        

        // console.log(count_number);

    }

}
//頁腳切換頁面事件
// function pagination_event(){

//     $('.main-table .dataTables_paginate').on('click',function(){

//         $('.main-table .DTFC_LeftWrapper tbody tr input').on('click',function(){

//             $(this).closest('tr').addClass('selected');

//             var b = ($(this).closest('tr')[0].dataset.dtRow)/1 + 1;

//             $(this).closest('.table-box').find('.dataTables_scrollBody tbody tr input#checkbox' + b).closest('tr').toggleClass('selected');

//         });

//     });

// }


//批次table 將選取的tr裡的內容取出 並且建構table
function batch_creat_table(Q_table){

    //塞值進入batch_table
    $('[to-do="batch"]').click( function () {

        var row_thead        = $( Q_table.table().header() ).find('th');
        var row_thead_choose = $( Q_table.table().header() ).find('th.be_choose');
        var row_data         = Q_table.rows('.selected').data();

        var aColumns = [];


        for (var index = 0; index < row_thead_choose.length; index++) {

            var b = row_thead_choose.eq(index).text();

            aColumns.push({ sTitle: b});
            
        }


        //建構table
        batch_table(aColumns,row_data);

    } );

    //刪除
    $('[to-do="delete"]').click( function () {

    } );

    //複製
    $('[to-do="copy"]').click( function () {

    } );

}
//把取出的值塞入已經建構好的批次table裡
function batch_print(Batch_table,row_data){
    
    Batch_table.clear().draw();
    // Batch_table.rows.add(row_data); // Add new data
    Batch_table.columns.adjust().draw(); // Redraw the DataTable

}


//cms_theme
//中間主區塊 列表項點擊 開啟右邊滑動隱藏區塊
function open_wrapper(){

    var a = $('.open_builder'),
        bg = $('.hiddenArea');
    //
    a.on('click', function (e) {

        // 2019.02.15 新增 contentObj
        // Alex 要鎖 Tab 用的

        var contentObj = $('ul.frame').find('li.inventory')  

        var content = $('.hiddenArea .hiddenArea_frame_box .box_block');
        
        var a = $('.box_header').outerHeight(),
            b = $('.hiddenArea_frame_controlBtn').outerHeight();
            c = a + b;
        
        
        if ( $(this).hasClass('open_builder') == true ) {

            bg.addClass('open');

            if ( content.hasClass('scroll-wrapper') == false && bg.hasClass('cms_hiddenArea') == false ) {

                content.scrollbar({});

                // bg.find('.hiddenArea_frame_box .scroll-wrapper.box_block').css('max-height', 'calc(100% - ' + b + 'px)');

            }else {

                content.find('.menu_content').scrollbar({});

                // bg.find('.hiddenArea_frame_box .scroll-wrapper.menu_content').css('max-height', 'calc(100% - ' + b + 'px)');

                // contentObj.find('.tab_content').scrollbar({})

            }

        }

    });

}


//中間主區塊 列表項點擊 關閉右邊滑動隱藏區塊
function close_wrapper(target){

    var object = target;

    var close_btn = target.find('.hiddenArea_frame .close_btn');


    close_btn.click(function() {

        //暫時的關閉功能
        object.addClass('remove');
        setTimeout(function(){
            object.removeClass('open').removeClass('remove');
        }, 1000);

        //本來的關閉功能
        // var size_judge = $('.modal-dialog'),
        //     screen     = $('.notify-screen');

        // if ( size_judge.hasClass('modal-sm') == true ) {

        //     screen.modal('show');

        //     $('.' + object + '').css('left','calc(100% - 17px)');

        //     $('body').removeClass('open_hideBlock');

        // }

    });

}


//fms_theme


/*============================================================
                        table執行
============================================================*/




/*============================================================
                            左邊slideBar
============================================================*/
function left_slideBar(){

    var bar = $('.left-slide'),
        bar_menu_item = bar.find('.sidebar-menu ul.menu-items');

    bar.mouseenter(function(){

        bar_menu_item.addClass('show');

    });

    bar.mouseleave(function(){

        bar_menu_item.removeClass('show');

    });

}


/*============================================================
                            左邊slideBar
============================================================*/







/*============================================================
                        中間主區塊
============================================================*/

    /*================================================*/
    /*SECONDARY SIDEBAR MENU(data-pages="sec-sidebar")*/
 
    //固定sideBar
    function static_sideBar(){

        $('.content-sidebar .body-list').scrollbar();

        // var sideBar = $('[data-pages="sidebar"]');

        // //
        // sideBar.mouseenter(function(){
        //     $('.content-sidebar').css('transform','translate3d(0,0,0)');
        // });
        // sideBar.mouseleave(function(){
        //     $('.content-sidebar').css('transform','translate3d(0,0,0)');
        // });

    }


    //language_category
    function language_category(){

        var lng           = $('.language .sub-menu .lng'),  //語系
            display_title = $('.language .display-title .title');  //顯示的標題

        lng.on('click',function(){

            if ( $(this).closest('.lng-category').length > 0 ) {
                //兩層，把被選取的語系文字 跟 他上一層的 分類標題名稱 做組合

                //抓出預備更換的文字
                var name = $(this).closest('.lng-category').find('.title-box .title').text();

                var lng = $(this).find('a').text();


                //預防有多餘空白問題(把空白消掉)
                name = name.replace(/ /g, "");

                lng = lng.replace(/ /g, "");


                //將抓出來且去除多餘空白的文字 依規則組合在一起
                var a = name + ' - ' + lng;

                display_title.text(a);

                
            }else {
                //一層，直接把被選擇的語系文字 與 標題名稱 組合

                //抓出預備更換的文字
                var name = [];

                var title = display_title.text();

                var lng = $(this).find('a').text();


                //預防有多餘空白問題(把空白消掉)
                name = title.split("-"); //用 - 把文字給分隔開來 

                name = name[0].replace(/ /g, "");

                lng = lng.replace(/ /g, "");


                //將抓出來且去除多餘空白的文字 依規則組合在一起
                var a = name + ' - ' + lng;

                display_title.text(a);

            }

        });

    }


    //SECONDARY sideBar_list
    function sideBar_list(Q_table){

        var staticBar         = $('.content-sidebar'),
            staticBar_list    = staticBar.find('.body-list .list'),
            Qtable_headerText = $('.inner-content .card-title .vice');

        staticBar_list.on('click',function(){

            var clickList_text = $(this).find('.title')[0].innerText;

            Qtable_headerText.text(clickList_text);

            Q_table.destroy();
            $('.inner-content .table-box .table').empty(); // empty in case the columns change

            card_table();
 
        });

    }


/*============================================================
                        中間主區塊
============================================================*/





/*============================================================
                        右邊滑動隱藏區塊
============================================================*/

    /*================================================*/

    //關閉提醒視窗
    function close_notifyScreen(){

        var object = 'quickview-wrapper';

        $('.notify-screen').on('click','.btn',function(){

            setTimeout(function(){

                $('.' + object + '').css('left','calc(100%)');
                
            }, 450);

        });

    }


    
    // quickview_btn.on('click',function(){

    //     $(this).attr();

    // });


    // $('.remove').on('click',function(){
        
    //     $('.modal').addClass('show');

    // });

    
/*============================================================
                        右邊滑動隱藏區塊
============================================================*/





/*空白鍵被綁定的事件，需要改要再去文件看一次，這個只是先抓出來 方便以後要改時可以快速找到是什麼東西*/
/*this.selEl.addEventListener('keydown',*/
/*// space key
    case 32:
        ev.preventDefault();
        if (self._isOpen() && typeof self.preSelCurrent != 'undefined' && self.preSelCurrent !== -1) {
            self._changeOption();
        }
        self._toggleSelect();
        break;*/

/*============================================================
* 從 page.js 拆出來的功能。
* 處理右側選單開合。
* 保險起見，page.js 裡面的這一段已經先被註解起來。
============================================================*/

$(document).on('click', '.sidebar-menu a', function (e) {

    if ($(this).parent().children('.sub-menu') === false) {
        return;
    }
    var el = $(this);
    var parent = $(this).parent().parent();
    var li = $(this).parent();
    var sub = $(this).parent().children('.sub-menu');


    if (li.hasClass("open active")) {
        el.children('.arrow').removeClass("open active");
        sub.slideUp(200, function() {
            li.removeClass("open active");
        });
        console.log('我走 if')

    } else {
        parent.children('li.open').children('.sub-menu').slideUp(200);
        parent.children('li.open').children('a').children('.arrow').removeClass('open active');
        parent.children('li.open').removeClass("open active");
        el.children('.arrow').addClass("open active");
        sub.slideDown(200, function() {
            li.addClass("open active");

        });
        li.siblings().find('.open .active').removeClass('open active')
        console.log('我沒走 if')
    }
    e.preventDefault();
});

