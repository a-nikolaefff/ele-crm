@extends('layouts.app')

@section('content')
    <x-page-title title="Заказчики"></x-page-title>
    <div class="mb-3">
        <a href="{{ route('customers.create') }}"
        >
            <button type="button" class="btn btn-success">Добавить компанию</button>
        </a>
    </div>

    <div class="row mb-3">
        <div class="col-12 col-sm-9 col-lg-6">
            <x-search-form
                :value="request()->search"
                placeholder="Поиск по имени или полному имени"
            ></x-search-form>
        </div>
    </div>

    <x-option-selector
        :url="route('customers.index')"
        parameter-name="customer_type_id"
        :options="$types"
        passing-property='id'
        displaying-property='name'
        all-options-selector='Любой тип'
    ></x-option-selector>

    <div class="table-responsive">
        <table class="table text-center table-fixed align-middle entity-table" id="sortableTable">

            <thead>
            <tr class="align-middle">
                <th class="col-2" scope="col">
                    <a class="d-block"
                       href="{{ route('customers.index', ['sort' => 'name', 'direction' => 'asc']) }}"
                    >
                        Имя
                    </a>
                </th>
                <th class="col-4" scope="col">
                    <a class="d-block"
                       href="{{ route('customers.index', ['sort' => 'full_name', 'direction' => 'asc']) }}"
                    >
                        Полное имя
                    </a>
                </th>
                <th class="col-3" scope="col">
                    <a class="d-block"
                       href="{{ route('customers.index', ['sort' => 'customer_type_id', 'direction' => 'asc']) }}"
                    >
                        Тип
                    </a>
                </th>
                <th class="col-1" scope="col"></th>
            </tr>
            </thead>

            <tbody>
            @foreach($customers as $customer)
                <tr>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->full_name }}</td>
                    <td>
                        @if($customer->type)
                            {{ $customer->type->name }}
                        @else
                            не задан
                        @endif


                        </td>
                    <td class="text-start">
                            <a href="{{ route('customers.edit', $customer->id) }}">
                                <x-edit-icon></x-edit-icon>
                            </a>
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>
        <div>
            {{ $customers->links() }}
        </div>
    </div>
@endsection
