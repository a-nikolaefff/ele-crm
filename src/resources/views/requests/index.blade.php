@extends('layouts.app')

@section('title', 'Заявки')

@section('content')
    <x-page-title title="Заявки"></x-page-title>

    <x-error-messages></x-error-messages>

    <div class="mb-3">
        <a href="{{ route('requests.create') }}"
        >
            <button type="button" class="btn btn-success">Создать заявку</button>
        </a>
    </div>

    <div class="row mb-3">
        <div class="col-12 col-sm-9 col-lg-6">
            <x-search-form
                :value="request()->search"
                placeholder="Поиск по заказчику, объекту, номенклатуре"
            ></x-search-form>
        </div>
    </div>

    <x-option-selector
        :url="route('customers.index')"
        parameter-name="status_id"
        :options="$statuses"
        passing-property='id'
        displaying-property='name'
        all-options-selector='любой статус'
    ></x-option-selector>

    @if($requests->count() === 0)
        <p class="h5 mt-2">
            Результаты не найдены
        </p>
    @else
        <div class="table-responsive-xl">
            <table class="table text-center table-fixed table-hover align-middle entityTable" id="sortableTable">

                <thead>
                <tr class="align-middle">
                    <th class="col-1" scope="col">
                        <a class="d-block"
                           href="{{ route('requests.index', ['sort' => 'number', 'direction' => 'asc']) }}"
                        >
                            Номер
                        </a>
                    </th>
                    <th class="col-1" scope="col">
                        <a class="d-block"
                           href="{{ route('requests.index', ['sort' => 'received_at', 'direction' => 'asc']) }}"
                        >
                            Поступила
                        </a>
                    </th>
                    <th class="col-2" scope="col">
                        <a class="d-block"
                           href="{{ route('requests.index', ['sort' => 'customer', 'direction' => 'asc']) }}"
                        >
                            Заказчик
                        </a>
                    </th>
                    <th class="col-2" scope="col">
                        <a class="d-block"
                           href="{{ route('requests.index', ['sort' => 'object', 'direction' => 'asc']) }}"
                        >
                            Объект
                        </a>
                    </th>

                    <th class="col-2" scope="col">
                        <a class="d-block"
                           href="{{ route('requests.index', ['sort' => 'equipment', 'direction' => 'asc']) }}"
                        >
                            Номенклатура
                        </a>
                    </th>

                    <th class="col-1" scope="col">
                        <a class="d-block"
                           href="{{ route('requests.index', ['sort' => 'status_id', 'direction' => 'asc']) }}"
                        >
                            Статус
                        </a>
                    </th>

                    <th class="col-1" scope="col">
                        <a class="d-block"
                           href="{{ route('requests.index', ['sort' => 'prospect', 'direction' => 'asc']) }}"
                        >
                            Перспективность
                        </a>
                    </th>
                    <th class="col-1" scope="col"></th>
                </tr>
                </thead>

                <tbody>
                @foreach($requests as $request)
                    <tr>
                        <td class="text-truncate max-w-100 clickable"
                            data-bs-toggle="collapse" data-bs-target="#request_{{$request->id}}">
                            {{ $request->received_at->format('Y') . '-' . $request->number }}
                        </td>
                        <td class="text-truncate max-w-125 clickable"
                            data-bs-toggle="collapse" data-bs-target="#request_{{$request->id}}">
                            {{ $request->received_at->format('d.m.Y') }}
                        </td>
                        <td class="text-truncate max-w-200 clickable"
                            data-bs-toggle="collapse" data-bs-target="#request_{{$request->id}}">
                            {{ $request->customer->name }}
                        </td>
                        <td class="text-truncate max-w-200 clickable"
                            data-bs-toggle="collapse" data-bs-target="#request_{{$request->id}}">
                            {{ $request->object }}
                        </td>
                        <td class="text-truncate max-w-200 clickable"
                            data-bs-toggle="collapse" data-bs-target="#request_{{$request->id}}">
                            {{ $request->equipment }}
                        </td>
                        <td class="clickable"
                            data-bs-toggle="collapse" data-bs-target="#request_{{$request->id}}">
                        <span class="badge statusBadge
                        @switch($request->status->name)
                            @case('новая') statusBadge_new
                            @break
                            @case('уточнение') statusBadge_awaiting-response
                            @break
                            @case('отменена') statusBadge_cancelled
                            @break
                            @case('в обработке') statusBadge_in-progress
                            @break
                            @case('ответ отправлен') statusBadge_completed
                            @break
                            @case('заказ получен') statusBadge_success
                            @break
                        @endswitch
                        ">
                                {{ $request->status->name }}
                            </span>
                        </td>
                        <td class="clickable"
                            data-bs-toggle="collapse" data-bs-target="#request_{{$request->id}}">
                            @if($request->prospect !== 0)
                                @for($i = 0; $i < $request->prospect; $i++)
                                    <i class='bx bxs-star'></i>
                                @endfor
                            @else
                                <i class='bx bxs-trash bx-sm'></i>
                            @endif
                        </td>

                        <td class="min-w-130 text-center">
                            <a href="{{ route('requests.edit', $request->id) }}">
                                <x-edit-icon></x-edit-icon>
                            </a>
                        </td>
                    </tr>
                    <tr class="hiddenRow">
                        <td colspan="12">
                            <div class="collapse" id="request_{{$request->id}}">
                                <div class="d-flex justify-content-center">
                                    <div class="entityTable__fullInfo">
                                        <div class="row gx-3">
                                            <div class="col-6">

                                                <div class="entityTable__infoBlock mb-3">
                                                    <div class="row mb-2">
                                                        <div class="col-4 entityTable__fieldName">
                                                            Номер:
                                                        </div>
                                                        <div class="col-8">
                                                            {{ $request->received_at->format('Y') . '-' . $request->number  }}
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-4 entityTable__fieldName">
                                                            Дата поступления:
                                                        </div>
                                                        <div class="col-8">
                                                            {{ $request->received_at->format('d.m.Y') }}
                                                        </div>
                                                    </div>

                                                    @if($request->answered_at)
                                                        <div class="row mt-2">
                                                            <div class="col-4 entityTable__fieldName">
                                                                Дата ответа:
                                                            </div>
                                                            <div class="col-8">
                                                                {{ $request->answered_at->format('d.m.Y') }}
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="entityTable__infoBlock mb-3">
                                                    <div class="row mb-2">
                                                        <div class="col-4 entityTable__fieldName">
                                                            Объект:
                                                        </div>
                                                        <div class="col-8 entityTable__fieldValue">
                                                            {{ $request->object }}
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-4 entityTable__fieldName">
                                                            Номенклатура:
                                                        </div>
                                                        <div class="col-8 entityTable__fieldValue">
                                                            {{ $request->equipment }}
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="entityTable__infoBlock">

                                                    <div class="row">
                                                        <div class="col-4 entityTable__fieldName">
                                                            Заказчик:
                                                        </div>
                                                        <div class="col-8">
                                                            <a href="{{ route('customers.show', $request->customer->id) }}">
                                                                {{ $request->customer->name }}
                                                            </a>
                                                        </div>
                                                    </div>

                                                    @if($request->customerEmployee)

                                                        @if($request->customerEmployee->name)
                                                            <div class="row mt-2">
                                                                <div class="col-4 entityTable__fieldName">
                                                                    Контактное лицо:
                                                                </div>
                                                                <div class="col-8">
                                                                    {{ $request->customerEmployee->name }}
                                                                </div>
                                                            </div>
                                                        @endif

                                                        @if($request->customerEmployee->post)
                                                            <div class="row mt-2">
                                                                <div class="col-4 entityTable__fieldName">
                                                                    Должность:
                                                                </div>
                                                                <div class="col-8">
                                                                    {{ $request->customerEmployee->post }}
                                                                </div>
                                                            </div>
                                                        @endif

                                                        @if($request->customerEmployee->email)
                                                            <div class="row mt-2">
                                                                <div class="col-4 entityTable__fieldName">
                                                                    Email:
                                                                </div>
                                                                <div class="col-8">
                                                                    <a href="mailto:{{$request->customerEmployee->email}}">
                                                                        {{ $request->customerEmployee->email }}
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        @endif

                                                        @if($request->customerEmployee->phone)
                                                            <div class="row mt-2">
                                                                <div class="col-4 entityTable__fieldName">
                                                                    Телефон:
                                                                </div>
                                                                <div class="col-8">
                                                                    <a href="tel:{{$request->customerEmployee->phone}}">
                                                                        {{ $request->customerEmployee->phone->formatInternational() }}
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        @endif

                                                    @endif
                                                </div>

                                                @if($request->projectOrganization)
                                                    <div class="entityTable__infoBlock mt-3">
                                                        <div class="row">
                                                            <div class="col-4 entityTable__fieldName">
                                                                Проектная организация:
                                                            </div>
                                                            <div class="col-8">
                                                                <a href="{{ route('customers.show', $request->projectOrganization->id) }}">
                                                                    {{ $request->projectOrganization->name }}
                                                                </a>
                                                            </div>
                                                        </div>

                                                        @if($request->projectOrganizationEmployee)

                                                            @if($request->projectOrganizationEmployee->name)
                                                                <div class="row mt-2">
                                                                    <div class="col-4 entityTable__fieldName">
                                                                        Контактное лицо:
                                                                    </div>
                                                                    <div class="col-8">
                                                                        {{ $request->projectOrganizationEmployee->name }}
                                                                    </div>
                                                                </div>
                                                            @endif

                                                            @if($request->projectOrganizationEmployee->post)
                                                                <div class="row mt-2">
                                                                    <div class="col-4 entityTable__fieldName">
                                                                        Должность:
                                                                    </div>
                                                                    <div class="col-8">
                                                                        {{ $request->projectOrganizationEmployee->post }}
                                                                    </div>
                                                                </div>
                                                            @endif

                                                            @if($request->projectOrganizationEmployee->email)
                                                                <div class="row mt-2">
                                                                    <div class="col-4 entityTable__fieldName">
                                                                        Email:
                                                                    </div>
                                                                    <div class="col-8">
                                                                        <a href="mailto:{{$request->projectOrganizationEmployee->email}}">
                                                                            {{ $request->projectOrganizationEmployee->email }}
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            @endif

                                                            @if($request->projectOrganizationEmployee->phone)
                                                                <div class="row mt-2">
                                                                    <div class="col-4 entityTable__fieldName">
                                                                        Телефон:
                                                                    </div>
                                                                    <div class="col-8">
                                                                        <a href="tel:{{$request->projectOrganizationEmployee->phone}}">
                                                                            {{ $request->projectOrganizationEmployee->phone->formatInternational() }}
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            @endif

                                                        @endif
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-6">

                                                <div class="entityTable__infoBlock mb-3">
                                                    <div class="row mb-2">
                                                        <div class="col-4 entityTable__fieldName">
                                                            Статус:
                                                        </div>
                                                        <div class="col-8">
                                                            {{ $request->status->name }}
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-4 entityTable__fieldName">
                                                            Перспективность:
                                                        </div>
                                                        <div class="col-8">
                                                            @if($request->prospect !== 0)
                                                                @for($i = 0; $i < $request->prospect; $i++)
                                                                    <i class='bx bxs-star'></i>
                                                                @endfor
                                                            @else
                                                                <i class='bx bxs-trash bx-sm'></i>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    @if($request->expected_order_date)
                                                        <div class="row mt-2">
                                                            <div class="col-4 entityTable__fieldName">
                                                                Ожидаемая дата заказа:
                                                            </div>
                                                            <div class="col-8">
                                                                {{ $request->expected_order_date->format('d.m.Y') }}
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @if($request->comment)
                                                        <div class="row mt-2">
                                                            <div class="col-4 entityTable__fieldName">
                                                                Комментарий:
                                                            </div>
                                                            <div class="col-8 entityTable__fieldValue">
                                                                {{ $request->comment }}
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="entityTable__infoBlock mb-3">
                                                    <div class="row mb-1">
                                                        <div class="col-6 col-lg-4 entityTable__fieldName">
                                                            Создана:
                                                        </div>
                                                        <div class="col-6 col-lg-8">
                                                            {{ $request->created_at }}
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-6 col-lg-4 entityTable__fieldName">
                                                            Пользователем:
                                                        </div>
                                                        <div class="col-6 col-lg-8">
                                                            {{ $request->createdByUser->name }}
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="entityTable__infoBlock">
                                                    <div class="row mb-1">
                                                        <div class="col-6 col-lg-4 entityTable__fieldName">
                                                            Обновлена:
                                                        </div>
                                                        <div class="col-6 col-lg-8">
                                                            {{ $request->updated_at }}
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-6 col-lg-4 entityTable__fieldName">
                                                            Пользователем:
                                                        </div>
                                                        <div class="col-6 col-lg-8">
                                                            {{ $request->updatedByUser->name }}
                                                        </div>
                                                    </div>
                                                </div>
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
                {{ $requests->links() }}
            </div>
        </div>
    @endif
@endsection
