@extends('template')

@section('title', 'Пользователь')

@section('content')
    <h1>{{ $user->name }}</h1>
    <ul class="list-group">
        <li class="list-group-item">ID: {{ $user->id }}</li>
        <li class="list-group-item">Логин: {{ $user->login }}</li>
        <li class="list-group-item">Роль: {{ $user->role }}</li>
        <li class="list-group-item">Отчёты:
            @foreach($user->reports as $report)
                @if($user->role === "user")
                    <a href="{{ route('reports.show', ['report' => $report]) }}" style="text-decoration: none">{{ $report->name }}</a>
                @endif
            @endforeach
        </li>
    </ul>
@endsection
