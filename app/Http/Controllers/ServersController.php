<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Server;
use App\Models\Location;
use App\Models\Node;

class ServersController extends Controller
{
    public function index(Request $request) {
        $user = $request->user();
        $items = Server::query()->with('node')->where('user_id', $user->id)->orderByDesc('id')->paginate(15);
        return view('servers.index', compact('items'));
    }

    public function create(Request $request) {
        $locations = Location::query()->where('is_active', true)->orderBy('name')->get();
         $eggs = DB::table('eggs')->orderBy('name')->get(['id','name']);
        return view('servers.create', compact('locations','eggs'));
    }

    public function store(Request $request) {
        $user = $request->user();
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'egg_id' => 'required|exists:eggs,id',
            'location_slug' => 'required|string|exists:locations,slug',
            'node_id' => 'required|exists:nodes,id',
            'cpu_limit' => 'required|integer|min:1|max:64000',
            'ram_mb' => 'required|integer|min:256|max:1048576',
            'disk_gb' => 'required|integer|min:1|max:1048576',
        ]);

        // ensure the node belongs to the chosen location
        $node = Node::with('location')->findOrFail($data['node_id']);
        if (!$node->location || $node->location->slug !== $data['location_slug']) {
            return back()->withErrors(['node_id' => 'Выбранный узел не принадлежит указанной локации'])->withInput();
        }

        $server = Server::create([
            'uuid' => (string) Str::uuid(),
            'name' => $data['name'],
            'egg_id' => $data['egg_id'],
            'user_id' => $user->id,
            'node_id' => $node->id,
            'cpu_limit' => $data['cpu_limit'],
            'ram_mb' => $data['ram_mb'],
            'disk_gb' => $data['disk_gb'],
            'status' => 'provisioning',
        ]);

        // TODO: dispatch job to agent for actual provisioning

        return redirect()->route('servers.index')->with('ok', 'Сервер поставлен в очередь на создание');
    }
}
