<?php
namespace App\Domain\Admin\Models;
use Illuminate\Database\Eloquent\Model;
class WikiPage extends Model {
    protected $fillable = ['title','slug','body','published'];
    protected $casts = ['published'=>'boolean'];
}