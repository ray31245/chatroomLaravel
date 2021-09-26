<?php
namespace App\Http\Controllers\Front;
/**原生函式**/
use Illuminate\Http\Request;
use View;
use ItemMaker;
use DateTime;
use Redirect;
use Session;
use Config;
use App\Http\Models\Basic\Fms\FmsFile;
use DB;
use Lang;
use App;
use Mail;

use BaseFunction;
/**相關Controller**/
use App\Http\Controllers\Controller;

/**相關Service**/
use App\Services\Front\AboutService;

use Socialite as Socialite;

use App\Http\Models\Product\ProductSerieMaterial;

class TestController extends Controller{

	private $seo;
	
	public function __construct()
	{
	}

	// 顯示首頁
	public function rename($branch,$locale)
	{
		// 撈出所有FMS檔案
        $filelist = FmsFile::
                            orderby('id','asc')
							->get();
		// 逐檔進行修改
        foreach ($filelist as $key => $value) {
			// 準備使用標題作為新的實際檔名
            $newfilename = substr(dirname($value->real_route),'-'.(strlen(dirname($value->real_route))-1)).'/'.self::processTitleToUrl($value->title).'.'.$value->type;
			// 當前檔案的實際檔名
			$originname = substr($value->real_route,'-'.(strlen($value->real_route)-1));
			dump(file_exists($newfilename));
			// 確認當前檔案是否存在
            if(file_exists($originname))
            {
				// 如果新實際檔名存在就在新的實際檔名上加時間戳
                if(file_exists($newfilename))
                {
                    $newfilename = substr(dirname($value->real_route),'-'.(strlen(dirname($value->real_route))-1)).'/'.self::processTitleToUrl($value->title).date("YmdHis").'.'.$value->type;
                }
                // 進行實際檔名修改，如果成功就洗回資料庫
                if(rename( $originname , $newfilename))
                {
                    $value->real_route = '/'.$newfilename;
                    $value->save();
                };	
            }
            dump($value->real_route,$newfilename);
        }
        return 'sucess';
    }
	public static function processTitleToUrl( $title )
	{
		$replace1 = str_replace(' ', '~', $title);
		$replace2 = str_replace('/', '^', $replace1);
		$replace3 = str_replace('.', '`', $replace2);
		$replace4 = str_replace('?', '@', $replace3);

		return $replace4;
	}


	public static function revertUrlToTitle( $url )
	{
		$replace1 = str_replace('~', ' ', $url);
		$replace2 = str_replace('^', '/', $replace1);
		$replace3 = str_replace('`', '.', $replace2);
		$replace4 = str_replace('@', '?', $replace3);

		return $replace4;
	}

