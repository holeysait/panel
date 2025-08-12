<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = ['name','code','type','value','starts_at','ends_at','is_active','description','meta'];
    protected $casts = ['starts_at'=>'datetime','ends_at'=>'datetime','is_active'=>'boolean','meta'=>'array'];
}
