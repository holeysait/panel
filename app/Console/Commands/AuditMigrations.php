<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class AuditMigrations extends Command
{
    protected $signature = 'migrations:audit';
    protected $description = 'List duplicate migration files by logical name';

    public function handle(Filesystem $fs)
    {
        $path = database_path('migrations');
        $files = collect($fs->files($path))
            ->filter(fn($f) => str_ends_with($f->getFilename(), '.php'))
            ->map(fn($f) => $f->getFilename());

        $groups = $files->groupBy(function ($name) {
            // strip timestamp (first 4 parts like 2025_08_12_123456_)
            return preg_replace('/^\d{4}_\d{2}_\d{2}_\d{6}_/', '', $name);
        })->filter(fn($g) => $g->count() > 1);

        if ($groups->isEmpty()) {
            $this->info('No duplicate logical migrations found ✅');
            return self::SUCCESS;
        }

        $this->warn('Duplicate logical migrations found:');
        foreach ($groups as $basename => $list) {
            $this->line("- {$basename}");
            foreach ($list as $fn) {
                $this->line("    • {$fn}");
            }
        }

        $this->newLine();
        $this->line('See docs/MIGRATION_CLEANUP.md for consolidation steps.');
        return self::SUCCESS;
    }
}
