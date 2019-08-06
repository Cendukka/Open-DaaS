<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

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
        $userTypes=Auth::user()->user_type_id=='1';
        //dd($userTypes);
        // DB::table('user_types')->pluck('user_typename');
        if(!$userTypes=='1'){
            return redirect(url()->previous());
        }
        return $next($request);
    
    }
}
