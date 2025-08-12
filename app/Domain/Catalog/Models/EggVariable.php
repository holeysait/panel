<?php
namespace App\Domain\Catalog\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class EggVariable extends Model {
    protected $fillable = ['egg_id','env_key','label','description','default','rules'];
    protected $casts = ['rules' => 'array'];
    public function egg(): BelongsTo { return $this->belongsTo(Egg::class); }
}