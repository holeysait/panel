<?php
namespace App\Services\Nodes;

use Illuminate\Support\Facades\Http;
use App\Models\Node;

class NodeHealth
{
    public function check(Node $node): array
    {
        $base = rtrim($node->daemon_url ?: ('https://'.$node->public_fqdn), '/');
        $url = $base.'/health';
        $ok = false; $err = null;
        try {
            $resp = Http::timeout(5)->acceptJson()->get($url);
            if ($resp->successful()) {
                $ok = true;
            } else {
                $err = 'HTTP '.$resp->status();
            }
        } catch (\Throwable $e) {
            $err = $e->getMessage();
        }
        $node->status = $ok ? 'online' : 'offline';
        if ($ok) {
            $node->last_seen_at = now();
            $node->last_health_error = null;
        } else {
            $node->last_health_error = substr((string)$err, 0, 250);
        }
        $node->save();
        return ['ok'=>$ok, 'url'=>$url, 'error'=>$err];
    }
}
