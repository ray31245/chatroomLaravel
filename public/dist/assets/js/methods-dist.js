"use strict";function mobile(){var t=navigator.userAgent,n=-1<t.indexOf("Android")||-1<t.indexOf("Adr"),e=!!t.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/);return n||e}function appleDebug(){window.onpageshow=function(t){t.persisted&&window.location.reload()}}function clickToggleClass(t,n){$(t).off().click(function(){$(this).toggleClass(n)})}function clickSwitchClass(t,n){$(t).off().click(function(){$(t).not(this).removeClass(n),$(this).addClass(n)})}function verificationInput(){var a=[],o=function(t,n){return t+""+n},c=0;$(".verification-wrap input").val(""),$(".verification-wrap input:first-child").focus(),$(".verification-wrap input").each(function(){$(this).on("input",function(t){var n=$(this),e=t.target.value.substr(t.target.value.length-1),i=""!==t.target.value.replace(/[^0-9\.-]/g,"");t.preventDefault(),i?(n.val("").val(e),a.splice(n.index(),1,e),n.parents(".verification-wrap").attr("data-verify-code",a.reduce(o)),n.next().focus(),c=0):n.val("")}),$(this).keyup(function(t){var n=$(this);("Backspace"===t.key||"Delete"===t.key)&&(t.preventDefault(),0==c?(n.val(""),c+=1):1==c&&(n.prev().focus(),c=0))})})}function verificationPaste(){$("form .verification-wrap input").on("paste",function(t){var e=t.originalEvent.clipboardData.getData("text"),n=$(this),i=$("form .verification-wrap input").eq(0);n.on("change",function(){i.val(""),$("form .verification-wrap input").each(function(t,n){$(n).val(e.split("")[t])})})})}function countDown(){clearInterval(interval),$(".countdown").html(""),$(".countdown").closest(".reverify_word").find(".send_again").removeClass("active");var t=Number($(".countdown").attr("data-seconds"))+1;interval=setInterval(function(){0==--t&&(clearInterval(interval),$(".countdown").closest(".reverify_word").find(".send_again").addClass("active")),$(".countdown").html(t+" sec")},1e3)}function copylink(t,n){var e="<div class='notice-wrapper'><div class='text'>"+n+"</div><input id='clipboard' type='text' readonly></div>";0<t.length&&$("body").append(e),$("body").on("click",t,function(){var t=window.location.href,n=$("#clipboard");n.val(t),n[0].setSelectionRange(0,9999),n.select(),document.execCommand("copy")&&(document.execCommand("copy"),$(".notice-wrapper .text").fadeIn(300).promise().done(function(){setTimeout(function(){$(".notice-wrapper .text").fadeOut(300)},2e3)}))})}var interval=null;