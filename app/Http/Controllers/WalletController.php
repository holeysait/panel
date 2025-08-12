<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Domain\Billing\Models\Transaction;

class WalletController extends Controller
{
    public function index(Request $request){
        $user = $request->user();
        $wallet = $user->wallet ?: $user->wallet()->create(['currency'=>'USD','balance_minor'=>0]);
        $transactions = Transaction::where('wallet_id',$wallet->id)->latest()->paginate(15);
        return view('wallet.index', [
            'balance'=>$wallet->balance_minor,
            'currency'=>$wallet->currency,
            'transactions'=>$transactions,
            'txCount'=>$transactions->total(),
            'lastTx'=>$transactions->first(),
        ]);
    }
}
