var common = {
  resize: function () {
    $(window).on('resize', function() {
      common.fixmobile100vh();
    });
  },
  fixmobile100vh: function() {
    let vh = window.innerHeight * 0.01;
    document.documentElement.style.setProperty('--vh', vh + 'px');
  },
  bodylock: function(type) {
    if (type) {
      if (mobile()) {
        $('html').css({
          'overflow-y': 'hidden',
          'height': '100%',
          'display': 'block',
        });
      } else {
        $('html').css({
          'overflow-y': 'hidden',
          'height': '100%',
          'display': 'block',
        });
      }
    } else {
      $('html').attr('style','');
      common.fixmobile100vh();
    }
  },
  // Blazy基本
  blazyInit() {
    var bLazy = new Blazy({
      offset: -100,
      success: function () { 
      }
    });
  },
  getMySwiper(name) {
    var swiperName = $(`[data-swiper-name="${name}"]`);
    var index = swiperName.data('swiperMyswiper');
    var myIndexSwiper = mySwiper[index];
    return myIndexSwiper
  },
  dropdown: function () {
    $('.dropdown .dropdown_opt').scrollbar();
    $('.dropdown .dropdown_click').off().on('click', function () {
      let $this = $(this),
          $open_obj = $this.next('.dropdown_select'),
          $icon = $this.closest('.dropdown').find('.icon-arrow_right'),
          $opt_li = $open_obj.find('li'),
          $title = $this.find('.dropdown_title');
      $open_obj.slideToggle('slow');
      $icon.toggleClass('open');
      $this.toggleClass('border');

      $opt_li.on('click', function () {
        let opt = $(this).text();
        $title.text(opt);
        $icon.removeClass('open');
      });

      $('body').on('mouseup', function (e) {
        let wrap = $this;
        if (!wrap.is(e.target) && wrap.has(e.target).length === 0) {
          $open_obj.slideUp();
          $icon.removeClass('open');
          $this.removeClass('border');
        }
      })
    });
  },
  dropdown_form: function () {
    $('.formdd_opt').scrollbar();
    $('.formdd_click').off().on('click', function () {
      let $this = $(this),
          $open_obj = $this.next('.formdd_select'),
          $icon = $this.closest('.formdd').find('.icon-arrow_right'),
          $opt_li = $open_obj.find('li'),
          $title = $this.find('.formdd_title');
      $open_obj.slideToggle('slow');
      $icon.toggleClass('open');

      $opt_li.on('click', function () {
        let opt = $(this).text();
        $title.text(opt);
        $icon.removeClass('open');
        $this.addClass('white');
        // if($this.closest('.form_list').hasClass('add')){
        // }else{
        //   $this.closest('.form_list').addClass('write');
        // }
      });

      $('body').on('mouseup', function (e) {
        let wrap = $this;
        if (!wrap.is(e.target) && wrap.has(e.target).length === 0) {
          $open_obj.slideUp();
          $icon.removeClass('open');
        }
      })
    });
  },

  dropdown_in: function () {
    $('.dropdown_in .dropdown_opt').scrollbar({ignoreMobile: true,});
    $('.dropdown_in .dropdown_click').off().on('click', function () {
      let $this = $(this),
          $obj_add = $this.closest('.dropdown_in'),
          $open_obj = $this.next('.dropdown_select'),
          $icon = $this.closest('.dropdown_in').find('.icon-arrow_right'),
          $opt_li = $open_obj.find('li'),
          $title = $this.find('.dropdown_title');
      $icon.toggleClass('open');
      $obj_add.toggleClass('open');

      $opt_li.on('click', function () {
        let opt = $(this).text(),
            opt_color = $(this).attr('data-bgcolor'),
            word_color = $(this).attr('word-color');
        $title.text(opt);
        $icon.removeClass('open');
        if(word_color == 'black'){
          setTimeout(function(){
            $this.css('background',opt_color)
            $this.addClass('word_b')
          },100)
        }else{
          setTimeout(function(){
            $this.css('background',opt_color)
            $this.removeClass('word_b')
          },100)
        }
      });

      $('body').on('mouseup', function (e) {
        let wrap = $this;
        if (!wrap.is(e.target) && wrap.has(e.target).length === 0) {
          // $open_obj.slideUp();
          $icon.removeClass('open');
          $obj_add.removeClass('open');
        }
      })
    });
  },
  eachWaypoint: function (target, offsetValue) {
    $(target).each(function (index, element) {
      $(element).waypoint({
        handler: function () {
          $(element).addClass('show');
        },
        offset: offsetValue,
      });
    });  
  },
  color: function() {
    $('[data-bgcolor]').each(function(){
      let $this = $(this),
          this_color = $this.attr("data-bgcolor");
      $this.css('background',this_color);
    })
  },

  gobackAnimate: function gobackAnimate() {
    $("html").append('<div class="animate-layer"><div class="layer-out"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="圖層_1" x="0px" y="0px" viewBox="0 0 291.3 350.6" style="enable-background:new 0 0 291.3 350.6;" xml:space="preserve"><style type="text/css"> .st0{fill:#FFFFFF;} .st1{fill:#FFFFFF;} .st2{fill:#FFFFFF;} .st3{fill:#FFFFFF;} .st4{fill:#FFFFFF;}</style><g><path class="st0" d="M188.7,19.9c1.7,2.5,2.2,6,1,8.8c-1.4,3.3-5.3,5.1-8.8,4c-2-0.7-3.8-1.8-4-4.3c-0.1-1.9,1.2-4,3-4.6   c3.3-1.1,6.8,0.9,6.8,4.2c0,0,1.5-6.4-5.5-7.3c-3.5-0.4-8.2,3.2-9.6,7.4c-1.4,4-1.6,8.5-0.1,12.6c1.6,4.4,5.3,7.2,8.4,10.6   c3.6,3.9,7.1,7.9,9.9,12.4c7.6,12,14.7,53.5-27.4,71.3c-1.9,3.1-1.4,12.1,0.8,14.4c1.3,1.3,3.1,2.5,5.2,3.3   C185.8,94.3,299.3,55.4,273.8,22c-14.5-16.7-37-24.5-58.4-20.8c-13.6,2.3-25.3,8.2-37.4,13.1c3.9,0.7,7.5,2.1,9.9,4.7   C188.2,19.2,188.5,19.6,188.7,19.9z"/><path class="st1" d="M163.4,185.8c-4.7,10.4-18,21.6-12.9,33.7c0.4,1,0.9,1.8,1.5,2.7c24,2.6,42.2,22.2,43.6,49.3c1.2,24.2-8.9,45-11.5,68.3   c-0.2,1.5-0.9,3.4-0.2,4.9c4.1,8.5,21.8,12.7,47.7-19.6c14.4-18,17.5-36.8,17.6-56C214.1,256,164.2,229.8,163.4,185.8z"/><g><path class="st2" d="M251.5,195.3c5.9-21.6,19.4-40,28.1-60.5c7.8-18.5,12.9-42.9,11.4-65.8c-3.8,26.4-28.7,61.9-109.2,101.9    c13.7,3.3,42.1,40.5,66.2,70.6C247.4,226.2,247.3,210.8,251.5,195.3z"/><path class="st3" d="M101.4,190.2c1.8,3.4,3.4,7.5,2.8,10.2c1.3-0.8,2.6-1.8,3.9-2.7c-0.4-2.5-1.4-5.1-3.9-7.8    C104.2,189.9,103.1,190.1,101.4,190.2z"/><path class="st4" d="M113.6,221.5c-4-2-5.9-4.2-6.6-6.5c-3.5,2.3-6.3,3.4-8.1,2.5c-14.2-7-1.5-16.7-6.6-27.6c-3.2-0.5-6.4-1.6-8.5-3.6    c-5,0.1-11.8-0.6-15.1-4.5c-5.5-6.4-10.4-10.3-11.1-11.1c-0.8-0.9-3.8-3.1-3.6-4.5c0.2-1,1.3-1,2.2-1c0.9,0,1.8,0.1,2.6,0.4    c3.8,1.2,7.8,4.2,10,7.2c0.7,1,1.8,1.3,2.9,1.4c-1.2-1.1-3.3-2.8-3.1-4c0.2-1,1.3-1,2.2-1c0.2,0,0.4,0,0.6,0    c-2.1-4.3-3.2-10.6,0.7-18.7c0,0-20.7,1.4-24.5-16.2c0,0,17.4-1.1,25.4,11.9c0,0,3.1-17.1,24.1-19.5c0,0,0.7,21.9-22.2,23.8    c0,0-6.8,13.4,3.2,21.4c0.4,0.3,0.8,0.5,1.2,0.8c5.4-1,10.7-0.4,14.6,4c7.5-1.4,15,0.3,18.3,10.9c0,0,1.4,1.9,2.9,4.5    c2.8-2.5,5.4-5.4,7.6-8.6c1.1-3.2,3.2-6.6,5.7-9.8c0.6-1.3,1.1-2.6,1.6-3.8c1.5-4,1.8-6.9,6.3-8.6c2.9-1.2,5.8-3,8.8-6.6    c1.1-4.7,1-10.3,1-10.3s-8.5,6-14.7,7.2s-19.6-10-21.3-14.6c-2.8-7.6,5-10.5,3.5-10.9c-4.9,3.3-12-1.7-12-1.7    c10.5,2.5,8.6-2.7,8.6-2.7c-5.3-2.2-5.6-11.1-5.6-11.1c-1.3-1.8-2.6-3.7-3.6-5.7c-4-7.8-4.1-16.4,1.2-23.6    c5.8-7.9,14.7-10,22.9-14.8c6.1-3.6,11.4-8.5,14.3-14.9c3.3-7.2,5.1-15,8.8-22.1c1.6-3,3.5-5.9,5.8-8.4c-4.2,0.6-8.6,0.9-13.3,0.6    c-22.9-1.2-41.1-16.2-63-20.8C55.2-3.5,30.8,5.4,16.1,23.6c-23.5,28.9-17.9,79-4.4,111.2c8.6,20.6,22.1,39,28.1,60.5    c12.4,45-12.3,89.3,20.1,129.7c25.9,32.3,43.6,28.1,47.7,19.6c2.2-4.5-2.7-15.2-3.8-19.6c-3.2-12.3-6.2-24.8-7.4-37.5    c-2.3-24.5,3.7-47,22.9-58.4c-0.9-2.5-1.4-5.2-1.6-7.9C116,221.9,114.6,222,113.6,221.5z"/></g></g></svg><div class="layer main"></div><div class="layer sub"></div></div>');
    setTimeout(function () {
      $('.animate-layer').addClass('active');
    }, 100);
    $("body").delay(100).animate({ opacity: "1" }, {
      queue: true,
      duration: 500,
      easing: "easeOutQuad",
      complete: function complete() {
        window.location.assign(ref);
      }
    });
  },
  transitions: function transitions() {
    // if ($('body').hasClass('home') || $('body').hasClass('nocg')) return;
    // $("html").append('<div class="lightbox_trans step"><div class="lightbox_wrap"><div class="svg"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="100px" height="100px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve"><g><path class="a" fill="none" stroke="#fff" stroke-width="8" stroke-miterlimit="10" d="M53.834,31.333h37.833v57.833H53.834 M45.5,31.333 H26.833V50.5H45.5"></path><path class="a" fill="none" stroke="#fff" stroke-width="8" stroke-miterlimit="10" d="M45.5,69.667H8V11.333h37.5 M53.834,69.667h18.999 V50.5H53.834"></path></g><g><path fill="none" stroke="#fff" stroke-width="1" stroke-miterlimit="10" d="M45.5,73.667H3.833V7.833H45.5v8H11.833v49.834H45.5V73.667z M45.5,54.5H22.667V27.333   H45.5v8H30.667V46.5H45.5V54.5z M95.5,93.168H53.834v-8H87.5V35.333H53.834v-8H95.5V93.168z M76.667,73.668H53.834v-8h14.833 V54.502H53.834v-8h22.833V73.668z"></path></g></svg></div></div></div>');
    $('.lightbox_trans').addClass('open');
    setTimeout(function () {
      $('.lightbox_trans').css('opacity', '0');
    }, 1500);
    setTimeout(function () {
      $('.lightbox_trans').remove();
    }, 1700);
  }
};

