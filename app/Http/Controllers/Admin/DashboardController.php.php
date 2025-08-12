<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $users = DB::table('users')->count();
        $servers = DB::table('servers')->count() ?? 0;
        $tx = DB::table('transactions')->count() ?? 0;
        $last = DB::table('transactions')->orderByDesc('id')->limit(10)->get();

        return view('admin.dashboard.index', compact('users','servers','tx','last'));
    }
}
