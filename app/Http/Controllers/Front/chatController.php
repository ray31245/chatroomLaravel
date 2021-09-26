<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// ADDs
// 套建
use Socialite as Socialite;
// 原生
use Session;
use View;

class chatController extends Controller
{
    // 全部聊天室的列表(目前無用)
    public function index()
    {
        // $loginstatus = Session::get('loginstatus');
        return View::make('Front.chat.index');
    }
    // 聊天室頁面
    public function room(Request $request)
    {
        // 從第三方登入跳回來會加SSL，但是測試環境沒有憑證，導回沒有SSL的狀態
        if(!empty($_SERVER['HTTPS'])&&$_SERVER['HTTPS']=='on')
        {
            return redirect('http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
        }
        $roomsn = $request->roomsn;
        // 取得當前登入者的session資訊，由第三方登入取得的帳號資訊
        $loginstatus = Session::get('loginstatus');
        // 從檔案中取得聊天室成員資訊
        if (file_exists('chatroomlist')) {
            $chatroomlist = self::editroomlist('','get');
        }else{
            $chatroomlist = [];
        }
        return View::make('Front.chat.room',['loginstatus'=>json_encode($loginstatus),'roomsn'=> $roomsn,'chatroomlist'=>$chatroomlist]);
    }
    // 統一用這支收websocket的訊息
    public function wschatcall(Request $request)
    {
        $data = json_decode($request->data,true);
        // 由於使用者的資訊是用HTML印到JS的變數，會有編碼問題，用這個轉回來
        $data = array_map(function($item){
            return htmlspecialchars_decode($item);
        },$data);
        // 使用者的資訊整成陣列，符合聊天室資訊的資料格式
        $info = ['roomsn'=>$data['roomsn'],'id'=>json_decode($data['loginstatus'],true)['id'],'name'=>json_decode($data['loginstatus'],true)['name']];
        // 離開或進入房間
        if ($data['act'] == 'intochatroom') {
            $chatroomlist = self::editroomlist($info,'into');
        }else if($data['act'] == 'leavechatroom'){
            $chatroomlist = self::editroomlist($info,'leave');
        }
        return response()->json('list has changed',200);
    }
    // 取得或編輯聊天室資訊的檔案
    public static function editroomlist($info,$type)
    {
        if (file_exists('chatroomlist')) {
            $chatroomlist = json_decode(file_get_contents('chatroomlist'),true);
            // 如果檔案鎖住了會讀到null，所住就等一下再讀
            if ($chatroomlist==null) {
                usleep(5000);
                $chatroomlist = self::editroomlist('','get');
            }
        }else{
            $chatroomlist = [];
        }
        // 如果有傳入進入或離開房間的資訊就是編輯，沒有的話就是讀檔
        if ($info!='') {
            // 確認檔案中是否有符合輸入的資訊
            $infoOLD = array_filter($chatroomlist,function($item)use($info){
                return ($item['roomsn'] == $info['roomsn'])&&($item['id'] == $info['id']);
            });
            // 如果有找到的話
            if ($infoOLD!=[]) {
                if ($type=='into') {
                }elseif ($type=='leave') {  //有找到且是離開就刪掉
                    foreach($chatroomlist as $key => $value)
                    {
                        // 刪掉roomsn跟id都有對到的
                        if ($value['roomsn']==current($infoOLD)['roomsn']&&$value['id']==current($infoOLD)['id']) {
                            unset($chatroomlist[$key]);
                        }
                    }
                }
            }else{
                if ($type=='into') {  //沒找到或是進入的話就要加進去
                    array_push($chatroomlist,$info);
                }elseif ($type=='leave') {
                }
            }
            // 已讀寫模式開啟檔案
            $fp = fopen('chatroomlist','w+');
            // 將當按鎖起來避免重覆寫入
            flock($fp, LOCK_EX); // do an exclusive lock
            // 寫進去
            fwrite($fp, json_encode($chatroomlist));
            // 解鎖
            flock($fp, LOCK_UN); // release the lock
        }
        return $chatroomlist;
    }
    // 建立房間(目前無用)
    public function createchatroom()
    {
        if (file_exists('chatroomlist')) {
            $chatroomlist = json_decode(file_get_contents('chatroomlist'));
            // $chatroomlist = '456';
        }else{
            $chatroomlist = [];
        }
        // $fp = fopen('chatroomlist','w+');
        // flock($fp, LOCK_EX); // do an exclusive lock
        // fwrite($fp, $counter);
        // flock($fp, LOCK_UN); // release the lock

        $data = ['aa'=>$chatroomlist];
        return response()->json($data, 200);
    }
}
