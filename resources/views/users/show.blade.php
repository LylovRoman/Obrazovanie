@extends('template')

@section('title', 'Пользователь')

@section('content')
    <h1>Пользователь</h1>
    <ul class="list-group">
        <li class="list-group-item">ID: {{ $user->id }}</li>
        <li class="list-group-item">Логин: {{ $user->login }}</li>
        <li class="list-group-item">Имя: {{ $user->name }}</li>
        <li class="list-group-item">Роль: {{ $user->role }}</li>
        <li class="list-group-item">Отчёты:
            @foreach($user->reports as $report)
                <a href="{{ route('reports.show', ['report' => $report]) }}" style="text-decoration: none">{{ $report->name }}</a>
            @endforeach
        </li>
    </ul>
@endsection
