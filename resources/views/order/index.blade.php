@extends('layouts.app')

@section('content')
    <div class="container py-4">

        @if (session('message'))
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                Esta recarga ya esta siendo procesada por otro usuario.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <h2 class="fw-bold">Recargas</h2>
        <hr>
            <form action="{{route('order.index')}}" method="get">
                <div class="row text-center">
                    <div class="col-1 text-end">
                        <label for="id" class="form-label fs-4 ">ID</label>
                    </div>

                    <div class="col">
                        <input type="number" name="id" class="form-control">
                    </div>
                    <div class="col-1 text-end">
                        <label for="game" class="form-label fs-4 ">Product</label>
                    </div>
                    <div class="col">
                        <select name="product_id" class="form-select">
                            <option value="" selected disabled>Seleccione</option>
                            @foreach ($products as $product)
                                <option value="{{$product->id}}">{{$product->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </div>
                </div>
            </form>
        <hr>

        <div class="row">


            @foreach ($orders as $order)

                <div class="col col-12 col-sm-6 col-md-6 col-lg-4">
                    <a href="{{ route('order.show', ['id' => $order->id]) }}">
                        <div class="card recharge-data">
                            <div class="card-header recharge-data-header">
                                <div class="row">
                                    <div class="col-1">
                                        <div class="fs-6 icon-bg">
                                            <i class="bi bi-bag boom-color-lightgray  fs-5"></i>
                                        </div>

                                    </div>
                                    <div class="col-11 text-center">
                                        <b class="fs-5">{{ $order->bundle->product->name }}</b>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-2">

                                <div class="row row-cols-1">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                ID del Pedido:
                                            </div>
                                            <div class="col ">
                                                B{{ $order->id }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                ID de la transacción:
                                            </div>
                                            <div class="col ">
                                                P{{ $order->payment->id }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                Articulo comprado:
                                            </div>
                                            <div class="col ">
                                                {{ $order->bundle->content }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                Método de pago:
                                            </div>
                                            <div class="col ">
                                                {{ $order->payment->paymentMethod->method }}
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
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


                                </div>
                            </div>
                        </div>


                    </a>
                </div>
            @endforeach

        </div>

    </div>
@endsection
