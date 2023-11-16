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
            @if(Auth::user()->role === "admin")
                <th scope="col">Привязаны</th>
                <th scope="col">Редактировать</th>
            {{--    <th scope="col">Удалить</th> --}}
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($reports as $report)
            <tr>
                <th scope="row">{{ $report->id }}</th>
                <td><a href="{{ route($report->link . '.index') }}" style="text-decoration: none">{{ $report->name }}</a></td>
                @if(Auth::user()->role === "admin")
                    <td>
                        @foreach($report->users as $user)
                            <a href="{{ route('users.show', ['user' => $user]) }}" style="text-decoration: none">{{ $user->name }}</a> |
                        @endforeach
                    </td>
                    <th scope="col"><a href="{{ route('reports.edit', ['report' => $report]) }}" style="text-decoration: none">✏️</a></th>
    {{-- <th scope="col"><a href="{{ route('reports.destroy', ['report' => $report]) }}" style="text-decoration: none">❌</a></th> --}}
                @endif
</tr>
@endforeach
</tbody>
</table>
@endsection
