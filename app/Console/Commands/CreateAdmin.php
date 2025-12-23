<?php
namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name     = $this->ask('name for user');
        $email    = $this->ask('email for user');
        $password = $this->secret('password for user');

        User::create([
            'name'     => $name,
            'email'    => $email,
            'password' => Hash::make($password),
            'role_id'  => 1,
        ]);

        $this->line("User {$name} created with:\nEmail: {$email}\nPassword: {$password}");
    }
}
