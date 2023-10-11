@extends('template')

@section('title', 'Редактировать отчёт')

@section('content')
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-5">
                <div class="card rounded-3 text-black">
                    <div class="row g-0">
                        <div class="card-body p-md-5 mx-md-4">
                            <div class="text-center">
                                <h4 class="mt-5 mb-5 pb-1">Редактировать отчёт</h4>
                            </div>
                            <form method="POST" action="{{ route('reports.update', ['report' => $report]) }}">
                                @csrf

                                <div class="form-outline mb-4">
                                    <input type="text" name="name" class="form-control" placeholder="Название" value="{{ $report->name }}">
                                </div>

                                <div class="form-outline mb-4">
                                    <select name="user_id" id="user_id" class="form-select">
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ ($report->user_id === $user->id) ?? "selected" }}>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="text-center pt-1 mb-5 pb-1">
                                    <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Отправить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
