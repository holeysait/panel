<?php
namespace App\Domain\Servers\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Server extends Model {
    protected $fillable = ['user_id','egg_id','node_id','allocation_id','uuid','name','cpu_limit','ram_mb','disk_gb','status'];
    public function egg(): BelongsTo { return $this->belongsTo(\App\Domain\Catalog\Models\Egg::class); }
    public function node(): BelongsTo { return $this->belongsTo(Node::class); }
    public function allocation(): BelongsTo { return $this->belongsTo(Allocation::class); }
}