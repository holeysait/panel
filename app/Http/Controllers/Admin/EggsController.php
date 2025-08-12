<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Egg;

class EggsController extends Controller
{
    public function index(Request $request) {
        $q = trim($request->get('q',''));
        $items = Egg::query()
            ->when($q, function($qq) use ($q) {
                $qq->where('name','like',"%{$q}%")->orWhere('docker_image','like',"%{$q}%");
            })
            ->orderBy('name')->paginate(20);
        return view('admin.eggs.index', compact('items','q'));
    }

    public function create() {
        return view('admin.eggs.create');
    }

    public function store(Request $request) {
        // parse features if provided as JSON string
        $featuresRaw = $request->input('features');
        if (is_string($featuresRaw) && strlen($featuresRaw)) {
            try { $request->merge(['features' => json_decode($featuresRaw, true, 512, JSON_THROW_ON_ERROR)]); }
            catch (\Throwable $e) { return back()->withErrors(['features'=>'Invalid JSON: '.$e->getMessage()])->withInput(); }
        }

        $data = $request->validate([
            'name'=>'required|string|max:255',
            'docker_image'=>'required|string|max:255',
            'startup_cmd'=>'required|string|max:255',
            'version'=>'nullable|string|max:100',
            'author'=>'nullable|string|max:255',
            'source_url'=>'nullable|url|max:255',
            'features'=>'nullable|array',
        ]);

        $item = Egg::create($data);
        return redirect()->route('admin.eggs.edit', $item)->with('ok','Игра/Яйцо создано');
    }

    public function show(Egg $egg) {
        $egg->load('variables');
        return view('admin.eggs.show', ['item'=>$egg]);
    }

    public function edit(Egg $egg) {
        return view('admin.eggs.edit', ['item'=>$egg]);
    }

    public function update(Request $request, Egg $egg) {
        $featuresRaw = $request->input('features');
        if (is_string($featuresRaw) && strlen($featuresRaw)) {
            try { $request->merge(['features' => json_decode($featuresRaw, true, 512, JSON_THROW_ON_ERROR)]); }
            catch (\Throwable $e) { return back()->withErrors(['features'=>'Invalid JSON: '.$e->getMessage()])->withInput(); }
        }

        $data = $request->validate([
            'name'=>'required|string|max:255',
            'docker_image'=>'required|string|max:255',
            'startup_cmd'=>'required|string|max:255',
            'version'=>'nullable|string|max:100',
            'author'=>'nullable|string|max:255',
            'source_url'=>'nullable|url|max:255',
            'features'=>'nullable|array',
        ]);

        $egg->update($data);
        return redirect()->route('admin.eggs.index')->with('ok','Сохранено');
    }

    public function destroy(Egg $egg) {
        $egg->delete();
        return back()->with('ok','Удалено');
    }
}