////////////////////////////////////
//              燈箱              //
////////////////////////////////////
function lightbox(data) {
  console.log("data" + data);
  setTimeout(function(){
    $(data.Container).addClass('open');
    lock_Scroll();
  },100);
  close_lightBox(data.Container);
  // console.log($(this))
  
}


// 關燈箱
function close_lightBox (target) {
  console.log(target)
  var ajaxCloseBtn = $(target).find('.ajax_close');
  console.log(ajaxCloseBtn)
  $(target).find('.lightbox_wrap').scrollbar({
    ignoreMobile: true,
  })
  
  ajaxCloseBtn.on('click', function () {
    setTimeout(function(){
      $(target).removeClass('open');
    },100);
    setTimeout(function(){
      $(target).remove();
      unlock_Scroll();
    },1000);
    // $('body').unbind('mouseup');
  });
  // $('body').bind('mouseup', function (e) {
  //   let wrap = $('.lightbox_wrap');
  //   if (!wrap.is(e.target) && wrap.has(e.target).length === 0) {
  //     setTimeout(function(){
  //       $(target).removeClass('open');
  //     },100)
  //     setTimeout(function(){
  //       $(target).remove();
  //       unlock_Scroll()
  //     },1000)
  //     $(this).unbind('mouseup');
  //   }
  // })
}

