<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Location;
class LocationSeeder extends Seeder {
    public function run(): void {
        Location::firstOrCreate(['slug'=>'warsaw'], [
            'name'=>'Warsaw, PL',
            'country'=>'PL',
            'city'=>'Warsaw',
            'is_active'=>true,
            'meta'=>[
                'provider'=>'OVH/Atman',
                'timezone'=>'Europe/Warsaw',
                'ports_from'=>10000, 'ports_to'=>19999,
                'priority'=>10,
                'test_ip'=>'1.1.1.1',
                'test_url'=>'https://example.com/ping.txt',
                'notes'=>'Primary EU region'
            ]
        ]);
    }
}
