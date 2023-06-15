@extends('layouts.admin')

@section('title', 'Пользователи')

@section('content')
    <x-page-title title="Пользователи"></x-page-title>

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

    <div class="table-responsive-xl">
        <table class="table text-center table-fixed align-middle entityTable" id="sortableTable">

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
                    <td class="text-truncate max-w-250">
                        {{ $user->name }}
                    </td>
                    <td>
                        {{ $user->role->name }}
                    </td>
                    <td class="text-truncate max-w-250">
                        {{ $user->email }}
                    </td>
                    <td>
                        @if($user->email_verified_at)
                            Да
                        @else
                            Нет
                        @endif
                    </td>
                    <td>{{ $user->created_at->format('d.m.Y') }}</td>

                    <td class="min-w-130 text-start">
                        <button data-bs-toggle="collapse" data-bs-target="#user_{{$user->id}}"
                                class="icon-button" type="button"
                        >
                            <x-accordion-arrow></x-accordion-arrow>
                        </button>

                        @can('update', $user)
                            <a href="{{ route('users.edit', $user->id) }}">
                                <x-edit-icon></x-edit-icon>
                            </a>
                        @endcan
                    </td>
                </tr>

                <tr class="hiddenRow">
                    <td colspan="12">
                        <div class="collapse" id="user_{{$user->id}}">
                            <div class="d-flex justify-content-center">
                                <div class="entityTable__fullInfoBlock">
                                    <div class="row gx-0">
                                        <div class="col-6">

                                            <div class="row mb-2">
                                                <div class="col-4 entityTable__fieldName">
                                                    Имя
                                                </div>
                                                <div class="col-8 max-w-415 break-long-words">
                                                    {{ $user->name }}
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-4 entityTable__fieldName">
                                                    Роль
                                                </div>
                                                <div class="col-8">
                                                    {{ $user->role->name }}
                                                </div>
                                            </div>


                                        </div>
                                        <div class="col-6">

                                            <div class="row mb-2">
                                                <div class="col-4 entityTable__fieldName">
                                                    Email
                                                </div>
                                                <div class="col-8 max-w-415 break-long-words">
                                                    {{ $user->email }}
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-4 entityTable__fieldName">
                                                    Подтверждение email
                                                </div>
                                                <div class="col-8">
                                                    @if($user->email_verified_at)
                                                        Да
                                                    @else
                                                        Нет
                                                    @endif
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <hr>

                                    <div class="entityTable__userInfoBlock">
                                        <div class="row gx-0">
                                            <div class="col-6">

                                                <div class="row">
                                                    <div class="col-6 col-lg-4 entityTable__fieldName">
                                                        Зарегистрирован
                                                    </div>
                                                    <div class="col-6 col-lg-8">
                                                        {{ $user->created_at }}
                                                    </div>
                                                </div>
                                            </div>

                                            @if($user->updatedByUser)
                                                <div class="col-6">
                                                    <div class="row mb-1">
                                                        <div class="col-6 col-lg-4 entityTable__fieldName">
                                                            Обновлен
                                                        </div>
                                                        <div class="col-6 col-lg-8">
                                                            {{ $user->updated_at }}
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-6 col-lg-4 entityTable__fieldName">
                                                            Администратором
                                                        </div>
                                                        <div class="col-6 col-lg-8">
                                                            {{ $user->updatedByUser->name }}
                                                        </div>
                                                    </div>

                                                </div>
                                            @endif


                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
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


