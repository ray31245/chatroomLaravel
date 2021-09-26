<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use BaseFunction;

class needtologin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {        
        //確認會員session
        if( !Session::has('loginstatus') )
        {
            Session::put('WannaGo', $request->getpathInfo());
            $url = route('loginindex', ['branch' => $request->branch]);
            // dd($url);
            return redirect($url);
        }
        return $next($request);
    }
}
