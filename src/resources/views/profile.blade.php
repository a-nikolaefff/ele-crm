@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Профиль пользователя</div>

                <div class="card-body">
                    @if (session('status'))
                        <x-alert type="success" :message="session('status')"/>
                    @endif
                    <table class="table">
                        <tbody>
                        <tr>
                            <th scope="col">Имя</th>
                            <td>{{ Auth::user()->name }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Роль</th>
                            <td>{{ Auth::user()->role->name }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Email</th>
                            <td>{{ Auth::user()->email }}</td>
                        </tr>

                        <tr>
                            <th scope="row">Подтверждение email</th>
                            <td>
                                @if(Auth::user()->email_verified_at)
                                    Да
                                @else
                                    Нет
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Регистрация</th>
                            <td>{{ Auth::user()->created_at }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
