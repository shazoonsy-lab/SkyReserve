<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index() {
        $users = User::with('roles')->get();
        $roles = Role::all();
        return view('admin.users.index', compact('users','roles'));
    }

    public function create()
{
    $roles = ['admin', 'employee'];

    return view('admin.users.create', compact('roles'));
}


    public function store(Request $request) {
        $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|string|min:6',
            'role'=>'required|string'
        ]);

        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
        ]);

        $user->assignRole($request->role);

        return redirect()->route('admin.users.index')->with('success','تم إضافة المستخدم بنجاح');
    }

    public function edit(User $user) {
        $roles = Role::all();
        return view('admin.users.edit', compact('user','roles'));
    }

    public function update(Request $request, User $user) {
        $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users,email,'.$user->id,
            'role'=>'required|string'
        ]);

        $user->update([
            'name'=>$request->name,
            'email'=>$request->email,
        ]);

        if ($request->password) $user->update(['password'=>bcrypt($request->password)]);
        $user->syncRoles($request->role);

        return redirect()->route('admin.users.index')->with('success','تم تحديث بيانات المستخدم');
    }

    public function destroy(User $user) {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success','تم حذف المستخدم');
    }
}
