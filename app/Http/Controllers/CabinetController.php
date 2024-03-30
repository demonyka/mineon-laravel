<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CabinetController extends Controller
{
    public function view()
    {
        return inertia('Cabinet');
    }
    public function skinUpload(Request $request)
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
