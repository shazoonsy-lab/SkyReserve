<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * عرض صفحة تسجيل الدخول
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * تنفيذ تسجيل الدخول + التوجيه حسب الدور
     */
    public function store(LoginRequest $request): RedirectResponse
{
    $request->authenticate();
    $request->session()->regenerate();

    $user = auth()->user();

    return match ($user->role) {
        'admin'    => redirect()->route('admin.dashboard'),
        'employee' => redirect()->route('employee.dashboard'),
        default    => redirect()->route('home'), // مستخدم عادي
    };
}


    /**
     * تسجيل الخروج
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
