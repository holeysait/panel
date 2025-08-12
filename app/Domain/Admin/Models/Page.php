<?php
namespace App\Domain\Admin\Models;
use Illuminate\Database\Eloquent\Model;
class Page extends Model {
    protected $fillable = ['title','slug','body','published'];
    protected $casts = ['published'=>'boolean'];
}