@extends('layouts.app')

@section('content')

    <div class="container py-4">

        @if ($order->orderStatus->status == 'Procesando')
            @if (auth()->user()->id != $order->asist_by)
                <div class="alert alert-primary alert-dismissible fade show mb-5" role="alert">
                    Esta recarga ya esta siendo procesada por otro usuario.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        @endif

        <div class="row flex-row d-flex justify-content-center">
            <div class="col-12 col-lg-6">

                <div class="card recharge-data">
                    <div class="card-header recharge-data-header">
                        <div class="row">
                            <div class="col-1">
                                <div class="fs-4 icon-bg">
                                    <i class="bi bi-receipt boom-color-lightgray fs-5"></i>
                                </div>

                            </div>
                            <div class="col-11 text-center">
                                <b class="fs-4">{{ $order->bundle->product->name }}</b>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <p class="fs-4">Detalles de Orden</p>
                        <div class="row">

                            <div class="col-4">
                                ID del Pedido:
                            </div>
                            <div class="col-8">
                                B-{{ $order->id }}
                            </div>

                            <div class="col-4">
                                Articulo comprado:
                            </div>
                            <div class="col-8">
                                {{ $order->bundle->content }}
                            </div>
                            @if (array_key_exists('bundle_discount', $order->payment->data))
                                <div class="col-5">
                                    Descuento del paquete:
                                </div>
                                <div class="col-7">
                                    {{ $order->payment->data['bundle_discount'] }} %
                                </div>
                            @endif

                            <div class="col-4">
                                Juego:
                            </div>
                            <div class="col-8">
                                {{ $order->bundle->product->name }}
                            </div>

                            <div class="col">
                                <hr>
                            </div>
                            @if ($order->bundle->product->category->category != 'Tarjetas')
                                <div class="col-12">
                                    <p class="fs-4">Información de Cuenta</p>
                                </div>
                                @if ($order->bundle->product->need_access)
                                    <div class="col-12">
                                        <p class="fs-4">Informacion de Cuenta</p>
                                    </div>
                                    <div class="col-4">
                                        ID de usuario BOOM:
                                    </div>
                                    <div class="col-8">
                                        {{ $accountInfo['user_id'] }}
                                    </div>
                                @elseif ($order->bundle->product->need_region_id)
                                    <div class="col-4">
                                        ID de región:
                                    </div>
                                    <div class="col-8">
                                        {{ $accountInfo['region_id'] }}
                                    </div>

                                    <div class="col-4">
                                        ID de cuenta:
                                    </div>
                                    <div class="col-8">
                                        {{ $accountInfo['account_id'] }}
                                    </div>
                                @else
                                    <div
                                        class="col-4 >
                                    ID de cuenta:
                                </div>
                                <div class="col-8">
                                        {{ $accountInfo['account_id'] }}
                                    </div>
                                @endif

                                <div class="col-12">
                                    <hr>
                                </div>
                            @endif

                            <div class="col-12">
                                <p class="fs-4">Detalles de Transacción</p>
                            </div>
                            <div class="col-4">
                                ID de la transacción:
                            </div>
                            <div class="col-8">
                                P-{{ $order->payment->id }}
                            </div>

                            <div class="col-4">
                                Método de pago:
                            </div>
                            <div class="col-8">
                                {{ $order->payment->paymentMethod->method }}
                            </div>

                            @if (array_key_exists('code', $order->payment->data))
                                <div class="col-4">
                                    Codigo de descuento:
                                </div>
                                <div class="col-8">
                                    {{ $order->payment->data['code'] }}
                                </div>
                            @endif

                            @if (array_key_exists('code_discount', $order->payment->data))
                                <div class="col-4">
                                    Valor del codigo:
                                </div>
                                <div class="col-8">
                                    {{ $order->payment->data['code_discount'] }} %
                                </div>
                            @endif



                            @if ($order->payment->paymentMethod->method == 'Pago Móvil')
                                <div class="col-4">
                                    Banco:
                                </div>
                                <div class="col-8">
                                    {{ $order->payment->data['bank'] }}
                                </div>
                                <div class="col-4">
                                    Telefono:
                                </div>
                                <div class="col-8">
                                    {{ $order->payment->data['phone'] }}
                                </div>

                                <div class="col-4">
                                    Codigo de transacción:
                                </div>
                                <div class="col-8">
                                    {{ $order->payment->data['transaction_id'] }}
                                </div>

                                <div class="col-4">
                                    Monto:
                                </div>
                                <div class="col-8">
                                    {{ $order->payment->data['amount'] }}VES
                                </div>
                            @endif

                            @if ($order->payment->paymentMethod->method == 'Zelle')
                                <div class="col-4">
                                    Nombre de cuenta:
                                </div>
                                <div class="col-8">
                                    {{ $order->payment->data['name'] }}
                                </div>
                                <div class="col-4">
                                    Codigo de confirmación:
                                </div>
                                <div class="col-8">
                                    {{ $order->payment->data['confirmation_code'] }}
                                </div>

                                <div class="col-4">
                                    Monto:
                                </div>
                                <div class="col-8">
                                    {{ $order->payment->data['amount'] }} USD
                                </div>
                            @endif

                            @if ($order->payment->paymentMethod->method == 'Binance (USDT)')
                                <div class="col-4">
                                    ID de Binance:
                                </div>
                                <div class="col-8">
                                    {{ $order->payment->data['user_id'] }}
                                </div>
                                <div class="col-4">
                                    Alias de Binance:
                                </div>
                                <div class="col-8">
                                    {{ $order->payment->data['binance_alias'] }}
                                </div>

                                <div class="col-4">
                                    Numero de orden:
                                </div>
                                <div class="col-8">
                                    {{ $order->payment->data['order_id'] }}
                                </div>

                                <div class="col-4">
                                    Monto:
                                </div>
                                <div class="col-8">
                                    {{ $order->payment->data['amount'] }} USDT
                                </div>
                            @endif
                            @if ($order->payment->paymentMethod->method == 'Reserve')
                                <div class="col-4">
                                    Usuario de Reserve:
                                </div>
                                <div class="col-8">
                                    {{ $order->payment->data['reserve_user'] }}
                                </div>
                                <div class="col-4">
                                    ID de Pago:
                                </div>
                                <div class="col-8">
                                    {{ $order->payment->data['transaction_id'] }}
                                </div>
                                <div class="col-4">
                                    Monto:
                                </div>
                                <div class="col-8">
                                    {{ $order->payment->data['amount'] }} USD
                                </div>
                            @endif
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-4">
                                        Estado:
                                    </div>
                                    @if ($order->orderStatus->status == 'Exitoso')
                                        <div class="col text-success">
                                            {{ $order->orderStatus->status }}
                                        </div>
                                    @elseif ($order->orderStatus->status == 'Pendiente')
                                        <div class="col text-warning">
                                            {{ $order->orderStatus->status }}
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
                            </div>

                            @if ($order->orderStatus->status != 'Exitoso' && $order->orderStatus->status != 'Pago No Procesado')
                                <div class="col-12 mt-4">
                                    <hr>
                                    <form action="{{ route('order.update') }}" method="post">
                                        @csrf
                                        <input type="text" name="order_id" value="{{ $order->id }}" hidden>
                                        @if ($order->bundle->product->category->category == 'Tarjetas')
                                        <label for="code" class="form-label">Codigo:</label>
                                        <input type="text" class="form-control mb-3" name="code" required>
                                        @endif
                                        <label for="order_status" class="form-label">Actualizar Estado:</label>
                                        <select name="order_status" id="" required class="form-select" required>

                                            @foreach ($orderStatuses as $orderStatus)
                                                <option value="{{ $orderStatus->id }}">
                                                    {{ $orderStatus->status }}</option>
                                            @endforeach
                                        </select>
                                        <div class="text-center mt-3">
                                            <input type="submit" value="Actualizar" class="btn btn-warning">
                                        </div>

                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
