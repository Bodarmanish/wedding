<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class venue
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
        if (Auth::guard('venue')->check()) {
            return $next($request);
        }
        return redirect()->route('venue');

    }
}
