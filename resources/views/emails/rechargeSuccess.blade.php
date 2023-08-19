<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
    <title>BOOMSHOP - Recarga Exitosa</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />


    <style>
        body {
            font-family: sans-serif, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        .body {
            background: #E5E5E5;
            color: #E5E5E5;


        }

        .order-data {
            background-color: #1E1E1E;
            border-radius: 5px;
            max-width: 320px;
            margin: 0px auto;
            margin-bottom: 10px;
        }

        .order-data-header {
            background-color: #FFCE00;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }

        .centered {
            width: 100%;
        }

        .card-body {
            padding: 20px;
        }

        .fs-4 {
            font-size: 14pt;
            font-weight: bold;
        }

        .fs-5 {
            font-size: 16pt;
        }

        .text-center {
            text-align: center;
        }

        .text-dark {
            color: #1E1E1E;
        }

        .boom-yellow {
            color: #FFCE00;
        }

        .fw-bold {
            font-weight: bold;
        }

        .w-80 {
            width: 85%;
            margin: 0px auto;
            background-color: black;
            min-height: 600px;
            padding: 25px;
        }

        .mt-5 {
            margin-top: 5%;
        }

        .d-inline {
            display: inline;
        }

        h1 {
            line-height: 64px;
            height: 64px;
        }

        .d-flex {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .list-unstyled {
            list-style: none;
            margin: 0px;
            padding: 0px;
            margin-top: 10px;
            text-align: center;
        }

        .li-inline {
            display: inline;
        }

        a {
            text-decoration: none;
            color: #E5E5E5;
            cursor: pointer;

        }

        i {
            color: #FFCE00;
        }
    </style>
</head>

<body>

    <div class="body">


        <h1 class="text-center text-dark">
            BOOMSHOP
        </h1>


        <div class="container">

            <div class="w-80">
                <div class="fs-1 boom-yellow text-center">
                    <img src="{{ asset('images/LOGO COMPLETO TRANSP.png') }}" alt="" srcset=""
                        width="64px">
                    <h2>¡Gracias!, {{ $order->user->nick }}.</h2>

                </div>
                <div class="fs-4 text-center">
                    <h5>Tu orden ha sido completada con éxito.</h5>
                </div>
                <div class="fs-4 boom-yellow text-center">
                    <h4>INFORMACIÓN DE COMPRA</h4>
                </div>
                <div class="centered">
                    <div class="card order-data">

                        <div class="card-body">
                            <p class="fs-4 text-center">Detalles de Orden</p>

                            <span class="fw-bold">ID del Pedido: </span>B-{{ $order->id }}
                            <br>
                            <span class="fw-bold">Paquete Comprado: </span>
                            {{ $order->bundle->content }}
                            <br>
                            @if (array_key_exists('bundle_discount', $order->payment->data))
                                <span class="fw-bold">Descuento del paquete: </span>
                                {{ $order->payment->data['bundle_discount'] }} %
                                <br>
                            @endif
                            <span class="fw-bold">Producto: </span>
                            {{ $order->bundle->product->name }}
                            <hr>

                            @if ($order->bundle->product->category->category != 'Tarjetas')
                                <div class="col-12">
                                    <p class="fs-4 text-center">Información de Cuenta</p>
                                </div>
                                @if ($order->bundle->product->need_access)
                                    <span class="fw-bold">ID de usuario BOOM: </span>
                                    {{ $order->account_info['user_id'] }}
                                @elseif ($order->bundle->product->need_region_id)
                                    <span class="fw-bold">ID de región: </span>
                                    {{ $order->account_info['region_id'] }}
                                    <br>
                                    <span class="fw-bold">ID de cuenta: </span>
                                    {{ $order->account_info['account_id'] }}
                                    <br>
                                @else
                                    <span class="fw-bold">ID de cuenta: </span>
                                    {{ $order->account_info['account_id'] }}
                                    <br>
                                @endif

                                <div class="col-12">
                                    <hr>
                                </div>
                            @endif

                            <div class="col-12">
                                <p class="fs-4 text-center">Detalles de Transacción</p>
                            </div>

                            <span class="fw-bold">ID de Pago: </span>P-{{ $order->payment->id }}
                            <br>
                            <span class="fw-bold">Método de pago: </span>{{ $order->payment->paymentMethod->method }}
                            <br>

                            @if (array_key_exists('code', $order->payment->data))
                                <span class="fw-bold">Codigo de descuento: </span>
                                {{ $order->payment->data['code'] }}
                                <br>
                            @endif

                            @if (array_key_exists('code_discount', $order->payment->data))
                                <span class="fw-bold">Valor del codigo:</span>
                                {{ $order->payment->data['code_discount'] }} %
                                <br>
                            @endif

                            @if ($order->payment->paymentMethod->method == 'Pago Móvil')
                                <span class="fw-bold">Banco: </span>{{ $order->payment->data['bank'] }}
                                <br>

                                <span class="fw-bold">Telefono:</span>
                                {{ $order->payment->data['phone'] }}
                                <br>

                                <span class="fw-bold">Referencia: </span>
                                {{ $order->payment->data['transaction_id'] }}
                                <br>

                                <span class="fw-bold">Monto:</span>{{ $order->payment->data['amount'] }}VES
                                <br>
                            @endif

                            @if ($order->payment->paymentMethod->method == 'Zelle')
                                <span class="fw-bold">Nombre de cuenta: </span>{{ $order->payment->data['name'] }}
                                <br>

                                <span class="fw-bold">Codigo de confirmación:
                                </span>{{ $order->payment->data['confirmation_code'] }}
                                <br>


                                <span class="fw-bold">Monto: </span>
                                {{ $order->payment->data['amount'] }} USD
                                <br>
                            @endif

                            @if ($order->payment->paymentMethod->method == 'Binance (USDT)')
                                <span class="fw-bold">ID de Binance:</span>
                                {{ $order->payment->data['user_id'] }}
                                <br>
                                <span class="fw-bold">Alias de Binance: </span>
                                {{ $order->payment->data['binance_alias'] }}
                                <br>

                                <span class="fw-bold">Numero de orden: </span>
                                {{ $order->payment->data['order_id'] }}
                                <br>

                                <span class="fw-bold">Monto: </span>
                                {{ $order->payment->data['amount'] }} USDT
                                <br>
                            @endif
                            @if ($order->payment->paymentMethod->method == 'Reserve')
                                <div class="col-5  col-xxl-3">
                                    <span class="fw-bold"></span>
                                    Usuario de Reserve
                                </div>
                                <div class="col-1">
                                    :
                                </div>
                                <div class="col-6 fw-bold ">
                                    {{ $order->payment->data['reserve_user'] }}
                                </div>
                                <div class="col-5  col-xxl-3">
                                    <span class="fw-bold"></span>
                                    ID de Pago
                                </div>
                                <div class="col-1">
                                    :
                                </div>
                                <div class="col-6 fw-bold ">
                                    {{ $order->payment->data['transaction_id'] }}
                                </div>
                                <div class="col-5  col-xxl-3">
                                    <span class="fw-bold">Monto</span>: {{ $order->payment->data['amount'] }} USD
                            @endif
                            <span class="fw-bold">Estado:</span>

                            @if ($order->orderStatus->status == 'Exitoso')
                                <span class=""></span>
                                {{ $order->orderStatus->status }}
                            @elseif ($order->orderStatus->status == 'Pendiente')
                                <span class=""></span>
                                {{ $order->orderStatus->status }}
                            @elseif ($order->orderStatus->status == 'Procesando')
                                <span class=""></span>
                                {{ $order->orderStatus->status }}
                            @else
                                <span class=""></span>
                                {{ $order->orderStatus->status }}
                            @endif

                        </div>
                    </div>
                </div>

                <hr>
                <div class="text-center">

                    <ul class="nav flex-column list-unstyled">
                        <li class="li-inline"><a href="https://www.instagram.com/boomshopve/" target="_blank"
                                class="nav-link p-0 text-muted"><img
                                    src="https://es.wikipedia.org/wiki/Archivo:Instagram_logo_2022.svg" alt=""
                                    width="25px">
                                BOOMSHOPVE</a></li>
                        <li class="li-inline"><a href="https://www.facebook.com/boomshopve" target="_blank"
                                class="nav-link p-0 text-muted"><i class="bi bi-facebook text-primary me-2 "></i>
                                BOOMSHOPVE</a>
                        </li>
                        <li class="li-inline"><a href="" target="_blank" class="nav-link p-0 text-muted"><i
                                    class="bi bi-whatsapp text-primary me-2 "></i>
                                SOPORTE</a>
                        </li>
                    </ul>

                </div>

            </div>

        </div>
        <div class="container">
            <iframe src="http://isboomshop.blogspot.com" frameborder="0" class="w-100 vh-100 news"></iframe>
        </div>

        <footer class="text-center fw-bold text-dark">
            &copy; 2023 BOOMSHOP, Todos los derechos reservados.
        </footer>
    </div>



</body>

</html>
