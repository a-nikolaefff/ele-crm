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

    <div class="table-responsive">
        <table class="table text-center table-fixed align-middle entityTable" id="sortableTable">

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
                    <td class="text-truncate max-w-100">
                        {{ $request->received_at->format('Y') . '-' . $request->number }}
                    </td>
                    <td class="text-truncate max-w-125">
                        {{ $request->received_at->format('d.m.Y') }}
                    </td>
                    <td class="text-truncate max-w-200">
                        {{ $request->customer->name }}
                    </td>
                    <td class="text-truncate max-w-200">
                        {{ $request->object }}
                    </td>
                    <td class="text-truncate max-w-200">
                        {{ $request->equipment }}
                    </td>
                    <td>
                        <span class="badge statusBadge
                        @switch($request->status->name)
                            @case('новая') statusBadge_new
                            @break
                            @case('уточнение') statusBadge_awaiting-response
                            @break
                            @case('в работе') statusBadge_in-progress
                            @break
                            @case('в работе') statusBadge_completed
                            @break
                            @case('ответ отправлен') statusBadge_completed
                            @break
                            @case('отменена') statusBadge_cancelled
                            @break
                        @endswitch
                        ">
                                {{ $request->status->name }}
                            </span>
                    </td>
                    <td>
                        @if($request->prospect !== 0)
                            @for($i = 0; $i < $request->prospect; $i++)
                                <i class='bx bxs-star'></i>
                            @endfor
                        @else
                            <i class='bx bxs-trash bx-sm'></i>
                        @endif
                    </td>

                    <td class="min-w-130 text-start">
                        <button data-bs-toggle="collapse" data-bs-target="#request_{{$request->id}}"
                                class="icon-button" type="button"
                        >
                            <x-accordion-arrow></x-accordion-arrow>
                        </button>

                        <a href="{{ route('requests.edit', $request->id) }}">
                            <x-edit-icon></x-edit-icon>
                        </a>
                    </td>
                </tr>
                <tr class="hiddenRow">
                    <td colspan="12">
                        <div class="collapse" id="request_{{$request->id}}">
                            <div class="d-flex justify-content-center">
                                <div class="entityTable__fullInfoBlock">
                                    <div class="row gx-0">
                                        <div class="col-6">

                                            <div class="row mb-2">
                                                <div class="col-4 entityTable__fieldName">
                                                    Номер
                                                </div>
                                                <div class="col-8">
                                                    {{ $request->received_at->format('Y') . '-' . $request->number  }}
                                                </div>
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col-4 entityTable__fieldName">
                                                    Дата поступления
                                                </div>
                                                <div class="col-8">
                                                    {{ $request->received_at->format('d.m.Y') }}
                                                </div>
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col-4 entityTable__fieldName">
                                                    Дата ответа
                                                </div>
                                                <div class="col-8">
                                                    @if($request->answered_at)
                                                        {{ $request->answered_at->format('d.m.Y') }}
                                                    @else
                                                        ответ не дан
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col-4 entityTable__fieldName">
                                                    Заказчик
                                                </div>
                                                <div class="col-8">
                                                    {{ $request->customer->name }}
                                                </div>
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col-4 entityTable__fieldName">
                                                    Проектная организация
                                                </div>
                                                <div class="col-8">
                                                    @if($request->projectOrganization)
                                                        {{ $request->projectOrganization->name }}
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col-4 entityTable__fieldName">
                                                    Объект
                                                </div>
                                                <div class="col-8">
                                                    {{ $request->object }}
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-4 entityTable__fieldName">
                                                    Номенклатура
                                                </div>
                                                <div class="col-8">
                                                    {{ $request->equipment }}
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-6">

                                            <div class="row mb-2">
                                                <div class="col-4 entityTable__fieldName">
                                                    Статус
                                                </div>
                                                <div class="col-8">
                                                    {{ $request->status->name }}
                                                </div>
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col-4 entityTable__fieldName">
                                                    Перспективность
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

                                            <div class="row mb-2">
                                                <div class="col-4 entityTable__fieldName">
                                                    Ожидаемая дата заказа
                                                </div>
                                                <div class="col-8">
                                                    @if($request->expected_order_date)
                                                        {{ $request->expected_order_date->format('d.m.Y') }}
                                                    @else
                                                        не задана
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col-4 entityTable__fieldName">
                                                    Комментарий
                                                </div>
                                                <div class="col-8">
                                                    {{ $request->comment }}
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <hr>

                                    <div class="entityTable__userInfoBlock">
                                        <div class="row gx-0">
                                            <div class="col-6">

                                                <div class="row mb-1">
                                                    <div class="col-6 col-lg-4 entityTable__fieldName">
                                                        Создана
                                                    </div>
                                                    <div class="col-6 col-lg-8">
                                                        {{ $request->created_at }}
                                                    </div>
                                                </div>

                                                <div class="row mb-2">
                                                    <div class="col-6 col-lg-4 entityTable__fieldName">
                                                        Пользователем
                                                    </div>
                                                    <div class="col-6 col-lg-8">
                                                        {{ $request->createdByUser->name }}
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-6">

                                                <div class="row mb-1">
                                                    <div class="col-6 col-lg-4 entityTable__fieldName">
                                                        Обновлена
                                                    </div>
                                                    <div class="col-6 col-lg-8">
                                                        {{ $request->updated_at }}
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-6 col-lg-4 entityTable__fieldName">
                                                        Пользователем
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
@endsection
