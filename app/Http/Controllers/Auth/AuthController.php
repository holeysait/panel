<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Domain\Billing\Models\Wallet;

class AuthController extends Controller
{
    public function showLogin() { return view('auth.login'); }
    public function showRegister() { return view('auth.register'); }

    public function login(Request $request) {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        $remember = (bool)$request->boolean('remember');
        if (Auth::attempt($data, $remember)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }
        return back()->withErrors(['email' => 'Неверные учетные данные'])->onlyInput('email');
    }

    public function register(Request $request) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed|min:6',
        ]);
        $user = User::create([
            'name' => $data['name'],
            'email'=> $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        // ensure wallet
        if (!$user->wallet()->exists()) {
            $user->wallet()->create(['currency'=>'USD','balance_minor'=>0]);
        }
        Auth::login($user);
        $request->session()->regenerate();
        return redirect()->route('dashboard');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
