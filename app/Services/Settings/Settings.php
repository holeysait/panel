<?php
namespace App\Services\Settings;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class Settings
{
    protected string $cacheKey = 'settings.kv';

    public function all(): array
    {
        return Cache::remember($this->cacheKey, now()->addMinutes(10), function () {
            return Setting::query()->pluck('value','key')->toArray();
        });
    }

    public function get(string $key, $default = null)
    {
        $all = $this->all();
        return $all[$key] ?? $default;
    }

    public function set(string $key, $value, string $type = 'string'): void
    {
        Setting::updateOrCreate(['key'=>$key], ['value'=>$value, 'type'=>$type]);
        Cache::forget($this->cacheKey);
    }

    public function flushCache(): void
    {
        Cache::forget($this->cacheKey);
    }
}
