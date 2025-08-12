<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Addon extends Model
{
    protected $fillable = ['name','code','description','unit','unit_price_minor','currency','is_active','meta'];
    protected $casts = ['is_active'=>'boolean','meta'=>'array'];
}
