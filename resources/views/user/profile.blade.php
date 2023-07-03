@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col">
                <div class="card recharge-data h-100">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-1">
                                <i class="bi bi-person-circle fs-3"></i>
                            </div>
                            <div class="col fs-3 boom-color-yellow fw-bold">
                                {{ $user->nick }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                Correo: <span class="fw-bold">{{ $user->email }}</span>
                            </div>
                            <div class="col">
                                <i class="bi bi-shield-fill-check text-success"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col">
                <div class="card recharge-data h-100"">
                    <div class="card-body">
                        <div class="row ">
                            <div class="col fs-3 text-center mb-3 boom-color-yellow fw-bold">
                                Ordenes
                            </div>
                        </div>

                        <div class="row">
                            <div class="col text-center ">
                                {{ count($user->orders) }}
                                <br>
                                <hr class="mx-3">
                                <span class="fw-bold">Totales</span>

                            </div>
                            <div class="col text-center">
                                {{ $pendingOrders }}
                                <br>
                                <hr class="mx-3">
                                <span class="fw-bold">Pendientes</span>

                            </div>
                            <div class="col text-center">
                                {{ $successOrders }}
                                <br>
                                <hr class="mx-3">
                                <span class="fw-bold">
                                    Exitosas
                                </span>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
