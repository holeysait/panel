<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Node;
use App\Models\Location;
class NodeSeeder extends Seeder {
    public function run(): void {
        $loc = Location::where('slug','warsaw')->first();
        if (!$loc) return;
        Node::firstOrCreate(['public_fqdn'=>'node1.waw.example.com'], [
            'name'=>'WAW-1',
            'daemon_url'=>'https://node1.waw.example.com:8088',
            'status'=>'online',
            'location_id'=>$loc->id,
            'capabilities'=>['cpu'=>'Ryzen 9 5950X','ram_gb'=>128,'ports'=>[10000,19999]]
        ]);
    }
}
