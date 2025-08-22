<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Project;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3), // sentence(3) -> 3 mots
            'description' => $this->faker->paragraph(),
            'creator_id' => User::Role('admin')->first(),
            'client_id' => User::Role('client')->inRandomOrder()->first(),
            'status' => 'en attente',
        ];
    }
}
