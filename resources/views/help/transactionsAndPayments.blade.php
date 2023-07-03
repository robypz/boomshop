@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="help-title text-center mb-4">Transacciones y Pagos</h1>
        <div class="help-text">
            <p class="fs-2 help-title">Transacciones</p>
            <ul class="list-unstyled">
                <li class="help-item p-2 mb-4">
                    <h3><i class="bi bi-arrow-clockwise help-title"></i> No he recibido mi recarga. ¿Qué puedo hacer?</h3>
                    <p class="fs-5">Se debe verificar el estado de su transacción en el historial de su cuenta de usuario.
                    </p>
                    <hr>
                </li>

                <li class="help-item p-2 mb-4">
                    <h3><i class="bi bi-wallet2 help-title"></i> Me equivoqué en la transacción. ¿Puedo reembolsar mi pedido?
                    </h3>
                    <p class="fs-5">Una vez procesada la recarga y haber aceptado las condiciones, no se puede solicitar
                        un
                        reembolso.
                    </p>
                    <hr>
                </li>

                <li class="help-item p-2 mb-4">
                    <h3><i class="bi bi-person-x-fill help-title"></i> Envié mi ID o Datos incorrectamente</h3>
                    <p class="fs-5">Debe asegurarse de leer cada descripción de la compra que desea adquirir, es
                        extremadamente importante
                        asegurarse de que la información que está enviando sea correcta del servicio que se está
                        solicitando. Si
                        envía su ID o Datos incorrectamente, existe una alta probabilidad de que se pierda para siempre. Si
                        su
                        caso es distinto al mencionado debe contactar al soporte vía Whatsapp.
                    </p>
                    <hr>
                </li>
                <li class="help-item p-2 mb-4">
                    <h3><i class="bi bi-hourglass-bottom help-title"></i>Se confirmó mi pago pero no me llegó la recarga
                    </h3>
                    <p class="fs-5">Si su compra aparece confirmada en su historial y no ha obtenido la misma, guarde
                        comprobantes que
                        verifiquen que no se ha realizado su recarga/compra e inmediatamente debe contactar al soporte vía
                        Whatsapp. (No deben pasar las 24 horas desde su transacción).
                    </p>
                    <hr>
                </li>
            </ul>

        </div>

        <div class="help-text">
            <p class="fs-2 help-title">Pagos</p>
            <ul class="list-unstyled">
                <li class="help-item p-2 mb-4">
                    <h3><i class="bi bi-clipboard-x-fill help-title"></i> Mi pedido me dio “Error de Entrega”, ¿Cómo obtengo
                        un reembolso?</h3>
                    <p class="fs-5">Si un pedido no se entrega (lamentablemente, esto sucede en algunas ocasiones debido a
                        inconvenientes
                        con la cuenta o el proveedor). Podrás solicitar un reembolso con tu número de transacción a Atención
                        al
                        Cliente vía Whatsapp.
                    </p>
                    <hr>
                </li>

                <li class="help-item p-2 mb-4">
                    <h3><i class="bi bi-currency-bitcoin help-title"></i> ¿Puedo pagar en otra criptomoneda con Binance?</h3>
                    <p class="fs-5">Actualmente solo recibimos “USDT” a través de Binance Pay.
                    </p>
                    <hr>


                </li>

                <li class="help-item p-2 mb-4">
                    <h3><i class="bi bi-bag-x help-title"></i> Mi transacción dice Pago Incompleto</h3>
                    <p class="fs-5">Si envió su pago desde pago móvil u otro medio de pago que cobre una tarifa de transacción extra y
                        afecte al precio total de la operación, existe una alta probabilidad de que se pierda para siempre.
                    </p>
                    <hr>

                </li>
                <li class="help-item p-2 mb-4">
                    <h3><i class="bi bi-exclamation-triangle help-title"></i> ¿Puedo realizar mi compra en dos o más pagos?
                    </h3>
                    <p class="fs-5">No, las transacciones deben ser realizadas únicamente en un solo pago.
                    </p>
                    <hr>
                </li>
            </ul>

        </div>
    </div>
@endsection
