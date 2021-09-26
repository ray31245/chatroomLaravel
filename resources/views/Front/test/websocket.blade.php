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
        <div id="msg-box"></div>
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
var name = prompt('請輸入用戶名:'); 
socket = new WebSocket('ws://192.168.10.10:6001'); 
console.log(socket); 
socket.onopen = function(){ console.log('connected success'); 
socket.send('login==='+name); } 
socket.onmessage = function(e){ 
    data = JSON.parse(e.data); console.log(data); 
    if(data.type=='login'){ $('#user-box').append('<li style="color:gray">'+data.msg+'</li>'); } 
    if(data.type=='user'){ 
        $('#msg-box').html(''); 
        for(i=0;i<data.name.length;i++){ 
            $('#msg-box').append('<li style="color:gray">'+data.name[i]+'</li>'); 
        } 
    } 
    if(data.type=='con'){ 
        $('#user-box').append('<li><span style="color:blue">'+data.time+'</span><span style="color:red">'+data.name+'</span><span style="color:blue">'+data.content+'</span></li>'); 
    } 
} 
document.onkeydown = function(e){ 
    if(e.keyCode==13){ send(); } 
} 
$('#send').click(function(){ send(); }); 
function send(){ 
    content = $('#content').val(); 
    $('#content').val(''); 
    if(content==''){ return false; } 
    socket.send('con==='+content); 
} 
</script>

