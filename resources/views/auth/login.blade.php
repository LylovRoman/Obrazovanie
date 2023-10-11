@extends('template')

@section('title', 'Вход')

@section('content')
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-5">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="card-body p-md-5 mx-md-4">

                                <div class="text-center">
                                    <h4 class="mt-5 mb-5 pb-1">Добро пожаловать</h4>
                                </div>

                                <form method="POST" action="/login">
                                    @csrf
                                    <p>Пожалуйста авторизуйтесь</p>

                                    <div class="form-outline mb-4">
                                        <input type="text" name="login" id="login" class="form-control" placeholder="Ваш логин">
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Ваш пароль">
                                    </div>

                                    <div class="text-center pt-1 mb-5 pb-1">
                                        <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Войти</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
