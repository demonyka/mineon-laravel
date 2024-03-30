<?php

namespace App\Services\Storage;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class SkinService
{
    /**
     * @param string $username
     * @return Response
     * @throws BindingResolutionException
     */
    public function getSkin(string $username): Response
    {
        $path = $this->getPath($username, 'skins');
        $skin = ImageManager::withDriver(Driver::class)->read($path);
        $image = $skin->encode();
        return response()->make($image, 200, ['Content-Type' => 'image/png']);
    }

    /**
     * @param string $username
     * @return Response
     * @throws BindingResolutionException
     */
    public function getCape(string $username): Response
    {
        $path = $this->getPath($username, 'capes');
        $skin = ImageManager::withDriver(Driver::class)->read($path);
        $image = $skin->encode();
        return response()->make($image, 200, ['Content-Type' => 'image/png']);
    }

    /**
     * @param string $username
     * @param integer $size
     * @return Response
     * @throws BindingResolutionException
     */
    public function getHead(string $username, int $size): Response
    {
        $path = $this->getPath($username, 'skins');
        $skin = ImageManager::withDriver(Driver::class)->read($path);
        $head = $skin->crop(8, 8, 8, 8);
        $head->resize($size, $size);
        $image = $head->encode();
        return response()->make($image, 200, ['Content-Type' => 'image/png']);
    }

    /**
     * @param string $username
     * @param string $type
     * @return string
     */
    private function getPath(string $username, string $type): string
    {
        $path = "{$type}/{$username}.png";
        if (file_exists(storage_path($path))) {
            return storage_path("{$path}");
        } else if (file_exists(storage_path("{$type}/default.png"))) {
            return storage_path("{$type}/default.png");
        } else {
            abort(404);
        }
    }
}