// 鎖螢幕
function lock_Scroll () {
  $("body").css({
    "overflow-y": "hidden"
  })
}

// un鎖螢幕
function unlock_Scroll() {
  $("body").css({
    "overflow-y": ""
  })
}

let swiper = {
  swiperInit: function(el,setting){
    var swiper = new Swiper(el,setting);
  },
  product: function(){
    swiper.swiperInit('.newsdt_relate .swiper-container', {
      loop: true,
      slidesPerGroup: 1,
      autoplay: {
        delay: 5000,
      },
      speed: 1000,
      effect: 'fade',
      
    });
  }
}

let menu = {
  openlbox() {
    $('.navbar .hamburger').on('click', function() {
      $('.menu-scroll').scrollbar({
        ignoreMobile: true,
      });
      $('.menu').addClass('open');
      common.bodylock(true);
      menu.closelbox();
    });
  },
  closelbox() {
    $('.menu .square-close').on('click', function() {
      $('.menu').removeClass('open');
      common.bodylock(false);
    });
  },
  fastestmenu() {
    let nowstatus = true;
    let once = true;
    $('.navbar .container .list .fast').on('mouseenter', function() {
      $('.navbar .fastest').addClass('active');
      if($('.navbar').hasClass('black')){ // 原本是否有黑色
        if(once){
          nowstatus = false
          once = false
        }
      }else{
        if(once){
          nowstatus = true
          once = false
        }
        $('.navbar').addClass('black');  
      }
    });
    $('.navbar .fastest').on('mouseleave', function() {
      $('.navbar .fastest').removeClass('active');
      if(nowstatus == true){
        $('.navbar').removeClass('black');
        nowstatus = true;
      }
      once = true
    });
  },
  init() {
    menu.openlbox();
    menu.fastestmenu();
    $('.navbar .fastest .wrap .wrap-content .scroll').scrollbar();
  },
  nav_scroll() {
    let nav_h = $('nav').height(),
        lastscrollY = 0;
    $(window).on('scroll',function(){
      var nowscrollY = $(window).scrollTop();
      if(nowscrollY <= lastscrollY){ // 滾輪方向
        //上滾 出現
        if(nav_h > nowscrollY){ // nav以上
          $('nav').addClass('show');
          setTimeout(function(){
            $('nav').removeClass('fixed');
          },500)
          $('nav').removeClass('black');
        }else{
          $('nav').addClass('show');
          $('nav').addClass('black');
        }
      }else{
        //下滾 隱藏
        if(nav_h > nowscrollY){
          
        }else{
          $('nav').addClass('fixed');
          $('nav').removeClass('show');
        }
        
      }
      setTimeout(function () {
        lastscrollY = nowscrollY;
    }, 100);
    })
  },
}

