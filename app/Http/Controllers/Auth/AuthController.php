<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Educational;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister()
    {
        $educationals = Educational::all();
        return view('auth.register', compact('educationals'));
    }
    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();

        $user = User::query()->create([
        'login' => $validated['login'],
        'name' => $validated['name'],
        'password' => Hash::make($validated['password']),
        'api_token' => '',
        'educational_id' => $validated['educational_id'] ? $validated['educational_id'] : null,
        'role' => isset($validated['educational_id']) ? 'educational' : 'ministry',
        ]);

        $credentials = $request->only('login', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended(route('main'));
        }

        return back()->withErrors([
            'error' => 'Ошибка регистрации.',
        ]);
    }

    public function showLogin()
    {
        return view('auth.login');
    }
    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        $credentials = $request->only('login', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended(route('main'));
        }

        return back()->withErrors([
            'error' => 'Неверно указан логин или пароль.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('login'));
    }
}
