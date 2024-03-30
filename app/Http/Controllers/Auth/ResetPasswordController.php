<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ResetPasswordController extends Controller
{
    public function view($token, Request $request)
    {
        $username = Cache::get("reset_password_token_{$token}");
        if (!$username) {
            abort(410);
        }
        $user = User::where('username', $username)->firstOrFail();
        $ip = Cache::get("reset_password_{$user->username}");
        if($ip !== $request->ip()) {
            abort(401);
        }
        return inertia('Auth/ResetPassword', ['username' => $user->username, 'token' => $token]);
    }
    public function store($token, Request $request)
    {
        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $username = Cache::get("reset_password_token_{$token}");
        if (!$username) {
            abort(410);
        }
        $user = User::where('username', $username)->firstOrFail();
        $ip = Cache::get("reset_password_{$user->username}");
        if($ip !== $request->ip()) {
            abort(401);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        Cache::forget("reset_password_token_{$token}");
        Cache::forget("reset_password_{$user->username}");

        return redirect()->route('login.view')
            ->with('message', ['type' => 'success', 'text' => 'Пароль успешно изменён']);
    }
}
