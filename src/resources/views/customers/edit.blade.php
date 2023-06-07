@extends('layouts.app')

@section('title', 'Редактирование заказчика')

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
                                <input id="name" name="name" type="text"
                                       class="form-control @error('name') is-invalid @enderror" autocomplete="off"
                                       value="{{ $customer->name }}" required autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="fullName" class="col-md-4 col-form-label text-md-end">
                                Полное имя
                            </label>
                            <div class="col-md-6">
                                <input id="fullName" name="full_name" type="text"
                                       class="form-control @error('full_name') is-invalid @enderror" autocomplete="off"
                                       required value="{{ $customer->full_name }}">
                                @error('full_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="role" class="col-md-4 col-form-label text-md-end">Тип</label>
                            <div class="col-md-6">
                                <select id="role" name="customer_type_id"
                                        class="form-select @error('role_id') is-invalid @enderror">
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

                        <div class="row mb-3">
                            <label for="website" class="col-md-4 col-form-label text-md-end">
                                Сайт
                            </label>
                            <div class="col-md-6">
                                <input id="website" name="website" type="url"
                                       class="form-control @error('website') is-invalid @enderror" autocomplete="off"
                                       value="{{ $customer->website }}">
                                @error('website')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="contact_person" class="col-md-4 col-form-label text-md-end">
                                Контактное лицо
                            </label>
                            <div class="col-md-6">
                                <input id="contact_person" name="contact_person" type="text" autocomplete="off"
                                       class="form-control @error('contact_person') is-invalid @enderror"
                                       value="{{ $customer->contact_person }}">
                                @error('contact_person')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">
                                Email
                            </label>
                            <div class="col-md-6">
                                <input id="email" name="email" type="email" autocomplete="off"
                                       class="form-control @error('email') is-invalid @enderror"
                                       value="{{ $customer->email }}">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-end">
                                Телефон
                            </label>
                            <div class="col-md-6">
                                <input id="phone" name="phone" type="tel"
                                       class="form-control @error('phone') is-invalid @enderror"
                                       autocomplete="off" placeholder="включая код страны (+7 или иной код)"
                                       value="{{ $customer->phone }}">
                                @error('phone')
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
