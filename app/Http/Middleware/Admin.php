<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Admin
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
        if(Auth::user()->role == "admin_owner") {
            return $next($request);
        } elseif(Auth::user()->role == "admin_penjualan") {
            return $next($request);
        } elseif(Auth::user()->role == "admin_bendahara") {
            return $next($request);
        } elseif(Auth::user()->role == "admin_gp") {
            return $next($request);
        }
        abort(403);
    }
}
