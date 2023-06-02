@extends('layouts.app')

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
                            <label for="receivedAt" class="col-md-4 col-form-label text-md-end">
                                Дата поступления
                            </label>
                            <div class="col-md-6">
                                <input id="receivedAt" type="text" name="received_at"
                                       placeholder="Выберите дату поступления"
                                       class="form-control"
                                       autocomplete="off @error('received_at') is-invalid @enderror"
                                       value="{{ $request->received_at->format('d.m.Y') }}">
                                @error('received_at')
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

                                <input id="customer" autocomplete="off"
                                       class="form-control @error('customer_id') is-invalid @enderror"
                                       value="{{ $request->customer->name }}"
                                >
                                <input name="customer_id" id="customerId" hidden="hidden"
                                       value="{{ $request->customer->id }}">
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
                                <input id="project_organization" autocomplete="off"
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
                                          class="form-control @error('object') is-invalid d-block @enderror"
                                          required autofocus>{{ $request->object }}</textarea>

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
                                          required autofocus>{{ $request->equipment }}</textarea>

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
                                          autofocus>{{ $request->comment }}</textarea>

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
                                       min="0" max="5" value="{{ $request->prospect }}">
                                @error('prospect')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="status" class="col-md-4 col-form-label text-md-end">
                                Статус
                            </label>
                            <div class="col-md-6">
                                <select id="status" class="form-select @error('status_id') is-invalid @enderror"
                                        name="status_id">
                                    @foreach($statuses as $status)
                                        <option
                                            value="{{ $status->id }}" {{ $request->status->id == $status->id ? 'selected' : '' }}
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
                            <label for="answeredAt" class="col-md-4 col-form-label text-md-end
                            @error('answered_at') is-invalid @enderror">
                                Дата ответа
                            </label>
                            <div class="col-md-6">
                                <input id="answeredAt" type="text" name="answered_at"
                                       placeholder="Выберите дату ответа"
                                       class="form-control @error('answered_at') is-invalid @enderror"
                                       autocomplete="off"
                                       @if($request->answered_at)
                                           value="{{ $request->answered_at->format('d.m.Y') }}"
                                    @endif
                                >
                                @error('answered_at')
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
