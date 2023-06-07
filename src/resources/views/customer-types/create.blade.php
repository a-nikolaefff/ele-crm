@extends('layouts.admin')

@section('title', 'Создание нового типа заказчиков')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">

                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <div>
                                Создание нового типа заказчиков
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('customer-types.store') }}">
                        @csrf

                        <div class="row mb-3">

                            <label for="name" class="col-md-4 col-form-label text-md-end">
                                Наименование
                            </label>
                            <div class="col-md-6">
                                <input id="name" name="name" type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       required autofocus>
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
                                    Создать тип
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
