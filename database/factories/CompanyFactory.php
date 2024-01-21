<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'ssm_no' => fake()->companySuffix() . fake()->numberBetween(0, 1000),
            'website' => fake()->url(),
            'location' => fake()->address(),
            'size' => fake()->numberBetween(10, 1000),
            'picture' => fake()->imageUrl(460, 345, 'building'),
            'created_at' => now(),
            'created_by' => '1',
        ];
    }
}
