@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card recharge-data">
                <div class="card-header recharge-data-header">
                    <div class="row">
                        <div class="col-1">
                            <div class="fs-4 icon-bg">
                                <i class="bi bi-database-add boom-color-lightgray fs-4"></i>
                            </div>

                        </div>
                        <div class="col-10 text-center">
                            <b class=" fs-4">Agregar Categoría</b>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('category.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        <div class="row mb-0">
                            <div class="col text-center mt-3">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Guardar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
