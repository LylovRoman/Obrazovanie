@extends('template')

@section('title', 'Отчёт')

@section('content')
    <h1>{{ $report->name }} от {{$report->user->name}}</h1>
    @include('reports.contents.content' . $report->id)
@endsection
