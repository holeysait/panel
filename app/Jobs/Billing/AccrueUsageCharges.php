<?php
namespace App\Jobs\Billing;
use App\Domain\Billing\Models\UsageRecord;
use App\Domain\Billing\Models\Price;
use App\Domain\Billing\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
class AccrueUsageCharges implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public function handle(): void {
        $prices = Price::whereIn('code', ['cpu_min','ram_mb_min','disk_gb_day','net_gb'])->get()->keyBy('code');
        UsageRecord::query()->orderBy('id')->chunkById(5000, function ($rows) use ($prices) {
            foreach ($rows as $r) {
                $server = $r->server; if (!$server) continue;
                $wallet = $server->user->wallet ?? null; if (!$wallet) continue;
                $cpu = (int)($r->cpu_ms / 60000);
                $ram = (int)$r->ram_mb_min;
                $disk_day_fraction = $r->disk_gb_x1000 / 1000.0 / (60*24);
                $net_gb = ($r->net_in_mb + $r->net_out_mb) / 1024.0;
                $charge = 0;
                $charge += ($prices['cpu_min']->unit_price_minor ?? 0) * $cpu;
                $charge += ($prices['ram_mb_min']->unit_price_minor ?? 0) * $ram;
                $charge += (int)round(($prices['disk_gb_day']->unit_price_minor ?? 0) * $disk_day_fraction);
                $charge += (int)round(($prices['net_gb']->unit_price_minor ?? 0) * $net_gb);
                if ($charge === 0) continue;
                \Illuminate\Support\Facades\DB::transaction(function () use ($wallet, $charge, $r) {
                    $wallet->decrement('balance_minor', $charge);
                    \App\Domain\Billing\Models\Transaction::create([
                        'wallet_id' => $wallet->id,
                        'type' => 'usage_charge',
                        'amount_minor' => -$charge,
                        'meta' => ['usage_record_id' => $r->id],
                    ]);
                });
            }
        });
    }
}