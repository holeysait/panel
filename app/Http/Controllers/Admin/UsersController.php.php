<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $q = trim($request->get('q',''));
        $users = User::query()
            ->when($q, fn($qq)=>$qq->where('name','like',"%$q%")
                ->orWhere('email','like',"%$q%"))
            ->orderBy('id','desc')->paginate(20)->withQueryString();
        return view('admin.users.index', compact('users', 'q'));
    }

    public function create() { return view('admin.users.create'); }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|string|min:6|confirmed',
            'is_admin'=>'nullable|boolean',
        ]);
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->is_admin = (bool)($data['is_admin'] ?? false);
        $user->save();
        return redirect()->route('admin.users.index')->with('ok','User created');
    }

    public function edit(User $user) { return view('admin.users.edit', compact('user')); }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users,email,'.$user->id,
            'password'=>'nullable|string|min:6|confirmed',
            'is_admin'=>'nullable|boolean',
        ]);
        $user->name = $data['name'];
        $user->email = $data['email'];
        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }
        $user->is_admin = (bool)($data['is_admin'] ?? false);
        $user->save();
        return redirect()->route('admin.users.index')->with('ok','User updated');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('ok','User deleted');
    }
}
