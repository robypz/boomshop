@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="text-center">
            <h2 class="footer-title">Historial de Compras</h2>
            <hr>
        </div>
        @if ($orders)
            <div class="row">
                @foreach ($orders as $order)
                    <div class="col col col-12 col-sm-6 col-md-6 col-lg-4">
                        <div class="card mb-4 recharge-data">

                            <div class="card-header recharge-data-header">
                                <div class="row">
                                    <div class="col-1">
                                        <div class="fs-6 icon-bg">
                                            <i class="bi bi-bag boom-color-lightgray fs-6"></i>
                                        </div>

                                    </div>
                                    <div class="col-11 text-center">
                                        <b class="fs-5">{{ $order->bundle->product->name }}</b>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body min-text boom-color-lightgray">
                                <div class="row mb-2">
                                    <div class="col-5">
                                        <div class="row">
                                            <div class="col">
                                                ID de Recarga
                                            </div>
                                            <div class="col-1">
                                                :
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col  fw-bold">
                                        B{{ $order->id }}
                                    </div>
                                </div>

                                <div class="row mb-2"">
                                    <div class="col-5">
                                        <div class="row">
                                            <div class="col">
                                                Estado del Pedido
                                            </div>
                                            <div class="col-1">
                                                :
                                            </div>
                                        </div>

                                    </div>
                                    @if ($order->orderStatus->status == 'Exitoso')
                                        <div class="col  text-center">
                                            <div class="rounded-pill bg-success w-75 fw-bold">
                                                {{ $order->orderStatus->status }}
                                            </div>

                                        </div>
                                    @elseif ($order->orderStatus->status == 'Pendiente')
                                        <div class="col text-center">
                                            <div class="rounded-pill bg-warning w-75 fw-bold boom-color-darkgray">
                                                {{ $order->orderStatus->status }}
                                            </div>
                                        </div>
                                    @elseif ($order->orderStatus->status == 'Procesando')
                                        <div class="col text-center">
                                            <div class="rounded-pill bg-info w-75 fw-bold">
                                                {{ $order->orderStatus->status }}
                                            </div>
                                        </div>
                                    @else
                                        <div class="col text-center">
                                            <div class="rounded-pill bg-danger w-75 fw-bold">
                                                {{ $order->orderStatus->status }}
                                            </div>
                                        </div>
                                    @endif


                                </div>

                                <div class="row mb-2"">
                                    <div class="col-5">
                                        <div class="row">
                                            <div class="col">
                                                Fecha de Pedido:
                                            </div>
                                            <div class="col-1">
                                                :
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col fw-bold">
                                        {{ $order->created_at }}
                                    </div>


                                </div>

                                <!--Bundle -->
                                <div class="row mb-2"">
                                    <div class="col-5 ">

                                        <div class="row">
                                            <div class="col">
                                                Paquete
                                            </div>
                                            <div class="col-1">
                                                :
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col fw-bold">
                                        {{ $order->bundle->content }}
                                    </div>
                                </div>


                                <!--Payment -->
                                <div class="row mb-2"">
                                    <div class="col-5">

                                        <div class="row">
                                            <div class="col">
                                                ID de Pago
                                            </div>
                                            <div class="col-1">
                                                :
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col fw-bold">
                                        P{{ $order->payment->id }}
                                    </div>
                                </div>

                                <div class="row mb-2"">
                                    <div class="col-5">
                                        <div class="row">
                                            <div class="col">
                                                Metodo de pago
                                            </div>
                                            <div class="col-1">
                                                :
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-5 fw-bold">
                                        {{ $order->payment->paymentMethod->method }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row mb-2"">
                                    <div class="col-5">

                                        <div class="row">
                                            <div class="col text-end fs-6 boom-color-yellow fw-bold">
                                                Monto
                                            </div>
                                            <div class="col-1">
                                                :
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col fw-bold fs-6">
                                        {{ $order->payment->data['amount'] }}
                                        @if ($order->payment->paymentMethod->method == 'Pago Móvil')
                                            VES
                                        @endif
                                        @if ($order->payment->paymentMethod->method == 'Binance (USDT)')
                                            USDT
                                        @endif
                                        @if ($order->payment->paymentMethod->method == 'Zelle')
                                            USD
                                        @endif
                                        @if ($order->payment->paymentMethod->method == 'Reserve')
                                            USD
                                        @endif

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>
                No hay nada que mostrar aquí
            </p>
        @endif
    </div>
@endsection
