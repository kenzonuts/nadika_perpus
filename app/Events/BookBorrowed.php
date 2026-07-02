<?php

declare(strict_types=1);

namespace App\Events;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BookBorrowed
{
    use Dispatchable;
    use SerializesModels;

    public function __construct(
        public readonly Model $borrowing,
    ) {}
}
