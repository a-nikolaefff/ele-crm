@extends('layouts.app')

@section('content')
    <h1 class="h2">Пользователи</h1>

    <x-error-messages></x-error-messages>

    <div class="row mb-3">
        <div class="col-12 col-sm-9 col-lg-6">
            <x-search-form
                :value="request()->search"
                placeholder="Поиск по имени или email"
            ></x-search-form>
        </div>
    </div>

    <x-option-selector
        :url="route('users.index')"
        parameter-name="role_id"
        :options="$roles"
        passing-property='id'
        displaying-property='name'
        all-options-selector='Любая роль'
    ></x-option-selector>

    <div class="table-responsive">
        <table class="table text-center table-fixed align-middle entity-table" id="sortableTable">

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
                       href="{{ route('users.index', ['sort' => 'role_id', 'direction' => 'asc']) }}"
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
                       href="{{ route('users.index', ['sort' => 'email_verified_at', 'direction' => 'asc']) }}"
                    >
                        Подтверждение email
                    </a>
                </th>
                <th class="col-2" scope="col">
                    <a class="d-block"
                       href="{{ route('users.index', ['sort' => 'created_at', 'direction' => 'asc']) }}"
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
        <div>
            {{ $users->links() }}
        </div>
    </div>

@endsection


