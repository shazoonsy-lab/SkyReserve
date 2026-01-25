<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        $employee = Auth::user();
        return view('employee.profile.edit', compact('employee'));
    }

    public function update(Request $request)
    {
        $employee = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $employee->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $employee->name = $request->name;
        $employee->email = $request->email;

        if ($request->filled('password')) {
            $employee->password = Hash::make($request->password);
        }

        $employee->save();

        return redirect()->route('employee.profile.edit')->with('success', 'تم تحديث البيانات بنجاح.');
    }
}
