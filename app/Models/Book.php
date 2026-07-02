<?php

namespace App\Models;

use App\Enums\BookPublicationStatus;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends BaseModel
{
    use SoftDeletes;

    protected $fillable = [
        'category_id',
        'shelf_id',
        'title',
        'subtitle',
        'isbn',
        'author',
        'publisher',
        'publication_year',
        'language',
        'pages',
        'description',
        'cover',
        'stock',
        'available_stock',
        'publication_status',
        'borrow_count',
    ];

    protected function casts(): array
    {
        return [
            'publication_year' => 'integer',
            'pages' => 'integer',
            'stock' => 'integer',
            'available_stock' => 'integer',
            'borrow_count' => 'integer',
            'publication_status' => BookPublicationStatus::class,
        ];
    }

    public function getActivityLogName(): string
    {
        return 'book';
    }

    public function getYearAttribute(): ?int
    {
        return $this->publication_year;
    }

    public function getAvailableAttribute(): int
    {
        return $this->available_stock;
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function shelf(): BelongsTo
    {
        return $this->belongsTo(Shelf::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(BookImage::class);
    }

    public function borrowingItems(): HasMany
    {
        return $this->hasMany(BorrowingItem::class);
    }
}
