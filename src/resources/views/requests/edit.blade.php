@extends('layouts.app')

@section('title', 'Редактирование заявки')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12 col-xl-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <div>
                                Редактирование заявки
                                № {{ $request->received_at->format('Y') . '-' . $request->number }}
                            </div>
                        </div>
                        <div>
                            <x-delete-modal-button question="Вы уверены, что вы хотите удалить данную заявку?"
                                                   :route="route('requests.destroy', $request->id)"/>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <form method="POST" action="{{ route('requests.update', $request->id) }}">
                        @method('PUT')
                        @csrf

                        <div class="row mb-3">
                            <label for="receivedAtDatePicker" class="col-md-4 col-form-label text-md-end">
                                Дата поступления
                            </label>
                            <div class="col-md-6">
                                <input id="receivedAtDatePicker" name="received_at" type="text"
                                       placeholder="Выберите дату поступления заявки"
                                       class="form-control @error('received_at') is-invalid @enderror"
                                       autocomplete="off" required
                                       aria-labelledby="receivedAtDateHelpBlock"
                                       value="{{ old('received_at', $request->received_at->format('d.m.Y')) }}">

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
                                           value="{{ $request->customer->name }}"
                                           aria-labelledby="customerHelpBlock"
                                    >
                                    <input id="customerId" name="customer_id" hidden="hidden"
                                           value="{{ $request->customer->id }}">

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
                            <label for="customerEmployeeSelect" class="col-md-4 col-form-label text-md-end">
                                Контактное лицо заказчика
                            </label>
                            <div class="col-md-6">
                                <select id="customerEmployeeSelect"
                                        class="form-select @error('customer_employee_id') is-invalid @enderror"
                                        name="customer_employee_id">
                                    <option value="">не задан</option>
                                    @foreach($request->customer->employees as $employee)
                                        <option
                                            value="{{ $employee->id }}" {{ old('customer_employee_id', $request->customer_employee_id) == $employee->id ? 'selected' : '' }}
                                        >{{ $employee->name }}</option>
                                    @endforeach
                                </select>
                                @error('customer_employee_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="projectOrganizationAutocomplete" class="col-md-4 col-form-label text-md-end">
                                Проектная организация
                            </label>
                            <div class="col-md-6 mb-2 mb-md-0">

                                <div class="d-flex">
                                    <input id="projectOrganizationAutocomplete" autocomplete="off"
                                           class="form-control @error('project_organization_id') is-invalid @enderror"
                                           @if(isset($request->projectOrganization))
                                               value="{{ $request->projectOrganization->name }}"
                                        @endif
                                    >
                                    <input name="project_organization_id" id="projectOrganizationId" hidden="hidden"
                                           @if(isset($request->projectOrganization))
                                               value="{{ $request->projectOrganization->id }}"
                                        @endif
                                    >
                                    @error('project_organization_id')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
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
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="projectOrganizationSelect" class="col-md-4 col-form-label text-md-end">
                                Контактное лицо проектной орг.
                            </label>
                            <div class="col-md-6">
                                <select id="projectOrganizationSelect"
                                        class="form-select @error('project_organization_employee_id') is-invalid @enderror"
                                        name="project_organization_employee_id">
                                    <option value="">не задан</option>
                                    @if($request->projectOrganization && $request->projectOrganization->employees)
                                        @foreach($request->projectOrganization->employees as $employee)
                                            <option
                                                value="{{ $employee->id }}" {{ old('project_organization_employee_id', $request->project_organization_employee_id) == $employee->id ? 'selected' : '' }}
                                            >{{ $employee->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('project_organization_employee_id')
                                <span class="invalid-feedback" role="alert">
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
                                <textarea id="object" name="object" type="text" rows="5"
                                          class="form-control @error('object') is-invalid d-block @enderror"
                                          required aria-labelledby="objectHelpBlock"
                                >{{ old('object',$request->object) }}</textarea>
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
                                <textarea id="equipment" name="equipment" type="text" rows="5"
                                          class="form-control @error('equipment') is-invalid @enderror"
                                          required
                                          aria-labelledby="equipmentHelpBlock"
                                >{{ old('equipment', $request->equipment) }}</textarea>

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
                                <textarea id="comment" name="comment" type="text" rows="5"
                                          class="form-control @error('comment') is-invalid @enderror"
                                          aria-labelledby="commentHelpBlock"
                                >{{ old('comment', $request->comment) }}</textarea>
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
                                       min="0" max="5" value="{{ old('prospect', $request->prospect) }}">
                                @error('prospect')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="requestStatus" class="col-md-4 col-form-label text-md-end">
                                Статус
                            </label>
                            <div class="col-md-6">
                                <select id="requestStatus" class="form-select @error('status_id') is-invalid @enderror"
                                        name="status_id">
                                    @foreach($statuses as $status)
                                        <option
                                            value="{{ $status->id }}" {{ old('status_id', $request->status_id) == $status->id ? 'selected' : '' }}
                                        >{{ $status->name }}</option>
                                    @endforeach
                                </select>
                                @error('status_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div id="answeredAtFormBlock" class="answeredAtDatepicker row mb-3">
                            <label for="answeredAtDatePicker" class="col-md-4 col-form-label text-md-end
                            @error('answered_at') is-invalid @enderror">
                                Дата ответа
                            </label>
                            <div class="col-md-6">
                                <input id="answeredAtDatePicker" type="text" name="answered_at"
                                       placeholder="Выберите дату ответа"
                                       class="form-control @error('answered_at') is-invalid @enderror"
                                       autocomplete="off"
                                       @if($request->answered_at)
                                           value="{{ old('answered_at', $request->answered_at->format('d.m.Y')) }}"
                                    @endif
                                >
                                @error('answered_at')
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
                                <input id="expectedOrderDatePicker" type="text" name="expected_order_date"
                                       placeholder="Выберите ожидаемую дату заказа"
                                       class="form-control @error('expected_order_date') is-invalid @enderror"
                                       autocomplete="off"
                                       @if($request->expected_order_date)
                                           value="{{ old('expected_order_date', $request->expected_order_date->format('d.m.Y')) }}"
                                    @endif>
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
