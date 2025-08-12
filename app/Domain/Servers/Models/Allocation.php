<?php
namespace App\Domain\Servers\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Allocation extends Model {
    public $timestamps = false;
    protected $fillable = ['node_id','ip','port','is_taken'];
    protected $casts = ['is_taken' => 'boolean'];
    public function node(): BelongsTo { return $this->belongsTo(Node::class); }
}