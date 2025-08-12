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
            ->when($q, function($qq) use ($q){
                $qq->where('name','like',"%{$q}%")->orWhere('code','like',"%{$q}%");
            })
            ->orderBy('id','desc')
            ->paginate(20)
            ->withQueryString();

        return view('admin.promotions.index', compact('items','q'));
    }
}
