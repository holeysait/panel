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
            ->when($q, function($qq) use ($q){
                $qq->where('name','like',"%{$q}%")->orWhere('slug','like',"%{$q}%");
            })
            ->orderBy('id','desc')
            ->paginate(20)
            ->withQueryString();

        return view('admin.tariffs.index', compact('items','q'));
    }

    public function create(){ return view('admin.tariffs.create'); }

    public function store(Request $request){
        $data = $request->validate([
            'name'=>'required|max:255',
            'slug'=>'required|max:255|unique:tariffs,slug',
            'description'=>'nullable',
            'price_minor'=>'required|integer|min:0',
            'currency'=>'required|string|size:3',
            'period'=>'required|in:hour,day,month',
            'cpu_limit'=>'required|integer|min:1',
            'ram_mb'=>'required|integer|min:128',
            'disk_gb'=>'required|integer|min:1',
            'ports'=>'required|integer|min:1',
            'is_active'=>'nullable|boolean'
        ]);
        $data['is_active'] = (bool)($data['is_active'] ?? false);
        Tariff::create($data);
        return redirect()->route('admin.tariffs.index')->with('ok','Тариф создан');
    }

    public function edit(Tariff $tariff){ return view('admin.tariffs.edit', ['item'=>$tariff]); }

    public function update(Request $request, Tariff $tariff){
        $data = $request->validate([
            'name'=>'required|max:255',
            'slug'=>'required|max:255|unique:tariffs,slug,'.$tariff->id,
            'description'=>'nullable',
            'price_minor'=>'required|integer|min:0',
            'currency'=>'required|string|size:3',
            'period'=>'required|in:hour,day,month',
            'cpu_limit'=>'required|integer|min:1',
            'ram_mb'=>'required|integer|min:128',
            'disk_gb'=>'required|integer|min:1',
            'ports'=>'required|integer|min:1',
            'is_active'=>'nullable|boolean'
        ]);
        $data['is_active'] = (bool)($data['is_active'] ?? false);
        $tariff->update($data);
        return redirect()->route('admin.tariffs.index')->with('ok','Тариф обновлён');
    }

    public function destroy(Tariff $tariff){
        $tariff->delete();
        return back()->with('ok','Тариф удалён');
    }
}
