<?php

namespace Database\Factories;

use App\Enums\BookPublicationStatus;
use App\Models\Book;
use App\Models\Category;
use App\Models\Shelf;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition(): array
    {
        $stock = fake()->numberBetween(1, 10);

        return [
            'category_id' => Category::factory(),
            'shelf_id' => Shelf::factory(),
            'title' => fake()->sentence(3),
            'subtitle' => fake()->optional()->sentence(2),
            'isbn' => fake()->unique()->isbn13(),
            'author' => fake()->name(),
            'publisher' => fake()->optional()->company(),
            'publication_year' => fake()->numberBetween(1990, (int) date('Y')),
            'language' => fake()->randomElement(['English', 'Indonesian', 'Japanese', 'French']),
            'pages' => fake()->numberBetween(100, 800),
            'description' => fake()->optional()->paragraph(),
            'cover' => null,
            'stock' => $stock,
            'available_stock' => $stock,
            'publication_status' => fake()->randomElement(BookPublicationStatus::cases()),
            'borrow_count' => fake()->numberBetween(0, 50),
        ];
    }

    public function published(): static
    {
        return $this->state(fn (array $attributes) => [
            'publication_status' => BookPublicationStatus::Published,
        ]);
    }
}
