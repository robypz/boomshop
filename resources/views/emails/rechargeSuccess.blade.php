<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BOOMSHOP - Recarga Exitosa</title>
    <link href="https://fonts.cdnfonts.com/css/montserrat" rel="stylesheet">
    <link rel="stylesheet" href="http://localhost:8000/build/assets/app.fe0e0589.css">


    <style>
        body{
            background: #030a06;
            color: #4bf220;
            font-family: 'Montserrat';

        }
        .recharge-data {
            background-color: #0f1612;

        }

        .recharge-data-header {
            background-color: #0ac458;

        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row flex-row d-flex justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6">

                <div class="text-center">
                    <img src="{{asset('images/BOOM LOGO 240.png')}}" alt="" srcset="">
                    <div class="fs-1">
                        <h1>Saludos, {{ $recharge->user->nick }}</h1>

                    </div>
                    <div class="fs-4">
                        <h2>Tu recarga ha sido completada con éxito.</h2>
                    </div>

                </div>

                <div class="card recharge-data">
                    <div class="card-header recharge-data-header">
                        <div class="row">
                            <div class="col-1">
                                <div class="fs-4 icon-bg">
                                    <i class="bi bi-clipboard text-white fs-4"></i>
                                </div>

                            </div>
                            <div class="col-11 text-center">
                                <h3><b class="text-white fs-4">{{ $recharge->bundle->game->name }}</b></h3>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <p class="fs-4">Detalles de Orden</p>
                        <div class="row">

                            <div class="col-4">
                                ID del Pedido:
                            </div>
                            <div class="col-8 text-white">
                                {{ $recharge->id }}
                            </div>

                            <div class="col-4">
                                Articulo comprado:
                            </div>
                            <div class="col-8 text-white">
                                {{ $recharge->bundle->content }}
                            </div>

                            <div class="col-4">
                                Juego:
                            </div>
                            <div class="col-8 text-white">
                                {{ $recharge->bundle->game->name }}
                            </div>

                            <hr>
                            @if ($recharge->bundle->game->need_access)
                                <div class="col-12">
                                    <p class="fs-4">Informacion de Cuenta</p>
                                </div>
                                <div class="col-4">
                                    email:
                                </div>
                                <div class="col-8 text-white">
                                    {{ $accountInfo['email'] }}
                                </div>

                                <div class="col-4">
                                    Contraseña:
                                </div>
                                <div class="col-8 text-white">
                                    {{ $accountInfo['password'] }}
                                </div>
                            @elseif ($recharge->bundle->game->need_region_id)
                                <div class="col-4">
                                    ID de región:
                                </div>
                                <div class="col-8 text-white">
                                    {{ $recharge->account_info['region_id'] }}
                                </div>

                                <div class="col-4">
                                    ID de cuenta:
                                </div>
                                <div class="col-8 text-white">
                                    {{ $recharge->account_info['account_id'] }}
                                </div>
                            @else
                                <div class="col-4 text-white">
                                    ID de cuenta:
                                </div>
                                <div class="col-8 text-white">
                                    {{ $recharge->account_info['account_id'] }}
                                </div>
                            @endif

                            <div class="col-12">
                                <hr>
                            </div>
                            <div class="col-12">
                                <p class="fs-4">Detalles de Transacción</p>
                            </div>
                            <div class="col-4">
                                ID de la transacción:
                            </div>
                            <div class="col-8 text-white">
                                {{ $recharge->payment->id }}
                            </div>

                            <div class="col-4">
                                Método de pago:
                            </div>
                            <div class="col-8 text-white">
                                {{ $recharge->payment->paymentMethod->method }}
                            </div>

                            @if ($recharge->payment->paymentMethod->method == 'Pago Móvil')
                                <div class="col-4">
                                    Banco:
                                </div>
                                <div class="col-8 text-white">
                                    {{ $recharge->payment->data['bank'] }}
                                </div>
                                <div class="col-4">
                                    Telefono:
                                </div>
                                <div class="col-8 text-white">
                                    {{ $recharge->payment->data['phone'] }}
                                </div>

                                <div class="col-4">
                                    Codigo de transacción:
                                </div>
                                <div class="col-8 text-white">
                                    {{ $recharge->payment->data['transaction_id'] }}
                                </div>

                                <div class="col-4">
                                    Monto:
                                </div>
                                <div class="col-8 text-white">
                                    {{ $recharge->payment->data['amount'] }}VES
                                </div>
                            @endif

                            @if ($recharge->payment->paymentMethod->method == 'Zelle')
                                <div class="col-4">
                                    Nombre de cuenta:
                                </div>
                                <div class="col-8 text-white">
                                    {{ $recharge->payment->data['name'] }}
                                </div>
                                <div class="col-4 ">
                                    Ultimos cuatro digitos de la cuenta:
                                </div>
                                <div class="col-8text-white">
                                    {{ $recharge->payment->data['account_number'] }}
                                </div>

                                <div class="col-4">
                                    Codigo de confirmación:
                                </div>
                                <div class="col-8 text-white">
                                    {{ $recharge->payment->data['confirmation_code'] }}
                                </div>

                                <div class="col-4">
                                    Monto:
                                </div>
                                <div class="col-8 text-white">
                                    {{ $recharge->payment->data['amount'] }} USD
                                </div>
                            @endif

                            @if ($recharge->payment->paymentMethod->method == 'Binance (USDT)')
                                <div class="col-4">
                                    ID de Binance:
                                </div>
                                <div class="col-8 text-white">
                                    {{ $recharge->payment->data['user_id'] }}
                                </div>
                                <div class="col-4">
                                    Alias de Binance:
                                </div>
                                <div class="col-8 text-white">
                                    {{ $recharge->payment->data['binance_alias'] }}
                                </div>

                                <div class="col-4">
                                    Numero de orden:
                                </div>
                                <div class="col-8 text-white">
                                    {{ $recharge->payment->data['order_id'] }}
                                </div>

                                <div class="col-4">
                                    Monto:
                                </div>
                                <div class="col-8 text-white">
                                    {{ $recharge->payment->data['amount'] }} USDT
                                </div>
                            @endif
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-4">
                                        Estado:
                                    </div>
                                    @if ($recharge->rechargeCondition->condition == 'Éxitoso')
                                        <div class="col text-success">
                                            {{ $recharge->rechargeCondition->condition }}
                                        </div>
                                    @elseif ($recharge->rechargeCondition->condition == 'Pendiente')
                                        <div class="col text-warning">
                                            {{ $recharge->rechargeCondition->condition }}
                                        </div>
                                    @elseif ($recharge->rechargeCondition->condition == 'Procesando')
                                        <div class="col text-info">
                                            {{ $recharge->rechargeCondition->condition }}
                                        </div>
                                    @else
                                        <div class="col text-danger">
                                            {{ $recharge->rechargeCondition->condition }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>

</html>
