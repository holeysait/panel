<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Node;
use App\Models\Location;
use App\Services\Nodes\NodeHealth;

class NodesController extends Controller
{
    public function index(Request $request) {
        $q = trim($request->get('q',''));
        $items = Node::query()
            ->with('location')
            ->when($q, function($qq) use ($q){
                $qq->where('name','like',"%{$q}%")
                   ->orWhere('public_fqdn','like',"%{$q}%");
            })
            ->orderBy('id','desc')
            ->paginate(20);
        return view('admin.nodes.index', compact('items','q'));
    }

    public function create() {
        $locations = Location::orderBy('name')->pluck('name','id');
        return view('admin.nodes.create', compact('locations'));
    }

    public function store(Request $request) {
        // Accept JSON string for capabilities and convert to array before validation
        $capRaw = $request->input('capabilities');
        if (is_string($capRaw) && strlen($capRaw)) {
            try {
                $decoded = json_decode($capRaw, true, 512, JSON_THROW_ON_ERROR);
            } catch (\Throwable $e) {
                return back()->withErrors(['capabilities' => 'Invalid JSON in capabilities: '.$e->getMessage()])->withInput();
            }
            $request->merge(['capabilities' => $decoded]);
        }

        $data = $request->validate([
            'name'=>'required|string|max:255',
            'public_fqdn'=>'required|string|max:255',
            'daemon_url'=>'required|url|max:255',
            'status'=>'nullable|string|max:50',
            'location_id'=>'nullable|exists:locations,id',
            'capabilities'=>'nullable|array'
        ]);
        $data['status'] = $data['status'] ?? 'offline';
        $data['capabilities'] = $data['capabilities'] ?? [];
        $item = Node::create($data);
        return redirect()->route('admin.nodes.edit', $item)->with('ok','Узел создан');
    }

    public function show(Node $node) {
        $node->load('location');
        return view('admin.nodes.show', ['item'=>$node]);
    }

    public function edit(Node $node) {
        $locations = Location::orderBy('name')->pluck('name','id');
        return view('admin.nodes.edit', ['item'=>$node, 'locations'=>$locations]);
    }

    public function update(Request $request, Node $node) {
        // Accept JSON string for capabilities and convert to array before validation
        $capRaw = $request->input('capabilities');
        if (is_string($capRaw) && strlen($capRaw)) {
            try {
                $decoded = json_decode($capRaw, true, 512, JSON_THROW_ON_ERROR);
            } catch (\Throwable $e) {
                return back()->withErrors(['capabilities' => 'Invalid JSON in capabilities: '.$e->getMessage()])->withInput();
            }
            $request->merge(['capabilities' => $decoded]);
        }

        $data = $request->validate([
            'name'=>'required|string|max:255',
            'public_fqdn'=>'required|string|max:255',
            'daemon_url'=>'required|url|max:255',
            'status'=>'nullable|string|max:50',
            'location_id'=>'nullable|exists:locations,id',
            'capabilities'=>'nullable|array'
        ]);
        $data['capabilities'] = $data['capabilities'] ?? [];
        $node->update($data);
        return redirect()->route('admin.nodes.index')->with('ok','Узел обновлён');
    }

    public function destroy(Node $node) {
        $node->delete();
        return back()->with('ok','Узел удалён');
    }

    public function ping(Node $node, NodeHealth $health) {
        $res = $health->check($node);
        return back()->with($res['ok'] ? 'ok' : 'error',
            $res['ok'] ? ('Узел доступен: ' . $res['url']) : ('Узел недоступен: ' . $res['error'])
        );
    }
}
