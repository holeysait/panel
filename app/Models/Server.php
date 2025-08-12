<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $fillable = [
        'uuid','name','user_id','node_id','egg_id','allocation_id',
        'cpu_limit','ram_mb','disk_gb','status'
    ];

    public function node() { return $this->belongsTo(Node::class); }
    public function user() { return $this->belongsTo(\App\Models\User::class); }
}
