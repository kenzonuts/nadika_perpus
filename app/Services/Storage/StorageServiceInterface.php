<?php

declare(strict_types=1);

namespace App\Services\Storage;

use Illuminate\Http\UploadedFile;

interface StorageServiceInterface
{
    public function upload(UploadedFile $file, string $directory, ?string $filename = null): string;

    public function delete(string $path): bool;

    public function url(string $path): string;

    public function exists(string $path): bool;
}
