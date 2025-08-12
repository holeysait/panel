<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WikiPage;

class WikiController extends Controller
{
    public function index(Request $request)
    {
        $q = trim($request->get('q',''));
        $items = WikiPage::query()
            ->when($q, fn($qq)=>$qq->where('title','like',"%$q%"))
            ->orderBy('id','desc')->paginate(20)->withQueryString();
        return view('admin.wiki.index', compact('items','q'));
    }
    public function create(){ return view('admin.wiki.create'); }
    public function store(Request $request){
        $data = $request->validate([
            'title'=>'required|max:255',
            'slug'=>'required|max:255|unique:wiki_pages,slug',
            'body'=>'required',
            'tags'=>'nullable|max:255',
            'is_published'=>'nullable|boolean'
        ]);
        WikiPage::create($data);
        return redirect()->route('admin.wiki.index')->with('ok','Created');
    }
    public function edit(WikiPage $wiki){ return view('admin.wiki.edit', ['item'=>$wiki]); }
    public function update(Request $request, WikiPage $wiki){
        $data = $request->validate([
            'title'=>'required|max:255',
            'slug'=>'required|max:255|unique:wiki_pages,slug,'.$wiki->id,
            'body'=>'required',
            'tags'=>'nullable|max:255',
            'is_published'=>'nullable|boolean'
        ]);
        $wiki->update($data);
        return redirect()->route('admin.wiki.index')->with('ok','Updated');
    }
    public function destroy(WikiPage $wiki){
        $wiki->delete();
        return back()->with('ok','Deleted');
    }
}
