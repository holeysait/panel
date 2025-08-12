<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Settings\Settings;

class SettingsCache extends Command
{
    protected $signature = 'settings:cache';
    protected $description = 'Warm up settings cache';

    public function handle(Settings $settings)
    {
        $settings->flushCache();
        $settings->all();
        $this->info('Settings cache warmed.');
        return self::SUCCESS;
    }
}
