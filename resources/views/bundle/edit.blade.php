@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row flex-row d-flex justify-content-center">
        <div class="col col-lg-6">
            <div class="card recharge-data">
                <div class="card-header recharge-data-header">
                    <div class="row">
                        <div class="col-1">
                            <div class="fs-4 icon-bg">
                                <i class="bi bi-pen text-white fs-4"></i>
                            </div>

                        </div>
                        <div class="col-11 text-center">
                            <b class="text-white fs-4">Editar Paquete</b>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('bundle.update') }}">
                        @csrf
                        <label for="id" class="form-label">ID</label>
                        <input type="text" name="id" value="{{$bundle->id}}" class="form-control mb-4" required readonly>

                        <label for="game_id" class="form-label">Juego</label>
                        <input type="text" name="game_id" value="{{$bundle->game->name}}" class="form-control mb-4" required readonly>

                        <label for="content" class="form-label">Contenido</label>
                        <input type="text" name="content" value="{{$bundle->content}}" class="form-control mb-4" required>

                        <label for="availability" class="form-label">Disponible</label>
                        <select name="availability" id="" required class="form-control mb-4">
                            <option value="{{$bundle->availability}}" selected>Seleccione</option>
                            <option value="1">Si</option>
                            <option value="0">No</option>
                        </select>

                        <label for="price" class="form-label">Precio</label>
                        <input type="number" name="price" step="0.01" min="1.00" value="{{$bundle->price}}" class="form-control mb-4" required>

                        <label for="discount" class="form-label">Descuento</label>
                        <input type="number" name="discount" min="0" max="100" step="1" value="{{$bundle->discount}}" class="form-control mb-4" required>
                        <div class="mt-3 text-center">
                            <button type="submit" class="btn btn-primary w-50"><b>Guardar</b></button>
                        </div>


                    </form>
                </div>

            </div>
        </div>

    </div>
</div>

@endsection
