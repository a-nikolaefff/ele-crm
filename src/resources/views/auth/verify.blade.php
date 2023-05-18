 @extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Необходимо подтверждение email адреса</div>

                    <div class="card-body">
                        @if (session('resent'))
                            <x-alert type="success" message="На ваш email отправлена ссылка для подтверждения email"/>
                        @endif
                        Пожалуйста подтвердите email адрес ваш перед тем как продолжить.
                        Письмо было отправлено вам при регистрации.
                        Если вы не получили письмо для подтверждения email - нажмите
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">здесь
                            </button>
                            для отправки нового письма.
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
