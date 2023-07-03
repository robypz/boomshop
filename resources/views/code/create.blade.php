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
                                    <i class="bi bi-percent boom-color-lightgray fs-4"></i>
                                </div>

                            </div>
                            <div class="col-10 text-center">
                                <b class=" fs-4">Agregar Código</b>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('code.store') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="code" class="col-md-4 col-form-label text-md-end">Código</label>

                                <div class="col-md-6">
                                    <input id="code" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="code"
                                        value="{{ old('code') }}" required autocomplete="code" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">


                                <p class="col-md-4 col-form-label text-md-end">Valido para:</p>


                                <div class="col-md-6">
                                    <br>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="only_for" id="all"
                                            value="true" onchange="showProducts(false)" required>
                                        <label class="form-check-label" for="all">
                                            Aplicar a todos los productos
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="only_for" id="only_for"
                                            value="false" onchange="showProducts(true)" required>
                                        <label class="form-check-label" for="only_for">
                                            Solo para para algunos productos
                                        </label>
                                    </div>
                                    <div class="row" id="products">
                                        @foreach ($products as $product)
                                            <div class="col">
                                                <div class="form-check">
                                                    <input class="form-check-input products" type="checkbox"
                                                        id="product-{{ $product->id }}" name="valid_for[]"
                                                        value="{{ $product->name }}">
                                                    <label class="form-check-label" for="product-{{ $product->id }}">
                                                        {{ $product->name }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="value" class="col-md-4 col-form-label text-md-end">Valor</label>

                                <div class="col-md-6">
                                    <input type="number" id="value" min=0 max=100
                                        class="form-control @error('value') is-invalid @enderror" name="value"
                                        value="{{ old('value') }}" required autocomplete="value" autofocus>

                                    @error('value')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="expiration_date" class="col-md-4 col-form-label text-md-end">Fecha de
                                    caducidad</label>

                                <div class="col-md-6">
                                    <input id="expiration_date" min="{{ $today }}" type="date"
                                        class="form-control @error('expiration_date') is-invalid @enderror"
                                        name="expiration_date" value="{{ old('expiration_date') }}" required
                                        autocomplete="expiration_date" autofocus>

                                    @error('expiration_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col text-center">
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
    <script>
        var products = document.getElementById('products')
        products.hidden = true;
        var check_products = document.getElementsByClassName("products");

        function showProducts(show) {

            if (show) {


                products.hidden = false;
                for (var i = 0; i < check_products.length; i++) {
                    check_products[i].checked = false;
                }

            } else {
                products.hidden = true;
                for (var i = 0; i < check_products.length; i++) {
                    check_products[i].checked = true;
                }

            }
        }
    </script>
@endsection
