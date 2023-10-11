<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $data = User::all();

        return response()->json([
            'data' => $data
        ], 200);
    }

    public function show($id)
    {
        return response()->json([
            'data' => User::find($id)
        ], 200);
    }
    public function update(UserRequest $request, $id)
    {
        $validated = $request->validated();

        $user = User::query()->find($id);

        $user->update([
            'name' => $validated['name'],
            'role' => $validated['role']
        ]);

        return response()->json([
            'message' => 'Пользователь успешно обновлен',
            'data' => $user
        ], 200);
    }
    public function destroy($id)
    {
        User::find($id)->delete();
        return response()->json(['message' => 'Пользователь удален'], 204);
    }
}
