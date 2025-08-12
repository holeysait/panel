<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Addon;

class AddonsController extends Controller
{
    public function index(Request $request)
    {
        $q = trim($request->get('q',''));
        $items = Addon::query()
            ->when($q, function($qq) use ($q){
                $qq->where('name','like',"%{$q}%")->orWhere('code','like',"%{$q}%");
            })
            ->orderBy('id','desc')
            ->paginate(20)
            ->withQueryString();

        return view('admin.addons.index', compact('items','q'));
    }
}
