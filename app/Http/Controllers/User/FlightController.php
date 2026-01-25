<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function index(Request $request)
    {
        $query = Flight::query();

        if ($request->filled('from')) {
            $query->where('departure_city', 'like', '%' . $request->from . '%');
        }

        if ($request->filled('to')) {
            $query->where('arrival_city', 'like', '%' . $request->to . '%');
        }

        $flights = $query->latest()->paginate(6);

        return view('user.flights.index', compact('flights'));
    }
    public function show(Flight $flight)
    {
        return view('user.flights.show', compact('flight'));
    }

    
    public function update(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $user->update($request->only('name', 'email'));

        return redirect()->back()->with('success', 'تم تحديث البيانات بنجاح!');
    }

    // هذه الدالة لتحديث الصورة
    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        // حذف الصورة القديمة إذا كانت موجودة
        if ($user->avatar) {
            Storage::delete('public/'.$user->avatar);
        }

        // تخزين الصورة الجديدة
        $path = $request->file('avatar')->store('avatars', 'public');
        $user->avatar = $path;
        $user->save();

        return redirect()->back()->with('success', 'تم تعديل الصورة بنجاح!');
    }

    // إضافة دالة تغيير كلمة المرور إذا لم تكن موجودة
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = Auth::user();

        if (!\Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'كلمة المرور الحالية غير صحيحة']);
        }

        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->back()->with('password_success', true);
    }
}
