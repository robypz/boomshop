@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="text-center">
            <h2>Recargas en proceso</h2>
            <hr>
        </div>
        @if ($orders)
            <div class="row row-cols-1 row-cols-md-4 ">
                @foreach ($orders as $order)
                    <a href="{{ route('order.show', ['id' => $order->id]) }}">
                        <div class="col">
                            <div class="card mb-4 recharge-data">

                                <div class="card-header recharge-data-header">
                                    <div class="row">
                                        <div class="col-2">
                                            <div class="fs-6 icon-bg">
                                                <i class="bi bi-bag text-white fs-6"></i>
                                            </div>

                                        </div>
                                        <div class="col-10 text-center">
                                            <b class="text-white fs-6">{{ $order->bundle->product->name }}</b>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-2">
                                    <div class="row">
                                        <div class="col">
                                            ID de Recarga:
                                        </div>
                                        <div class="col text-white">
                                            {{ $order->id }}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            Estatus:
                                        </div>
                                        @if ($order->orderStatus->status == 'Exitoso')
                                            <div class="col text-success">
                                                {{ $order->orderStatus->status }}
                                            </div>
                                        @elseif ($order->orderStatus->status == 'Pendiente')
                                            <div class="col text-warning">
                                                {{ $recharge->orderStatus->status }}
                                            </div>
                                        @elseif ($order->orderStatus->status == 'Procesando')
                                            <div class="col text-info">
                                                {{ $order->orderStatus->status }}
                                            </div>
                                        @else
                                            <div class="col text-danger">
                                                {{ $order->orderStatus->status }}
                                            </div>
                                        @endif


                                    </div>
                                    <!--Bundle -->
                                    <div class="row">
                                        <div class="col">
                                            Paquete:
                                        </div>
                                        <div class="col text-white">
                                            {{ $order->bundle->content }}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            Precio:
                                        </div>
                                        <div class="col text-white">
                                            {{ $order->bundle->price }} $
                                        </div>
                                    </div>
                                    <!--Payment -->
                                    <div class="row">
                                        <div class="col">
                                            ID de Pago:
                                        </div>
                                        <div class="col text-white">
                                            {{ $order->payment->id }}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            Metodo de pago:
                                        </div>
                                        <div class="col text-white">
                                            {{ $order->payment->paymentMethod->method }}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            Monto:
                                        </div>
                                        <div class="col text-white">
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

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <p>
                No hay nada que mostrar aquí
            </p>
        @endif
    </div>
@endsection
