@extends('layouts.app')

@section('title', 'Добро пожаловать в EleCRM!')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1 class="h5">Добро пожаловать в EleCRM!</h1>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <x-alert type="success" :message="session('status')"/>
                    @endif

                    <p>
                        Если Вы являетесь верифицированным сотрудником компании вы можете свободно пользоваться системой.
                    </p>

                    <p>
                        Если Вы только что зарегистрировались, то для получения доступа к системе EleCRM вам необходимо
                        выполнить несколько простых шагов:
                    </p>

                    <ol>
                        <li class="mb-2">
                            Подтвердите Ваш email адрес. Письмо с ссылкой для подтверждения Вашего email адреса было
                            отправлено на email адрес указанный Вами при регистрации.
                            Если Вы не получили это письмо  - нажмите
                            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">здесь
                                </button>
                                для отправки нового письма.
                            </form>
                        </li>
                        <li class="mb-2">
                            Сообщите администратору компании Ваш email указанный при регистрации,
                            что бы он мог верифицировать Ваш аккаунт и предоставил доступ к системе.
                        </li>
                        <li class="mb-2">
                            Ожидайте письма о верификации вашего аккаунта как аккаунта сотрудника компании
                            и предоставления доступа к системе.
                        </li>
                    </ol>

                </div>
            </div>
        </div>
    </div>
@endsection
