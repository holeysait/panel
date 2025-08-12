<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WikiPage extends Model
{
    protected $fillable = ['title','slug','body','tags','is_published','meta'];
    protected $casts = ['is_published'=>'boolean','meta'=>'array'];
}
