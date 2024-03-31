<?php

namespace App\Http\Controllers\Cabinet\Security;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;

class ChangePasswordController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'password' => ['required', Rules\Password::defaults()],
            'new_password' => ['required', Rules\Password::defaults()],
        ]);
        if($request->password == $request->new_password) {
            throw ValidationException::withMessages([
                'new_password' => trans('auth.passwords_exactly'),
            ]);
        }
        $user = auth()->user();
        if (Hash::check($request->password, $user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->save();
            return redirect()->back()
                ->with('message', ['type' => 'success', 'text' => 'Пароль успешно изменён']);
        } else {
            throw ValidationException::withMessages([
                'password' => trans('auth.failed_password'),
            ]);
        }
    }
}
