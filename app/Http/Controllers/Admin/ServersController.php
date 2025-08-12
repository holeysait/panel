<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Server;

class ServersController extends Controller
{
    public function index(Request $request) {
        $q = trim($request->get('q',''));
        $items = Server::query()
            ->with('node','user')
            ->when($q, function($qq) use ($q){
                $qq->where('name','like',"%{$q}%")
                   ->orWhere('uuid','like',"%{$q}%");
            })
            ->orderByDesc('id')->paginate(20);
        return view('admin.servers.index', compact('items','q'));
    }

    public function show(Server $server) {
        $server->load('node','user');
        return view('admin.servers.show', ['item'=>$server]);
    }
}
