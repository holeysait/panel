<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Billing\Models\Price;
use App\Domain\Billing\Models\Transaction;
use App\Domain\Servers\Models\Server;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = $request->user();

        // Ensure wallet exists
        $wallet = $user->wallet()->first();
        if (!$wallet) {
            $wallet = $user->wallet()->create([
                'currency' => 'USD',
                'balance_minor' => 0,
            ]);
        }

        $balance   = (int) ($wallet->balance_minor ?? 0);
        $currency  = $wallet->currency ?? 'USD';
        $serverCount = Server::where('user_id', $user->id)->count();
        $transactions = $wallet->transactions()->latest()->limit(10)->get();
        $prices = Price::query()->orderBy('code')->get();

        return view('dashboard.index', [
            'user' => $user,
            'balance' => $balance,
            'currency' => $currency,
            'serverCount' => $serverCount,
            'transactions' => $transactions,
            'prices' => $prices,
        ]);
    }
}
