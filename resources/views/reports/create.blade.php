@extends('template')

@section('title', 'Добавить отчёт')

@section('content')
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-5">
                <div class="card rounded-3 text-black">
                    <div class="row g-0">
                        <div class="card-body p-md-5 mx-md-4">
                            <div class="text-center">
                                <h4 class="mt-5 mb-5 pb-1">Добавить отчёт</h4>
                            </div>
                            <form method="POST" action="{{ route('reports.store') }}">
                                @csrf
                                <div class="form-outline mb-4">
                                    <input type="text" name="name" class="form-control" placeholder="Название">
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="text" name="link" class="form-control" placeholder="Ссылка на записи">
                                </div>

                                <div class="form-outline mb-4">
                                    <select name="user_ids[]" id="user_ids" class="selectpicker w-100" multiple title="Привязать отчёт" data-live-search="true">
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
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
