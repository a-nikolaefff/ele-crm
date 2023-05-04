@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Профиль пользователя</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table">
                        <tbody>
                        <tr>
                            <th scope="col">Имя</th>
                            <td>{{ Auth::user()->name }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Email</th>
                            <td>{{ Auth::user()->email }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Роль</th>
                            <td>{{ Auth::user()->role->name }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Подтверждение email</th>
                            <td>{{ Auth::user()->email_verified_at }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
