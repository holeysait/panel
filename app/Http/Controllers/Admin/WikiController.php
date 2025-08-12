<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WikiPage;
use Illuminate\Support\Str;

class WikiController extends Controller {
  public function index(Request $r) {
    $q = $r->string('q')->toString();
    $items = WikiPage::when($q, fn($qq)=>$qq->where('title','like',"%$q%"))->latest()->paginate(20)->withQueryString();
    return view('admin.wiki.index', compact('items','q'));
  }
  public function create() { return view('admin.wiki.create'); }
  public function store(Request $r) {
    $data = $r->validate([
      'title'=>'required|string|max:255',
      'slug'=>'nullable|string|max:255',
      'content'=>'required|string',
      'parent_id'=>'nullable|integer',
      'is_published'=>'sometimes|boolean',
    ]);
    if (empty($data['slug'])) $data['slug'] = Str::slug($data['title']).'-'.Str::random(4);
    $data['is_published'] = (bool)($data['is_published'] ?? false);
    $item = WikiPage::create($data);
    return redirect()->route('admin.wiki.edit',$item)->with('ok','Страница вики создана');
  }
  public function edit(WikiPage $wiki) { return view('admin.wiki.edit',['item'=>$wiki]); }
  public function update(Request $r, WikiPage $wiki) {
    $data = $r->validate([
      'title'=>'required|string|max:255',
      'slug'=>'required|string|max:255',
      'content'=>'required|string',
      'parent_id'=>'nullable|integer',
      'is_published'=>'sometimes|boolean',
    ]);
    $data['is_published'] = (bool)($data['is_published'] ?? false);
    $wiki->update($data);
    return back()->with('ok','Сохранено');
  }
  public function destroy(WikiPage $wiki) {
    $wiki->delete();
    return redirect()->route('admin.wiki.index')->with('ok','Удалено');
  }
}