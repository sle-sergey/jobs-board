<?php

namespace Database\Factories;

use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->jobTitle(),
            'description' => fake()->paragraph(4, true),
            'salary' => fake()->randomFloat(2, 50000, 150000),
            'location' => fake()->city(),
            'category' => fake()->randomElement(Job::$category),
            'experience' => fake()->randomElement(Job::$experience)
        ];
    }
}
