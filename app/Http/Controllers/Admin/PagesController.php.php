<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;

class PagesController extends Controller
{
    public function index(Request $request)
    {
        $q = trim($request->get('q',''));
        $items = Page::query()
            ->when($q, fn($qq)=>$qq->where('title','like',"%$q%"))
            ->orderBy('id','desc')->paginate(20)->withQueryString();
        return view('admin.pages.index', compact('items','q'));
    }
    public function create(){ return view('admin.pages.create'); }
    public function store(Request $request){
        $data = $request->validate([
            'title'=>'required|max:255',
            'slug'=>'required|max:255|unique:pages,slug',
            'body'=>'required',
            'is_published'=>'nullable|boolean',
            'show_in_menu'=>'nullable|boolean'
        ]);
        Page::create($data);
        return redirect()->route('admin.pages.index')->with('ok','Created');
    }
    public function edit(Page $page){ return view('admin.pages.edit', ['item'=>$page]); }
    public function update(Request $request, Page $page){
        $data = $request->validate([
            'title'=>'required|max:255',
            'slug'=>'required|max:255|unique:pages,slug,'.$page->id,
            'body'=>'required',
            'is_published'=>'nullable|boolean',
            'show_in_menu'=>'nullable|boolean'
        ]);
        $page->update($data);
        return redirect()->route('admin.pages.index')->with('ok','Updated');
    }
    public function destroy(Page $page){
        $page->delete();
        return back()->with('ok','Deleted');
    }
}
