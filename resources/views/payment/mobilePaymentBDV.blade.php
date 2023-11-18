@extends('layouts.blank')

@section('content')
    <div class="container py-2 min-vh-100">
        <div class="row flex-row d-flex justify-content-center">
            <div class="col-12 col-md-10 col-lg-8 col-xl-8 col-xxl-6">
                <div class="card recharge-data">
                    <div class="card-header recharge-data-header lh-sm p-1">
                        <div class="row">
                            <div class="col-1">
                                <div class="icon-bg">
                                    <i class="bi bi-cart text-white "></i>
                                </div>

                            </div>
                            <div class="col-11 text-center">
                                <b class="fs-4 fw-bold">Resumen de Orden</b>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @include('payment.preOrder')
                        <form action="{{ route('payment.payWithPuntoYaBDV') }}" method="post">
                            @csrf
                            <input type="text" name="bundle_id" hidden value="{{ $bundle->id }}">
                            <input type="text" name="payment_method_id" hidden value="{{ $paymentMethod->id }}">
                            @if ($bundle->product->need_region_id)
                                <input type="text" name="account_id" hidden value="{{ $data['account_id'] }}">
                                <input type="text" name="region_id" hidden value="{{ $data['region_id'] }}">
                            @elseif ($bundle->product->need_access)
                                <input type="tel" name="phone" hidden value="{{ $data['phone'] }}">
                            @else
                                <input type="text" name="account_id" hidden value="{{ $data['account_id'] }}">
                            @endif

                            <div class="row mb-1 mt-3">
                                <div class="col-8">
                                    <input id="code" name="code" class="form-control" type="text"
                                        placeholder="Código de descuento">
                                </div>
                                <div class="col-4">
                                    <button type="button" onclick="validateCode()" id="validate-btn"
                                        class="btn w-100 btn-blue">
                                        Aplicar
                                    </button>
                                </div>
                                <div class="my-2" id="message">

                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <input type="number" name="amount" step="0.01" class="form-control mb-4"
                                        id="form-amount"
                                        value="{{ number_format((($bundle->price+$bundle->price*0.02) - ($bundle->price+$bundle->price*0.02)* ($bundle->discount / 100)) * $paymentMethod->valuation->value,2) }}"
                                        required hidden>
                                </div>
                                <div class="col-12">
                                    <div class="row p-0">
                                        <div class="col-6 text-end p-0">
                                            <span class="">Sub total&nbsp;:&nbsp;</span>
                                        </div>
                                        <div class="col text-start p-0">
                                            {{ number_format((($bundle->price) - ($bundle->price)* ($bundle->discount / 100)) * $paymentMethod->valuation->value,2) }}&nbsp;VES
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row p-0">
                                        <div class="col-6 text-end p-0">
                                            <span class="">Fees(2%)&nbsp;:&nbsp;</span>
                                        </div>
                                        <div class="col text-start p-0">
                                            {{ number_format(((($bundle->price) - ($bundle->price)* ($bundle->discount / 100)) * $paymentMethod->valuation->value)*0.02,2) }}&nbsp;VES
                                        </div>
                                    </div>
                                </div>
                                @if ($bundle->discount > 0)
                                    <div class="col-12 text-end mb-3 mt-1">
                                        <div class="row">
                                            <div class="col">
                                                <span class="">Monto Total&nbsp;:&nbsp;</span>
                                            </div>
                                            <div class="col">
                                                <span class="text-decoration-line-through text-muted">
                                                    {{ $bundle->price * $paymentMethod->valuation->value }}
                                                    VES</span> <br>
                                                <span class="fs-5" id="amount-container">
                                                    <span class="fw-bold boom-color-yellow"
                                                        id="amount">{{ number_format((($bundle->price+$bundle->price*0.02) - ($bundle->price+$bundle->price*0.02)* ($bundle->discount / 100)) * $paymentMethod->valuation->value,2)}}</span>
                                                    <span class="fw-bold"> VES</span>
                                                </span>
                                                <br>
                                                <br>
                                                <span class="fs-6" id="code-discount" hidden>
                                                    <span class="fw-bold text-primary" id="code-discount-amount"></span>
                                                    <span class="fw-bold"> VES</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-12 text-end mb-3 mt-1">
                                        <div class="row">
                                            <div class="col p-0">
                                                <span class="">Monto Total&nbsp;:&nbsp;</span>
                                            </div>
                                            <div class="col p-0 text-start">
                                                <span class="fs-6" id="amount-container">
                                                    <span class="fw-bold boom-color-yellow"
                                                        id="amount">{{ number_format((($bundle->price+$bundle->price*0.02) - ($bundle->price+$bundle->price*0.02)* ($bundle->discount / 100)) * $paymentMethod->valuation->value,2) }}</span>
                                                    <span class="fw-bold"> VES</span>
                                                </span>

                                                <br>

                                                <span class="fs-6" id="code-discount" hidden>
                                                    <span class="fw-bold text-primary" id="code-discount-amount"></span>
                                                    <span class="fw-bold"> VES</span>
                                                </span>
                                            </div>
                                        </div>



                                    </div>
                                @endif

                            </div>

                            <!-- Button trigger modal -->
                            <div class="text-center">
                                <img src="{{ route('image.show', ['image' => $paymentMethod->image]) }}" alt="">
                                <br>
                                <button type="button" class="btn btn-primary w-50" data-bs-toggle="modal"
                                    data-bs-target="#refunds">
                                    <span class="fw-bold btn-color fs-6">Pagar</span>
                                </button>
                            </div>


                            <!-- Modal -->
                            <div class="modal fade " id="refunds" data-bs-backdrop="static" data-bs-keyboard="false"
                                tabindex="-1" aria-labelledby="refundsLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content boom-notice">
                                        <div class="modal-header">
                                            <h1 class="modal-title  fw-bold text-primary text-center" id="refundsLabel">
                                                Sin Reembolsos
                                            </h1>
                                            <i type="button" class="bi bi-x-lg text-primary" data-bs-dismiss="modal"
                                                aria-label="Close"></i>
                                        </div>
                                        <div class="modal-body text-justify">
                                            <p>
                                                Usted es responsable de asegurarse de que leyó la descripción e
                                                instrucciones del servicio a adquirir y asegura que el monto de la
                                                transacción ingresado o mostrado en su pantalla sea correcto antes
                                                de
                                                confirmar la transacción. Una vez que se confirme la transacción, se
                                                considerará irrevocable y no podrá cancelar, detener o realizar un
                                                reembolso de esa transacción.
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="{{ route('product.show', ['id' => $bundle->product->id]) }}">
                                                <button type="button" class="btn btn-blue"
                                                    data-bs-dismiss="modal">Volver</button>
                                            </a>

                                            <button onclick="pay()" class="btn btn-primary">Entendido</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div id="cronometer" class="fs-4 text-center">
                        <span id="minutes" class="fw-bold">00</span><span
                            class="fw-bold boom-color-yellow">&nbsp;:&nbsp;</span><span id="seconds"
                            class="fw-bold">00</span>
                    </div>


                </div>

            </div>

        </div>

    </div>
    <script>
        function myFunction(res) {
            if (res.status == '204') {
                var code = document.getElementById('code');
                code.value = '';

                if (res.message == 'Este código no existe en nuestra base de datos.') {
                    var message = document.getElementById('message');
                    message.innerHTML = '<p>' + res.message + '</p>';
                    message.classList.add("text-danger");
                    message.hidden = false;
                }
                if (res.message == 'Este código ha expirado.') {
                    var message = document.getElementById('message');
                    message.innerHTML = '<p>' + res.message + '</p>';
                    message.classList.add("text-danger");
                    message.hidden = false;
                }
                if (res.message == 'Este código ya ha sido utilizado.') {
                    var message = document.getElementById('message');
                    message.innerHTML = '<p>' + res.message + '</p>';
                    message.classList.add("text-danger");
                    message.hidden = false;
                }
                if (res.message == 'Este código no es válido para este producto.') {
                    var message = document.getElementById('message');
                    message.innerHTML = '<p>' + res.message + '</p>';
                    message.classList.add("text-danger");
                    message.hidden = false;
                }
            }
            if (res.status == '200') {

                document.getElementById('code').readOnly = true;
                document.getElementById('validate-btn').disabled = true;

                var message = document.getElementById('message');
                message.innerHTML = '<p>' + 'Codigo valido' + '</p>';
                message.classList.remove("text-danger");
                message.classList.add("text-success");
                message.hidden = false;

                var amount = document.getElementById('amount-container');
                amount.classList.remove("fs-5");
                amount.classList.add("text-decoration-line-through");
                amount.classList.add("text-muted");

                var Amountinput = document.getElementsByName("amount")[0];

                var newAmount = Amountinput.value - Amountinput.value * (res.code.value / 100);
                var newAmount = newAmount.toFixed(2);

                Amountinput.value = newAmount;

                console.log(Amountinput.value);

                var codeDiscount = document.getElementById('code-discount');
                var codeDiscountAmount = document.getElementById('code-discount-amount');
                codeDiscountAmount.innerHTML = newAmount;
                codeDiscount.hidden = false;


            }

        }

        function validateCode() {
            var code = document.getElementById('code').value;
            var product = document.getElementById('product').innerHTML;
            console.log(product);

            var URL = '{{ route('code.validate') }}';

            fetch(URL, {
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'url': URL,
                        "X-CSRF-Token": document.querySelector('input[name=_token]').value
                    },
                    method: 'post',
                    credentials: "same-origin",
                    body: JSON.stringify({
                        code: code,
                        product: product
                    })
                }).then(res => res.json()).then((responseJson) => {
                    this.myFunction(responseJson);
                })
                .catch(function(error) {

                    console.log(error);

                });

        }
    </script>


    <script>
        var minutesLabel = document.getElementById("minutes");
        var secondsLabel = document.getElementById("seconds");

        var seconds = 900;
        var x = setInterval(function() {
            secondsLabel.innerHTML = pad(seconds % 60);
            minutesLabel.innerHTML = pad(parseInt(seconds / 60));
            seconds--;
            if (seconds < 0) {
                clearInterval(x);
                window.location.href = 'http://boomshop.test';
            }
        }, 1000);

        function pad(val) {
            var valString = val + "";
            if (valString.length < 2) {
                return "0" + valString;
            } else {
                return valString;
            }
        }
    </script>

    <script>

    </script>
@endsection
