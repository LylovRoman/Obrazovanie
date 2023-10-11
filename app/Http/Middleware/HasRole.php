<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class HasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role) : Response
    {
        // Проверяем, что пользователь аутентифицирован
        if ($request->user() && $request->user()->role === $role) {
            // Если у пользователя есть требуемая роль, пропускаем его дальше
            return $next($request);
        }

        // Проверяем, есть ли у запроса API токен
        $token = $request->bearerToken();

        if ($token) {
            // Предполагаем, что у вас есть модель User с атрибутом `api_token`
            $user = User::where('api_token', $token)->first();

            // Проверяем, существует ли пользователь и имеет ли он требуемую роль
            if ($user && $user->role === $role) {
                return $next($request);
            }
        }

        // Если у пользователя нет требуемой роли или токен недействителен, возвращаем ошибку
        if ($request->is('api/*')) {
            return response()->json(['error' => 'Отсутствует необходимая роль или неверный API токен'], 403);
        } else {
            throw new HttpException(403, 'Отсутствует необходимая роль или неверный API токен');
        }
    }
}
