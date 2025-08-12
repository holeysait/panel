<?php
namespace App\Domain\Admin\Models;
use Illuminate\Database\Eloquent\Model;
class News extends Model {
    protected $fillable = ['title','slug','body','published','published_at'];
    protected $casts = ['published'=>'boolean','published_at'=>'datetime'];
}