<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Domain\Billing\Models\Wallet;

class MakeAdmin extends Command
{
    protected $signature = 'panel:make-admin {email} {--name=} {--password=}';
    protected $description = 'Create or update user as admin (and ensure wallet exists)';

    public function handle(): int
    {
        $email = $this->argument('email');
        $name = $this->option('name') ?? 'Admin';
        $password = $this->option('password');

        $user = User::firstOrCreate(['email'=>$email], [
            'name' => $name,
            'password' => $password ? bcrypt($password) : bcrypt(str()->random(12)),
        ]);

        $user->is_admin = 1;
        $user->save();

        // Ensure wallet
        if (!$user->wallet) {
            $user->wallet()->create(['currency'=>'USD','balance_minor'=>0]);
        }

        $this->info("User {$user->email} is now admin (id={$user->id}).");
        return self::SUCCESS;
    }
}
