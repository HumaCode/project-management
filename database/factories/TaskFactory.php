<?php

namespace Database\Factories;

use App\Models\Project;
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
        $user = User::factory()->create();

        return [
            'name'                  => $this->faker->sentence(4),
            'description'           => $this->faker->paragraph(),
            'image_path'            => $this->faker->optional()->imageUrl(640,480,'abstract'),
            'status'                => $this->faker->randomElement(['in_progress', 'pending', 'cancelled', 'completed', 'on_hold']),
            'priority'              => $this->faker->randomElement(['low', 'medium', 'high']),
            'due_date'              => $this->faker->optional()->dateTimeBetween('now', '+3 months'),
            'assigned_user_id'      => $this->faker->optional()->randomElement([User::factory(), null]),
            'created_by'            => $user->id,
            'updated_by'            => $user->id,
            'project_id'            => Project::factory(),
            'category_id'           => Project::factory(),
        ];
    }
}
