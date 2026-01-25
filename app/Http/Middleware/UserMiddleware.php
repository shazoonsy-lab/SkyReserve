<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     */
   public function handle($request, \Closure $next)
{
   if (!auth()->check()) {
        return redirect()->route('login');
    }

    if (auth()->user()->role !== 'user') {
        return redirect()->route('unauthorized');
    }

    return $next($request);
}
}
