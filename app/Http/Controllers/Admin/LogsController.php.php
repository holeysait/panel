<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AuditLog;

class LogsController extends Controller
{
    public function index(Request $request)
    {
        $q = trim($request->get('q',''));
        $items = AuditLog::query()
            ->when($q, fn($qq)=>$qq->where('action','like',"%$q%"))
            ->orderBy('id','desc')->paginate(50)->withQueryString();
        return view('admin.logs.index', compact('items','q'));
    }
}
