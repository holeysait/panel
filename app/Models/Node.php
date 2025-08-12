<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    protected $fillable = ['name','public_fqdn','daemon_url','capabilities','status','location_id'];
    protected $casts = ['capabilities'=>'array'];

    public function location() { return $this->belongsTo(Location::class); }
}
