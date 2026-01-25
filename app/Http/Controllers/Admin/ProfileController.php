<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit() {
        $user = Auth::user();
        return view('admin.profile.edit', compact('user'));
    }

    public function update(Request $request) {
        $user = Auth::user();

        $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users,email,'.$user->id,
        ]);

        $user->update($request->only('name','email'));

        if ($request->password) $user->update(['password'=>bcrypt($request->password)]);

        return redirect()->route('profile.edit')->with('success','تم تحديث بيانات الحساب');
    }
}
