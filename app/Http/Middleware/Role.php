<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Role
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
        if (Auth::check() && ($request->user()->role == 0 || $request->user()->role == 1 || $request->user()->role == 2)){
            return $next($request);
        }
        return redirect()->guest('/');
    }
}