	public static function langexport($branch,$locale,$lan)
	{
		// dd($lan);
		// $aa = [
        //     [
        //         "id"=>1,
        //         "rank"=>3,
        //     ],
        //     [
        //         "id"=>2,
        //         "rank"=>2,
        //     ],
        //     [
        //         "id"=>3,
        //         "rank"=>1,
        //     ],
        // ];        
        // $aa = collect($aa);
       
        // $aa->sortByDesc(function($q,$key){              
		// 	return $q['id'];
		// 	// dump($q);
        // });
		// dd($aa);
		App::setLocale($locale);
		$var = Lang::get($lan);
		echo '<table style="width:100%">';
		foreach ($var as $key => $value) {
			echo '<tr>';
			echo '<td>'.$key.'<td>'.'<td>'.htmlspecialchars($value).'<td>';
			echo '</tr>';
		}
		echo '</table>';
		dd($var);
	}
	public static function resumfile()
	{
		$files = DB::table('basic_log_data')->where('table_name','basic_fms_file')->where('log_type','del')->orderby('create_time', 'asc')->get()/*->sortBy('data_id')->pluck('data_id')*/->map(function($item){return [$item->data_id,json_decode($item->ChangeData)];});
		dd($files);
	}
	public static function importlangui()
	{
		$unit_Arr = [
			'關於我們'=>'about.php',
			'應用範疇'=>'application.php',
			'菁英招募'=>'career.php',
			'聯絡我們'=>'contact.php',
			'下載中心'=>'download.php',
			'頁尾'=>'footer.php',
			'首頁'=>'home.php',
			'投資關係人'=>'investor.php',
			'信件'=>'mail.php',
			'最新消息'=>'news.php',
			'產品資訊'=>'products.php',
			'快速選單'=>'quick.php',
			'隱私權'=>'privacy.php',
		];
		$locale_list=config('models.BranchOriginUnit')::get();
		return view('importlangui', [
			'unit_Arr'=>$unit_Arr,
			'locale_list'=>$locale_list,
			]);
		// dd($unit_Arr,$locale_list);
	}
	public static function getlang(Request $request)
	{
		$path = resource_path('lang/'.$request->all()['local'].'/'.$request->all()['unit']);
		$filename = $path;
		$nameArr = [];
		$valArr = [];
		App::setlocale($request->all()['local']);
		$langarr = Lang::get(str_replace('.php','',$request->all()['unit']));
		//判斷是否有該檔案
		if(file_exists($filename)){
			$filemtime = filemtime($filename);
			$file = fopen($filename, "r");
			if($file != NULL){
				//當檔案未執行到最後一筆，迴圈繼續執行(fgets一次抓一行)
				while (!feof($file)) {
					$str = fgets($file);
					if (preg_match("/\/\//",$str)&&!preg_match("/:\/\//",$str)) {
						array_push ($nameArr,$str);
					}
					if (preg_match("/=>/",$str)) {
						array_push ($valArr,$str);
					}
				}
				fclose($file);
			}
		}
		$nameArr = array_map(function($item){return str_replace(['//',"\r\n"],'',$item); },$nameArr);
		// echo $str;
		return view('getlang', [
			'local' => $request->all()['local'],
			'unit' => $request->all()['unit'],
			'nameArr'=>$nameArr,
			'langarr'=>$langarr,
			'filemtime'=>$filemtime,
			]);
		dd($nameArr,$langarr);
	}
	protected static $newLangArr;
	public static function compilelang(Request $request)
	{
		$data = $request->all();
		$nameArr = $data['name'];
		$keyArr = $data['key'];
		$valArr = $data['val'];
		$local = $data['local'];
		$unit = $data['unit'];
		$path = resource_path('lang/'.$local.'/'.$unit);
		$filename = $path;
		self::$newLangArr = [];
		array_walk($nameArr,function($val,$key)use($keyArr,$valArr){
			self::$newLangArr[$key] = [ $val,$keyArr[$key],$valArr[$key] ];
		});
		//判斷是否有該檔案
		if(file_exists($filename)){
			$file = fopen($filename, "w+");
			// $filemtime = filemtime($filename);
			// if($filemtime+1*24*60*60>strtotime('now'))echo '一天後才可編輯';die;
			echo fwrite($file,"<?php\r\nreturn [\r\n");
			// if($file != NULL){
				//當檔案未執行到最後一筆，迴圈繼續執行(fgets一次抓一行)
				$i = 0;
				// while (!feof($file)) {
					// $str = fgets($file);
					foreach(self::$newLangArr as $key => $value)
					{
						echo fwrite($file,"\t//".$value[0]."\r\n"."\t'".$value[1]."'"." => '".str_replace("'","\'",nl2br($value[2]))."',\r\n");
					}
					echo fwrite($file,"];\r\n?>");
					// if (preg_match("/\/\//",$str)) {
					// 	array_push ($nameArr,$str);
					// }
					// if (preg_match("/=>/",$str)) {
					// 	array_push ($valArr,$str);
					// }
				// }
				fclose($file);
			// }
		}
		Mail::raw('立弘生化'.$local.'的'.$unit .'遭到修改，請更新', function ($message) use($local,$unit) {
			$message->from('bevis@wddgroup.com','立弘生化'.$local.'的'.$unit .'遭到修改，請更新');
    		$message->to('bevis@wddgroup.com');
		});
		echo '<script>alert("編譯成功\r\n即將跳轉至選擇單元及語系頁面");location.href="importlangui";</script>';
		// dd(self::$newLangArr,$nameArr,$keyArr,$valArr,$local,$unit);
	}
	// 把第二層資料夾拉到第一層
	public static function movefmsfolder($branch,$locale,$seconed='')
	{
		if(!$seconed)
		{return '<script>alert("請指定第二層資料夾ID")</script>';}
		dump('移動第二層資料夾至第一層包含底下的子目錄');
		// 撈出指定第二層資料夾
		$seconed_folder = config('models.FmsSecond')::where('id',$seconed)->first();
		// 開第一層資料夾
		$first_folder_path = config('models.FmsFirst');
		$first_folder = new $first_folder_path;
		$first_folder->title = $seconed_folder->title;
		$first_folder->is_active = 1;
		$first_folder->type = 1;
		$first_folder->zero_id = 1;
		$first_folder->created_user = 3;
		$first_folder->last_edit_user = 3;
		$first_folder->save();
		dump('第二層資料夾',$seconed_folder->toArray());
		dump('第一層資料夾',$first_folder->toArray());
		// 撈出第二層資料夾底下的檔案
		$seconed_files = config('models.FmsFile')::where('second_id',$seconed_folder->id)->get();
		// 更改第二層資料夾底下的檔案至新開的第一層資料夾
		foreach ($seconed_files as $key => $value) {
			$value->second_id = 0;
			$value->first_id = $first_folder->id;
			$value->save();
		}
		dump('第一層資料夾底下有搬到的檔案',$seconed_files->toArray());
		// 撈出第二層資料夾底下的第三層資料夾
		$third_folders = config('models.FmsThird')::where('second_id',$seconed_folder->id)->get();
		dump('第二層底下的第三層');
		foreach ($third_folders as $key => $value) {
			// 複製第三層到第二層
			$new_seconed_folder_path = config('models.FmsSecond');
			$new_seconed = new $new_seconed_folder_path;
			$new_seconed->title = $value->title;
			$new_seconed->first_id = $first_folder->id;
			$new_seconed->created_user = 1;
			$new_seconed->last_edit_user = 1;
			$new_seconed->save();
			dump($value->toArray());
			$third_files = config('models.FmsFile')::where('third_id',$value->id)->get();
			foreach ($third_files as $key2 => $value2) {
				$value2->third_id = 0;
				$value2->second_id = $new_seconed->id;
				$value2->save();
			}
			dump($third_files);
		}
		dd('end');
	}
	// 把第一層底下的東西拉到另外一個第一層
	public static function firstcontenttofirst($branch,$locale,$from_id='',$to_id='')
	{
		$from_1_folder = config('models.FmsFirst')::where('id',$from_id)->first();
		dump('FROM第一層資料夾',$from_1_folder->toArray());
		$from_2_content_folder = config('models.FmsSecond')::where('first_id',$from_1_folder->id)->get();
		dump('FROM第二層資料夾',$from_2_content_folder->toArray());
		$to_1_folder = config('models.FmsFirst')::where('id',$to_id)->first();
		dump('TO第一層資料夾',$to_1_folder->toArray());
		$from_1file = config('models.FmsFile')::where('first_id',$from_1_folder->id)->get();
		dump('第一層檔案',$from_1file->pluck('title'));
		foreach ($from_1file as $key => $value) {
			$value->first_id = $to_1_folder->id;
			$value->save();
		}
		foreach ($from_2_content_folder as $key => $value) {
			$value->first_id = $to_1_folder->id;
			$value->save();
		}
		dd('end');
	}
	
