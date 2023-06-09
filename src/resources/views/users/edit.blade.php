@extends('layouts.admin')

@section('title', 'Редактирование пользователя')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">

                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <div>
                                Редактирование пользователя
                            </div>
                        </div>
                        <div>
                            @can('delete', $user)
                                <x-delete-modal-button question="Вы уверены, что хотите удалить этого пользователя?"
                                                       :route="route('users.destroy', $user->id)"/>
                            @endcan
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('users.update', $user->id) }}">
                        @method('PUT')
                        @csrf
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Имя</label>
                            <div class="col-md-6">
                                <input id="name" name="name" type="text" maxlength="50"
                                       class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name', $user->name) }}" required autocomplete="name"
                                       aria-labelledby="nameHelpBlock"
                                       autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                <div id="nameHelpBlock" class="form-text">
                                    Обязательное поле. Не более 50 символов.
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="role" class="col-md-4 col-form-label text-md-end">Роль</label>
                            <div class="col-md-6">
                                <select id="role" name="role_id"
                                        class="form-select @error('role_id') is-invalid @enderror">
                                    @foreach($roles as $role)
                                        <option
                                            value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 align-middle">
                            <div class="col-10 col-md-5 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Подтвердить изменения
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
