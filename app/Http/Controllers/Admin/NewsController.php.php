<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $q = trim($request->get('q',''));
        $items = News::query()
            ->when($q, fn($qq)=>$qq->where('title','like',"%$q%"))
            ->orderBy('id','desc')->paginate(20)->withQueryString();
        return view('admin.news.index', compact('items','q'));
    }
    public function create(){ return view('admin.news.create'); }
    public function store(Request $request){
        $data = $request->validate([
            'title'=>'required|max:255',
            'slug'=>'required|max:255|unique:news,slug',
            'excerpt'=>'nullable|max:500',
            'body'=>'required',
            'is_published'=>'nullable|boolean',
            'published_at'=>'nullable|date'
        ]);
        News::create($data);
        return redirect()->route('admin.news.index')->with('ok','Created');
    }
    public function edit(News $news){ return view('admin.news.edit', ['item'=>$news]); }
    public function update(Request $request, News $news){
        $data = $request->validate([
            'title'=>'required|max:255',
            'slug'=>'required|max:255|unique:news,slug,'.$news->id,
            'excerpt'=>'nullable|max:500',
            'body'=>'required',
            'is_published'=>'nullable|boolean',
            'published_at'=>'nullable|date'
        ]);
        $news->update($data);
        return redirect()->route('admin.news.index')->with('ok','Updated');
    }
    public function destroy(News $news){
        $news->delete();
        return back()->with('ok','Deleted');
    }
}
