<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SatgasAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->guard('satgas')->check()) {
            return redirect(route('satgas.login'));
        }
        return $next($request);
    }
}
