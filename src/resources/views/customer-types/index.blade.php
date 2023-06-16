@extends('layouts.admin')

@section('title', 'Типы заказчиков')

@section('content')
    <x-page-title title="Типы заказчиков"></x-page-title>

    <x-error-messages></x-error-messages>

    @can('create', \App\Models\CustomerType::class)
        <a href="{{ route('customer-types.create') }}"
        >
            <button type="button" class="btn btn-success">Создать тип</button>
        </a>
    @endcan
    <div class="table-responsive-xl">
        <table class="table text-center table-fixed table-hover align-middle entityTable" id="sortableTable">

            <thead>
            <tr class="align-middle">
                <th class="col-6" scope="col">
                    <a class="d-block"
                       href="{{ route('customer-types.index', ['sort' => 'name', 'direction' => 'asc']) }}"
                    >
                        Наименование
                    </a>
                </th>

                <th class="col-5" scope="col">
                    <a class="d-block"
                       href="{{ route('customer-types.index', ['sort' => 'is_base_type', 'direction' => 'asc']) }}"
                    >
                        Категория
                    </a>
                </th>

                <th class="col-1" scope="col"></th>
            </tr>
            </thead>

            <tbody>
            @foreach($customerTypes as $type)
                <tr>
                    <td class="clickable" data-bs-toggle="collapse" data-bs-target="#customerType_{{$type->id}}">
                        {{ $type->name }}
                    </td>
                    <td class="clickable" data-bs-toggle="collapse" data-bs-target="#customerType_{{$type->id}}">
                        @if($type->is_base_type)
                            Базовый тип CRM
                        @else
                            Пользовательский тип
                        @endif
                    </td>

                    <td class="min-w-130 text-center">
                        @can('update', $type)
                            <a href="{{ route('customer-types.edit', $type->id) }}">
                                <x-edit-icon></x-edit-icon>
                            </a>
                        @endcan
                    </td>

                </tr>

                <tr class="hiddenRow">
                    <td colspan="12">
                        <div class="collapse" id="customerType_{{$type->id}}">
                            <div class="d-flex justify-content-center">
                                <div class="entityTable__fullInfo">
                                    <div class="row gx-3">
                                        <div class="col-6">
                                            <div class="entityTable__infoBlock mb-3">
                                                <div class="row">
                                                    <div class="col-4 entityTable__fieldName">
                                                        Наименование
                                                    </div>
                                                    <div class="col-8 entityTable__fieldValue">
                                                        {{ $type->name }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="entityTable__infoBlock">
                                                <div class="row">
                                                    <div class="col-4 entityTable__fieldName">
                                                        Категория
                                                    </div>
                                                    <div class="col-8">
                                                        @if($type->is_base_type)
                                                            Базовый тип CRM
                                                        @else
                                                            Пользовательский тип
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="entityTable__infoBlock mb-3">
                                                <div class="row">
                                                    <div class="col-6 col-lg-4 entityTable__fieldName">
                                                        Создан
                                                    </div>
                                                    <div class="col-6 col-lg-8">
                                                        {{ $type->created_at }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="entityTable__infoBlock">
                                                <div class="row">
                                                    <div class="col-6 col-lg-4 entityTable__fieldName">
                                                        Обновлен
                                                    </div>
                                                    <div class="col-6 col-lg-8">
                                                        {{ $type->updated_at }}
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
            {{ $customerTypes->links() }}
        </div>
    </div>

@endsection


