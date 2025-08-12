<?php
namespace App\Domain\Billing\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Wallet extends Model {
    protected $fillable = ['currency','balance_minor'];
    public function owner(): MorphTo { return $this->morphTo(); }
    public function transactions(): HasMany { return $this->hasMany(Transaction::class); }
}