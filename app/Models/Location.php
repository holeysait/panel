<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ['name','slug','country','city','is_active','meta'];
    protected $casts = ['is_active'=>'boolean','meta'=>'array'];
}
