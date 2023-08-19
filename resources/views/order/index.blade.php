@extends('layouts.app')

@section('content')
    <div class="container py-4">

        @if (session('message'))
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                Esta recarga ya esta siendo procesada por otro usuario.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <h2 class="fw-bold text-center">Ordenes</h2>
        <hr>
        <form action="{{ route('order.index') }}" method="get">
            <div class="row">
                <div class="col-12 col-xxl-1 text-xxl-end text-start">
                    <label for="id" class="form-label-sm">ID</label>
                </div>

                <div class="col-12 col-xxl-2 mb-2">
                    <input type="number" name="id" class="form-control-sm w-100">
                </div>
                <div class="col-12 col-xxl-1 text-xxl-end text-start">
                    <label for="game" class="form-label-sm  ">Producto</label>
                </div>
                <div class="col-12 col-xxl-2 mb-2">
                    <select name="product_id" class="form-select-sm w-100">
                        <option value="" selected disabled>Todos</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-xxl-3 text-xxl-start text-center">
                    <button type="submit" class="btn btn-primary btn-sm">Buscar</button>
                </div>
            </div>
        </form>
        <hr>

        <div class="row">


            @foreach ($orders as $order)
                <div class="col col-12 col-sm-6 col-md-6 col-lg-4 mb-4">
                    <a href="{{ route('order.show', ['id' => $order->id]) }}">
                        <div class="card recharge-data h-100">
                            <div class="card-header recharge-data-header">
                                <div class="row">
                                    <div class="col-2 d-flex align-items-center jsutify-content-center">
                                        <div class="fs-6 icon-bg">
                                            <i class="bi bi-bag boom-color-lightgray fs-6"></i>
                                        </div>

                                    </div>
                                    <div class="col-10 text-center d-flex align-items-center justify-content-center">
                                        <b class="fs-6">{{ $order->bundle->product->name }}</b>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body min-text p-2">

                                <div class="row row-cols-1">
                                    <div class="col mb-2">
                                        <div class="row">
                                            <div class="col-5 col-xxl-4">
                                                ID del Pedido
                                            </div>
                                            <div class="col-1">
                                                :
                                            </div>
                                            <div class="col-6 fw-bold">
                                                B{{ $order->id }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col mb-2">
                                        <div class="row">
                                            <div class="col-5 col-xxl-4">
                                                ID de transacción
                                            </div>
                                            <div class="col-1">
                                                :
                                            </div>
                                            <div class="col-6 fw-bold">
                                                P{{ $order->payment->id }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col mb-2">
                                        <div class="row">
                                            <div class="col-5 col-xxl-4">
                                                Paq. Comprado
                                            </div>
                                            <div class="col-1">
                                                :
                                            </div>
                                            <div class="col-6 fw-bold ">
                                                {{ $order->bundle->content }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col mb-2">
                                        <div class="row">
                                            <div class="col-5 col-xxl-4">
                                                Método de pago
                                            </div>
                                            <div class="col-1">
                                                :
                                            </div>
                                            <div class="col-6 fw-bold ">
                                                {{ $order->payment->paymentMethod->method }}
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col mb-2">
                                        <div class="row">
                                            <div class="col-5 col-xxl-4">
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
                                                    <div class="rounded-pill bg-info w-75 fw-bold boom-color-darkgray text-truncate">
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


                                </div>
                            </div>
                        </div>


                    </a>
                </div>
            @endforeach

        </div>

        {{$orders->links()}}

    </div>
@endsection
