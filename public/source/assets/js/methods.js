// 檢測裝置
function mobile() {
  let u = navigator.userAgent;
  let isAndroid = u.indexOf('Android') > -1 || u.indexOf('Adr') > -1; //Android終端
  let isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //iOS終端
  let device = isAndroid || isiOS;
  return device;
};

//IOS 回上一頁空白修正
function appleDebug() {
  window.onpageshow = function (event) {
      if (event.persisted) {
          window.location.reload();
      }
  };
}

// 點擊開關class
// clickToggleClass(點擊目標,加上cls名稱)
function clickToggleClass(target,className) {
  $(target).off().click(function () {
    $(this).toggleClass(className);
  });
}

// 點擊切換active
// clickSwitchClass(點擊目標,加上cls名稱)
function clickSwitchClass(target,className) {
  $(target).off().click(function () {
    $(target).not(this).removeClass(className);
    $(this).addClass(className);
  });
}

// 驗證碼
// 搭配以下結構使用
// .verification-wrap(data-verify-code="")
//   input(type="number" maxlength="1")
//   input(type="number" maxlength="1")
//   input(type="number" maxlength="1")
//   input(type="number" maxlength="1")
//   input(type="number" maxlength="1")
//   input(type="number" maxlength="1")
function verificationInput() {
  let codeArray = [];
  let reducer = (accumulator, currentValue) => `${accumulator}` + `${currentValue}`;
  let clear = 0
  $('.verification-wrap input').val('')
  $('.verification-wrap input:first-child').focus();
  $(".verification-wrap input").each(function () {
    $(this).on('input', function (e) {
      let input = $(this);
      let typeNum = e.target.value.substr(e.target.value.length - 1);
      let onlyNumber = e.target.value.replace(/[^0-9\.-]/g, '') !== '';
      e.preventDefault()
      //如果輸入為數字
      if (onlyNumber) {
        input.val('').val(typeNum);
        codeArray.splice(input.index(), 1, typeNum);
        input.parents('.verification-wrap').attr('data-verify-code', codeArray.reduce(reducer));
        input.next().focus();
        clear = 0;
      } else {
        input.val('');
      }
    })
    $(this).keyup(function (e) {
      let input = $(this);
      let is_clear = e.key === "Backspace" || e.key === "Delete";
      if (is_clear) {
        e.preventDefault();
        if (clear == 0) {
          input.val('');
          clear += 1;
        } else if (clear == 1) {
          input.prev().focus();
          clear = 0;
        }
      }
    })
  });
}
//驗證碼貼上
function verificationPaste() {
  $('form .verification-wrap input').on('paste',function(event) {
    let paste = event.originalEvent.clipboardData.getData('text');
    let vm = $(this);
    let firstInput = $('form .verification-wrap input').eq(0);
    vm.on('change',function(){
      firstInput.val('');
      $('form .verification-wrap input').each(function(index, ele) {
        $(ele).val(paste.split('')[index]);
      });
    });
  });
}

// 倒數計時
// 搭配以下結構使用
// .countdown(data-seconds="600")  data-seconds 填入欲倒數秒數
var interval = null;
function countDown() {
  clearInterval(interval);
  $('.countdown').html('');
  $('.countdown').closest('.reverify_word').find('.send_again').removeClass('active');
  var set_seconds = Number($('.countdown').attr('data-seconds')) + 1;
  // var set_time = Math.floor(set_seconds / 60) + ':' + set_seconds % 60;
  interval = setInterval(function() {
    // var timer = set_time.split(':');
    // var minutes = parseInt(timer[0], 10);
    // var seconds = parseInt(timer[1], 10);
    --set_seconds;
    // minutes = (seconds < 0) ? --minutes : minutes;
    // minutes = (minutes < 10) ? minutes = '0' + minutes : minutes;
    if (set_seconds == 0){
      clearInterval(interval);
      $('.countdown').closest('.reverify_word').find('.send_again').addClass('active');
    }
    // seconds = (seconds < 0) ? 59 : seconds;
    // seconds = (seconds < 10) ? '0' + seconds : seconds;
    $('.countdown').html(set_seconds + " sec");
    // set_time = minutes + ':' + seconds;
  }, 1000);
}


// 複製網址
// el => 點擊的對象
// text => 想要顯示的文字
// 使用範例 common.copylink('.xxx','Copied 您已成功複製連結')
// css在 sass/base/_common 要改樣式可以進去改
function copylink(el,text) {
  let notice = "<div class='notice-wrapper'><div class='text'>" + text + "</div><input id='clipboard' type='text' readonly></div>"
  if (el.length > 0) {
    $('body').append(notice)
  }
  $('body').on('click', el, function () {
    let url = window.location.href
    let clipboard = $('#clipboard')
    clipboard.val(url);
    clipboard[0].setSelectionRange(0, 9999);
    clipboard.select();
    if (document.execCommand('copy')) {
      document.execCommand('copy');
      $('.notice-wrapper .text').fadeIn(300).promise().done(function () {
        setTimeout(function () {
          $('.notice-wrapper .text').fadeOut(300)
        }, 2000)
      });
    }
  })
}