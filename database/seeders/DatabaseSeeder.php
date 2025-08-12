<?php

namespace Database\Seeders;

use Database\Seeders\LocationSeeder;
use Database\Seeders\NodeSeeder;
use Database\Seeders\EggSeeder;

use Database\Seeders\AdminSeeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            LocationSeeder::class,
            EggSeeder::class,
            NodeSeeder::class,AdminSeeder::class]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
