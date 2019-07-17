<?php

namespace App\Http\Middleware;
use App\user;
use App\user_types;
use Closure;
use Auth;
use DB;

class CheckCompany
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        if(Auth::user()->user_type_id != 1 && Auth::user()->user_company_id != $request->route('company')->company_id){
            $c = 1;
            return redirect(str_replace(''.$request->route('company')->company_id,Auth::user()->user_company_id,$request->path(),$c));
        }
        return $next($request);
    }
}
