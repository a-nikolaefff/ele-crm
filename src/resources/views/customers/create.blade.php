@extends('layouts.app')

@section('title', 'Создание заказчика')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">

                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <div>
                                Создание нового заказчика
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('customers.store') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">
                                Имя
                            </label>
                            <div class="col-md-6">
                                <input id="name" name="name" type="text" maxlength="30"
                                       class="form-control @error('name') is-invalid @enderror" autocomplete="off"
                                       required autofocus value="{{ old('name') }}"
                                       aria-labelledby="nameHelpBlock">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                <div id="nameHelpBlock" class="form-text">
                                    Обязательное поле. Не более 30 символов.
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="full-name" class="col-md-4 col-form-label text-md-end">
                                Полное имя
                            </label>
                            <div class="col-md-6">
                                <input id="full-name" name="full_name" type="text" maxlength="70"
                                       class="form-control @error('full_name') is-invalid @enderror" autocomplete="off"
                                       required value="{{ old('full_name') }}"
                                       aria-labelledby="fullNameHelpBlock">
                                @error('full_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                <div id="fullNameHelpBlock" class="form-text">
                                    Обязательное поле. Не более 70 символов.
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="customerType" class="col-md-4 col-form-label text-md-end">Тип</label>
                            <div class="col-md-6">
                                <select id="customerType" name="customer_type_id"
                                        class="form-select @error('role_id') is-invalid @enderror">
                                    <option value="">не задан</option>
                                    @foreach($types as $type)
                                        <option
                                            value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="hasProjectDepartment" class="col-md-4 col-form-label text-md-end">
                                Есть проектный отдел
                            </label>
                            <div class="col-md-6 d-flex align-items-center">
                                <input id="hasProjectDepartment" name="has_project_department"
                                       type="checkbox"
                                       class="form-check-input @error('has_project_department') is-invalid @enderror">
                                @error('has_project_department')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="website" class="col-md-4 col-form-label text-md-end">
                                Сайт
                            </label>
                            <div class="col-md-6">
                                <input id="website" name="website" type="url"
                                       class="form-control @error('website') is-invalid @enderror" autocomplete="off"
                                       value="{{ old('website') }}"
                                       placeholder="включая часть http:// или https://">
                                @error('website')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 align-middle">
                            <div class="col-10 col-md-5 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Добавить заказчика
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
