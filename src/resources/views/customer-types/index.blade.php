@extends('layouts.admin')

@section('content')
    <x-page-title title="Типы заказчиков"></x-page-title>

    @can('create', \App\Models\CustomerType::class)
        <a href="{{ route('customer-types.create') }}"
        >
            <button type="button" class="btn btn-success">Добавить тип</button>
        </a>
    @endcan
    <div class="table-responsive">
        <table class="table text-center table-fixed align-middle entity-table" id="sortableTable">

            <thead>
            <tr class="align-middle">
                <th class="col-2" scope="col">
                    <a class="d-block"
                       href="{{ route('customer-types.index', ['sort' => 'name', 'direction' => 'asc']) }}"
                    >
                        Наименование
                    </a>
                </th>
                <th class="col-2" scope="col">
                    <a class="d-block"
                       href="{{ route('customer-types.index', ['sort' => 'created_at', 'direction' => 'asc']) }}"
                    >
                        Дата создания
                    </a>
                </th>
                <th class="col-1" scope="col"></th>
            </tr>
            </thead>

            <tbody>
            @foreach($customerTypes as $type)
                <tr>
                    <td>{{ $type->name }}</td>
                    <td>{{ $type->created_at->format('Y-m-d') }}</td>
                    <td class="text-start">
                        @can('update', $type)
                            <a href="{{ route('customer-types.edit', $type->id) }}">
                                <x-edit-icon></x-edit-icon>
                            </a>
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>
        <div>
            {{ $customerTypes->links() }}
        </div>
    </div>

@endsection


