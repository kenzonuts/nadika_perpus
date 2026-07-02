<?php

declare(strict_types=1);

namespace App\ViewModels;

use App\Models\Book;
use App\ViewModels\Concerns\FormatsBookData;
use Illuminate\Support\Collection;

final class BookIndexViewModel
{
    use FormatsBookData;

    public function __construct(private readonly Collection $books) {}

    public function toArray(): array
    {
        return $this->books->map(fn (Book $book): array => $this->mapBook($book))->all();
    }
}
