@extends('layouts.app')

@section('content')
    <div class="container d-flex align-items-center justify-content-center">
        <div class="card recharge-data">
            <div class="card-header recharge-data-header text-center">
                {{ $product->name }}
            </div>
            <div class="card-body">
                <form action="{{ route('product.update', ['id' => $product->id]) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="available" class="form-label">Disponibilidad</label>
                        </div>
                        <div class="col-12 mb-3">
                            <select class="form-select" name="available" id="available">
                                <option value="1" selected>Si</option>
                                <option value="0" selected>No</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="available" class="form-label">Compo personalizable</label>
                        </div>
                        <div class="col-12 mb-3">
                            <input class="form-control" type="text" name="customizable_field" value="{{$product->customizable_field}}">
                        </div>
                        <div class="col mb-3 text-center">
                            <input type="submit" value="Actualizar" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
