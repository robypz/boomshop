@extends('layouts.app')

@section('content')
    <div class="container py-4">

        <div class="row flex-row d-flex justify-content-center">
            <div class="col col-12 col-lg-6">
                <div class="card recharge-data">
                    <div class="card-header recharge-data-header">
                        <div class="row">
                            <div class="col-1">
                                <div class="fs-4 icon-bg">
                                    <i class="bi bi-credit-card text-white fs-4"></i>
                                </div>

                            </div>
                            <div class="col-11 text-center">
                                <b class="text-white fs-4">Actualizar Método de Pago</b>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('paymentMethod.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="number" hidden name="id" value="{{ $paymentMethod->id }}">
                            <div class="mb-3">
                                <label for="method" class="form-label">Metodo</label>
                                <input class="form-control" type="text" id="method" name="method" value="{{ $paymentMethod->method }}">
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Imagen</label>
                                <input type="file" class="form-control" name="image" value="{{ $paymentMethod->image }}">
                            </div>

                            <div class="mb-3">
                                <label for="available" class="form-label">Disponible</label>
                                <select class="form-select" name="available" id="available">
                                    <option value="{{ $paymentMethod->available }}" selected>
                                    @if ($paymentMethod->available)
                                        Si
                                    @else
                                        No
                                    @endif</option>
                                    <option value="1">Si</option>
                                    <option value="0">No</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="valuation_id" class="form-label">Valuación</label>
                                <select class="form-select" name="valuation_id" id="">
                                    <option value="{{ $paymentMethod->valuation->id }}" selected>{{ $paymentMethod->valuation->name }}</option>
                                    @foreach ($valuations as $valuation)
                                        <option value="{{ $valuation->id }}">{{ $valuation->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-warning">Actualizar</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
