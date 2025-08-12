<?php
namespace App\Domain\Billing\Models;
use Illuminate\Database\Eloquent\Model;
class Price extends Model {
    protected $table = 'price_catalog';
    protected $fillable = ['code','unit','unit_price_minor','meta'];
    protected $casts = ['meta' => 'array'];
}