let home = {
  setSwiper() {
    let destroySwiper = function() {
      if ($(window).innerWidth() <= 1366) {
        $('.swiper-container').swiper4();
      }
      else {
        mySwiper[$('.recruit-swiper').attr('data-swiper-myswiper')].destroy();
        $('.recruit-swiper').attr('data-swiper4-active', '');
      }
    }
    destroySwiper();
    $(window).on('resize', function() {
      destroySwiper();
    });
  },
  init() {
    home.setSwiper();
  },
};

let news = {
  selectjudge:function () {
    let total = 0,
        window_w = $(window).width();
    console.log(window_w);
    $('.news_sort_ul').find('a').each(function(){
      let w = $(this).outerWidth(true);
      total +=w;
    })
    console.log(total);
    if((window_w * 0.8) <= total){
      // ul太長 ul隱藏
      $('.news_sort_ul').hide();
      $('.news_sort .dropdown').show();
    }else{
      // ul太短 ul顯示
      $('.news_sort_ul').show();
      $('.news_sort .dropdown').hide();
    }
    let resize = false;
    let t;
    $(window).stop().resize(function () {
      resize = true;
      clearTimeout(t);
      t = setTimeout(doResize, 300);
    });
    
    function doResize() {
      let resize_w = $(window).width();
      console.log(resize_w);
      if((resize_w * 0.8) <= total){
        // ul太長 ul隱藏
        $('.news_sort_ul').hide();
        $('.news_sort .dropdown').show();
      }else{
        // ul太短 ul顯示
        $('.news_sort_ul').show();
        $('.news_sort .dropdown').hide();
      }
    };
  },
};

