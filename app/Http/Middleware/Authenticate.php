<?php 
namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use App\Http\Controllers\Fantasy\BackendController as myBackEnd;

use UnitMaker;
use BaseFunction;
use App;
use Session;

class Authenticate {

	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;

	/**
	 * Create a new filter instance.
	 *
	 * @param  Guard  $auth
	 * @return void
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
		//myBackEnd::checkRouteLang();
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		// dd($_SERVER['HTTP_X_REQUESTED_WITH']);
		if( Session::has('fantasy_user') )
		{
			return $next($request);
		}
		else
		{
			if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')
			{
				return $next($request);
			}
			else
			{
				return redirect()->guest( url( 'auth/login') );
			}

			//return redirect()->guest( url( 'auth/login') );
		}
	}

}
