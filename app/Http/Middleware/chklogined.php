<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use BaseFunction;

class chklogined
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
        if( Session::has('loginstatus') )
        {
            abort(403);
        }
        return $next($request);
    }
}
