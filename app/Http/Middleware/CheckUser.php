<?php

namespace App\Http\Middleware;
use App\user;
use App\user_types;
use Closure;
use Auth;
use DB;

class CheckAdmin
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
       
        return $next($request);
    }
}
