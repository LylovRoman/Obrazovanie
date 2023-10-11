@extends('template')

@section('title', 'Пользователи')

@section('content')
    <h1>Пользователи
        <a href="{{ route('users.create') }}" style="text-decoration: none">+</a>
    </h1>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Логин</th>
            <th scope="col">Имя</th>
            <th scope="col">Роль</th>
            <th scope="col">Редактировать</th>
            <th scope="col">Удалить</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td><a href="{{ route('users.show', ['user' => $user]) }}" style="text-decoration: none">{{ $user->login }}</a></td>
                <td><a href="{{ route('users.show', ['user' => $user]) }}" style="text-decoration: none">{{ $user->name }}</a></td>
                <td>{{ $user->role }}</td>
                <th scope="col"><a href="{{ route('users.edit', ['user' => $user]) }}" style="text-decoration: none">✏️</a></th>
                <th scope="col"><a href="{{ route('users.destroy', ['user' => $user]) }}" style="text-decoration: none">❌</a></th>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
