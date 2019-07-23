<?php

namespace App\Http\Middleware;
use App\user;
use App\user_types;
use Closure;
use Auth;
use DB;

class CheckManager
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
        $userTypes=Auth::user()->user_type_id=='2'||'1';
        // dd($userTypes);
        // DB::table('user_types')->pluck('user_typename');
        if(!($userTypes=='2'||$userTypes=='1')){
            return redirect('/');
        }
        return $next($request);
    }
}
