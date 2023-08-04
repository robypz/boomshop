@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card recharge-data">
            <div class="card-header  recharge-data-header boom-color-lightgray text-center">
                <span class="ms-bold fs-5">Cerrado</span>
            </div>
            <div class="card-body rechar-data-body text-center">
                Estimado usuario, nuestros sistemas estan cerrados a partir de, {{$close_time}},<br>
                te esperamos nuevamente en nuestro horario comprendido para ser atendido.
            </div>

            <div class="card-footer text-center">
                <a href="{{route('home')}}"><button class="btn btn-primary">Volver</button></a>
            </div>
        </div>
    </div>
@endsection
