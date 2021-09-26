BaseUrl = $('.base-url').val();
        
preurl = location.href.split("/",17);

var _token = $('#_token').val();
$(document).ready(function () {
    pagegroup = 10000;
    // chkstatus();
});
// 頁碼切換的上一頁上個群組頁下一頁下個群組頁把這個綁在[jumpbtn]
function jumppage(_this)
{
    var nowpage = Number($('[pageindex].active').attr('pageindex'));
    switch (_this.attr('jumpbtn')) {
        case 'backjump':
            // $("[pageindex="+(nowpage-5)+"]").click();
            $("[pageindex="+(nowpage-pagegroup)+"]").click();
        break;
        case 'backstep':
            $("[pageindex="+(nowpage-1)+"]").click();
        break;
        case 'nextstep':
            $("[pageindex="+(nowpage+1)+"]").click();
        break;
        case 'nextjump':
            // $("[pageindex="+(nowpage+5)+"]").click();
            $("[pageindex="+(nowpage+pagegroup)+"]").click();
        break;
    
        default:
        break;
    }
    console.log(nowpage);
}
// 載入時與切換頁碼時擷取當前頁碼[currentpage]控制頁碼顯示為啟動顯示隱藏:
// pagegroup為一次顯示的頁碼數量
// [pagecount] 紀載全部分頁總數(必須放置於可以代表整個頁碼表的元素上)
// [currentpage]標記當前頁碼
// [pageindex]再所有頁碼的元素上標記所代表的頁碼
// .prev5直接跳到當前頁碼減一個群組數量的頁碼按鈕(如果有用到順便改成[jumpbtn="backjump"])(選填)
// .prev往前一個頁碼按鈕(如果有用到順便改成[jumpbtn="backstep"])(選填)
// .next5直接跳到當前頁碼加一個群組數量的頁碼按鈕(如果有用到順便改成[jumpbtn="nextjump"])(選填)
// .next往後一個頁碼按鈕(如果有用到順便改成[jumpbtn="nextstep"])(選填)
function chkstatus()
{
    // var pagegroup = 5;
    var pagecount = $('[pagecount]').attr('pagecount');
    if (pagecount==1) {
        $('[pagecount]').hide();
    }
    var currentpage = $('[currentpage]').attr('currentpage');
    $('[pageindex]').removeClass('active');
    $('[pageindex="'+currentpage+'"]').addClass('active');
    if(currentpage<pagegroup+1)
    {
        $('.prev5').css('visibility', 'hidden');
        if(currentpage<=1)
        {
            $('.prev').css('visibility', 'hidden');
        }else{
            $('.prev').css('visibility', 'visible');
        }
    }else{
        $('.prev5').css('visibility', 'visible');
        $('.prev').css('visibility', 'visible');
    }
    if(currentpage>pagecount-pagegroup){
        $('.next5').css('visibility', 'hidden');
        if(Number(currentpage)>=Number(pagecount))
        {
            // console.log(currentpage,pagecount);
            // console.log(Number(currentpage)>=Number(pagecount));
            $('.next').css('visibility', 'hidden');
        }else{
            $('.next').css('visibility', 'visible');
        }
    }else{
        $('.next5').css('visibility', 'visible');
        $('.next').css('visibility', 'visible');
    }
        // console.log(currentpage);
        // console.log(pagecount);
        // console.log(Math.round(pagegroup));
        console.log(currentpage<pagecount-Math.round(pagegroup));
        // console.log(pagegroup);
        
    $("[pageindex]").hide();
    if(currentpage>Math.round(pagegroup/2)&&currentpage<=pagecount-Math.round(pagegroup/2))
    {
        $("[pageindex]:gt("+(Number(currentpage)-4)+"):lt("+pagegroup+")").show();
    }else if(currentpage<=Math.round(pagegroup/2)){
        $("[pageindex]:lt("+pagegroup+")").show();
    }else if(currentpage>=pagecount-Math.round(pagegroup/2))
    {
        console.log("[pageindex]:gt("+(Number(pagecount)-6)+"):lt("+pagegroup+")");
        if (Math.sign(Number(pagecount)-6)==1) {
            $("[pageindex]:gt("+(Number(pagecount)-6)+"):lt("+pagegroup+")").show();
        }else{
            $("[pageindex]:lt("+pagegroup+")").show();
        }
    }
}
// 計算螢幕寬度
// $(window).resize(function() {
//     var width = $(window).width(); 
//     console.log(width);
//     if (width<768) {
//         console.log('小於768');
        
