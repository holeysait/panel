<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Domain\Servers\Models\Server;

class ServersPageController extends Controller
{
    public function index() {
        $servers = Server::with('egg')->where('user_id', Auth::id())->latest()->paginate(15);
        return view('servers.index', ['servers' => $servers]);
    }
}
