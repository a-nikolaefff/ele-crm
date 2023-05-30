@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">

                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <div>
                                Редактирование типа заказчиков
                            </div>
                        </div>
                        <div>
                            <x-delete-modal-button question="Вы уверены, что хотите удалить данный тип?
                            У всех заказчиков с данным типом тип будет не задан"
                                                   :route="route('customer-types.destroy', $customerType->id)"/>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    @if (session('status'))
                        <x-alert type="success" :message="session('status')"/>
                    @endif

                    <form method="POST" action="{{ route('customer-types.update', $customerType->id) }}">
                        @method('PUT')
                        @csrf
                        <div class="row mb-3">

                            <label for="name" class="col-md-4 col-form-label text-md-end">
                                Наименование
                            </label>
                            <div class="col-md-6">
                                <input type="text"
                                       class="form-control @error('name') is-invalid @enderror" name="name"
                                       value="{{ $customerType->name }}" required autocomplete="name" autofocus>

                                @error('name')
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
