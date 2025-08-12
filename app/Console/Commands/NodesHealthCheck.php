<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Node;
use App\Services\Nodes\NodeHealth;

class NodesHealthCheck extends Command
{
    protected $signature = 'nodes:health-check {--id=}';
    protected $description = 'Проверить доступность узлов (обновляет status, last_seen_at, last_health_error)';

    public function handle(NodeHealth $health): int
    {
        $q = Node::query();
        if ($id = $this->option('id')) $q->where('id', $id);
        $count = 0; $ok = 0;
        foreach ($q->cursor() as $node) {
            $count++;
            $res = $health->check($node);
            $this->line(sprintf('[%s] %s -> %s %s',
                $node->id, $node->public_fqdn ?? $node->name, $res['ok'] ? 'online' : 'offline', $res['ok'] ? '' : $res['error']
            ));
            if ($res['ok']) $ok++;
        }
        $this->info("Готово. {$ok}/{$count} online.");
        return self::SUCCESS;
    }
}
