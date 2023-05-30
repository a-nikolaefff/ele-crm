@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">

                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <div>
                                Редактирование заказчика
                            </div>
                        </div>
                        <div>
                            <x-delete-modal-button question="Вы уверены, что хотите данного заказчика?
                            Это действие также удалит все заявки данного заказчика"
                                                   :route="route('customers.destroy', $customer->id)"/>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    @if (session('status'))
                        <x-alert type="success" :message="session('status')"/>
                    @endif

                    <form method="POST" action="{{ route('customers.update', $customer->id) }}">
                        @method('PUT')
                        @csrf
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">
                                Имя
                            </label>
                            <div class="col-md-6">
                                <input id="name" type="text"
                                       class="form-control @error('name') is-invalid @enderror" name="name"
                                       value="{{ $customer->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">
                                Полное имя
                            </label>
                            <div class="col-md-6">
                                <input type="text"
                                       class="form-control @error('name') is-invalid @enderror" name="full_name"
                                       value="{{ $customer->full_name }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="role" class="col-md-4 col-form-label text-md-end">Тип</label>
                            <div class="col-md-6">
                                <select class="form-select @error('role_id') is-invalid @enderror"
                                        name="customer_type_id">
                                    <option value="">не задан</option>
                                    @foreach($types as $type)
                                        <option
                                            value="{{ $type->id }}" {{ $customer->customer_type_id == $type->id ? 'selected' : '' }}>
                                            {{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('role_id')
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
