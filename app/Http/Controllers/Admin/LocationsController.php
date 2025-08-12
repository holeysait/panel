<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;

class LocationsController extends Controller
{
    public function index(Request $request)
    {
        $q = trim($request->get('q',''));
        $items = Location::query()
            ->when($q, function($qq) use ($q){
                $qq->where('name','like',"%{$q}%")
                   ->orWhere('slug','like',"%{$q}%")
                   ->orWhere('city','like',"%{$q}%")
                   ->orWhere('country','like',"%{$q}%");
            })
            ->orderBy('id','desc')
            ->paginate(20)
            ->withQueryString();

        return view('admin.locations.index', compact('items','q'));
    }

    public function create(){ return view('admin.locations.create'); }

    public function store(Request $request){
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'slug'=>'required|string|max:255|unique:locations,slug',
            'country'=>'nullable|string|max:100',
            'city'=>'nullable|string|max:100',
            'is_active'=>'nullable|boolean'
        ]);
        $data['is_active'] = (bool)($data['is_active'] ?? false);
        Location::create($data);
        return redirect()->route('admin.locations.index')->with('ok','Локация создана');
    }

    public function edit(Location $location){ return view('admin.locations.edit', ['item'=>$location]); }

    public function update(Request $request, Location $location){
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'slug'=>'required|string|max:255|unique:locations,slug,'.$location->id,
            'country'=>'nullable|string|max:100',
            'city'=>'nullable|string|max:100',
            'is_active'=>'nullable|boolean'
        ]);
        $data['is_active'] = (bool)($data['is_active'] ?? false);
        $location->update($data);
        return redirect()->route('admin.locations.index')->with('ok','Локация обновлена');
    }

    public function destroy(Location $location){
        $location->delete();
        return back()->with('ok','Локация удалена');
    }
}
