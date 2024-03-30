<?php

namespace App\Services\Storage;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class SkinUploadService
{
    /**
     * Загрузка и валидация файла.
     *
     * @param UploadedFile $file
     * @param string $name
     * @param array $dimensions
     * @param string $directory
     * @throws \Exception
     */
    public function upload(UploadedFile $file, string $username, array $dimensions, string $directory): void
    {
        list($width, $height) = getimagesize($file);
        if (!in_array([$width, $height], $dimensions)) {
            throw new \Exception('Недопустимый размер изображения.');
        }
        $filename = $username . '.png';
        $file->move(storage_path($directory), $filename);
    }
}

