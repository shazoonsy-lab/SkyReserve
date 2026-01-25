<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeMiddleware
{
    public function handle($request, \Closure $next)
{
     if (!auth()->check()) {
        return redirect()->route('login');
    }

    if (auth()->user()->role !== 'employee') {
        return redirect()->route('unauthorized');
    }

    return $next($request);
}
}
