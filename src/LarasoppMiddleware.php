<?php

namespace Larasopp;

use Closure;
use Illuminate\Http\Request;

class LarasoppMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
		if ($request->header('Controll-Token') != config('broadcasting.connections.larasopp.token')) abort(401);
        return $next($request);
    }
}
