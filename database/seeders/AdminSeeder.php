<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $email = env('ADMIN_EMAIL', 'admin@example.com');
        $pass  = env('ADMIN_PASSWORD', 'admin12345');
        $user = User::firstOrCreate(
            ['email' => $email],
            ['name' => 'Admin', 'password' => Hash::make($pass)]
        );
        if (!($user->is_admin ?? false)) {
            $user->is_admin = 1;
            $user->save();
        }
        $this->command->info("Admin user ensured: {$email}");
    }
}
