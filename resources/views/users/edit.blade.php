@extends('template')

@section('title', 'Редактировать пользователя')

@section('content')
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-5">
                <div class="card rounded-3 text-black">
                    <div class="row g-0">
                        <div class="card-body p-md-5 mx-md-4">
                            <div class="text-center">
                                <h4 class="mt-5 mb-5 pb-1">Редактировать пользователя</h4>
                            </div>
                            <form method="POST" action="{{ route('users.update', ['user' => $user]) }}">
                                @csrf
                                <div class="form-outline mb-4">
                                    <input type="text" name="login" class="form-control" placeholder="Логин" value="{{ $user->login }}">
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="text" name="name" class="form-control" placeholder="Имя" value="{{ $user->name }}">
                                </div>

                                <div class="form-outline mb-4">
                                    <select name="role" class="form-select">
                                        <option value="user" {{ ($user->role === "user") ? 'selected' : '' }}>Пользователь</option>
                                        <option value="admin" {{ ($user->role === "admin") ? 'selected' : '' }}>Администратор</option>
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