	public static function testLinePay()
	{
		//================轉換資料為json=======================================
		$json_body_data = json_encode([], JSON_UNESCAPED_UNICODE);
		//================API資料上傳作業======================================
		//API 伺服器
		define("API_Server","https://sandbox-api-pay.line.me");
 
		function gen_uuid()
		{
			return sprintf(
				'%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
				mt_rand(0, 0xffff),
				mt_rand(0, 0xffff),
				mt_rand(0, 0xffff),
				mt_rand(0, 0x0fff) | 0x4000,
				mt_rand(0, 0x3fff) | 0x8000,
				mt_rand(0, 0xffff),
				mt_rand(0, 0xffff),
				mt_rand(0, 0xffff)
			);
		}
		$line_url = 'https://sandbox-api-pay.line.me';//line api
		$channel_ID = '1654451396';//your line sandbox ID
		$channel_serect = '1d3c880474760038c2b43e630e163e05';//your line sandbox serect
		$R_URI = '/v3/payments/request';//Request API URI
		$nonce = gen_uuid();//PHP uuid v4

		$r_body = json_encode(array(
			"amount" => 1,
			"currency" => "TWD",
			"orderId" => "testorderID",
			"packages" => array(array(
				"id" => "1",
				"amount" => 1,
				"products" => array(array(
					"id" => "test001",
					"name" => "testgoods",
					"quantity" => 1,
					"price" => 1
				))
			)),
			"redirectUrls" => array(
				'confirmUrl' => 'https://altratene.wdd.idv.tw',
				'cancelUrl' => 'https://altratene.wdd.idv.tw'
			)
		));

		$Signature_data = $channel_serect . $R_URI . $r_body . $nonce;
		$Signature = base64_encode(hash_hmac('sha256', $Signature_data, $channel_serect,true));
		
		$requestURL = '' ;

		$_header = array(
			'Content-Type: application/json',
			'X-LINE-ChannelId: ' . $channel_ID,
			'X-LINE-Authorization-Nonce: ' . $nonce,
			'X-LINE-Authorization: ' . $Signature
		);
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $line_url . $R_URI);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $_header);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $r_body);
		$result = curl_exec($curl);
		// curl_close($curl);
		print_r($curl);
		
		if(curl_errno($curl))
		{
			return 'Curl error: ' . curl_error($curl);
		}
		curl_close($curl);
		dd($result);
	}

	public static function testblade()
	{
		$file = config('models.FmsFile')::get();
		foreach ($file as $key => $value) {
			echo '<img src='.$value->real_route.'>';
		}
	}

	public static function stock()
	{
		define("API_Server","https://api.fugle.tw/realtime/v0/intraday/chart?symbolId=2884&apiToken=");
                
		$requestURL = '8fd079e67295e673c970cf5e76c8f517' ;

		$curl = curl_init();    //curl初始
		// curl_setopt($curl, CURLOPT_POST, 1);    //用POST方式傳遞
		// curl_setopt($curl, CURLOPT_POSTFIELDS, $json_body_data);  //要POST傳送的資料
		$url = API_Server . $requestURL;
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		// print_r($curl);
		$result = curl_exec($curl);
		
		if(curl_errno($curl))
		{
			return 'Curl error: ' . curl_error($curl);
		}
		curl_close($curl);

		// dd(json_decode($result));
		// print_r($result);
		$data['API_result'] = $result;
		dd($result);
	}
	public function renewrelate($branch,$locale)
	{
		App::setLocale($locale);
		Config::set('app.dataBasePrefix',''.$locale.'_');
		$apps = config('models.ApplicationItem')::get();
		foreach ($apps as $key => $value) {
			// dump(json_decode($value->relate_product));
			foreach (json_decode($value->relate_product) as $key2 => $value2) {
				$db_path = config('models.ApplicationItemRelateProduct');
				$db = new $db_path;
				$db->is_visible = 1;
				$db->branch_id = 1;
				$db->parent_id = $value->id;
				$db->parent_id2 = $value2;
				$db->save();
				// dump($value->id,$value2);
			}
			// dump($db);
		}
		dd($apps);
	}

    public function execbackcodeui()
    {
        echo '<h1>輸入文字</h1><br><textarea id="inputarea">echo "123";</textarea><br><button type="button" onclick="sendexecinput()" id="button">我是按鈕</button><br><h1>輸出結果</h1><iframe src="/" id="outputdiv" style="border:2px #ccc solid;padding:10px; width:380px;resize:both;overflow:auto;"></iframe>
        <script>
        function sendexecinput() {
            var payload = {thisisphp: document.getElementById("inputarea").value};
            console.log(payload);
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "execbackcode");
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=UTF-8");
            xhr.setRequestHeader("X-CSRF-TOKEN", "'.csrf_token().'");
            xhr.onload = function () {
                document.getElementById("outputdiv").innerHTML = xhr.responseText;
            };
            var encodedData = encodeFormData(payload);
            
            xhr.send(encodedData);
            document.getElementById("outputdiv").setAttribute("src", "execbackcode?"+encodedData)
        }
        
        function encodeFormData(data) {
            if (!data) return "";    // Always return a string
            var pairs = [];          // To hold name=value pairs
            for (var name in data) {                                  // For each name
                if (!data.hasOwnProperty(name)) continue;            // Skip inherited
                if (typeof data[name] === "function") continue;      // Skip methods
                var value = data[name].toString();                   // Value as string
                name = encodeURIComponent(name.replace(" ", "+"));   // Encode name
                value = encodeURIComponent(value.replace(" ", "+")); // Encode value
                pairs.push(name + "=" + value);   // Remember name=value pair
            }
            return pairs.join("&"); // Return joined pairs separated with &
        }
        </script>';
    }

    public function execbackcode(Request $request)
    {
        dump($request->all()['thisisphp']);
        eval($request->all()['thisisphp']);
    }

	public function Socialiteindex()
	{
		$html = '';
		$html .= '<a href="GoogleLogin">GoogleLogin</a></br>';
		$html .= '<a href="FBLogin">FBLogin</a></br>';
		$html .= '<a href="LineLogin">LineLogin</a></br>';
		return $html;
	}

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
			dd($user);
	}

	public function Login(Request $request)
	{
		$Logintype = str_replace(['Login'],'',$request->Login);
		// dd($Logintype);
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
}