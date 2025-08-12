<?php
namespace App\Domain\Admin\Models;
use Illuminate\Database\Eloquent\Model;
class Location extends Model {
    protected $fillable = ['name','code','country','city','enabled'];
    protected $casts = ['enabled'=>'boolean'];
}