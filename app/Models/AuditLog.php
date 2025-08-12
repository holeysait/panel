<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    protected $fillable = ['user_id','action','model','model_id','ip','meta'];
    protected $casts = ['meta'=>'array'];
}
