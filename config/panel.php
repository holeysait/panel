<?php

return [
    'brand_name' => env('PANEL_BRAND_NAME', 'PANEL'),
    'base_url'   => env('APP_URL', 'http://localhost'),
    'timezone'   => env('PANEL_TIMEZONE', 'Europe/Amsterdam'),
    'currency'   => env('PANEL_CURRENCY', 'RUB'),
    'tax_percent'=> (float) env('PANEL_TAX_PERCENT', 0),
    'wallet_minor_units' => (int) env('PANEL_WALLET_MINOR_UNITS', 2),
    'backup' => [
        'disk' => env('BACKUP_DISK', 's3'),
        'retention_days' => (int) env('BACKUP_RETENTION_DAYS', 14),
    ],
    'agent' => [
        'ws_url' => env('AGENT_WS_URL', null),
        'token'  => env('AGENT_TOKEN', null),
    ],
];
