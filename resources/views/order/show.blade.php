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
                                <div class="fs-5 icon-bg">
                                    <i class="bi bi-receipt boom-color-lightgray fs-5"></i>
                                </div>

                            </div>
                            <div class="col-11 text-center">
                                <b class="fs-5">{{ $order->bundle->product->name }}</b>
                            </div>
                        </div>
                    </div>

                    <div class="card-body min-text">
                        <p class="fs-4">Detalles de Orden</p>
                        <div class="row">

                            <div class="col-5 col-xxl-3">
                                ID del Pedido
                            </div>
                            <div class="col-1">
                                :
                            </div>
                            <div class="col-6 fw-bold ">
                                B-{{ $order->id }}
                            </div>

                            <div class="col-5 col-xxl-3 text-truncate">
                                Paquete Comprado
                            </div>
                            <div class="col-1">
                                :
                            </div>
                            <div class="col-6 fw-bold ">
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

                            <div class="col-5 col-xxl-3">
                                Producto
                            </div>
                            <div class="col-1">
                                :
                            </div>
                            <div class="col-6 fw-bold ">
                                {{ $order->bundle->product->name }}
                            </div>

                            <div class="col-12">
                                <hr>
                            </div>

                                <div class="col-12">
                                    <p class="fs-4">Información de Cuenta</p>
                                </div>
                                <div class="col-5  col-xxl-3">
                                    <span>Usuario de BOOM</span>
                                </div>
                                <div class="col-1">
                                    :
                                </div>
                                <div class="col-6 fw-bold ">
                                    <a href="{{route('user.show',['id' =>$order->user->id])}}" target="_blank" data-bs-toggle="modal" data-bs-target="#exampleModal">{{$order->user->nick}}</a>

                                      <!-- Modal -->
                                      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header recharge-data-header">
                                              <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body recharge-data">
                                                <p><span class="fw-bold">Nombre:</span> {{ $order->user->name }}</p>
                                                <p><span class="fw-bold">Apellido:</span> {{ $order->user->name }}</p>
                                                <p><span class="fw-bold">Correo:</span> {{ $order->user->name }}</p>
                                                <p><span class="fw-bold">Rol:</span>
                                                    @foreach ($order->user->roles as $role)
                                                        {{ $role->name }}
                                                    @endforeach
                                                </p>
                                            </div>
                                            <div class="modal-footer recharge-data">
                                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                </div>
                                @if ($order->bundle->product->need_access)
                                    <div class="col-12">
                                        <p class="fs-4">Informacion de Cuenta</p>
                                    </div>
                                    <div class="col-4 col-xxl-3">
                                        Teléfono:
                                    </div>
                                    <div class="col-6 fw-bold ">
                                        {{ $accountInfo['phone'] }}
                                    </div>
                                @elseif ($order->bundle->product->need_region_id)
                                    <div class="col-5 col-xxl-3">
                                        ID de región
                                    </div>
                                    <div class="col-1">
                                        :
                                    </div>
                                    <div class="col-6 fw-bold ">
                                        {{ $accountInfo['region_id'] }}
                                    </div>

                                    <div class="col-5 col-xxl-3">
                                        ID de cuenta
                                    </div>
                                    <div class="col-1">
                                        :
                                    </div>
                                    <div class="col-6 fw-bold ">
                                        {{ $accountInfo['account_id'] }}
                                    </div>
                                @elseif ($order->bundle->product->category->category != 'Tarjetas')
                                    <div class="col-5 col-xxl-3">
                                        ID de cuenta
                                    </div>
                                    <div class="col-1">
                                        :
                                    </div>
                                    <div class="col-6 fw-bold ">
                                        {{ $accountInfo['account_id'] }}
                                    </div>
                                @endif

                                <div class="col-12">
                                    <hr>
                                </div>

                            <div class="col-12">
                                <p class="fs-4">Detalles de Transacción</p>
                            </div>
                            <div class="col-5  col-xxl-3">
                                ID de Pago
                            </div>
                            <div class="col-1">
                                :
                            </div>
                            <div class="col-6 fw-bold ">
                                P-{{ $order->payment->id }}
                            </div>

                            <div class="col-5  col-xxl-3">
                                Método de pago
                            </div>
                            <div class="col-1">
                                :
                            </div>
                            <div class="col-6 fw-bold ">
                                {{ $order->payment->paymentMethod->method }}
                            </div>

                            @if (array_key_exists('code', $order->payment->data))
                                <div class="col-5">
                                    Codigo de descuento
                                </div>
                                <div class="col-1">
                                    :
                                </div>
                                <div class="col-6 fw-bold ">
                                    {{ $order->payment->data['code'] }}
                                </div>
                            @endif

                            @if (array_key_exists('code_discount', $order->payment->data))
                                <div class="col-5 ">
                                    Valor del codigo
                                </div>
                                <div class="col-1">
                                    :
                                </div>
                                <div class="col-6 fw-bold" >
                                    {{ $order->payment->data['code_discount'] }} %
                                </div>
                            @endif
                            @if ($order->payment->paymentMethod->method == 'PuntoYaBDV')
                                <div class="col-5  col-xxl-3">
                                    Description
                                </div>
                                <div class="col-1">
                                    :
                                </div>
                                <div class="col-6 fw-bold ">
                                    {{ $order->payment->data['description'] }}
                                </div>
                                <div class="col-5  col-xxl-3">
                                    Referencia
                                </div>
                                <div class="col-1">
                                    :
                                </div>
                                <div class="col-6 fw-bold ">
                                    {{ $order->payment->data['transactionId'] }}
                                </div>

                                <div class="col-5  col-xxl-3">
                                    Monto
                                </div>
                                <div class="col-1">
                                    :
                                </div>
                                <div class="col-6 fw-bold ">
                                    {{ $order->payment->data['amount'] }}VES
                                </div>
                            @endif


                            @if ($order->payment->paymentMethod->method == 'Pago Móvil')
                                <div class="col-5  col-xxl-3">
                                    Banco
                                </div>
                                <div class="col-1">
                                    :
                                </div>
                                <div class="col-6 fw-bold ">
                                    {{ $order->payment->data['bank'] }}
                                </div>
                                <div class="col-5  col-xxl-3">
                                    Telefono
                                </div>
                                <div class="col-1">
                                    :
                                </div>
                                <div class="col-6 fw-bold ">
                                    {{ $order->payment->data['phone'] }}
                                </div>

                                <div class="col-5  col-xxl-3">
                                    Referencia
                                </div>
                                <div class="col-1">
                                    :
                                </div>
                                <div class="col-6 fw-bold ">
                                    {{ $order->payment->data['transaction_id'] }}
                                </div>

                                <div class="col-5  col-xxl-3">
                                    Monto
                                </div>
                                <div class="col-1">
                                    :
                                </div>
                                <div class="col-6 fw-bold ">
                                    {{ $order->payment->data['amount'] }}VES
                                </div>
                            @endif

                            @if ($order->payment->paymentMethod->method == 'Zelle')
                                <div class="col-5  col-xxl-3">
                                    Nombre de cuenta
                                </div>
                                <div class="col-1">
                                    :
                                </div>
                                <div class="col-6 fw-bold ">
                                    {{ $order->payment->data['name'] }}
                                </div>
                                <div class="col-5  col-xxl-3 text-truncate">
                                    Codigo de confirmación
                                </div>
                                <div class="col-1">
                                    :
                                </div>
                                <div class="col-6 fw-bold ">
                                    {{ $order->payment->data['confirmation_code'] }}
                                </div>

                                <div class="col-5  col-xxl-3">
                                    Monto
                                </div>
                                <div class="col-1">
                                    :
                                </div>
                                <div class="col-6 fw-bold ">
                                    {{ $order->payment->data['amount'] }} USD
                                </div>
                            @endif

                            @if ($order->payment->paymentMethod->method == 'Binance (USDT)')
                                <div class="col-5  col-xxl-3">
                                    ID de Binance
                                </div>
                                <div class="col-1">
                                    :
                                </div>
                                <div class="col-6 fw-bold ">
                                    {{ $order->payment->data['user_id'] }}
                                </div>
                                <div class="col-5  col-xxl-3">
                                    Alias de Binance
                                </div>
                                <div class="col-1">
                                    :
                                </div>
                                <div class="col-6 fw-bold ">
                                    {{ $order->payment->data['binance_alias'] }}
                                </div>

                                <div class="col-5  col-xxl-3">
                                    Numero de orden
                                </div>
                                <div class="col-1">
                                    :
                                </div>
                                <div class="col-6 fw-bold ">
                                    {{ $order->payment->data['order_id'] }}
                                </div>

                                <div class="col-5  col-xxl-3">
                                    Monto
                                </div>
                                <div class="col-1">
                                    :
                                </div>
                                <div class="col-6 fw-bold ">
                                    {{ $order->payment->data['amount'] }} USDT
                                </div>
                            @endif
                            @if ($order->payment->paymentMethod->method == 'Reserve')
                                <div class="col-5  col-xxl-3">
                                    Usuario de Reserve
                                </div>
                                <div class="col-1">
                                    :
                                </div>
                                <div class="col-6 fw-bold ">
                                    {{ $order->payment->data['reserve_user'] }}
                                </div>
                                <div class="col-5  col-xxl-3">
                                    ID de Pago
                                </div>
                                <div class="col-1">
                                    :
                                </div>
                                <div class="col-6 fw-bold ">
                                    {{ $order->payment->data['transaction_id'] }}
                                </div>
                                <div class="col-5  col-xxl-3">
                                    Monto
                                </div>
                                <div class="col-1">
                                    :
                                </div>
                                <div class="col-6 fw-bold ">
                                    {{ $order->payment->data['amount'] }} USD
                                </div>
                            @endif
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-5  col-xxl-3">
                                        Estado
                                    </div>
                                    <div class="col-1">
                                        :
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
                                            <div class="rounded-pill bg-info w-75 fw-bold text-truncate boom-color-darkgray">
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
                            </div>

                            @if ($order->orderStatus->status != 'Exitoso' && $order->orderStatus->status != 'No Procesado')
                                <div class="col-12 mt-4">
                                    <hr>
                                    <h2>Actualizar</h2>
                                    <form action="{{ route('order.update') }}" method="post">
                                        @csrf
                                        <input type="text" name="order_id" value="{{ $order->id }}" hidden>
                                        @if ($order->bundle->product->category->category == 'Tarjetas')
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="code" class="form-label">Codigo:</label>
                                            </div>
                                            <div class="col-12">
                                                <input type="text" class="form-control-sm mb-3 w-100" name="code" required>
                                            </div>
                                        </div>


                                        @endif
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="order_status" class="form-label">Actualizar Estado:</label>

                                            </div>
                                            <div class="col-12">
                                                <select name="order_status" id="" required class="form-select-sm w-100" required>

                                                    @foreach ($orderStatuses as $orderStatus)
                                                        <option value="{{ $orderStatus->id }}">
                                                            {{ $orderStatus->status }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

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
