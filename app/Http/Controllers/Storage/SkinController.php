<?php

namespace App\Http\Controllers\Storage;

use App\Http\Controllers\Controller;
use App\Services\Storage\SkinService;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SkinController extends Controller
{
    protected SkinService $skinService;

    public function __construct(SkinService $skinService)
    {
        $this->skinService = $skinService;
    }

    /**
     * @param $username
     * @return Response
     * @throws BindingResolutionException
     */
    public function getSkin($username)
    {
        return $this->skinService->getSkin($username);
    }

    /**
     * @param $username
     * @return Response
     * @throws BindingResolutionException
     */
    public function getCape($username)
    {
        return $this->skinService->getCape($username);
    }

    /**
     * @param $username
     * @param Request $request
     * @return Response
     * @throws BindingResolutionException
     */
    public function getHead($username, Request $request)
    {
        $size = $request->size ?: 128;
        return $this->skinService->getHead($username, $size);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function skinUpload(Request $request): JsonResponse
    {
        $request->validate([
            'skin' => 'required|file|mimes:png|max:1024'
        ]);
        try {
            $skin = $request->file('skin');
            auth()->user()->attachSkin($skin);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
        return response()->json(['success' => 'Скин успешно загружен']);
    }
}
