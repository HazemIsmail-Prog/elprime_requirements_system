<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Requirement>
 */
class RequirementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
                'date' => fake()->dateTimeBetween('-2 days' , '+5 days'),
                'account' => fake()->name(),
                'description' => fake()->sentence(8),
                'remarks' => fake()->sentence(6),
                'amount' => fake()->numerify(),
                'comment' => null,
                'is_completed' => rand(0,1),
                'client_id' => rand(1,5),
                'created_by' => 1,
            ];
    }
}
