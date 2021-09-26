// node 的WED框架
const express = require('express');
// 類似CURL的JS套建
const request = require('request');
// WebSocket套建
const SocketServer = require('ws');
// 目前不知道完整功能為何
const util = require("util");

const PORT = 3000;
// 建立WebSocket監聽的資訊
const server = express().listen(PORT,() => console.log(`Listening on ${PORT}`));
// console.log(server);
// 建立監聽服務
const wss = new SocketServer.Server({server});
// 當連線建立時
wss.on('connection',function connection(ws, req,cli) {
    console.log('client connected!');
    // 嘗試做群組廣播，但是目前找不到參數，先用塞的，但是抓不出來
    // ws.BVSADDIdentify = Math.floor(Math.random()*999999);
    // 收到訊息時
    ws.on('message',data => {
        let clients = wss.clients;
        let dataObj = JSON.parse(data);
        console.log(dataObj);
        // 所有溜覽器發過來的訊息都將實施廣播
        clients.forEach(client=>{
            client.send(data);
        });
        // log 出當前的動作
        // console.log(dataObj.act);
        // 如果是進入或是離開房間的事件，發訊息給SERVER更新聊天室成員
        if (['intochatroom','leavechatroom'].indexOf(dataObj.act)>-1) {
            talkwithServer(dataObj,wss);
        }
        // 本來要做群組廣播，目前放棄，先保留CODE
        if (dataObj.act) {
            if (dataObj.act=='createchatroom') {}
            request({
                uri:'http://interviewtest.com/chatgroomact/createchatroom',
                method:"GET",
            },function (error,response,body) {
                var responsebody = body;
                clients.forEach(client=>{
                    // client.send(responsebody);
                    // req.socket.remoteAddress   <<-- 取得IP
                    // 從前台顯示clients資訊，需要用這個util.inspect顯示資訊
                    // client.send(util.inspect(clients,{showHidden:true,depth:null}));
                    // 嘗試做群組廣播，但是目前找不到參數，先用塞的，但是抓不出來
                    // client.send(clients.BVSADDIdentify);

                    // client.send(client);
                });
            })
        }
    });
    ws.on('close',()=>{
        console.log('Close connect!');
    });
});
// 專門發訊息給SERVER的function
var talkwithServer = function(data,wss)
{
    request({
        uri:'http://interviewtest.com/wschatcall/?data='+encodeURIComponent(JSON.stringify(data)),
        method:"GET",
        // form:{
        //     postData:'data'
        // }
    },function (error,response,body) {
        if (response.statusCode!='200') {
            
        }
        wss.clients.forEach(function (client) {
            
            client.send(body);
        });
        console.log(response.statusCode);
    })
}