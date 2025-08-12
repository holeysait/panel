<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServersController extends Controller
{
    public function index(Request $request)
    {
        $Server = class_exists('App\\Domain\\Servers\\Models\\Server')
            ? \App\Domain\Servers\Models\Server::class
            : (class_exists('App\\Models\\Server') ? \App\Models\Server::class : null);

        $hasModel = (bool)$Server;
        $items = collect();
        if ($Server) {
            $q = trim($request->get('q',''));
            $items = $Server::query()
                ->when($q, function($qq) use ($q){ $qq->where('name','like',"%{$q}%"); })
                ->orderBy('id','desc')
                ->paginate(20)
                ->withQueryString();
        }

        return view('admin.servers.index', compact('items','hasModel'));
    }

    public function show($server)
    {
        $Server = class_exists('App\\Domain\\Servers\\Models\\Server')
            ? \App\Domain\Servers\Models\Server::class
            : (class_exists('App\\Models\\Server') ? \App\Models\Server::class : null);

        abort_unless($Server, 404);
        $item = $Server::findOrFail($server);
        return view('admin.servers.show', compact('item'));
    }

    public function update(Request $request, $server)
    {
        $Server = class_exists('App\\Domain\\Servers\\Models\\Server')
            ? \App\Domain\Servers\Models\Server::class
            : (class_exists('App\\Models\\Server') ? \App\Models\Server::class : null);

        abort_unless($Server, 404);
        $item = $Server::findOrFail($server);
        $data = $request->validate([
            'name'=>'sometimes|string|max:255',
            'status'=>'sometimes|string|max:32',
        ]);
        $item->fill($data)->save();
        return back()->with('ok','Сервер обновлён');
    }
}
