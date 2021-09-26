<?php 
namespace App\Http\Controllers\Fantasy;

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


class PhotosController extends BackendController 
{

	public function __construct()
	{
		parent::__construct();
        // parent::checkRouteLang();
        // parent::checkRouteBranch();
		View::share('unitTitle', 'Photos');
        View::share('unitSubTitle', 'Information Technology System');
        View::share('FantasyUser', session('fantasy_user'));
	}
	public function index()
	{
		return View::make('Fantasy.photos.index',
		[
			
		]);
	}
}