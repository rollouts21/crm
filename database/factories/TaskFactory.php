<?php
namespace Database\Factories;

use App\Enums\TaskPriorityEnum;
use App\Enums\TaskStatusEnum;
use App\Models\Client;
use App\Models\Deal;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $status = $this->faker->randomElement(TaskStatusEnum::cases())->value;
        return [
            'owner_id'     => User::inRandomOrder()->value('id'),
            'deal_id'      => Deal::inRandomOrder()->value('id'),
            'client_id'    => Client::inRandomOrder()->value('id'),
            'title'        => $this->faker->sentence,
            'description'  => $this->faker->text(300),
            'due_at'       => $this->faker->date(),
            'status'       => $this->faker->randomElement(TaskStatusEnum::cases())->value,
            'priority'     => $this->faker->randomElement(TaskPriorityEnum::cases())->value,
            'completed_at' => $this->faker->dateTime(),
        ];
    }
}
