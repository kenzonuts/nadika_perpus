<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Services\BookImportService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessBookImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public string $filePath, public ?string $userId = null) {}

    public function handle(BookImportService $service): void
    {
        if (! file_exists($this->filePath)) {
            return;
        }

        $rows = [];
        if (($handle = fopen($this->filePath, 'r')) !== false) {
            while (($line = fgetcsv($handle)) !== false) {
                if (! isset($line[0]) || $line[0] === 'title') {
                    continue;
                }

                $rows[] = [
                    'title' => $line[0],
                    'isbn' => $line[1] ?? uniqid('isbn-', true),
                    'author' => $line[2] ?? 'Unknown',
                    'category_id' => $line[3] ?? null,
                    'shelf_id' => $line[4] ?? null,
                    'stock' => (int) ($line[5] ?? 1),
                    'available_stock' => (int) ($line[5] ?? 1),
                    'publication_status' => $line[6] ?? 'draft',
                ];
            }

            fclose($handle);
        }

        $service->processRows(array_filter($rows, fn (array $row): bool => ! empty($row['category_id']) && ! empty($row['shelf_id'])));
    }
}
