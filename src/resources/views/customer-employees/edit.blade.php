@extends('layouts.app')

@section('title', 'Редактирование контактного лица')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">

                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <div>
                                Редактирование контактного лица
                            </div>
                        </div>
                        <div>
                            <x-delete-modal-button question="Вы уверены, что хотите удалить данное контактное лицо?"
                                                   :route="route('customer-employees.destroy', $customerEmployee->id)"/>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('customer-employees.update', $customerEmployee->id) }}">
                        @method('PUT')
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">
                                Имя
                            </label>
                            <div class="col-md-6">
                                <input id="name" name="name" type="text" autocomplete="off"
                                       maxlength="70"
                                       class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name', $customerEmployee->name) }}"
                                       aria-labelledby="nameHelpBlock">

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                <div id="nameHelpBlock" class="form-text">
                                    Обязательное поле. Не более 70 символов
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="post" class="col-md-4 col-form-label text-md-end">
                                Должность
                            </label>
                            <div class="col-md-6">
                                <input id="post" name="post" type="text" autocomplete="off"
                                       class="form-control @error('post') is-invalid @enderror"
                                       value="{{ old('post', $customerEmployee->post) }}"
                                       aria-labelledby="postHelpBlock">
                                @error('post')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                <div id="postHelpBlock" class="form-text">
                                    Не более 70 символов
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">
                                Email
                            </label>
                            <div class="col-md-6">
                                <input id="email" name="email" type="email" autocomplete="off"
                                       class="form-control @error('email') is-invalid @enderror"
                                       value="{{ old('email', $customerEmployee->email) }}">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-end">
                                Телефон
                            </label>
                            <div class="col-md-6">
                                <input id="phone" name="phone" type="tel"
                                       class="form-control @error('phone') is-invalid @enderror"
                                       autocomplete="off" placeholder="включая код страны (+7 или иной код)"
                                       value="{{ old('phone', $customerEmployee->phone) }}">
                                @error('phone')
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
