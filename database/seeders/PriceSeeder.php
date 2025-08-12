<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Domain\Billing\Models\Price;

class PriceSeeder extends Seeder
{
    public function run(): void
    {
        $defaults = config('billing.default_prices');
        $units = [
            'cpu_min' => 'minute',
            'ram_mb_min' => 'mb_min',
            'disk_gb_day' => 'gb_day',
            'net_gb' => 'gb',
            'backup_gb_month' => 'gb_month',
        ];
        foreach ($defaults as $code => $price) {
            Price::updateOrCreate(['code' => $code], [
                'unit' => $units[$code] ?? 'unit',
                'unit_price_minor' => $price,
                'meta' => null,
            ]);
        }
    }
}
