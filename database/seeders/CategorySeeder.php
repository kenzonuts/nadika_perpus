<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    private const CATEGORIES = [
        'Fiction',
        'Non-Fiction',
        'Science',
        'Technology',
        'History',
        'Biography',
        'Philosophy',
        'Art & Design',
        'Business',
        'Self-Help',
        'Children',
        'Young Adult',
        'Poetry',
        'Religion',
        'Travel',
        'Cooking',
        'Health',
        'Education',
    ];

    public function run(): void
    {
        foreach (self::CATEGORIES as $name) {
            Category::query()->firstOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'name' => $name,
                    'description' => "Books in the {$name} category.",
                ]
            );
        }
    }
}