let product = {

  type_select: function() {
    // 項目收合
    $('.type_list').off().on('click',function(){
      let $this = $(this),
          open_obj = $this.next('.type_item');
      open_obj.slideToggle('slow');
      $this.closest('.type_select').toggleClass('close');
    });
    // 手機板 - 項目收合
    $('.type_icon').off().on('click',function(){
      let $this = $(this),
          open_obj = $this.siblings('.type_item');
      open_obj.slideToggle('slow');
      $this.closest('.type_select').toggleClass('close');
    });
    // 點選項目 加 active
    $('.one_select .type_li').off().on('click',function(){
      $(this).closest('li').addClass('select').siblings().removeClass('select');
    });
  },

  type_select_lb: function() {
    // 項目複選
    $('.more_select .type_li').on('click',function(){
      $(this).closest('li').toggleClass('select');
      $('.more_select').each(function(){
        let num = 0;
        let change_num = $(this).closest('.type_select').find('.num');
        $(this).find('li').each(function(){
          if($(this).hasClass('select')){
            num++;
          }else{
          }
        })
        change_num.text(num);
      });
    });
  },

  reset_btn: function(reset_btn,container) {
    // 清除按鈕
    $(reset_btn).on('click',function(){
      let $this = $(this),
          $reset_obj = $this.closest(container).find('.type_item li'),
          $select_num = $this.closest(container).find('.num');
      $reset_obj.removeClass('select');
      $select_num.text("0");
    })
  },

  // 購買/分享 - fixed按鈕
  fixed_btn: function() {
    let header_h = $('.navbar').height();
    $(window).on('scroll',function(){
      let now_top = $(window).scrollTop(),
          show_top = $('.productdt_ct').offset().top;
      if(now_top + header_h + 100 > show_top){
        $('.fixed_btn').addClass('show');
      }else{
        $('.fixed_btn').removeClass('show');
      }

      // 位置判斷
      if($(window).width() > 1023){
        let li_num = $('.fixed_btn ul li').length;
        for(var i = 0; i < li_num; i++ ){
          let li = {},
              li_h = {};
          li[i] = $('.fixed_btn ul li').eq(i).find('a').attr('data-anchor-target');
          li_h[i] = $(li[i]).offset().top - 160;
          if($(window).scrollTop() > li_h[i]){
            $('.fixed_btn ul li').eq(i).addClass('active').siblings().removeClass('active');
          }else{}
        }
      }
    })

  },

  // 篩選開啟
  filter_open: function() {
    // 開啟
    $('.btn_filter').on('click',function(){
      // $('nav').css('opacity','0');
      // setTimeout(function(){
      //   $('nav').css('transform','translateY(-100%)');
      // },600);
      
      $('.pdfilter_lb').addClass('open');
      $('body').addClass('fixed');
      // 點擊非區域 ---> 關閉
      // $('body').on('mouseup', function () {
      //   let wrap = $('.lb_wrap');
      //   if (!wrap.is(e.target) && wrap.has(e.target).length === 0) {
      //     $('.pdfilter_lb').removeClass('open');
      //     $('body').removeClass('fixed');
      //     // $('nav').css('transform','none');
      //     // setTimeout(function(){
      //     //   $('nav').css('opacity','1');
      //     // },500);
      //   }
      // });
      // 關閉
      $('.btn_close').on('click',function(){
        $('.pdfilter_lb').removeClass('open');
        $('body').removeClass('fixed');
        // $('nav').css('transform','none');
        // setTimeout(function(){
        //   $('nav').css('opacity','1');
        // },500);
        
      });
    });
  },

  model_open: function() {
    $('.btn_model').on('click',function(){
      // $('nav').css('opacity','0');
      // setTimeout(function(){
      //   $('nav').css('transform','translateY(-100%)');
      // },600);
      $('.lb_model').addClass('open');
      $('nav').removeClass('show');
      $('body').addClass('fixed');
      // 關閉
      $('.btn_close').on('click',function(){
        $('.lb_model').removeClass('open');
        $('body').removeClass('fixed');
        // $('nav').css('transform','none');
        // setTimeout(function(){
        //   $('nav').css('opacity','1');
        // },500);
      });
    });
  }
};