//         pagegroup = 3;
//         chkstatus();
//     }
// });
function simpleajax(sendturl,sendArr,mustdo,successdo,is_post,parameterinput)
{
    var type = is_post?'post':'get';
    $.ajax({
        url: sendturl,
        type: type,
        data: {
            // _token: _token,
            data: sendArr,
        },
        headers: {
            'X-CSRF-TOKEN': $('#_token').val()
        },
    }).done(function(data){
        // data = '222';
        mustdo(data,parameterinput);
        if (data.success) {
            successdo(data,parameterinput);
        }
        if (data.warning,data.warningtitle) {
            try {
                // console.log(data.warning);
                noticelightbox(encodeURI(data.warning),encodeURI(data.warningtitle));
            } catch (error) {
                console.log(error);
                if(data.warning){
                    alert(data.warning);
                }
            }
        }
        if (data.message) {
            console.log(data.message);
        }
        if (data.exec) {
            eval(data.exec);
        }
        // alert('submit');
    }).fail(function(jqXHR, textStatus, errorThrown, data) {});
}

function formenter(select,enterbtn) {
    $('body').on('keydown',select,function(event){
        if (event.which == 13) {
            // alert('123');
            // console.log($(select),enterbtn);
            enterbtn.click();
        }
    });
}
// 表單重置功能，一鍵完成
function formreset(range,openbtn){
    var inputrangeselect = range+' [name]:not([name="_token"])';
    var textrangeselect = range+' [inittext]';
    var formArr = new Object();
    var textarr = new Object();
    $(openbtn).on('click',function(){
        if(JSON.stringify(formArr)!="{}") {
            for (var x in formArr) {
                $(inputrangeselect+'[name='+x+']').val(formArr[x]);
            }
        } else {
            $(inputrangeselect).each(function(){
                formArr[$(this).attr('name')]=$(this).val();
            });
        }
        if (JSON.stringify(textarr)!="{}") {
            for (var x in textarr) {
                $(textrangeselect+'[inittext='+x+']').text(textarr[x]);
            }
        }else{
            $(textrangeselect).each(function(){
                textarr[$(this).attr('inittext')]=$(this).text();
            });
        }
    })
}
// 表單重置，拆開來做(開始的時候紀錄表單狀況)
function formresetinit(range) {
    var formArr = new Object();
    var textarr = new Object();
    var inputrangeselect = range+' [name]:not([name="_token"])';
    var textrangeselect = range+' [inittext]';
    $(inputrangeselect).each(function(){
        formArr[$(this).attr('name')]=$(this).val();
    });
    $(textrangeselect).each(function(){
        textarr[$(this).attr('inittext')]=$(this).text();
    });
    var output = [];
    output['formArr'] = formArr;
    output['textarr'] = textarr;
    return output;
}
// 表單重置，拆開來做(要重置的時候動作)
function formresetact(range,formtextArr){
    var inputrangeselect = range+' [name]:not([name="_token"])';
    var textrangeselect = range+' [inittext]';
    formArr = formtextArr['formArr'];
    textarr = formtextArr['textarr'];
    console.log(formtextArr);
    for (var x in formArr) {
        $(inputrangeselect+'[name='+x+']').val(formArr[x]);
    }
    for (var x in textarr) {
        $(textrangeselect+'[inittext='+x+']').text(textarr[x]);
    }
}


// 換驗證碼
function cgCapt(id) {
    var url = location.protocol +'//'+ location.host + '/captcha/api/default';
    $.ajax({
        url: url,
        type: 'get'
    }).done(function (capt) {
        let ele = document.getElementById(id)
        ele.setAttribute("src", capt.img);
        ele.setAttribute("data-key", capt.key);
    });
}

function nl2br (str, is_xhtml) {
    if (typeof str === 'undefined' || str === null) {
        return '';
    }
    var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
}

// 輸入cookie名,與cookie值
function setCookie(cname, cvalue, exdays)
{
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
// 輸入cookie取cookie值
function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

//刪除cookie
function delCookie(name){
    var exp = new Date();
    exp.setTime(exp.getTime() - 1);
    var cval = getCookie(name);
    if (cval != null) document.cookie = name + "=" + cval + ";expires=" + exp.toGMTString();
}


// 取得get變數的function
function funcUrlGet(url,variable){
    var query = url.split("?");
    var vars = query[1]!=undefined?query[1].split("&"):[];
    for (var i=0;i<vars.length;i++) {
        var pair = vars[i].split("=");
        if(pair[0] == variable){return pair[1];}
    }
    return(false);
}


// 刪除GET變數的function
function funcUrlDel(url,name){
    var loca = url.split("?");
    var baseUrl = loca[0];
    if (loca[1].indexOf(name)>-1) {
        var obj = {}
        var arr = loca[1].split("&");
        for (var i = 0; i < arr.length; i++) {
            arr[i] = arr[i].split("=");
            obj[arr[i][0]] = arr[i][1];
        };
        delete obj[name];
        var url = baseUrl + '?' + JSON.stringify(obj).replace(/[\"\{\}]/g,"").replace(/\:/g,"=").replace(/\,/g,"&");
        return url
    };
}
// 在網址中加入GET變數的function
function updateQueryStringParameter(uri, key, value) {
    if(!value) {
        return uri;
    }
    var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
    var separator = uri.indexOf('?') !== -1 ? "&" : "?";
    if (uri.match(re)) {
        return uri.replace(re, '$1' + key + "=" + value + '$2');
    }
    else {
        return uri + separator + key + "=" + value;
    }
}