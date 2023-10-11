<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();

        $user = User::query()->create([
        'name' => $validated['name'],
        'password' => Hash::make($validated['password']),
        'api_token' => ''
        ]);

        $token = $user->createToken();

        return response()->json(['token' => $token], 201);
    }
    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        $user = User::query()->where('name', $validated['name'])->first();

        if ($user && Hash::check($validated['password'], $user['password'])) {
            $token = $user->createToken();
            return response()->json(['token' => $token], 201);
        } else {
            return response()->json(['auth' => 'Некорректный логин или пароль'], 401);
        }
    }

    public function logout()
    {
        $user = Auth::user();
        $user->api_token = '';
        $user->save();

        return response()->json(['auth' => 'Пользователь разлогинен'], 200);
    }
}
