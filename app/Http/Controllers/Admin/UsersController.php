<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller {
    public function index(Request $r) {
        $q = trim($r->get('q',''));
        $users = User::query()
            ->when($q, fn($qr)=>$qr->where(function($w) use ($q){
                $w->where('name','like',"%$q%")->orWhere('email','like',"%$q%");
            }))
            ->orderBy('id','desc')->paginate(20)->withQueryString();
        return view('admin.users.index', compact('users','q'));
    }
    public function create() {
        return view('admin.users.create');
    }
    public function store(Request $r) {
        $data = $r->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|string|min:6|confirmed',
            'is_admin'=>'nullable|boolean',
            'locale'=>'nullable|string|max:8',
        ]);
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->is_admin = (bool)($data['is_admin'] ?? false);
        $user->locale = $data['locale'] ?? null;
        $user->save();
        // ensure wallet exists if Wallet model/migration present
        try { if (method_exists($user, 'wallet') && !$user->wallet) { $user->wallet()->create(['currency'=>'USD','balance_minor'=>0]); } } catch(\Throwable $e){}
        return redirect()->route('admin.users.index')->with('success','Пользователь создан');
    }
    public function edit(User $user) {
        return view('admin.users.edit', compact('user'));
    }
    public function update(Request $r, User $user) {
        $data = $r->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users,email,'.$user->id,
            'password'=>'nullable|string|min:6|confirmed',
            'is_admin'=>'nullable|boolean',
            'locale'=>'nullable|string|max:8',
        ]);
        $user->name = $data['name'];
        $user->email = $data['email'];
        if (!empty($data['password'])) $user->password = bcrypt($data['password']);
        $user->is_admin = (bool)($data['is_admin'] ?? false);
        $user->locale = $data['locale'] ?? null;
        $user->save();
        return redirect()->route('admin.users.index')->with('success','Пользователь обновлён');
    }
    public function destroy(User $user) {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success','Пользователь удалён');
    }
}
