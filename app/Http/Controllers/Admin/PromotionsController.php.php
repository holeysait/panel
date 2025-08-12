<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promotion;

class PromotionsController extends Controller
{
    public function index(Request $request)
    {
        $q = trim($request->get('q',''));
        $items = Promotion::query()
            ->when($q, fn($qq)=>$qq->where('name','like',"%$q%") ->orWhere('code','like',"%$q%"))
            ->orderBy('id','desc')->paginate(20)->withQueryString();
        return view('admin.promotions.index', compact('items','q'));
    }

    public function create(){ return view('admin.promotions.create'); }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=>'required|max:255',
            'code'=>'required|max:64|unique:promotions,code',
            'type'=>'required|in:percent,fixed',
            'value'=>'required|numeric|min:0',
            'starts_at'=>'nullable|date',
            'ends_at'=>'nullable|date|after_or_equal:starts_at',
            'is_active'=>'nullable|boolean',
            'description'=>'nullable|string'
        ]);
        Promotion::create($data);
        return redirect()->route('admin.promotions.index')->with('ok','Created');
    }

    public function edit(Promotion $promotion){ return view('admin.promotions.edit', ['item'=>$promotion]); }

    public function update(Request $request, Promotion $promotion)
    {
        $data = $request->validate([
            'name'=>'required|max:255',
            'code'=>'required|max:64|unique:promotions,code,'.$promotion->id,
            'type'=>'required|in:percent,fixed',
            'value'=>'required|numeric|min:0',
            'starts_at'=>'nullable|date',
            'ends_at'=>'nullable|date|after_or_equal:starts_at',
            'is_active'=>'nullable|boolean',
            'description'=>'nullable|string'
        ]);
        $promotion->update($data);
        return redirect()->route('admin.promotions.index')->with('ok','Updated');
    }

    public function destroy(Promotion $promotion)
    {
        $promotion->delete();
        return back()->with('ok','Deleted');
    }
}
