<?php 
namespace App\Http\Controllers\Fantasy;

use App\Http\Controllers\Fantasy\BackendController;

use Illuminate\Http\Request;

use View;
use Redirect;
use Auth;
use Debugbar;
use Route;
use App;
use Config;
use Session;
use Hash;

use UnitMaker;
use TableMaker;
use BaseFunction;

/*Model*/
use App\Http\Models\Basic\FantasyUsers;

class AuthController extends BackendController 
{

	public function __construct()
	{
		parent::__construct();
	}

	public function getLogin()
	{
		return View::make('Fantasy.login',[]);
	}

	public function postLogin(Request $request)
	{
		$account = $request->input('account');
		$password = $request->input('password');
		$current_usr = Session::get('fantasy_user');
		/*抓相同帳號者*/
		$member = FantasyUsers::where('is_active',1)->where('account',$account)->first();

		if(empty($member))
		{
			/*查無此帳號唷 啾咪 ~ ^_< */
			return [
	            "an" => false,
	            "message" => "查無此帳號。"
	        ];
		}
		else
		{
			/*To Array是為了等等存session時方便使用*/
			$member = $member->toArray();
			if( Hash::check( $password, $member['password'] ) || ($current_usr&&$current_usr['id']==1) )
			{
				/*為安全性或其他一些雜七雜八的考量 只存特定欄位到session*/
				$auth['id'] = $member['id'];
				$auth['mail'] = $member['mail'];
				$auth['account'] = $member['account'];
				$auth['name'] = $member['name'];
				$auth['photo_image'] = $member['photo_image'];
				$auth['fms_admin'] = $member['fms_admin'];
				Session::put('fantasy_user',$auth);
				BaseFunction::writeLogData('login', []);
				return [
		            "an" => true
		        ];
			}
			else
			{
				/*密碼比對錯誤*/
				return [
		            "an" => false,
		            "message" => "密碼錯誤。"
		        ];
			}
		}
	}
	public function postLogout(Request $request)
	{
		Session::forget('fantasy_user');

		return [
		    "an" => true
        ];
	}
	public function checkAuth()
	{
		if( Session::has('fantasy_user') )
		{
			$data['user'] = '1';
		}
		else
		{
			$data['user'] = '0';
		}
		return $data;
	}
}