@extends('template')

@section('title', 'Отчёты')

@section('content')
    <h1>Отчёты
        @if(Auth::user()->role === "admin")
            <a href="{{ route('reports.create') }}" style="text-decoration: none">+</a>
        @endif
    </h1>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Отчёт</th>
            <th scope="col">Источник</th>
            @if(Auth::user()->role === "admin")
                <th scope="col">Редактировать</th>
                <th scope="col">Удалить</th>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($reports as $report)
            <tr>
                <th scope="row">{{ $report->id }}</th>
                <td><a href="{{ route('reports.show', ['report' => $report]) }}" style="text-decoration: none">{{ $report->name }}</a></td>
                <td><a href="{{ route('users.show', ['user' => $report->user]) }}" style="text-decoration: none">{{ $report->user->name }}</a></td>
                @if(Auth::user()->role === "admin")
                    <th scope="col"><a href="{{ route('reports.edit', ['report' => $report]) }}" style="text-decoration: none">✏️</a></th>
                    <th scope="col"><a href="{{ route('reports.destroy', ['report' => $report]) }}" style="text-decoration: none">❌</a></th>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