let service = {
  // 填寫完畢
  write_done: function(){
    $('.form_input input,textarea').on('keyup',function(e){
      let $this = $(this);
      if($this.val() == ""){
        $this.closest('.form_list').removeClass('write');
      }else{
        $this.closest('.form_list').addClass('write');
      }
      // if(e.keyCode == 8){
      //   console.log('a')
      //   console.log($(this).val());
      //   if($this.val() == ""){
      //     $this.closest('.form_list').removeClass('write');
      //   }
      // }else{
      //   $this.closest('.form_list').addClass('write');
      // }
    });
    $('.formdd ul li').on('click', function () {
      // let opt = $(this).text();
      // $title.text(opt);
      // $this.addClass('white');
      if($(this).closest('.form_list').hasClass('add')){
      }else{
        $(this).closest('.form_list').addClass('write');
      }
    });
  },

  // 表單重製按鈕
  btn_reset: function(btn,container){
    $(btn).on('click',function(){
      let $this = $(this),
          $clear_container = $this.closest(container);
      $clear_container.find('input,textarea').val('');
      $clear_container.find('.form_list').removeClass('write');
      $clear_container.find('.type_item li').removeClass('select');
      $clear_container.find('.formdd_title').each(function(){
        let $this = $(this),
            text = $this.attr('data-reset');
        $this.text(text);
        $this.closest('.formdd_click').removeClass('white');
      })
    })
  },
};

let contact = {
  tab: function(){
    $('.contact_li').on('click',function(){
      let $this = $(this),
          tab_num = $this.closest('.contact_ul').find('a').length,
          this_num = $this.index(),
          $tab_obj = $this.closest('.contact_ct').find('.tab_obj');
      $this.addClass('active').siblings().removeClass('active');
      $tab_obj.eq(this_num).fadeIn(0).siblings().fadeOut(0);
      Waypoint.destroyAll()
      
      $('.contact_tab').find('.waypoint').removeClass('show');
      
      setTimeout(function(){
        // Waypoint.refreshAll();
        common.eachWaypoint('.waypoint','80%');
      },300);
    })
  },

}

