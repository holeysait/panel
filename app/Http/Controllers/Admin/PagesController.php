<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Str;

class PagesController extends Controller {
  public function index(Request $r) {
    $q = $r->string('q')->toString();
    $items = Page::when($q, fn($qq)=>$qq->where('title','like',"%$q%"))->latest()->paginate(20)->withQueryString();
    return view('admin.pages.index', compact('items','q'));
  }
  public function create() { return view('admin.pages.create'); }
  public function store(Request $r) {
    $data = $r->validate([
      'title'=>'required|string|max:255',
      'slug'=>'nullable|string|max:255',
      'content'=>'required|string',
      'is_published'=>'sometimes|boolean',
    ]);
    if (empty($data['slug'])) $data['slug'] = Str::slug($data['title']).'-'.Str::random(4);
    $data['is_published'] = (bool)($data['is_published'] ?? false);
    $item = Page::create($data);
    return redirect()->route('admin.pages.edit',$item)->with('ok','Страница создана');
  }
  public function edit(Page $page) { return view('admin.pages.edit',['item'=>$page]); }
  public function update(Request $r, Page $page) {
    $data = $r->validate([
      'title'=>'required|string|max:255',
      'slug'=>'required|string|max:255',
      'content'=>'required|string',
      'is_published'=>'sometimes|boolean',
    ]);
    $data['is_published'] = (bool)($data['is_published'] ?? false);
    $page->update($data);
    return back()->with('ok','Сохранено');
  }
  public function destroy(Page $page) {
    $page->delete();
    return redirect()->route('admin.pages.index')->with('ok','Удалено');
  }
}