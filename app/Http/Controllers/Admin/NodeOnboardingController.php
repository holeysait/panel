<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Node;

class NodeOnboardingController extends Controller
{
    public function show(Node $node, Request $request)
    {
        $panelUrl = rtrim(config('panel.base_url', config('app.url')), '/');
        $locationSlug = optional($node->location)->slug ?? 'your-location-slug';
        $tokenPlain = session('node_token_plain'); // show once after generation
        $env = [
            'NODE_NAME' => $node->name,
            'NODE_LOCATION_SLUG' => $locationSlug,
            'PANEL_WS_URL' => $panelUrl.'/agent',
            'AGENT_LISTEN_ADDR' => '127.0.0.1:8088',
            'NODE_PORT_RANGE' => '10000-19999',
            'NODE_TOKEN' => $tokenPlain ?: '[PASTE_NODE_TOKEN_HERE]',
        ];

        $ufw = 'ufw allow 22/tcp\nufw allow 443/tcp\nufw allow 10000:19999/tcp\nufw allow 10000:19999/udp';

        // Build nginx config using NOWDOC to avoid PHP variable interpolation like $host
        $nginxTemplate = <<<'NGX'
server {
  server_name __FQDN__;
  listen 443 ssl http2;
  # ssl_certificate /etc/letsencrypt/live/__FQDN__/fullchain.pem;
  # ssl_certificate_key /etc/letsencrypt/live/__FQDN__/privkey.pem;

  location / {
    proxy_set_header Host $host;
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header Upgrade $http_upgrade;
    proxy_set_header Connection "upgrade";
    proxy_pass http://127.0.0.1:8088;
  }
}
NGX;
        $nginx = str_replace('__FQDN__', $node->public_fqdn, $nginxTemplate);

        $systemd = <<<'UNIT'
[Unit]
Description=PANEL Node Agent
After=network-online.target docker.service
Wants=network-online.target

[Service]
User=root
Group=root
EnvironmentFile=/etc/panel-agent.env
ExecStart=/usr/local/bin/panel-agent
Restart=always
RestartSec=2s
LimitNOFILE=65535
WorkingDirectory=/root

[Install]
WantedBy=multi-user.target
UNIT;

        return view('admin.nodes.onboarding', compact('node','panelUrl','env','ufw','systemd','nginx','tokenPlain'));
    }

    public function generateToken(Node $node, Request $request)
    {
        $tokenPlain = bin2hex(random_bytes(24)); // 48 hex chars
        $hash = hash('sha256', $tokenPlain);
        $node->api_token_hash = $hash;
        $node->token_last_shown_at = now();
        $node->save();

        return redirect()
            ->route('admin.nodes.onboarding', $node)
            ->with('ok', 'Токен сгенерирован. Сохраните его — он отображается только один раз.')
            ->with('node_token_plain', $tokenPlain);
    }
}
