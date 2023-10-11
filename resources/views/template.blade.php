<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body style="background: #eeecec;">
<header>
    <div class="container">
        <header class="d-flex justify-content-center py-3">
            <ul class="nav nav-pills">
                @if(Auth::check())
                    <li class="nav-item"><a href="{{ route('reports.index') }}" class="nav-link {{ request()->is('reports') ? 'active' : '' }}">📑Отчёты</a></li>
                    @if(Auth::user()->role === "admin")
                        <li class="nav-item"><a href="{{ route('users.index') }}" class="nav-link {{ request()->is('users') ? 'active' : '' }}">👥Пользователи</a></li>
                    @endif
                    @if(Auth::user()->role === "user")
                        <li class="nav-item"><a href="{{ route('users.show', ["user" => Auth::user()]) }}" class="nav-link {{ request()->is('users*') ? 'active' : '' }}">👤 {{ Auth::user()->name }}</a></li>
                    @endif
                    <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link">🚪Выйти</a></li>
                @else
                    <li class="nav-item"><a href="{{ route('login') }}" class="nav-link {{ request()->is('login') ? 'active' : '' }}">Авторизоваться</a></li>
                   <!-- <li class="nav-item"><a href="{{ route('register') }}" class="nav-link {{ request()->is('register') ? 'active' : '' }}">Регистрироваться</a></li> -->
                @endif
            </ul>
        </header>
    </div>
</header>
<main>
    <div class="container">
        @yield('content')
    </div>
</main>

<footer>
    <div class="container fixed-bottom">
        <footer class="py-3 my-4">
            <p class="text-center text-muted">© 2023 каб. 35</p>
        </footer>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

