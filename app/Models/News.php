<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = ['title','slug','excerpt','body','is_published','published_at','meta'];
    protected $casts = ['is_published'=>'boolean','published_at'=>'datetime','meta'=>'array'];
}
