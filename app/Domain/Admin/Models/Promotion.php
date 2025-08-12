<?php
namespace App\Domain\Admin\Models;
use Illuminate\Database\Eloquent\Model;
class Promotion extends Model {
    protected $fillable = ['code','name','description','kind','value','starts_at','ends_at','enabled'];
    protected $casts = ['enabled'=>'boolean','starts_at'=>'datetime','ends_at'=>'datetime'];
}