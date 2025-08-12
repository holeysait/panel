<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Domain\Servers\Models\Server;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class ServerController extends Controller {
    public function store(Request $req) {
        $data = $req->validate([
            'user_id'=>'required|integer',
            'egg_id'=>'required|integer',
            'name'=>'required|string',
            'cpu_limit'=>'required|integer',
            'ram_mb'=>'required|integer',
            'disk_gb'=>'required|integer',
        ]);
        $data['uuid'] = (string) Str::uuid();
        $server = Server::create($data);
        return response()->json($server, 201);
    }
}