<?php
namespace Database\Factories;

use App\Enums\ClientStatusEnum;
use App\Models\Source;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'owner_id'        => User::query()->inRandomOrder()->value('id'),
            'status'          => fake()->randomElement(ClientStatusEnum::cases())->value,
            'source_id'       => Source::query()->inRandomOrder()->value('id'),
            'name'            => $this->faker->name,
            'phone'           => $this->faker->phoneNumber(),
            'email'           => $this->faker->email(),
            'city'            => $this->faker->city(),
            'note'            => $this->faker->text(200),
            'last_contact_at' => $this->faker->dateTime(),
        ];
    }
}
