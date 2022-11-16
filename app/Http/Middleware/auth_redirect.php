<?php

namespace App\Http\Middleware;

use Closure;

class auth_redirect
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

        $group = Auth()->user()->getUserGroup->pluck('GroupCode')->toArray();
        // dd($group, Auth()->user());
        if( in_array('USER_CORSEC', $group) ){
            return redirect()->route('home');
        }
        
        return $next($request);
    }
}
