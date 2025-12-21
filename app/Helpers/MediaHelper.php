<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class MediaHelper
{
    /**
     * Store default image in public disk if exists, otherwise return relative path
     */
    public static function storeDefault(
        string $relativePath,
        string $directory,
        string $prefix
    ): string {
        $content = self::findDefaultContent($relativePath);

        if ($content === null) {
            return $relativePath;
        }

        $storagePath = $directory . '/' . uniqid() . "_{$prefix}.png";
        Storage::disk('public')->put($storagePath, $content);

        return $storagePath;
    }

    /**
     * Upload custom file if exists
     */
    public static function storeUploaded(
        ?UploadedFile $file,
        string $directory
    ): ?string {
        if (!$file) {
            return null;
        }

        return $file->storeAs(
            $directory,
            uniqid() . '.' . $file->getClientOriginalExtension(),
            'public'
        );
    }

    /**
     * Locate bundled default image content
     */
    private static function findDefaultContent(string $relativePath): ?string
    {
        $paths = [
            public_path($relativePath),
            public_path('storage/' . $relativePath),
            storage_path('app/public/' . $relativePath),
        ];

        foreach ($paths as $path) {
            if (file_exists($path)) {
                return file_get_contents($path);
            }
        }

        return null;
    }
}
