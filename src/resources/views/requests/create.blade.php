@extends('layouts.app')

@section('title', 'Создание заявки')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12 col-xl-8">
            <div class="card">

                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <div>
                                Создание новой заявки
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('requests.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="receivedAtDatePicker" class="col-md-4 col-form-label text-md-end">
                                Дата поступления
                            </label>
                            <div class="col-md-6">
                                <input id="receivedAtDatePicker" name="received_at" type="text"
                                       placeholder="Выберите дату поступления"
                                       class="form-control required @error('received_at') is-invalid @enderror"
                                       autocomplete="off" required
                                       value="{{ old('received_at') }}"
                                       aria-labelledby="receivedAtDateHelpBlock">

                                @error('received_at')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                <div id="receivedAtDateHelpBlock" class="form-text">
                                    Обязательное поле
                                </div>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="customerAutocomplete" class="col-md-4 col-form-label text-md-end">
                                Заказчик
                            </label>
                            <div class="col-md-6 mb-2 mb-md-0">
                                <div class="d-flex">
                                    <input id="customerAutocomplete" name="customer" autocomplete="off"
                                           class="form-control @error('customer_id') is-invalid @enderror"
                                           value="{{ old('customer') }}"
                                           aria-labelledby="customerHelpBlock">

                                    <input name="customer_id" id="customerId" hidden="hidden"
                                           value="{{ old('customer_id') }}">

                                    <div id="customerResetAutocomplete" class="resetAutocomplete">
                                        <button class="btn btn-outline-danger autocompleteButton" type="button">
                                            <i class='bx bx-x-circle'></i>
                                        </button>
                                    </div>

                                    <a href="{{ route('customers.create') }}" target="_blank"
                                    >
                                        <button class="btn btn-outline-success autocompleteButton" type="button">
                                            <i class='bx bx-message-square-add'></i>
                                        </button>
                                    </a>

                                </div>

                                @error('customer_id')
                                <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                <div id="customerHelpBlock" class="form-text">
                                    Обязательное поле
                                </div>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="projectOrganizationAutocomplete" class="col-md-4 col-form-label text-md-end">
                                Проектная организация
                            </label>
                            <div class="col-md-6 mb-2 mb-md-0">
                                <div class="d-flex">
                                    <input id="projectOrganizationAutocomplete" autocomplete="off"
                                           name="project_organization"
                                           class="form-control @error('project_organization_id') is-invalid @enderror"
                                           value="{{ old('project_organization') }}">
                                    <input id="projectOrganizationId" name="project_organization_id" hidden="hidden"
                                           value="{{ old('project_organization_id') }}">

                                    <div id="projectOrganizationResetAutocomplete" class="resetAutocomplete">
                                        <button class="btn btn-outline-danger autocompleteButton" type="button">
                                            <i class='bx bx-x-circle'></i>
                                        </button>
                                    </div>

                                    <a href="{{ route('customers.create') }}" target="_blank"
                                    >
                                        <button class="btn btn-outline-success autocompleteButton" type="button">
                                            <i class='bx bx-message-square-add'></i>
                                        </button>
                                    </a>

                                </div>

                                @error('project_organization_id')
                                <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>

                        <div class="row mb-3">
                            <label for="object" class="col-md-4 col-form-label text-md-end">
                                Объект
                            </label>
                            <div class="col-md-6">
                                <textarea id="object" name="object" type="text" rows="5" maxlength="200"
                                          class="form-control @error('object') is-invalid @enderror"
                                          required aria-labelledby="objectHelpBlock">{{ old('object') }}</textarea>
                                @error('object')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                <div id="objectHelpBlock" class="form-text">
                                    Обязательное поле. Не более 200 символов.
                                </div>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="equipment" class="col-md-4 col-form-label text-md-end">
                                Номенклатура
                            </label>
                            <div class="col-md-6">
                                <textarea id="equipment" name="equipment" type="text" rows="5" maxlength="200"
                                          class="form-control @error('equipment') is-invalid @enderror"
                                          required aria-labelledby="equipmentHelpBlock">{{ old('equipment') }}</textarea>
                                @error('equipment')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                <div id="equipmentHelpBlock" class="form-text">
                                    Обязательное поле. Не более 200 символов.
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="comment" class="col-md-4 col-form-label text-md-end">
                                Комментарий
                            </label>
                            <div class="col-md-6">
                                <textarea id="comment" name="comment" type="text" rows="5" maxlength="200"
                                          class="form-control @error('comment') is-invalid @enderror"
                                          aria-labelledby="commentHelpBlock"
                                >{{ old('comment') }}</textarea>
                                @error('comment')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                <div id="commentHelpBlock" class="form-text">
                                    Не более 200 символов
                                </div>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="prospect" class="col-md-4 col-form-label text-md-end">
                                Перспективность
                            </label>
                            <div class="col-md-6">
                                <input id="prospect" name="prospect" type="range"
                                       class="form-range @error('prospect') is-invalid @enderror"
                                       min="0" max="5" value="{{ old('prospect') }}">
                                @error('prospect')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="expectedOrderDatePicker" class="col-md-4 col-form-label text-md-end">
                                Ожидаемая дата заказа
                            </label>
                            <div class="col-md-6">
                                <input id="expectedOrderDatePicker" name="expected_order_date" type="text"
                                       placeholder="Выберите ожидаемую дату заказа"
                                       class="form-control @error('expected_order_date') is-invalid @enderror"
                                       autocomplete="off"
                                       value="{{ old('expected_order_date') }}">
                                @error('expected_order_date')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 align-middle">
                            <div class="col-10 col-md-5 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Добавить заявку
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
