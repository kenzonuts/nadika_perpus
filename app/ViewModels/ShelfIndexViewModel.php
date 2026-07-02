<?php

declare(strict_types=1);

namespace App\ViewModels;

use App\Models\Shelf;
use Illuminate\Support\Collection;

final class ShelfIndexViewModel
{
    public function __construct(private readonly Collection $shelves) {}

    public function toArray(): array
    {
        return $this->shelves->map(fn (Shelf $shelf): array => [
            'id' => $shelf->id,
            'code' => $shelf->code,
            'name' => $shelf->name,
            'location' => $shelf->location,
            'description' => $shelf->description,
        ])->all();
    }
}
