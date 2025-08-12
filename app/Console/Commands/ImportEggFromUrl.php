<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Domain\Catalog\Models\Egg;
use App\Domain\Catalog\Models\EggVariable;
class ImportEggFromUrl extends Command {
    protected $signature = 'eggs:import {url}';
    protected $description = 'Import a Pterodactyl egg JSON from URL into local catalog';
    public function handle(): int {
        $url = $this->argument('url');
        $this->info("Fetching $url");
        $resp = Http::timeout(20)->get($url);
        if (!$resp->ok()) { $this->error('Failed to fetch: ' . $resp->status()); return self::FAILURE; }
        $json = $resp->json(); if (!is_array($json)) { $this->error('Invalid JSON'); return self::FAILURE; }
        $eggData = [
            'name' => data_get($json, 'name') ?? data_get($json, 'meta.name', 'Unknown'),
            'docker_image' => data_get($json, 'docker_images.0') ?? data_get($json, 'docker_image', 'ubuntu:22.04'),
            'startup_cmd' => data_get($json, 'startup') ?? data_get($json, 'meta.startup', ''),
            'version' => data_get($json, 'meta.version'),
            'author' => data_get($json, 'author'),
            'source_url' => $url,
            'features' => data_get($json, 'features') ?? [],
        ];
        $egg = Egg::create($eggData);
        $variables = data_get($json, 'variables', []);
        foreach ($variables as $v) {
            EggVariable::create([
                'egg_id' => $egg->id,
                'env_key' => data_get($v, 'env_variable') ?? data_get($v, 'name', 'VAR'),
                'label' => data_get($v, 'name') ?? data_get($v, 'description', 'Variable'),
                'description' => data_get($v, 'description'),
                'default' => (string)(data_get($v, 'default_value') ?? ''),
                'rules' => [
                    'type' => data_get($v, 'rules.type', 'string'),
                    'regex' => data_get($v, 'rules.regex') ?? data_get($v, 'rules', null),
                    'required' => (bool)data_get($v, 'required', false),
                    'editable' => (bool)data_get($v, 'user_viewable', true),
                    'secret' => (bool)data_get($v, 'user_editable', false) === false ? false : (bool)data_get($v, 'is_secret', false),
                ],
            ]);
        }
        $this->info('Imported egg: '.$egg->name.' (ID '.$egg->id.') with '.count($variables).' variables.');
        return self::SUCCESS;
    }
}