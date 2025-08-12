<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Egg extends Model
{
    protected $fillable = [
        'name','docker_image','startup_cmd','version','author','source_url','features'
    ];
    protected $casts = [
        'features' => 'array',
    ];

    public function variables() {
        return $this->hasMany(EggVariable::class);
    }
}
