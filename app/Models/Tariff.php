<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tariff extends Model
{
    protected $fillable = [
        'name','slug','description','price_minor','currency','period',
        'cpu_limit','ram_mb','disk_gb','ports','is_active','meta'
    ];
    protected $casts = ['is_active'=>'boolean','meta'=>'array'];
}
