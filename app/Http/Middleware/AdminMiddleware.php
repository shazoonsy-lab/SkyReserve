<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
          if (!auth()->check()) {
        return redirect()->route('login');
    }

    if (auth()->user()->role !== 'admin') {
        return redirect()->route('unauthorized');
    }

    return $next($request);
}
};


