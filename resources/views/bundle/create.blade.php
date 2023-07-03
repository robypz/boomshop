@extends('layouts.app')

@section('content')
    <div class="container py-4">


        @if(session('message'))
            <div class="alert alert-primary alert-dismissible fade show mb-5" role="alert">
                {{session('message')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif



        <div class="row flex-row d-flex justify-content-center">
            <div class="col col-lg-6">
                <div class="card recharge-data">
                    <div class="card-header recharge-data-header">
                        <div class="row">
                            <div class="col-1">
                                <div class="fs-4 icon-bg">
                                    <i class="bi bi-plus-square text-white fs-4"></i>
                                </div>

                            </div>
                            <div class="col-10 text-center">
                                <b class="text-white fs-4">Agregar Paquete</b>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('bundle.store') }}">
                            @csrf
                            <label for="product_id" class="form-label">Producto</label>
                            <select name="product_id" id="" required class="form-select mb-4">
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                            <label for="content" class="form-label">Contenido</label>
                            <input type="text" name="content" class="form-control" required>

                            <label for="availability" class="form-label">Disponible</label>
                            <select name="availability" id="" required class="form-control mb-4">
                                <option value="1">Si</option>
                                <option value="0">No</option>
                            </select>

                            <label for="price" class="form-label">Precio</label>
                            <input type="number" name="price" step="0.01" min="1.00" class="form-control mb-4">

                            <label for="discount" class="form-label">Descuento</label>
                            <input type="number" name="discount" min="0" max="100" step="1" required
                                class="form-control mb-4">

                            <div class="text-center mt-2">
                                <button type="submit" class="form-control w-50 btn btn-primary">Guardar</button>
                            </div>


                        </form>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
