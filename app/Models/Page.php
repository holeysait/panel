<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['title','slug','body','is_published','show_in_menu','meta'];
    protected $casts = ['is_published'=>'boolean','show_in_menu'=>'boolean','meta'=>'array'];
}
