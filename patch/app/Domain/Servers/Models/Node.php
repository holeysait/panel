<?php
namespace App\Domain\Servers\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Node extends Model {
    protected $fillable = ['name','public_fqdn','daemon_url','capabilities','status'];
    protected $casts = ['capabilities' => 'array'];
    public function allocations(): HasMany { return $this->hasMany(Allocation::class); }
}