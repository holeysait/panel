<?php
namespace App\Domain\Catalog\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Egg extends Model {
    protected $fillable = ['name','docker_image','startup_cmd','version','author','source_url','features'];
    protected $casts = ['features' => 'array'];
    public function variables(): HasMany { return $this->hasMany(EggVariable::class); }
}