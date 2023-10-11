@extends('template')

@section('title', 'Регистрация')

@section('content')
    <h1>Регистрация</h1>
    <form method="POST" action="/register">
        @csrf
        <label for="login">Логин:</label>
        <input type="text" name="login" id="login">
        <label for="name">Имя:</label>
        <input type="text" name="name" id="name">
        <label for="password">Пароль:</label>
        <input type="password" name="password" id="password">
        <label for="password_confirmation">Повторите пароль:</label>
        <input type="password" name="password_confirmation" id="password_confirmation">
        <button type="submit">Отправить</button>
    </form>
@endsection
