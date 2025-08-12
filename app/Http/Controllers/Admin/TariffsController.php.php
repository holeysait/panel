<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tariff;

class TariffsController extends Controller
{
    public function index(Request $request)
    {
        $q = trim($request->get('q',''));
        $items = Tariff::query()
            ->when($q, fn($qq)=>$qq->where('name','like',"%$q%"))
            ->orderBy('id','desc')->paginate(20)->withQueryString();
        return view('admin.tariffs.index', compact('items','q'));
    }

    public function create() { return view('admin.tariffs.create'); }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'slug'=>'required|string|max:255|unique:tariffs,slug',
            'description'=>'nullable|string',
            'price_minor'=>'required|integer|min:0',
            'currency'=>'required|string|size:3',
            'period'=>'required|string|in:hour,day,month',
            'cpu_limit'=>'required|integer|min:1',
            'ram_mb'=>'required|integer|min:128',
            'disk_gb'=>'required|integer|min:1',
            'ports'=>'required|integer|min:1',
            'is_active'=>'nullable|boolean',
        ]);
        Tariff::create($data);
        return redirect()->route('admin.tariffs.index')->with('ok','Created');
    }

    public function edit(Tariff $tariff)
    {
        return view('admin.tariffs.edit', ['item'=>$tariff]);
    }

    public function update(Request $request, Tariff $tariff)
    {
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'slug'=>'required|string|max:255|unique:tariffs,slug,'.$tariff->id,
            'description'=>'nullable|string',
            'price_minor'=>'required|integer|min:0',
            'currency'=>'required|string|size:3',
            'period'=>'required|string|in:hour,day,month',
            'cpu_limit'=>'required|integer|min:1',
            'ram_mb'=>'required|integer|min:128',
            'disk_gb'=>'required|integer|min:1',
            'ports'=>'required|integer|min:1',
            'is_active'=>'nullable|boolean',
        ]);
        $tariff->update($data);
        return redirect()->route('admin.tariffs.index')->with('ok','Updated');
    }

    public function destroy(Tariff $tariff)
    {
        $tariff->delete();
        return back()->with('ok','Deleted');
    }
}
