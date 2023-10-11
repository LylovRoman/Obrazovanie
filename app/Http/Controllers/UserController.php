<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    public function show(User $user)
    {
        if ((Auth::id() === $user->id) || (Auth::user()->role === 'admin')){
            $user->with('reports');
            return view('users.show', compact('user'));
        } else {
            return redirect(route('users.show', ['user' => Auth::user()->with('reports')]));
        }
    }
    public function create()
    {
        return view('users.create');
    }
    public function store(RegisterRequest $request)
    {
        $validated = $request->validated();

        $report = User::query()->create([
            'login' => $validated['login'],
            'name' => $validated['name'],
            'password' => Hash::make($validated['password']),
            'api_token' => '',
            'role' => $validated['role'],
        ]);

        $text = "Это новый отчёт.";
        file_put_contents(resource_path('views/reports/contents/content' . $report->id . '.blade.php'), $text);

        return redirect()->route('reports.index');
    }
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }
    public function update(UserRequest $request, User $user)
    {
        $validated = $request->validated();

        $user->update([
            'login' => $validated['login'],
            'name' => $validated['name'],
            'role' => $validated['role']
        ]);

        return redirect()->route('users.index');
    }
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index');
    }
}
