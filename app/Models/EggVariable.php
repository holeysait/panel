<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EggVariable extends Model
{
    protected $table = 'egg_variables';

    protected $fillable = [
        'egg_id','env_key','label','description','default','rules'
    ];
    protected $casts = [
        'rules' => 'array',
    ];

    public function egg() { return $this->belongsTo(Egg::class); }
}
