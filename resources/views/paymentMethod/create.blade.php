@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row flex-row d-flex justify-content-center">
            <div class="col-12 col-lg-6">
                <div class="card recharge-data">
                    <div class="card-header recharge-data-header">
                        <div class="row">
                            <div class="col-1">
                                <div class="fs-4 icon-bg">
                                    <i class="bi bi-wallet-fill text-white fs-4"></i>
                                </div>

                            </div>
                            <div class="col-11 text-center">
                                <b class="text-white fs-4">Agregar Método de Pago</b>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('paymentMethod.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <label for="method" class="form-label">Nombre</label>
                            <input class="form-control mb-3" type="text" name="method" required>

                            <label for="image" class="form-label">Imagen</label>
                            <input type="file" name="image" class="form-control mb-3" required>

                            <label for="available" class="form-label">Disponible</label>
                            <select name="available" id="available" class="form-select mb-3" required>

                                <option value="1">Si</option>
                                <option value="0">No</option>

                            </select>

                            <label for="valuation_id" class="form-label">Valuacion</label>
                            <select name="valuation_id" id="valuation_id" class="form-select mb-3">
                                @foreach ($valuations as $valuation)
                                    <option value="{{ $valuation->id }}">{{ $valuation->name }}</option>
                                @endforeach
                            </select>
                            <div class="text-center">

                                <button class="btn btn-primary" type="submit" name="save" id="save">
                                    <b>Guardar</b>
                                </button>

                            </div>


                        </form>
                    </div>


                </div>
            </div>
        </div>


    </div>
@endsection
