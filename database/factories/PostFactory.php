<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'job_title' => fake()->jobTitle(),
            'description' => fake()->paragraph(2, true),
            'location' => fake()->address(),
            'company_id' => fake()->numberBetween(1, 10),
            'job_field_id' => fake()->numberBetween(1, 3),
            'office' => fake()->imageUrl(460, 345, 'building'),
            'status' => '1',
            'created_by' => '1',
            'created_at' => now(),
        ];
    }
}
