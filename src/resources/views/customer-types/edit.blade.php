@extends('layouts.admin')

@section('title', 'Редактирование типа заказчиков')

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
                            У всех заказчиков этого типа, после удаления типа, не будет указан какой-либо тип."
                                                   :route="route('customer-types.destroy', $customerType->id)"/>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('customer-types.update', $customerType->id) }}">
                        @method('PUT')
                        @csrf
                        <div class="row mb-3">

                            <label for="name" class="col-md-4 col-form-label text-md-end">
                                Наименование
                            </label>
                            <div class="col-md-6">
                                <input id="name" name="name" type="text" maxlength="50"
                                       class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name', $customerType->name) }}" required
                                       aria-labelledby="nameHelpBlock"
                                       autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                <div id="nameHelpBlock" class="form-text">
                                    Обязательное поле. Не более 50 символов.
                                </div>
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
