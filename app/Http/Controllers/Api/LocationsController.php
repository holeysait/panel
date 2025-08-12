<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Node;

class LocationsController extends Controller
{
    public function index(Request $request) {
        $items = Location::query()
            ->where('is_active', true)
            ->withCount('nodes')
            ->orderByRaw('JSON_EXTRACT(meta, "$.priority") IS NULL, JSON_EXTRACT(meta, "$.priority") ASC')
            ->orderBy('name')
            ->get()
            ->map(function($loc){
                return [
                    'id'=>$loc->id,
                    'name'=>$loc->name,
                    'slug'=>$loc->slug,
                    'country'=>$loc->country,
                    'city'=>$loc->city,
                    'priority'=>data_get($loc->meta,'priority',100),
                    'nodes_count'=>$loc->nodes_count,
                ];
            });
        return response()->json(['data'=>$items]);
    }

    public function nodes(string $slug) {
        $loc = Location::where('slug',$slug)->firstOrFail();
        $nodes = $loc->nodes()->get(['id','name','public_fqdn','status','daemon_url']);
        return response()->json(['location'=>['id'=>$loc->id,'name'=>$loc->name,'slug'=>$loc->slug], 'nodes'=>$nodes]);
    }
}
