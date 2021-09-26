<!doctype html>
 <html> 
<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"/>
 <style type="text/css"> body,p{margin:0px; padding:0px; font-size:14px; color:#333; font-family:Arial, Helvetica, sans-serif;} #box,.but-box{width:50%; margin:5px auto;border-radius:5px} #box{border:1px #ccc solid;height:400px;width:700px;margin-top:50px;overflow-y:auto; overflow-x:hidden; position:relative;} #user-box{margin-right:111px; height:100%;overflow-y:auto;overflow-x: hidden;} #msg-box{width:110px; overflow-y:auto; overflow-x:hidden; float:right; border-left:1px #ccc solid; height:100%; background-color:#F1F1F1;} button{float:right; width:80px; height:35px; font-size:18px;} input{width:100%; height:30px; padding:2px; line-height:20px; outline:none; border:solid 1px #CCC;} .but-box p{margin-right:160px;} </style>
 <script src="https://cdn.bootcss.com/jquery/2.2.1/jquery.min.js"></script> 
 {{-- <script src="jquery/2.2.1/jquery.min.js"></script>  --}}
</head> 
<body> 
    <h3 style="margin-left:600px">這是個web聊天室 </h3> 
    <div id="box"> 
        <div id="msg-box">
            @foreach ($chatroomlist as $item)
            <b loginid={{$item['id']}}>{{$item['name']}}</b><br/>
            @endforeach
        </div>
        <div id="user-box"></div> 
    </div> 
    <div class="but-box"> 
        <button id="send">發送</button> 
        <p>
            <textarea cols="60" style="resize:none" id="content"> </textarea>
        </p> 
    </div> 
</body> 
</html> 
<script> 
    var loginstatus = '{{$loginstatus}}';
    var roomsn = '{{$roomsn}}';
    let ws = new WebSocket('ws://interviewtest.com:3000');
    
    ws.onopen = () => {
        intochatroom();
        console.log('open connection');
    }
    ws.onclose =() =>{
        leavechatroom();
        console.log('close connection');
    }
    ws.onmessage = event => {
        try {
            console.log(JSON.parse(event.data));
        } catch (error) {
            console.log(error);
            console.log(event.data);
        }
        // 將收到的訊息轉回物件
        let responsedata = JSON.parse(event.data);
        // 有人進入房間
        if (responsedata.act=='intochatroom') {
            // 進入的人資訊
            let loginstatus = JSON.parse(escape2Html(responsedata.loginstatus));
            // 頁面上的成員新增
            $('#msg-box').append('<b loginid='+loginstatus.id+'>'+loginstatus.name+'</b><br/>');
            // 第一次載入的時候會把自己也載近來，把第一個多的自己刪掉
            $('#msg-box').remove('[loginid="'+loginstatus.id+'"]:first');
            // 廣播有人進入聊天室
            $('#user-box').append('<p><b>'+JSON.parse(escape2Html(responsedata.loginstatus)).name+'已進入聊天室</b></p>');
        }
        // 有人離開房間
        if (responsedata.act=='leavechatroom') {
            // 離開人的資訊
            let loginstatus = JSON.parse(escape2Html(responsedata.loginstatus));
            // 在頁面上找到離開的人
            let elem = document.querySelector('[loginid="'+loginstatus.id+'"]');
            // 測試的時候，有時會出現找不到人的狀況，找不到就跳過
            try {
                var nextelem = elem.nextElementSibling;
                elem.parentNode.removeChild(nextelem);   
            } catch (error) {
                console.log(error);
            }
            // 頁面上成員刪除
            elem.parentNode.removeChild(elem);
            // 廣播有人離開聊天室
            $('#user-box').append('<p><b>'+JSON.parse(escape2Html(responsedata.loginstatus)).name+'已離開聊天室</b></p>');
        }
        // 顯是聊天訊息
        if (responsedata.act=='msg') {
            // console.log(responsedata.loginstatus);
            $('#user-box').append('<p><b>'+JSON.parse(escape2Html(responsedata.loginstatus)).name+'</b> : '+escape2Html(responsedata.msg)+'</p>');
        }
        // messagedata = event;
    }
    // 離開頁面時，發給node，有人離開
    window.onbeforeunload = function() {
        leavechatroom();
    }
    // 發送訊息按鈕事件
    $('#send').on('click',function () {
        let senddata = new Object;
        // 動作為訊息
        senddata.act = 'msg';
        // 發訊息人資訊
        senddata.loginstatus = loginstatus;
        // 訊息房號(目前房號功能無用)
        senddata.roomsn = roomsn;
        // 訊息內容
        senddata.msg = $('#content').val();
        $('#content').val('');
        // 訊息只能發字串，把物件轉字串
        ws.send(JSON.stringify(senddata));
    });
    // 按Enter，綁發訊息
    $('#content').on('keydown',function(event){
        if (event.which=='13') {
            $('#send').click();
        }
    });
    // 有人進入的function
    var intochatroom = function(){
        // 考慮的多分頁狀態，設定localStorage，分頁數+1
        localStorage.setItem('loginstatus', loginstatus);
        localStorage.setItem('roomsn'+roomsn,(parseInt(getcount())+1).toString());
        if (getcount()=='1') {
            let senddata = new Object;
            senddata.act = 'intochatroom';
            senddata.loginstatus = loginstatus;
            senddata.roomsn = roomsn;
            ws.send(JSON.stringify(senddata));   
        }
    }
    // 有人離開的function
    var leavechatroom = function(){
        // 考慮到多分頁狀態，設定localStorage，分頁數-1
        localStorage.setItem('roomsn'+roomsn,(parseInt(getcount())-1).toString());
        if (getcount()=='0') {
            let senddata = new Object;
            senddata.act = 'leavechatroom';
            senddata.loginstatus = loginstatus;
            senddata.roomsn = roomsn;
            ws.send(JSON.stringify(senddata));
        }
    } 
    // 取得localStorage目前開啟的分頁數
    var getcount = function (){
        if (parseInt(localStorage.getItem('roomsn'+roomsn))>0) {
            count = localStorage.getItem('roomsn'+roomsn);
        }else{
            count = '0';
        }
        return count;
    };



// var name = prompt('請輸入用戶名:'); 
// socket = new WebSocket('ws://192.168.10.10:6001'); 
// console.log(socket); 
// socket.onopen = function(){ console.log('connected success'); 
// socket.send('login==='+name); } 
// socket.onmessage = function(e){ 
//     data = JSON.parse(e.data); console.log(data); 
//     if(data.type=='login'){ $('#user-box').append('<li style="color:gray">'+data.msg+'</li>'); } 
//     if(data.type=='user'){ 
//         $('#msg-box').html(''); 
//         for(i=0;i<data.name.length;i++){ 
//             $('#msg-box').append('<li style="color:gray">'+data.name[i]+'</li>'); 
//         } 
//     } 
//     if(data.type=='con'){ 
//         $('#user-box').append('<li><span style="color:blue">'+data.time+'</span><span style="color:red">'+data.name+'</span><span style="color:blue">'+data.content+'</span></li>'); 
//     } 
// } 
// document.onkeydown = function(e){ 
//     if(e.keyCode==13){ send(); } 
// } 
// $('#send').click(function(){ send(); }); 
// function send(){ 
//     content = $('#content').val(); 
//     $('#content').val(''); 
//     if(content==''){ return false; } 
//     socket.send('con==='+content); 
// } 
function escape2Html(str) {
  var temp = document.createElement("div");
  temp.innerHTML = str;
  var output = temp.innerText || temp.textContent;
  temp = null;
  return output;
}
</script>

