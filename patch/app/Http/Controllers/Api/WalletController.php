<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Domain\Billing\Models\Wallet;
use App\Domain\Billing\Models\Transaction;
use Illuminate\Http\Request;
class WalletController extends Controller {
    public function deposit(Wallet $wallet, Request $req) {
        $amount = (int)$req->input('amount_minor', 0);
        if ($amount <= 0) return response()->json(['error'=>'amount_minor must be > 0'], 422);
        $wallet->increment('balance_minor', $amount);
        $tx = Transaction::create([
            'wallet_id' => $wallet->id,
            'type' => 'deposit',
            'amount_minor' => $amount,
            'meta' => ['source' => 'api'],
        ]);
        return response()->json(['wallet'=>$wallet, 'transaction'=>$tx]);
    }
    public function transactions(Wallet $wallet) { return $wallet->transactions()->latest()->paginate(50); }
}