let member = {
  // 頭貼預覽
  readURL: function(input,e,ori_name,ori_pic){
    var files = e.currentTarget.files;
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('.mb_hd_pic img').attr('src', e.target.result);
        $('.pic_name').text(input.files[0].name)
      };
      reader.readAsDataURL(input.files[0]);
    }else{
      $('.mb_hd_pic img').attr('src', ori_pic);
      $('.pic_name').text(ori_name);
    }
  },
  //會員照片上傳即時預覽
  photo_upload: function () {
    var ori_name = $('.pic_name').text();
    var ori_pic = $('.mb_hd_pic img').attr('src');
    $('#upload').change(function (e) {
      member.readURL(this,e,ori_name,ori_pic);
    });
  },

  maintenance_more: function () {
    $('.mt_btn').on('click',function(){
      let $this = $(this),
          $open_obj = $this.closest('.mt_list');
      $open_obj.addClass('open').siblings().removeClass('open');
    })
  },

  fixed: function(){
    let all_w = $('.mb_common').outerWidth(),
        window_w = $(window).width(),
        left_w = $('.mb_right').width()*2/3;
    if($(window).width()>1023){
      $('.js_fixed .mb_left').css({
        left: (window_w-all_w)/2,
        width: left_w
      });
    }else{
      $('.js_fixed .mb_left').css({
        left: 'auto',
        width: '100%'
      });
    }
    let resize = false;
    let t;
    $(window).stop().resize(function () {
      resize = true;
      clearTimeout(t);
      t = setTimeout(doRes, 300);
    });
    function doRes() {
      member.fixed();
      member.fix_scroll();
    };
  },

  fix_scroll: function(){
    let obj_top = $('.js_fixed .mb_right').offset().top,
        obj_h = $('.js_fixed .mb_right').outerHeight(),
        window_h = $(window).height();
    
    let left_h = $('.js_fixed .mb_left').outerHeight(),
        minus_h = (window_h-left_h)/2;
    if($(window).width()>1023){
      $(window).on('scroll',function(){
        let window_top = $(window).scrollTop();
        if(window_top > obj_top+obj_h-window_h+minus_h){
          $('.js_fixed').addClass('tran');
          $('.js_fixed .mb_left').css({
            position: 'absolute',
            top: 'auto',
            bottom: '0'
          })
        }else{
          $('.js_fixed').removeClass('tran');
          $('.js_fixed .mb_left').css({
            position: 'fixed',
            top: '50%',
            bottom: 'auto'
          })
        }
      });
    }else{}
  },

  agree_btn: function() {
    $('.agree_btn span').on('click',function(){
      $(this).closest('.agree_btn').toggleClass('click');
    })
  },

  signup:function(element,go){
    // $(element).one('click',function(){
    let $this = element,
        transform_obj = $this.closest('.mb_right'),
        now_step = $this.closest('.mb_right_wrap').attr('data-page'),
        $this_step = $this.closest('.mb_right_wrap'),
        next_step = go == 'back' ? Number(now_step) - 1 : Number(now_step) + 1,
        $next_step = $this.closest('.mb_right').find('.mb_right_wrap').eq(next_step - 1),
        $light = $this.closest('.mb_common').find('.step_li');
    $light.eq(next_step).addClass('active').siblings().removeClass('active');
    transform_obj.addClass('transform');
    setTimeout(function(){
      $this_step.slideUp(0);
      transform_obj.removeClass('transform');
      $next_step.slideDown(0);
    },300);
    $('.send_again').off().click(function() {
      countDown();
    });
    // })
  },

  open_lb:function(element){
    // element.on('click',function(){
    let $this = element,
        open_page = $this.attr('open-page');
    $('.lb_step_wrap').scrollbar();
    $('[page="'+open_page+'"]').addClass('open');
    $('body').addClass('fixed');
    ///// 開啟的假如是signup頁面
    if(open_page == 'member_signup'){
      countDown();
      $('.send_again').off().click(function() {
        countDown();
      });
    }
    $('.lb_close').on('click',function(){
      $('[page="'+open_page+'"]').removeClass('open');
      $('body').removeClass('fixed');
    });
    // })
  },
  lb_step:function(element,go){
    // $(element).one('click',function(){
    let $this = element,
        transform_obj = $this.closest('.mb_right'),
        now_step = $this.closest('.mb_right_wrap').attr('data-page'),
        $this_step = $this.closest('.mb_right_wrap'),
        next_step = go == 'back' ? Number(now_step) - 1 : Number(now_step) + 1,
        $next_step = $this.closest('.mb_right').find('.mb_right_wrap').eq(next_step - 1),
        $light = $this.closest('.mb_common').find('.step_li');
    $light.eq(next_step-1).addClass('active').siblings().removeClass('active');
    transform_obj.addClass('transform');
    setTimeout(function(){
      $this_step.slideUp(0);
      transform_obj.removeClass('transform');
      $next_step.slideDown(0);
    },300);
    
    if(now_step == 1){
      setTimeout(function(){
        countDown();
      },100);
      $('.send_again').off().click(function() {
        countDown();
      });
    }
    // })
  },

}

