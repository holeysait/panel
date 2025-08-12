<?php
namespace App\Domain\Billing\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Domain\Servers\Models\Server;
class UsageRecord extends Model {
    public $timestamps = false;
    protected $fillable = ['server_id','ts_minute','cpu_ms','ram_mb_min','disk_gb_x1000','net_in_mb','net_out_mb'];
    protected $casts = ['ts_minute' => 'datetime'];
    public function server(): BelongsTo { return $this->belongsTo(Server::class); }
}