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

    <div class="table-responsive">
        <table class="table text-center table-fixed align-middle entityTable" id="sortableTable">

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

                    <td class="min-w-130 text-start">
                        <button data-bs-toggle="collapse" data-bs-target="#customer_{{$customer->id}}"
                                class="icon-button" type="button"
                        >
                            <x-accordion-arrow></x-accordion-arrow>
                        </button>

                        <a href="{{ route('customers.edit', $customer->id) }}">
                            <x-edit-icon></x-edit-icon>
                        </a>
                    </td>
                </tr>
                <tr class="hiddenRow">
                    <td colspan="12">
                        <div class="collapse" id="customer_{{$customer->id}}">
                            <div class="d-flex justify-content-center">
                                <div class="entityTable__fullInfoBlock">
                                    <div class="row gx-0">
                                        <div class="col-6">

                                            <div class="row mb-2">
                                                <div class="col-4 entityTable__fieldName">
                                                    Имя
                                                </div>
                                                <div class="col-8">
                                                    {{ $customer->name }}
                                                </div>
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col-4 entityTable__fieldName">
                                                    Полное имя
                                                </div>
                                                <div class="col-8">
                                                    {{ $customer->full_name }}
                                                </div>
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col-4 entityTable__fieldName">
                                                    Тип
                                                </div>
                                                <div class="col-8">
                                                    @if($customer->type)
                                                        {{ $customer->type->name }}
                                                    @else
                                                        не задан
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col-4 entityTable__fieldName">
                                                    Есть проектный отдел
                                                </div>
                                                <div class="col-8">
                                                    @if($customer->has_project_department)
                                                        да
                                                    @else
                                                        нет
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-4 entityTable__fieldName">
                                                    Сайт
                                                </div>
                                                <div class="col-8">
                                                    @if($customer->website)
                                                        <a href="{{ $customer->website }}" target="_blank">
                                                            {{ $customer->website }}
                                                        </a>
                                                    @else
                                                        не указан
                                                    @endif
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-6">

                                            <div class="row mb-2">
                                                <div class="col-4 entityTable__fieldName">
                                                    Контактное лицо
                                                </div>
                                                <div class="col-8">
                                                    @if($customer->contact_person)
                                                        {{ $customer->contact_person }}
                                                    @else
                                                        не указано
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="row mb-2">
                                                <div class="col-4 entityTable__fieldName">
                                                    Должность
                                                </div>
                                                <div class="col-8">
                                                    @if($customer->post)
                                                        {{ $customer->post }}
                                                    @else
                                                        не указана
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col-4 entityTable__fieldName">
                                                    Email
                                                </div>
                                                <div class="col-8">
                                                    @if($customer->email)
                                                        <a href="mailto:{{$customer->email}}">
                                                            {{ $customer->email }}
                                                        </a>
                                                    @else
                                                        не указан
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col-4 entityTable__fieldName">
                                                    Телефон
                                                </div>
                                                <div class="col-8">
                                                    @if($customer->phone)
                                                        <a href="tel:{{$customer->phone}}">
                                                            {{ $customer->phone->formatInternational() }}
                                                        </a>
                                                    @else
                                                        не указан
                                                    @endif
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
                                                        Создан
                                                    </div>
                                                    <div class="col-6 col-lg-8">
                                                        {{ $customer->created_at }}
                                                    </div>
                                                </div>

                                                <div class="row mb-2">
                                                    <div class="col-6 col-lg-4 entityTable__fieldName">
                                                        Пользователем
                                                    </div>
                                                    <div class="col-6 col-lg-8">
                                                        {{ $customer->createdByUser->name }}
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-6">

                                                <div class="row mb-1">
                                                    <div class="col-6 col-lg-4 entityTable__fieldName">
                                                        Обновлен
                                                    </div>
                                                    <div class="col-6 col-lg-8">
                                                        {{ $customer->updated_at }}
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-6 col-lg-4 entityTable__fieldName">
                                                        Пользователем
                                                    </div>
                                                    <div class="col-6 col-lg-8">
                                                        {{ $customer->updatedByUser->name }}
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
            {{ $customers->links() }}
        </div>
    </div>
@endsection
