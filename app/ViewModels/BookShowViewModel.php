<?php

declare(strict_types=1);

namespace App\ViewModels;

use App\Models\Book;
use App\ViewModels\Concerns\FormatsBookData;

final class BookShowViewModel
{
    use FormatsBookData;

    public function __construct(private readonly Book $book) {}

    public function toArray(): array
    {
        return [$this->mapBook($this->book)];
    }
}
