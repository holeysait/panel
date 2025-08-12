<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Egg;

class EggSeeder extends Seeder
{
    public function run(): void
    {
        Egg::firstOrCreate(['name'=>'Minecraft Paper'], [
            'docker_image'=>'ghcr.io/papermc/paper:latest',
            'startup_cmd'=>'java -Xms{{RAM_MB}}M -Xmx{{RAM_MB}}M -jar paper.jar nogui',
            'version'=>'latest',
            'author'=>'PaperMC',
            'source_url'=>'https://papermc.io/',
            'features'=>['rcon'=>true,'allocations'=>['tcp','udp']],
        ]);
        Egg::firstOrCreate(['name'=>'CS2'], [
            'docker_image'=>'ghcr.io/steam/cs2:latest',
            'startup_cmd'=>'bash ./start.sh +map de_mirage -port {{PORT}}',
            'version'=>'latest',
            'author'=>'Valve',
            'source_url'=>'https://developer.valvesoftware.com/',
            'features'=>['rcon'=>true,'allocations'=>['udp']],
        ]);
    }
}
