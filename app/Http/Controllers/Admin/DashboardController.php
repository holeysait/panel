<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        try { $users = DB::table('users')->count(); } catch (\Throwable $e) { $users = 0; }
        try { $servers = DB::table('servers')->count(); } catch (\Throwable $e) { $servers = 0; }
        try { $tx = DB::table('transactions')->count(); } catch (\Throwable $e) { $tx = 0; }
        try { $last = DB::table('transactions')->orderByDesc('id')->limit(10)->get(); } catch (\Throwable $e) { $last = collect(); }

        return view('admin.dashboard.index', compact('users','servers','tx','last'));
    }
}
