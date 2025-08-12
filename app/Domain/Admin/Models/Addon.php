<?php
namespace App\Domain\Admin\Models;
use Illuminate\Database\Eloquent\Model;
class Addon extends Model {
    protected $fillable = ['code','name','description','unit','unit_price_minor','enabled'];
    protected $casts = ['enabled'=>'boolean'];
}