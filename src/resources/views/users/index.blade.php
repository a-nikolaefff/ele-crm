@extends('layouts.app')

@section('content')
    <h1 class="h2">Пользователи</h1>
    <div class="table-responsive">
        <table class="table text-center align-middle sortable-table" id="sortableTable">

            <thead>
            <tr class="align-middle">
                <th class="col-2" scope="col">
                    <a class="d-block"
                       href="{{ route('users.index', ['sort' => 'name', 'direction' => 'asc']) }}"
                    >
                        Имя
                    </a>
                </th>
                <th class="col-1" scope="col">
                    <a class="d-block"
                       href="{{ route('users.index', ['sort' => 'role', 'direction' => 'asc']) }}"
                    >
                        Роль
                    </a>
                </th>
                <th class="col-3" scope="col">
                    <a class="d-block"
                       href="{{ route('users.index', ['sort' => 'email', 'direction' => 'asc']) }}"
                    >
                        Email
                    </a>
                </th>
                <th class="col-1" scope="col">
                    <a class="d-block"
                       href="{{ route('users.index', ['sort' => 'email-verification', 'direction' => 'asc']) }}"
                    >
                        Подтверждение email
                    </a>
                </th>
                <th class="col-2" scope="col">
                    <a class="d-block"
                       href="{{ route('users.index', ['sort' => 'registration', 'direction' => 'asc']) }}"
                    >
                        Регистрация
                    </a>
                </th>
                <th class="col-1" scope="col"></th>
            </tr>
            </thead>

            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->role->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td> @if($user->email_verified_at)
                            Да
                        @else
                            Нет
                        @endif</td>
                    <td>{{ $user->created_at->format('Y-m-d') }}</td>
                    <td class="text-start">
                        @can('update', $user)
                            <a href="{{ route('users.edit', $user->id) }}">
                                <x-edit-icon></x-edit-icon>
                            </a>
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>
    </div>
    <div>
        {{ $users->links() }}
    </div>
@endsection


