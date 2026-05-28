<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;

class FileUploadService
{
    private array $allowedMimes = [
        'image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'
    ];

    private array $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

    private int $maxSizeBytes = 5 * 1024 * 1024; // 5MB

    public function validateAndStore(UploadedFile $file, string $path = 'children'): ?string
    {
        // Validate mime type
        if (!in_array($file->getMimeType(), $this->allowedMimes)) {
            Log::warning('Invalid file upload attempt', [
                'mime' => $file->getMimeType(),
                'original_name' => $file->getClientOriginalName(),
            ]);
            return null;
        }

        // Validate extension
        $extension = strtolower($file->getClientOriginalExtension());
        if (!in_array($extension, $this->allowedExtensions)) {
            return null;
        }

        // Validate file size
        if ($file->getSize() > $this->maxSizeBytes) {
            return null;
        }

        // Generate safe filename
        $filename = bin2hex(random_bytes(16)) . '.' . $extension;

        // Store file
        return $file->storeAs($path, $filename, 'public');
    }
}