<?php

declare(strict_types=1);

namespace App\ViewModels;

use App\Models\Book;
use App\Models\Category;
use App\Models\Shelf;

final class BookFormViewModel
{
    public function __construct(private readonly ?Book $book = null) {}

    public function toArray(): array
    {
        return [
            'books' => [[
                'id' => $this->book?->id,
                'title' => $this->book?->title ?? '',
                'subtitle' => $this->book?->subtitle ?? '',
                'isbn' => $this->book?->isbn ?? '',
                'author' => $this->book?->author ?? '',
                'publisher' => $this->book?->publisher ?? '',
                'publication_year' => $this->book?->publication_year,
                'language' => $this->book?->language ?? 'English',
                'pages' => $this->book?->pages,
                'description' => $this->book?->description ?? '',
                'stock' => $this->book?->stock ?? 0,
                'status' => $this->book?->publication_status->value ?? 'draft',
            ]],
            'categories' => Category::query()->pluck('name')->all(),
            'shelves' => Shelf::query()->pluck('code')->all(),
            'languages' => ['English', 'Indonesian', 'Spanish', 'French', 'German'],
        ];
    }
}
