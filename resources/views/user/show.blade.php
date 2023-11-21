@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center align-items-center py-4">
        <div class="card recharge-data">
            <div class="card-header recharge-data-header fs-4 text-center">
                Datos de usuario
            </div>
            <div class="card-body">
                <p><span class="fw-bold">Nombre:</span> {{ $user->name }}</p>
                <p><span class="fw-bold">Apellido:</span> {{ $user->last_name }}</p>
                <p><span class="fw-bold">Correo:</span> {{ $user->email }}</p>
                <p><span class="fw-bold">Rol:</span>
                    @foreach ($user->roles as $role)
                        {{ $role->name }}
                    @endforeach
                </p>


            </div>
        </div>
    </div>
@endsection
