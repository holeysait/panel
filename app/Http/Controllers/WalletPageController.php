<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Domain\Billing\Models\Wallet;

class WalletPageController extends Controller
{
    public function index() {
        $user = Auth::user();
        $wallet = $user->wallet;
        $transactions = $wallet ? $wallet->transactions()->latest()->paginate(20) : collect();
        return view('wallet.index', ['wallet' => $wallet, 'transactions' => $transactions]);
    }
}
