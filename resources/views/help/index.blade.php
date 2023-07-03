@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col">
                <h1 class="text-center"><i class="bi bi-info-circle"></i> Ayuda</h1>
            </div>
        </div>
        <div class="row row-cols-2">
            <div class="col p-4 d-flex align-items-center justify-content-center">
                <a href="{{ route('help.boom') }}">
                    <div class="help-card">
                        <div class="d-flex align-items-center justify-content-center h-100">
                            <h2 class="fw-bold">BOOM</h2>
                        </div>
                    </div>
                </a>


            </div>

            <div class="col p-4 d-flex align-items-center justify-content-center">
                <a href="{{ route('help.transactionsAndPayments') }}">
                    <div class="help-card">
                        <div class="d-flex align-items-center justify-content-center h-100">
                            <div>
                                <h2 class="text-center fs-1"><i class="bi bi-coin"></i></h2>
                                <h2 class="fw-bold">Transacciones y Pagos</h2>
                            </div>

                        </div>

                    </div>
                </a>


            </div>

            <div class="col p-4 d-flex align-items-center justify-content-center">
                <a href="{{ route('help.paymentMethods') }}">
                    <div class="help-card">

                        <div class="d-flex align-items-center justify-content-center h-100">
                            <div>
                                <h2 class="text-center fs-1"><i class="bi bi-credit-card"></i></h2>
                                <h2 class="fw-bold">Métodos de Pago</h2>
                            </div>

                        </div>

                    </div>
                </a>



            </div>

            <div class="col p-4 d-flex align-items-center justify-content-center">
                <a href="{{route('help.tutorials')}}">
                    <div class="help-card">
                        <div class="d-flex align-items-center justify-content-center h-100">
                            <div>
                                <h2 class="text-center fs-1"><i class="bi bi-collection-play-fill"></i></h2>
                                <h2 class="fw-bold">Tutoriales</h2>
                            </div>

                        </div>

                    </div>
                </a>

            </div>
        </div>
    </div>
@endsection
