@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Подтверждение email адреса</div>

                    <div class="card-body">
                        @if (session('resent'))
                            <x-alert type="success" message="На ваш email отправлена ссылка для подтверждения email"/>
                        @endif

                        Пожалуйста подтвердите email адрес ваш перед тем как продолжить.
                        Если вы не получили письмо для подтверждения email -
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">нажмите здесь для отправки
                                нового письма
                            </button>
                            .
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
