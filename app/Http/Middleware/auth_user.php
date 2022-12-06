<?php

namespace App\Http\Middleware;

use Closure;

class auth_user
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
        if( !Auth()->check() ){
            return redirect()->route('login');
        }

        // $group = Auth()->user()->getUserGroup->pluck('GroupCode')->toArray();
        // if( !in_array('USER_CORSEC', $group) ){
        //     abort(404);
        // }
        
        return $next($request);
    }
}
