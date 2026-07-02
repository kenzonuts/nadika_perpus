<?php

namespace Database\Seeders;

use App\Enums\BookPublicationStatus;
use App\Models\Book;
use App\Models\Category;
use App\Models\Shelf;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $categoryIds = Category::query()->pluck('id');
        $shelfIds = Shelf::query()->pluck('id');

        if ($categoryIds->isEmpty() || $shelfIds->isEmpty()) {
            return;
        }

        Book::factory()
            ->count(50)
            ->state(function () use ($categoryIds, $shelfIds): array {
                $stock = fake()->numberBetween(1, 15);

                return [
                    'category_id' => $categoryIds->random(),
                    'shelf_id' => $shelfIds->random(),
                    'stock' => $stock,
                    'available_stock' => $stock,
                    'publication_status' => BookPublicationStatus::Published,
                ];
            })
            ->create();
    }
}
