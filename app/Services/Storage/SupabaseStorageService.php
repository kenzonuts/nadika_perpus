<?php

declare(strict_types=1);

namespace App\Services\Storage;

use App\Helpers\UploadHelper;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SupabaseStorageService implements StorageServiceInterface
{
    private const string DISK = 'supabase';

    public function upload(UploadedFile $file, string $directory, ?string $filename = null): string
    {
        UploadHelper::validateImage($file);

        $extension = strtolower($file->getClientOriginalExtension());
        $filename ??= Str::uuid()->toString().'.'.$extension;
        $path = trim($directory, '/').'/'.$filename;

        Storage::disk(self::DISK)->put($path, $file->getContent(), 'public');

        return $path;
    }

    public function delete(string $path): bool
    {
        if (! $this->exists($path)) {
            return false;
        }

        return Storage::disk(self::DISK)->delete($path);
    }

    public function url(string $path): string
    {
        return Storage::disk(self::DISK)->url($path);
    }

    public function exists(string $path): bool
    {
        return Storage::disk(self::DISK)->exists($path);
    }
}
