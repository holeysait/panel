<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Settings\Settings;

class SettingsSet extends Command
{
    protected $signature = 'settings:set {key} {value} {--type=string}';
    protected $description = 'Set a setting (key, value, type)';

    public function handle(Settings $settings)
    {
        $settings->set($this->argument('key'), $this->argument('value'), $this->option('type'));
        $this->info('OK');
        return self::SUCCESS;
    }
}
