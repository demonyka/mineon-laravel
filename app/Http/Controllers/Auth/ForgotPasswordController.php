<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\Auth\ResetPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ForgotPasswordController extends Controller
{
    public function view()
    {
        return inertia('Auth/ForgotPassword');
    }
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:16|min:3|exists:users,username',
        ]);
        $user = User::where('username', $request->username)->firstOrFail();
        if (Cache::has("reset_password_{$user->username}")) {
            if ($request->ip() === Cache::get("reset_password_{$user->username}")) {
                throw ValidationException::withMessages([
                    'username' => trans('auth.throttle.request'),
                ]);
            }
        }
        $token = Str::random(64);
        Cache::put("reset_password_token_{$token}", $user->username, now()->addMinutes(10));
        Cache::put("reset_password_{$user->username}", $request->ip(), now()->addMinutes(10));
        Mail::to($user->email)->send(new ResetPasswordMail($token));
        return redirect()->route('login.view')
            ->with('message', ['type' => 'success', 'text' => 'Запрос на восстановление пароля отправлен']);
    }
}
