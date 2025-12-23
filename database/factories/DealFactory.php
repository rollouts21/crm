<?php
namespace Database\Factories;

use App\Enums\DealsStatusEnum;
use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Deal>
 */
class DealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'client_id'         => Client::inRandomOrder()->value('id'),
            'owner_id'          => User::inRandomOrder()->value('id'),
            'title'             => $this->faker->sentence,
            'amount'            => rand(12000, 500000),
            'status'            => $this->faker->randomElement(DealsStatusEnum::cases())->value,
            'expected_close_at' => $this->faker->date(),
            'closed_at'         => $this->faker->datetime(),
            'lost_reason'       => $this->faker->text(200),
            'comment'           => $this->faker->paragraph(10),
        ];
    }
}
