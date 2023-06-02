@extends('layouts.app')

@section('content')
    <x-page-title title="Заявки"></x-page-title>
    <div class="mb-3">
        <a href="{{ route('requests.create') }}"
        >
            <button type="button" class="btn btn-success">Добавить заявку</button>
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
        <table class="table text-center table-fixed align-middle entity-table" id="sortableTable">

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
                        Получено
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
                    <td class="text-truncate max-w-200">{{ $request->object }}</td>
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

                    <td class="text-start">
                        <a href="{{ route('requests.edit', $request->id) }}">
                            <x-edit-icon></x-edit-icon>
                        </a>
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
