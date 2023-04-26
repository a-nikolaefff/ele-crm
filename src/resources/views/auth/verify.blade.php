@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Подтверждение email адреса</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    Пожалуйста подтвердите email адрес ваш перед тем как продолжить.
                    Если вы не получили письмо для подтверждения email -
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">нажмите здесь для отправки нового письма</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
