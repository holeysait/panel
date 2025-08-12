<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Settings\Settings;

class SettingsGet extends Command
{
    protected $signature = 'settings:get {key?}';
    protected $description = 'Get a setting by key or dump all';

    public function handle(Settings $settings)
    {
        $key = $this->argument('key');
        if ($key) {
            $this->info((string) $settings->get($key, ''));
        } else {
            $this->line(json_encode($settings->all(), JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
        }
        return self::SUCCESS;
    }
}
