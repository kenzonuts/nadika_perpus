<?php

declare(strict_types=1);

return [
    'borrow_limit' => (int) env('LIBRARY_BORROW_LIMIT', 3),
    'loan_duration_days' => (int) env('LIBRARY_LOAN_DURATION', 14),
    'fine_per_day' => (int) env('LIBRARY_FINE_PER_DAY', 5000),
    'max_upload_size_kb' => (int) env('LIBRARY_MAX_UPLOAD_KB', 2048),
    'allowed_image_types' => ['jpg', 'jpeg', 'png', 'webp'],
    'cache_ttl' => [
        'dashboard' => 300,
        'statistics' => 600,
        'popular_books' => 3600,
    ],
];
