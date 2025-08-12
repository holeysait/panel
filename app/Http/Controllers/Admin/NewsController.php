<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Str;

class NewsController extends Controller {
  public function index(Request $r) {
    $q = $r->string('q')->toString();
    $items = News::when($q, fn($qq)=>$qq->where('title','like',"%$q%"))->latest()->paginate(20)->withQueryString();
    return view('admin.news.index', compact('items','q'));
  }
  public function create() { return view('admin.news.create'); }
  public function store(Request $r) {
    $data = $r->validate([
      'title'=>'required|string|max:255',
      'slug'=>'nullable|string|max:255',
      'excerpt'=>'nullable|string',
      'content'=>'required|string',
      'is_published'=>'sometimes|boolean',
      'published_at'=>'nullable|date',
    ]);
    if (empty($data['slug'])) $data['slug'] = Str::slug($data['title']).'-'.Str::random(4);
    $data['author_id'] = $r->user()->id ?? null;
    $data['is_published'] = (bool)($data['is_published'] ?? false);
    $item = News::create($data);
    return redirect()->route('admin.news.edit',$item)->with('ok','Новость создана');
  }
  public function edit(News $news) { return view('admin.news.edit',['item'=>$news]); }
  public function update(Request $r, News $news) {
    $data = $r->validate([
      'title'=>'required|string|max:255',
      'slug'=>'required|string|max:255',
      'excerpt'=>'nullable|string',
      'content'=>'required|string',
      'is_published'=>'sometimes|boolean',
      'published_at'=>'nullable|date',
    ]);
    $data['is_published'] = (bool)($data['is_published'] ?? false);
    $news->update($data);
    return back()->with('ok','Сохранено');
  }
  public function destroy(News $news) {
    $news->delete();
    return redirect()->route('admin.news.index')->with('ok','Удалено');
  }
}