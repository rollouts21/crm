<?php
namespace Database\Seeders;

use App\Models\Client;
use App\Models\Deal;
use App\Models\Role;
use App\Models\Source;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::factory()->create([
            'name' => 'admin',
        ]);
        Role::factory()->create([
            'name' => 'manager',
        ]);
        User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Source::factory(5)->create();
        Client::factory(70)->create();
        Deal::factory(65)->create();
        Task::factory(100)->create();
    }
}
