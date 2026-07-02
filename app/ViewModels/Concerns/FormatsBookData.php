<?php

declare(strict_types=1);

namespace App\ViewModels\Concerns;

use App\Models\Book;

trait FormatsBookData
{
    private function mapBook(Book $book): array
    {
        return [
            'id' => $book->id,
            'title' => $book->title,
            'subtitle' => $book->subtitle,
            'isbn' => $book->isbn,
            'author' => $book->author,
            'publisher' => $book->publisher,
            'category' => $book->category?->name ?? '-',
            'shelf' => $book->shelf?->code ?? '-',
            'language' => $book->language,
            'year' => $book->publication_year,
            'pages' => $book->pages,
            'stock' => $book->stock,
            'available' => $book->available_stock,
            'status' => $book->publication_status->value,
            'description' => $book->description,
            'cover' => $book->cover,
            'rating' => round(min(5, max(1, $book->borrow_count / 10)), 1),
            'borrows' => $book->borrow_count,
            'color' => 'from-primary/80 to-primary',
            'updated_at' => $book->updated_at?->diffForHumans(),
            'deleted_at' => $book->deleted_at?->diffForHumans(),
        ];
    }
}
