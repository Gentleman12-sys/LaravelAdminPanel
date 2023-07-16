@extends('layouts.app')

@section('title-block')
Login
@endsection

@section('content-block')
<form action="{{ route('admin-login-submit') }}" method="post">
    @csrf

    <section class="vh-100">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card shadow-2-strong" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">

                <h3 class="mb-1">ВОЙТИ В СИСТЕМУ</h3>
                <p class="mb-3">Авторизация в админ. панели</p>

                <div class="form-outline mb-4">
                <input name="username" type="text" id="typeEmailX-2" class="form-control form-control-lg" placeholder="Имя админа" />
                </div>

                <div class="form-outline mb-4">
                <input name="password" type="password" id="typePasswordX-2" class="form-control form-control-lg" placeholder="Пароль" />
                </div>

                <button class="form-control form-control-lg btn btn-success" type="submit"><h3>Войти</h3></button>

            </div>
            </div>
        </div>
        </div>
    </div>
    </section>
</form>
@endsection