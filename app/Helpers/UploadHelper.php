<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Exceptions\LibraryException;
use Illuminate\Http\UploadedFile;

final class UploadHelper
{
    /**
     * @return array{extension: string, mime: string}
     */
    public static function validateImage(UploadedFile $file): array
    {
        $maxSizeKb = (int) config('library.max_upload_size_kb', 2048);
        $allowedTypes = config('library.allowed_image_types', ['jpg', 'jpeg', 'png', 'webp']);

        if (! is_array($allowedTypes)) {
            $allowedTypes = ['jpg', 'jpeg', 'png', 'webp'];
        }

        $maxBytes = $maxSizeKb * 1024;

        if ($file->getSize() > $maxBytes) {
            throw new LibraryException(
                "File size exceeds the maximum allowed size of {$maxSizeKb} KB.",
                ['max_size_kb' => $maxSizeKb],
            );
        }

        $extension = strtolower($file->getClientOriginalExtension());
        $mimeType = (string) $file->getMimeType();

        $allowedMimes = [
            'jpg' => ['image/jpeg'],
            'jpeg' => ['image/jpeg'],
            'png' => ['image/png'],
            'webp' => ['image/webp'],
        ];

        if (! in_array($extension, $allowedTypes, true)) {
            throw new LibraryException(
                'Invalid file type. Allowed types: '.implode(', ', $allowedTypes),
                ['allowed_types' => $allowedTypes],
            );
        }

        $validMimes = $allowedMimes[$extension] ?? [];

        if (! in_array($mimeType, $validMimes, true)) {
            throw new LibraryException(
                'Invalid MIME type for the uploaded file.',
                ['mime' => $mimeType, 'extension' => $extension],
            );
        }

        return [
            'extension' => $extension,
            'mime' => $mimeType,
        ];
    }
}
