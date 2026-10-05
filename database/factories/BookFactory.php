<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => ucwords(fake()->words(3, true)),
            'isbn' => fake()->unique()->numerify('978##########'),
            'author' => fake()->name(),
            'publisher' => fake()->company(),
            'published_year' => fake()->numberBetween(2000, (int) date('Y')),
            'price' => fake()->randomFloat(2, 50_000, 500_000),
            'stock' => fake()->numberBetween(0, 50),
            'description' => fake()->optional(0.85)->paragraph(),
        ];
    }
}
