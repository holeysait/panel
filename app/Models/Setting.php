<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key','value'];
    public $timestamps = false;

    public static function getValue(string $key, $default = null) {
        $rec = static::where('key',$key)->first();
        return $rec ? $rec->value : $default;
    }

    public static function setValue(string $key, $value) {
        return static::updateOrCreate(['key'=>$key], ['value'=>$value]);
    }
}
