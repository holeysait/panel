<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class SettingsController extends Controller
{
    public function index(Request $request){
        return view('settings.index');
    }
    public function updateProfile(Request $request){
        $user = $request->user();
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users,email,'.$user->id,
        ]);
        $user->update($data);
        return back()->with('status','Профиль обновлён');
    }
    public function updatePassword(Request $request){
        $user = $request->user();
        $data = $request->validate([
            'current_password'=>'required',
            'password'=>['required','confirmed',Password::min(6)],
        ]);
        if (!Hash::check($data['current_password'], $user->password)) {
            return back()->withErrors(['current_password'=>'Неверный текущий пароль']);
        }
        $user->update(['password'=>Hash::make($data['password'])]);
        return back()->with('status','Пароль обновлён');
    }
    public function updateLocale(Request $request){
        $user = $request->user();
        $data = $request->validate(['locale'=>'required|in:ru,en']);
        $user->update(['locale'=>$data['locale']]);
        return back()->with('status','Язык сохранён');
    }
}
