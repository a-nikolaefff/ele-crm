@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12 col-xl-8">
            <div class="card">

                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <div>
                                Добавление новой заявки
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('requests.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="receivedAt" class="col-md-4 col-form-label text-md-end">
                                Дата поступления
                            </label>
                            <div class="col-md-6">
                                <input id="receivedAt" type="text" name="received_at"
                                       placeholder="Выберите дату поступления"
                                       class="form-control @error('answered_at') is-invalid @enderror"
                                       autocomplete="off"
                                       value="{{ old('received_at') }}">
                                @error('answered_at')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="customer" class="col-md-4 col-form-label text-md-end">
                                Заказчик
                            </label>
                            <div class="col-md-6 mb-2 mb-md-0">
                                <input id="customer" name="customer" autocomplete="off"
                                       class="form-control @error('customer_id') is-invalid @enderror"
                                       value="{{ old('customer') }}"
                                >
                                <input name="customer_id" id="customerId" hidden="hidden"
                                       value="{{ old('customer_id') }}">
                                @error('customer_id')
                                <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <a href="{{ route('customers.create') }}" target="_blank"
                                >
                                    <button type="button" class="btn btn-success">Добавить</button>
                                </a>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="project_organization" class="col-md-4 col-form-label text-md-end">
                                Проектная организация
                            </label>
                            <div class="col-md-6 mb-2 mb-md-0">
                                <input id="project_organization" autocomplete="off" name="project_organization"
                                       class="form-control @error('project_organization_id') is-invalid @enderror"
                                       value="{{ old('project_organization') }}">
                                <input name="project_organization_id" id="projectOrganizationId" hidden="hidden"
                                       value="{{ old('project_organization_id') }}">
                                @error('project_organization_id')
                                <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <a href="{{ route('customers.create') }}" target="_blank"
                                >
                                    <button type="button" class="btn btn-success">Добавить</button>
                                </a>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="object" class="col-md-4 col-form-label text-md-end">
                                Объект
                            </label>
                            <div class="col-md-6">
                                <textarea id="object" name="object" type="text" rows="2"
                                          class="form-control @error('object') is-invalid @enderror"
                                          required autofocus>{{ old('object') }}</textarea>
                                @error('object')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="equipment" class="col-md-4 col-form-label text-md-end">
                                Номенклатура
                            </label>
                            <div class="col-md-6">
                                <textarea id="equipment" name="equipment" type="text" rows="3"
                                          class="form-control @error('equipment') is-invalid @enderror"
                                          required autofocus>{{ old('equipment') }}</textarea>
                                @error('equipment')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="comment" class="col-md-4 col-form-label text-md-end">
                                Комментарий
                            </label>
                            <div class="col-md-6">
                                <textarea id="comment" name="comment" type="text" rows="5"
                                          class="form-control @error('comment') is-invalid @enderror"
                                          autofocus>{{ old('comment') }}</textarea>
                                @error('comment')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror
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
