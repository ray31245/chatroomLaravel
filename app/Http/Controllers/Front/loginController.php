<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// ADDs
// 套建
use Socialite as Socialite;
// 原生
use Session;

class loginController extends Controller
{
	// 登入的動作
	public function Loginact(Request $request)
	{	// 確認登入類型
		$Logintype = str_replace(['Loginact'],'',$request->Loginact);
		switch ($Logintype) {
			case 'Google':
				return Socialite::driver('google')->redirect();
				break;
			case 'FB':
				return Socialite::driver('facebook')->redirect();
				break;
			case 'Line':
				return Socialite::driver('line')->redirect();
				break;
			
			default:
				echo 'WTF';
				die;
				break;
		}
	}
	// 接第三方登入回的，然後導到原本要去的頁面
	public function loginCallBack(Request $request)
	{
		$loginCallBacktype = str_replace(['loginBy','CallBack'],'',$request->loginCallBack);
		// dd($loginCallBacktype);
		switch ($loginCallBacktype) {
			case 'Google':
				$user = Socialite::driver('google')->stateless()->user();
				break;
			case 'FB':
				$user = Socialite::driver('facebook')->stateless()->user();
				break;
			case 'Line':
				$user = Socialite::driver('line')->stateless()->user();
				break;
			
			default:
				echo 'WTF';
				die;
				break;
			}
            $loginstatus = ['id'=>$user->id,'name'=>$user->name];
            Session::put('loginstatus', $loginstatus);
            // dd($_SERVER);
            if (Session::get('WannaGo')) {
                return redirect(Session::get('WannaGo'));
            }else {
                // return "<script>window.close();</script>";
                return "logined";
            }
			var_dump($user);
	}
    // 顯示可登入的選項
    public function loginindex()
    {
		$html = '';
		$html .= '<a href="GoogleLoginact">GoogleLogin</a></br>';
		$html .= '<a href="FBLoginact">FBLogin</a></br>';
		$html .= '<a href="LineLoginact">LineLogin</a></br>';
		return $html;
    }
    //
}
