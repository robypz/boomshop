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
                                <i class="bi bi-cash-coin text-white fs-4"></i>
                            </div>

                        </div>
                        <div class="col-11 text-center">
                            <b class="text-white fs-4">Actualizar Valuación</b>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{route('valuation.update')}}" method="post">
                        @csrf

                        <input type="text" name="valuation_id" value="{{$valuation->id}}" hidden>

                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" name="name" value="{{$valuation->name}}" class="form-control">

                        <label for="value" class="form-label">Valor</label>
                        <input type="number" name="value" step="0.01" value="{{$valuation->value}}" class="form-control">
                        <div class="mt-3 text-center">
                            <input type="submit" value="Actualizar" class="btn btn-warning">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


</div>

@endsection
