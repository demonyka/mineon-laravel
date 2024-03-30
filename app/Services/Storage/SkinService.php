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
     * @param $username
     * @return Response
     * @throws BindingResolutionException
     */
    public function getSkin($username): Response
    {
        $path = $this->getSkinPath($username);
        $skin = ImageManager::withDriver(Driver::class)->read($path);
        $image = $skin->encode();
        return response()->make($image, 200, ['Content-Type' => 'image/png']);
    }

    /**
     * @param $username
     * @param $size
     * @return Response
     * @throws BindingResolutionException
     */
    public function getHead($username, $size): Response
    {
        $path = $this->getSkinPath($username);
        $skin = ImageManager::withDriver(Driver::class)->read($path);
        $head = $skin->crop(8, 8, 8, 8);
        $head->resize($size, $size);
        $image = $head->encode();
        return response()->make($image, 200, ['Content-Type' => 'image/png']);
    }

    /**
     * @param $username
     * @return string
     */
    private function getSkinPath($username): string
    {
        $path = "skins/{$username}.png";
        if (Storage::exists($path)) {
            return storage_path("app/{$path}");
        } else {
            return storage_path("app/skins/default.png");
        }
    }
}
