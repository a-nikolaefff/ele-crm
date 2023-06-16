@extends('layouts.app')

@section('title', 'Заказчики')

@section('content')
    <x-page-title title="Заказчики"></x-page-title>

    <x-error-messages></x-error-messages>

    <div class="mb-3">
        <a href="{{ route('customers.create') }}"
        >
            <button type="button" class="btn btn-success">Создать заказчика</button>
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
        all-options-selector='любой тип'
        not-specified-option-selector="не задан"
    ></x-option-selector>

    @if($customers->count() === 0)
        <p class="h5 mt-2">
            Результаты не найдены
        </p>
    @else

        <div class="table-responsive-xl">
            <table class="table text-center table-fixed table-hover align-middle entityTable" id="sortableTable">

                <thead>
                <tr class="align-middle">
                    <th class="col-4" scope="col">
                        <a class="d-block"
                           href="{{ route('customers.index', ['sort' => 'name', 'direction' => 'asc']) }}"
                        >
                            Имя
                        </a>
                    </th>
                    <th class="col-5" scope="col">
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
                </tr>
                </thead>

                <tbody>
                @foreach($customers as $customer)
                    <tr class="clickable" onclick="window.location='{{ route('customers.show', $customer->id) }}';">
                        <td>
                                {{ $customer->name }}
                        </td>
                        <td>
                            {{ $customer->full_name }}
                        </td>
                        <td>
                            @if($customer->type)
                                {{ $customer->type->name }}
                            @else
                                не задан
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
            <div>
                {{ $customers->links() }}
            </div>
        </div>
    @endif
@endsection
