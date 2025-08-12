<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Domain\Servers\Models\Server;

class DashboardController extends Controller
{
    public function index() {
        $user = Auth::user();
        $serversCount = Server::where('user_id', $user->id)->count();
        return view('dashboard', [
            'user' => $user,
            'serversCount' => $serversCount,
        ]);
    }
}
