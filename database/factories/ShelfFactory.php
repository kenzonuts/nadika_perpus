<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shelf>
 */
class ShelfFactory extends Factory
{
    public function definition(): array
    {
        $section = fake()->randomLetter().fake()->numberBetween(1, 9);

        return [
            'code' => 'SH-'.strtoupper($section).'-'.fake()->unique()->numberBetween(100, 999),
            'name' => 'Shelf '.$section,
            'location' => fake()->randomElement(['Floor 1', 'Floor 2', 'Basement', 'Reading Room']),
            'description' => fake()->optional()->sentence(),
        ];
    }
}
