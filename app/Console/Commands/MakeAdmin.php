<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Domain\Billing\Models\Wallet;

class MakeAdmin extends Command
{
    protected $signature = 'panel:make-admin {email} {password} {--name=Admin}';
    protected $description = 'Create or update an admin user with a wallet';

    public function handle(): int
    {
        $email = $this->argument('email');
        $password = $this->argument('password');
        $name = $this->option('name');

        $user = User::firstOrCreate(['email' => $email], ['name' => $name, 'password' => Hash::make($password)]);
        if (!$user->wasRecentlyCreated) {
            $user->password = Hash::make($password);
            $user->save();
        }
        if (!$user->wallet) {
            $wallet = new Wallet(['currency' => 'USD', 'balance_minor' => 0]);
            $user->wallet()->save($wallet);
        }
        $this->info("Admin ready: {$user->email}");
        return self::SUCCESS;
    }
}