//頁面讀取完執行
var readyFunction = {
  checkFunction() {
    //擷取body的data-page
    var functionName = $('body').attr('data-page');
    //呼叫共用function
    readyFunction.common(functionName);
    //呼叫函數( 如果 data-page = home 輸出的結果為 readyFunction.home(); )
    // eval("readyFunction." + functionName + "();");
    if (functionName !== undefined) {
      eval("readyFunction." + functionName + "();");
    }
  },
  //呼叫共用function
  common(pagename) {
    console.log(`Now page is ${pagename}!`);
    common.transitions();
    //IOS 回上一頁空白修正
    appleDebug();
    //初始化Blazy
    // common.blazyInit();
    //初始化AOS.js
    // AOS.init();
    //啟動 Swiper
    $('.swiper4').swiper4();
    // 啟動 anchor
    $('.gotop').anchor4()
    // resize
    common.resize();
    // 100vh 高度修正
    common.fixmobile100vh();
    // 選單
    menu.init();
    // 下拉
    common.dropdown();
    setTimeout(function(){
      common.eachWaypoint('.waypoint','80%');
    },1500)
    
    $('._articleBlock').article4();
    $('[data-anchor]').anchor4();
    $('[data-ajax]').ajax4();


    product.filter_open();
    $('.lb_select').scrollbar();
    // product.color();
    product.type_select();
    product.type_select_lb();
    product.reset_btn('.reset','.pdfilter_lb');

    if($('body').attr('data-page') == 'news_detail'){
      $('nav').addClass('dark');
    }else if($('body').attr('data-page') == 'product_search_list'){
      $('nav').addClass('dark');
    }else{
      
    }
    menu.nav_scroll();
    
  },
  //呼叫各頁面function
  //首頁
  home() {
    home.init();
  },
  //最新消息
  news() {
    news.selectjudge();
  },
  news_detail() {
    // copylink('.icon-share','Copied 您已成功複製連結')
  },
  product() {

  },
  product_series() {
    // product.color();
    // product.type_select();
    // product.type_select_lb();
    // $('.lb_select').scrollbar()
    // product.filter_open();
  },
  product_list() {
    product.model_open();
    $('.lb_main').scrollbar();
    product.reset_btn('.reset','.lb_model');
  },
  product_detail() {
    common.color();
    product.fixed_btn();
    common.dropdown_in();
  },
  
  product_search_list() {
    common.dropdown_in();
  },


  service() {

  },
  service_form() {
    // $.ajax4({
    //   Route: 'ajax_service_form_alert1.html',
    //   Container: '.lightbox',
    //   // Block: '容器外層的區塊，預設為body，字串不需要$()，可使用.#[]各種DON方式輸入
    //   Callback: 'lightbox',
    //   // Backready: 'ajax完成後後呼叫後端程式呼叫，字串不需()，可留空'
    //   // Backloaded: 'ajax完成後的程市呼叫，字串不需()，可留空'
    // });
    // product.type_select();
    // product.type_select_lb();
    common.dropdown_form();
    service.write_done();
    service.btn_reset('.clear','.service_form_ct');
    
  },
  contact() {
    common.dropdown_form();
    service.write_done();
    service.btn_reset('.clear','.form');
    contact.tab();
  },
  member() {
    // member.open_lb();
  },
  member_home() {
  },
  member_profile() {
    common.dropdown_form();
    member.photo_upload();
  },
  member_account() {
    // member.open_lb();
  },
  member_maintenance() {
    member.maintenance_more();
  },
  member_signup() {
    common.dropdown_form();
    member.fixed();
    member.fix_scroll();
    member.agree_btn();
    service.write_done();
    member.signup();
    // member.open_lb();
  },
  privacy() {

  },
  about() {

  },
}

$(document).ready(function(){
  readyFunction.checkFunction();
})