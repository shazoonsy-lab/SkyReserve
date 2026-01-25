<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyGuestOnly
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {

            // إذا مستخدم عادي → ممنوع
            if (Auth::user()->role === 'user') {
                abort(403, 'غير مصرح لك بالوصول');
            }

            // إذا موظف أو مدير مسجل → حوّله للوحة مباشرة
            return redirect()->route(
                Auth::user()->role === 'admin'
                    ? 'admin.dashboard'
                    : 'employee.dashboard'
            );
        }

        return $next($request);
    }
}
