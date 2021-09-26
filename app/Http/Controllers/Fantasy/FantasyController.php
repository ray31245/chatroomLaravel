<?php 
namespace App\Http\Controllers\Fantasy;

use App\Http\Controllers\Fantasy\BackendController as myBackEnd;

use Illuminate\Http\Request;

use View;
use Redirect;
use Auth;
use Debugbar;
use Route;
use App;
use Config;
use Session;

use UnitMaker;
use TableMaker;
use BaseFunction;

/*Model*/


class FantasyController extends BackendController 
{

	public function __construct()
	{
		parent::__construct();
		View::share('unitTitle', 'Backstage');
		View::share('unitSubTitle', '');
		View::share('FantasyUser', session('fantasy_user'));
	}

	public function index()
	{
		$locale = App::getLocale();
		if (Session::get('fantasy_user')) 
		{
            return redirect(BaseFunction::cms_url('/'));
			// return View::make('Fantasy.index',[]);
		}
		else
		{
			return redirect('auth/login');
		}
    }
    
    public function cleared(){
        \Artisan::call('cache:clear');
        \Artisan::call('clear-compiled');
        \Artisan::call('optimize');
        \Artisan::call('view:clear');
        \Artisan::call('config:clear');
        \Artisan::call('route:clear');
        \Artisan::call('config:cache');
        echo phpinfo();
        return 'ok';
    }
}