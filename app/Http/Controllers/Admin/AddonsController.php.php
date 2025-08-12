<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Addon;

class AddonsController extends Controller
{
    public function index(Request $request)
    {
        $q = trim($request->get('q',''));
        $items = Addon::query()
            ->when($q, fn($qq)=>$qq->where('name','like',"%$q%"))
            ->orderBy('id','desc')->paginate(20)->withQueryString();
        return view('admin.addons.index', compact('items','q'));
    }

    public function create() { return view('admin.addons.create'); }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'code'=>'required|string|max:64|unique:addons,code',
            'description'=>'nullable|string',
            'unit'=>'required|string|max:32',
            'unit_price_minor'=>'required|integer|min:0',
            'currency'=>'required|string|size:3',
            'is_active'=>'nullable|boolean',
        ]);
        Addon::create($data);
        return redirect()->route('admin.addons.index')->with('ok','Created');
    }

    public function edit(Addon $addon)
    {
        return view('admin.addons.edit', ['item'=>$addon]);
    }

    public function update(Request $request, Addon $addon)
    {
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'code'=>'required|string|max:64|unique:addons,code,'.$addon->id,
            'description'=>'nullable|string',
            'unit'=>'required|string|max:32',
            'unit_price_minor'=>'required|integer|min:0',
            'currency'=>'required|string|size:3',
            'is_active'=>'nullable|boolean',
        ]);
        $addon->update($data);
        return redirect()->route('admin.addons.index')->with('ok','Updated');
    }

    public function destroy(Addon $addon)
    {
        $addon->delete();
        return back()->with('ok','Deleted');
    }
}
