<?php
namespace App\Domain\Billing\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Transaction extends Model {
    protected $fillable = ['wallet_id','type','amount_minor','meta'];
    protected $casts = ['meta' => 'array'];
    public function wallet(): BelongsTo { return $this->belongsTo(Wallet::class); }
}