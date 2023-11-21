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

                    <div class="card-body lh-1">

                        <div class="row lh-sm">
                            <div class="col">
                                <div class="row">
                                    <div class="col text-center">
                                        <p class="text-primary">
                                            <span class="fw-bold">Producto:</span><br>
                                            <span class="footer-title" id="product"> {{ $bundle->product->name }}</span>
                                        </p>

                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="row">
                                    <div class="col text-center">
                                        <p class=" text-primary">
                                            <span class="fw-bold">Paquete:</span><br>
                                            <span class="footer-title">{{ $bundle->content }}</span>
                                        </p>

                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <p class=" text-primary text-center">
                                            <span class="fw-bold">Precio:</span> <br>
                                            <span class="footer-title">{{ $bundle->price }} $</span>

                                        </p>

                                    </div>
                                </div>
                            </div>
                            @if ($bundle->discount > 0)
                                <div class="col">
                                    <div class="row">
                                        <div class="col text-center">
                                            <p class=" text-primary">
                                                <span class="fw-bold">Descuento: </span> <br>
                                                <span class="footer-title">{{ $bundle->discount }} %</span>

                                            </p>

                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>

                        <hr>
                        @if ($paymentMethod->method == 'Pago Móvil')
                            <p class="">
                            <div class="cuadrado text-center ">1</div>&nbsp;Paga el monto de tu orden mostrado en <span
                                class="fw-bold boom-color-yellow">Bs.
                                {{ ($bundle->price - $bundle->price * ($bundle->discount / 100)) * $paymentMethod->valuation->value }}</span>,
                            &nbsp;a la
                            cuenta:
                            </p>
                            <div
                                class="container mb-3 text-center d-flex aling-items-center justify-content-center justify-content-lg-center">
                                <div class="row row-cols-2">
                                    <div class="col text-end p-0 mb-1">
                                        Titular <span class="text-primary">:</span>&nbsp;
                                    </div>

                                    <div class="col text-start p-0 mb-1">
                                        Juan Enrique
                                    </div>
                                    <div class="col text-end p-0 mb-1">
                                        Banco <span class="text-primary">:</span>&nbsp;
                                    </div>
                                    <div class="col text-start p-0 mb-1">
                                        <span class="bg-primary boom-color-darkgray fw-bold">Banesco</span>
                                    </div>
                                    <div class="col text-end p-0 mb-1">
                                        Cadula <span class="text-primary">:</span>&nbsp;
                                    </div>
                                    <div class="col text-start p-0 mb-1">
                                        V-<span class=""
                                            id="ci">6189959</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <div class="tooltip-x ">
                                            <i class="bi bi-clipboard" onclick="copy('ci','myTooltip-ci')"
                                                onmouseout="outFunc('myTooltip-ci')">
                                                <span class="tooltiptext" id="myTooltip-ci">Copiar al
                                                    portapapeles</span>

                                            </i>
                                        </div>
                                    </div>
                                    <div class="col text-end p-0 mb-1">
                                        Teléfono <span class="text-primary">:</span>&nbsp;
                                    </div>

                                    <div class="col p-0 text-start mb-1">
                                        <span class="" id="tlf">04120328247</span>&nbsp;
                                        <div class="tooltip-x ">
                                            <i class="bi bi-clipboard" onclick="copy('tlf','myTooltip-tlf')"
                                                onmouseout="outFunc('myTooltip-tlf')">
                                                <span class="tooltiptext" id="myTooltip-tlf">Copiar al
                                                    portapapeles</span>
                                            </i>
                                        </div>

                                        <!-- <button
                                                                                                                        class="copy rounded-pill">Copiar</button>-->
                                    </div>

                                </div>


                            </div>
                            <hr>
                            <div class="">
                                <div class="mt-3 mb-2">
                                    <p class="">
                                    <div class="cuadrado text-center ">2</div> Ingresa correctamente los datos de tu pago en
                                    el
                                    formulario.</p>
                                </div>
                                <form action="{{ route('order.store') }}" method="post">
                                    @csrf
                                    <input type="text" name="bundle_id" hidden value="{{ $bundle->id }}">
                                    <input type="text" name="payment_method_id" hidden value="{{ $paymentMethod->id }}">
                                    @if ($bundle->product->need_region_id)
                                        <input type="text" name="account_id" hidden value="{{ $account_id }}">
                                        <input type="text" name="region_id" hidden value="{{ $region_id }}">
                                    @elseif ($bundle->product->need_access)
                                        <input type="tel" name="phone" hidden value="{{ $phone }}">
                                    @else
                                        <input type="text" name="account_id" hidden value="{{ $account_id }}">
                                    @endif
                                    <select name="bank" required class="form-select mb-4"
                                        aria-placeholder="Selecciona tu banco">
                                        <option value="" selected>Selecciona tu banco</option>
                                        <option value="100% BANCO">100%BANCO</option>
                                        <option value="ABN AMRO BANK">ABN AMRO BANK</option>
                                        <option value="BANCAMIGA BANCO MICROFINANCIERO, C.A.">BANCAMIGA BANCO
                                            MICROFINANCIERO,
                                            C.A.
                                        </option>
                                        <option value="BANCO ACTIVO BANCO COMERCIAL, C.A.">BANCO ACTIVO BANCO COMERCIAL,
                                            C.A.
                                        </option>
                                        <option value="BANCO AGRICOLA">BANCO AGRICOLA</option>
                                        <option value="BANCO BICENTENARIO">BANCO BICENTENARIO</option>
                                        <option value="BANCO CARONI, C.A. BANCO UNIVERSAL">BANCO CARONI, C.A. BANCO
                                            UNIVERSAL
                                        </option>
                                        <option value="BANCO DE DESARROLLO DEL MICROEMPRESARIO">BANCO DE DESARROLLO DEL
                                            MICROEMPRESARIO
                                        </option>
                                        <option value="BANCO DE VENEZUELA S.A.I.C.A.">BANCO DE VENEZUELA S.A.I.C.A.
                                        </option>
                                        <option value="BANCO DEL CARIBE C.A.">BANCO DEL CARIBE C.A.</option>
                                        <option value="BANCO DEL PUEBLO SOBERANO C.A.">BANCO DEL PUEBLO SOBERANO C.A.
                                        </option>
                                        <option value="BANCO DEL TESORO">BANCO DEL TESORO</option>
                                        <option value="BANCO ESPIRITO SANTO, S.A.">BANCO ESPIRITO SANTO, S.A.</option>
                                        <option value="BANCO EXTERIOR C.A.">BANCO EXTERIOR C.A.</option>
                                        <option value="BANCO INDUSTRIAL DE VENEZUELA.">BANCO INDUSTRIAL DE VENEZUELA.
                                        </option>
                                        <option value="BANCO INTERNACIONAL DE DESARROLLO, C.A.">BANCO INTERNACIONAL DE
                                            DESARROLLO,
                                            C.A.
                                        </option>
                                        <option value="BANCO MERCANTIL C.A.">BANCO MERCANTIL C.A.</option>
                                        <option value="BANCO NACIONAL DE CREDITO">BANCO NACIONAL DE CREDITO</option>
                                        <option value="BANCO OCCIDENTAL DE DESCUENTO.">BANCO OCCIDENTAL DE DESCUENTO.
                                        </option>
                                        <option value="BANCO PLAZA">BANCO PLAZA</option>
                                        <option value="BANCO PROVINCIAL BBVA">BANCO PROVINCIAL BBVA</option>
                                        <option value="BANCO VENEZOLANO DE CREDITO S.A.">BANCO VENEZOLANO DE CREDITO S.A.
                                        </option>
                                        <option value="BANCRECER S.A. BANCO DE DESARROLLO">BANCRECER S.A. BANCO DE
                                            DESARROLLO
                                        </option>
                                        <option value="BANFANB">BANFANB</option>
                                        <option value="BANGENTE">BANGENTE</option>
                                        <option value="BANPLUS BANCO COMERCIAL C.A">BANPLUS BANCO COMERCIAL C.A</option>
                                        <option value="CITIBANK.">CITIBANK.</option>
                                        <option value="CORP BANCA.">CORP BANCA.</option>
                                        <option value="DELSUR BANCO UNIVERSAL">DELSUR BANCO UNIVERSAL</option>
                                        <option value="FONDO COMUN">FONDO COMUN</option>
                                        <option value=" Instituto Municipal de Crédito Popular"> Instituto Municipal de
                                            Crédito
                                            Popular
                                        </option>
                                        <option value="MIBANCO BANCO DE DESARROLLO, C.A.">MIBANCO BANCO DE DESARROLLO, C.A.
                                        </option>
                                        <option value="SOFITASA">SOFITASA</option>
                                    </select>
                                    <input class="form-control mb-4" type="tel" name="phone"
                                        placeholder="Número de teléfono" required>
                                    <input class="form-control mb-4" type="number" placeholder="Número de referencia"
                                        name="transaction_id" required>
                                    <div class="row mb-1">
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
                                            <input type="number" name="amount" step="0.01"
                                                class="form-control mb-4" id="form-amount"
                                                value="{{ number_format(($bundle->price + $bundle->price * 0.01 - ($bundle->price + $bundle->price * 0.01) * ($bundle->discount / 100)) * $paymentMethod->valuation->value, 2) }}"
                                                required hidden>
                                        </div>
                                        <div class="col-12">
                                            <div class="row p-0">
                                                <div class="col-6 text-end p-0">
                                                    <span class="">Sub total&nbsp;:&nbsp;</span>
                                                </div>
                                                <div class="col text-start p-0">
                                                    @if ($bundle->discount != 0)
                                                        <span
                                                            class="text-muted text-decoration-line-through">{{ number_format($bundle->price * $paymentMethod->valuation->value, 2) }}&nbsp;VES</span>
                                                    @endif
                                                    {{ number_format(($bundle->price - $bundle->price * ($bundle->discount / 100)) * $paymentMethod->valuation->value, 2) }}&nbsp;VES
                                                </div>
                                            </div>
                                        </div>
                                        @if ($bundle->discount > 0)
                                            <div class="col-12 text-end mb-3 mt-1">
                                                <div class="row">
                                                    <div class="col p-0">
                                                        <span class="">Monto Total&nbsp;:&nbsp;</span>
                                                    </div>
                                                    <div class="col p-0 text-start">
                                                        <span class="fs-6" id="amount-container">
                                                            <span class="fw-bold boom-color-yellow"
                                                                id="amount">{{ number_format(($bundle->price - $bundle->price * ($bundle->discount / 100)) * $paymentMethod->valuation->value, 2) }}</span>
                                                            <span class="fw-bold"> VES</span>
                                                        </span>

                                                        <br>

                                                        <span class="fs-6" id="code-discount" hidden>
                                                            <span class="fw-bold text-primary"
                                                                id="code-discount-amount"></span>
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
                                                                id="amount">{{ number_format(($bundle->price - $bundle->price * ($bundle->discount / 100)) * $paymentMethod->valuation->value, 2) }}</span>
                                                            <span class="fw-bold"> VES</span>
                                                        </span>

                                                        <br>

                                                        <span class="fs-6" id="code-discount" hidden>
                                                            <span class="fw-bold text-primary"
                                                                id="code-discount-amount"></span>
                                                            <span class="fw-bold"> VES</span>
                                                        </span>
                                                    </div>
                                                </div>



                                            </div>
                                        @endif




                                        <div class="text-center">

                                        </div>

                                        <!-- Button trigger modal -->
                                        <div class="text-center">
                                            <button type="button" class="btn btn-primary w-50" data-bs-toggle="modal"
                                                data-bs-target="#refunds">
                                                <span class="fw-bold btn-color">Pagar</span>
                                            </button>
                                        </div>


                                        <!-- Modal -->
                                        <div class="modal fade " id="refunds" data-bs-backdrop="static"
                                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="refundsLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content boom-notice">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title  fw-bold" id="refundsLabel">Sin
                                                            Reembolsos
                                                        </h1>
                                                        <i type="button" class="bi bi-x-lg" data-bs-dismiss="modal"
                                                            aria-label="Close"></i>
                                                    </div>
                                                    <div class="modal-body ">
                                                        <p>
                                                            Usted es responsable de asegurarse de que leyó la descripción e
                                                            instrucciones del servicio a adquirir y asegura que el monto de
                                                            la
                                                            transacción ingresado o mostrado en su pantalla sea correcto
                                                            antes
                                                            de
                                                            confirmar la transacción. Una vez que se confirme la
                                                            transacción, se
                                                            considerará irrevocable y no podrá cancelar, detener o realizar
                                                            un
                                                            reembolso de esa transacción.
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a
                                                            href="{{ route('product.show', ['id' => $bundle->product->id]) }}">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Volver</button>
                                                        </a>

                                                        <button type="submit" class="btn btn-primary">Entendido</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        @endif

                        @if ($paymentMethod->method == 'Zelle')
                            <p class="">
                            <div class="cuadrado text-center ">1</div> Envía tu pago completo a la siguiente dirección de
                            Zelle</p>
                            <div
                                class="container mb-3 text-center d-flex aling-items-center justify-content-end justify-content-lg-center">
                                <div class="row row-cols-2 payment-data-binance">
                                    <div class="col-9  mb-1  d-flex align-items-center justify-content-center">
                                        <span class="text-primary" id="name">Olvin de Barros</span>
                                    </div>
                                    <div class="col-3 mb-1  text-start d-flex align-items-center ">
                                        <div class="tooltip-x ">
                                            <button class="copy rounded-pill" onclick="copy('name','myTooltip-name')"
                                                onmouseout="outFunc('myTooltip-name')">
                                                <span class="tooltiptext" id="myTooltip-name">Copiar al
                                                    portapapeles</span>
                                                Copiar
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-9 mb-1  d-flex align-items-center justify-content-center">
                                        <span class="" id="email">pay@isboomshop.com</span>
                                    </div>
                                    <div class="col-3 mb-1  text-start d-flex align-items-center ">

                                        <div class="tooltip-x ">
                                            <button class="copy rounded-pill" onclick="copy('email','myTooltip-email')"
                                                onmouseout="outFunc('myTooltip-email')">
                                                <span class="tooltiptext" id="myTooltip-email">Copiar al
                                                    portapapeles</span>
                                                Copiar
                                            </button>
                                        </div>
                                    </div>
                                </div>


                            </div>


                            <hr>
                            <div class=" mt-4 mb-2 ">

                                <p class="">
                                <div class="cuadrado text-center ">2</div> Ingresa correctamente los datos de tu pago en
                                el
                                formulario.</p>
                            </div>
                            <form action="{{ route('order.store') }}" method="post">
                                @csrf
                                <input type="text" name="bundle_id" hidden value="{{ $bundle->id }}">


                                <input type="text" name="payment_method_id" hidden value="{{ $paymentMethod->id }}">
                                @if ($bundle->product->need_region_id)
                                    <input type="text" name="account_id" hidden value="{{ $account_id }}">
                                    <input type="text" name="region_id" hidden value="{{ $region_id }}">
                                @elseif ($bundle->product->need_access)
                                    <input type="email" name="email" hidden value="{{ $email }}">
                                    <input type="password" name="password" hidden value="{{ $password }}">
                                @else
                                    <input type="text" name="account_id" hidden value="{{ $account_id }}">
                                @endif

                                <input type="text" name="name" required class="form-control mb-4"
                                    placeholder="Nombre del titular de la cuenta Zelle">


                                <input type="number" name="confirmation_code" class="form-control mb-4"
                                    placeholder="Código de confirmación" required>
                                <label for="confirmation_code" hidden class="form-label">Monto</label>
                                <div class="row mb-4">
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
                                            value="{{ number_format(($bundle->price + $bundle->price * 0.01 - ($bundle->price + $bundle->price * 0.01) * ($bundle->discount / 100)) * $paymentMethod->valuation->value, 2) }}"
                                            required hidden>
                                    </div>
                                    <div class="col-12">
                                        <div class="row p-0">
                                            <div class="col-6 text-end p-0">
                                                <span class="">Sub total&nbsp;:&nbsp;</span>
                                            </div>
                                            <div class="col text-start p-0">
                                                @if ($bundle->discount != 0)
                                                    <span
                                                        class="text-muted text-decoration-line-through">{{ number_format($bundle->price * $paymentMethod->valuation->value, 2) }}&nbsp;USD</span>
                                                @endif
                                                {{ number_format(($bundle->price - $bundle->price * ($bundle->discount / 100)) * $paymentMethod->valuation->value, 2) }}&nbsp;USD
                                            </div>
                                        </div>
                                    </div>
                                    @if ($bundle->discount > 0)
                                        <div class="col-12 text-end mb-3 mt-1">
                                            <div class="row">
                                                <div class="col p-0">
                                                    <span class="">Monto Total&nbsp;:&nbsp;</span>
                                                </div>
                                                <div class="col p-0 text-start">
                                                    <span class="fs-6" id="amount-container">
                                                        <span class="fw-bold boom-color-yellow"
                                                            id="amount">{{ number_format(($bundle->price - $bundle->price * ($bundle->discount / 100)) * $paymentMethod->valuation->value, 2) }}</span>
                                                        <span class="fw-bold"> USD</span>
                                                    </span>

                                                    <br>

                                                    <span class="fs-6" id="code-discount" hidden>
                                                        <span class="fw-bold text-primary"
                                                            id="code-discount-amount"></span>
                                                        <span class="fw-bold"> USD</span>
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
                                                            id="amount">{{ number_format(($bundle->price - $bundle->price * ($bundle->discount / 100)) * $paymentMethod->valuation->value, 2) }}</span>
                                                        <span class="fw-bold"> USD</span>
                                                    </span>

                                                    <br>

                                                    <span class="fs-6" id="code-discount" hidden>
                                                        <span class="fw-bold text-primary"
                                                            id="code-discount-amount"></span>
                                                        <span class="fw-bold"> USD</span>
                                                    </span>
                                                </div>
                                            </div>



                                        </div>
                                    @endif




                                    <div class="text-center">

                                    </div>

                                    <!-- Button trigger modal -->
                                    <div class="text-center">
                                        <button type="button" class="btn btn-primary w-50" data-bs-toggle="modal"
                                            data-bs-target="#refunds">
                                            <span class="fw-bold btn-color">Pagar</span>
                                        </button>
                                    </div>


                                    <!-- Modal -->
                                    <div class="modal fade " id="refunds" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="refundsLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content boom-notice">
                                                <div class="modal-header">
                                                    <h1 class="modal-title  fw-bold" id="refundsLabel">Sin
                                                        Reembolsos
                                                    </h1>
                                                    <i type="button" class="bi bi-x-lg" data-bs-dismiss="modal"
                                                        aria-label="Close"></i>
                                                </div>
                                                <div class="modal-body ">
                                                    <p>
                                                        Usted es responsable de asegurarse de que leyó la descripción e
                                                        instrucciones del servicio a adquirir y asegura que el monto de
                                                        la
                                                        transacción ingresado o mostrado en su pantalla sea correcto
                                                        antes
                                                        de
                                                        confirmar la transacción. Una vez que se confirme la
                                                        transacción, se
                                                        considerará irrevocable y no podrá cancelar, detener o realizar
                                                        un
                                                        reembolso de esa transacción.
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="{{ route('product.show', ['id' => $bundle->product->id]) }}">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Volver</button>
                                                    </a>

                                                    <button type="submit" class="btn btn-primary">Entendido</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endif

                        @if ($paymentMethod->method == 'Binance (USDT)')
                            <div class="">
                                <p class="text-center">
                                <div class="cuadrado text-center ">1</div> Envía el monto total de la orden, únicamente en
                                “USDT” a la cuenta:
                                </p>

                                <div
                                    class="container mb-3 text-center d-flex aling-items-center justify-content-end justify-content-lg-center">
                                    <div class="row row-cols-2 payment-data-binance">
                                        <div class="col-9  mb-1  d-flex align-items-center justify-content-center">
                                            <span class="text-primary" id="ci">Correo Electrónico</span>
                                        </div>
                                        <div class="col-3 mb-1  text-start d-flex align-items-center ">

                                        </div>
                                        <div class="col-9 mb-1  d-flex align-items-center justify-content-center">
                                            <span class="" id="tlf">pay@isboomshop.com</span>
                                        </div>
                                        <div class="col-3 mb-1  text-start d-flex align-items-center ">

                                            <div class="tooltip-x ">
                                                <button class="copy rounded-pill" onclick="copy('tlf','myTooltip-tlf')"
                                                    onmouseout="outFunc('myTooltip-tlf')">
                                                    <span class="tooltiptext" id="myTooltip-tlf">Copiar al
                                                        portapapeles</span>
                                                    Copiar
                                                </button>
                                            </div>
                                        </div>
                                    </div>


                                </div>






                                <hr>
                                <div class=" mt-2 mb-2">
                                    <div class="cuadrado text-center ">2</div> Ingresa correctamente los datos de tu pago
                                    en
                                    el
                                    formulario.
                                </div>



                                <form action="{{ route('order.store') }}" method="post">
                                    @csrf
                                    <input type="text" name="bundle_id" hidden value="{{ $bundle->id }}">


                                    <input type="text" name="payment_method_id" hidden
                                        value="{{ $paymentMethod->id }}">
                                    @if ($bundle->product->need_region_id)
                                        <input type="text" name="account_id" hidden value="{{ $account_id }}">
                                        <input type="text" name="region_id" hidden value="{{ $region_id }}">
                                    @elseif ($bundle->product->need_access)
                                        <input type="email" name="email" hidden value="{{ $email }}">
                                        <input type="password" name="password" hidden value="{{ $password }}">
                                    @else
                                        <input type="text" name="account_id" hidden value="{{ $account_id }}">
                                    @endif


                                    <input type="text" name="user_id" class="form-control mb-4"
                                        placeholder="ID de Usuario en Binance" required>
                                    <input type="text" name="binance_alias" class="form-control mb-4"
                                        placeholder="Alias de Binance" required>
                                    <input type="number" name="order_id" class="form-control mb-4"
                                        placeholder="ID de Orden" required>
                                    <div class="row mb-2">
                                        <div class="col-8">
                                            <input id="code" name="code" class="form-control" type="text"
                                                placeholder="Código de Descuento">
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
                                            <input type="number" name="amount" step="0.01"
                                                class="form-control mb-4" id="form-amount"
                                                value="{{ number_format(($bundle->price + $bundle->price * 0.01 - ($bundle->price + $bundle->price * 0.01) * ($bundle->discount / 100)) * $paymentMethod->valuation->value, 2) }}"
                                                required hidden>
                                        </div>
                                        <div class="col-12">
                                            <div class="row p-0">
                                                <div class="col-6 text-end p-0">
                                                    <span class="">Sub total&nbsp;:&nbsp;</span>
                                                </div>
                                                <div class="col text-start p-0">
                                                    @if ($bundle->discount != 0)
                                                        <span
                                                            class="text-muted text-decoration-line-through">{{ number_format($bundle->price * $paymentMethod->valuation->value, 2) }}&nbsp;USDT</span>
                                                    @endif
                                                    {{ number_format(($bundle->price - $bundle->price * ($bundle->discount / 100)) * $paymentMethod->valuation->value, 2) }}&nbsp;USDT
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row p-0">
                                                <div class="col-6 text-end p-0">
                                                    <span class="">Fees(1%)&nbsp;:&nbsp;</span>
                                                </div>
                                                <div class="col text-start p-0">
                                                    {{ number_format(($bundle->price - $bundle->price * ($bundle->discount / 100)) * $paymentMethod->valuation->value * 0.01, 2) }}&nbsp;USDT
                                                </div>
                                            </div>
                                        </div>
                                        @if ($bundle->discount > 0)
                                            <div class="col-12 text-end mb-3 mt-1">
                                                <div class="row">
                                                    <div class="col p-0">
                                                        <span class="">Monto Total&nbsp;:&nbsp;</span>
                                                    </div>
                                                    <div class="col p-0 text-start">
                                                        <span class="fs-6" id="amount-container">
                                                            <span class="fw-bold boom-color-yellow"
                                                                id="amount">{{ number_format(($bundle->price + $bundle->price * 0.01 - ($bundle->price + $bundle->price * 0.01) * ($bundle->discount / 100)) * $paymentMethod->valuation->value, 2) }}</span>
                                                            <span class="fw-bold"> USDT</span>
                                                        </span>

                                                        <br>

                                                        <span class="fs-6" id="code-discount" hidden>
                                                            <span class="fw-bold text-primary"
                                                                id="code-discount-amount"></span>
                                                            <span class="fw-bold"> USDT</span>
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
                                                                id="amount">{{ number_format(($bundle->price + $bundle->price * 0.01 - ($bundle->price + $bundle->price * 0.01) * ($bundle->discount / 100)) * $paymentMethod->valuation->value, 2) }}</span>
                                                            <span class="fw-bold"> USDT</span>
                                                        </span>

                                                        <br>

                                                        <span class="fs-6" id="code-discount" hidden>
                                                            <span class="fw-bold text-primary"
                                                                id="code-discount-amount"></span>
                                                            <span class="fw-bold"> USDT</span>
                                                        </span>
                                                    </div>
                                                </div>



                                            </div>
                                        @endif
                                        <p type="button" data-bs-toggle="modal"
                                            class="text-center mt-2 text-decoration-underline text-primary"
                                            data-bs-target="#exampleModal">¿Cómo hacer
                                            pago con Binance?</p>

                                        <!-- Modal -->
                                        <div class="modal fade " id="exampleModal" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered ">
                                                <div class="modal-content recharge-data">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">¿Cómo hacer
                                                            pago
                                                            con
                                                            Binance ?</h1>
                                                        <i type="button" class="bi bi-x-lg" data-bs-dismiss="modal"
                                                            aria-label="Close"></i>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div id="carouselExampleCaptions" class="carousel slide">
                                                            <div class="carousel-indicators">
                                                                <button type="button"
                                                                    data-bs-target="#carouselExampleCaptions"
                                                                    data-bs-slide-to="0" class="active"
                                                                    aria-current="true" aria-label="Slide 1"><i
                                                                        class="bi bi-1-square-fill"></i></button>

                                                                <button type="button"
                                                                    data-bs-target="#carouselExampleCaptions"
                                                                    data-bs-slide-to="1" aria-label="Slide 2"></button>
                                                                <button type="button"
                                                                    data-bs-target="#carouselExampleCaptions"
                                                                    data-bs-slide-to="2" aria-label="Slide 3"></button>
                                                                <button type="button"
                                                                    data-bs-target="#carouselExampleCaptions"
                                                                    data-bs-slide-to="3" aria-label="Slide 4"></button>
                                                            </div>
                                                            <div class="carousel-inner">
                                                                <div class="carousel-item active">
                                                                    <img src="{{ asset('images/binance/0.PortadaBinance.jpg') }}"
                                                                        class="d-block w-100" alt="...">
                                                                    <div class="carousel-caption d-none d-md-block">

                                                                    </div>
                                                                </div>
                                                                <div class="carousel-item">
                                                                    <img src="{{ asset('images/binance/1.Binance.jpg') }}"
                                                                        class="d-block w-100" alt="...">
                                                                    <div class="carousel-caption d-none d-md-block">

                                                                    </div>
                                                                </div>
                                                                <div class="carousel-item">
                                                                    <img src="{{ asset('images/binance/2.Binance.jpg') }}"
                                                                        class="d-block w-100" alt="...">
                                                                    <div class="carousel-caption d-none d-md-block">

                                                                    </div>
                                                                </div>
                                                                <div class="carousel-item">
                                                                    <img src="{{ asset('images/binance/3.Binance.jpg') }}"
                                                                        class="d-block w-100" alt="...">
                                                                    <div class="carousel-caption d-none d-md-block">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <button class="carousel-control-prev" type="button"
                                                                data-bs-target="#carouselExampleCaptions"
                                                                data-bs-slide="prev">
                                                                <span class="carousel-control-prev-icon"
                                                                    aria-hidden="true"></span>
                                                                <span class="visually-hidden">Previous</span>
                                                            </button>
                                                            <button class="carousel-control-next" type="button"
                                                                data-bs-target="#carouselExampleCaptions"
                                                                data-bs-slide="next">
                                                                <span class="carousel-control-next-icon"
                                                                    aria-hidden="true"></span>
                                                                <span class="visually-hidden">Next</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cerrar</button>
                                                        <button type="button" data-bs-dismiss="modal"
                                                            class="btn btn-primary">Aceptar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-center">

                                        </div>

                                        <!-- Button trigger modal -->
                                        <div class="text-center">
                                            <button type="button" class="btn btn-primary w-50" data-bs-toggle="modal"
                                                data-bs-target="#refunds">
                                                <span class="fw-bold btn-color">Pagar</span>
                                            </button>
                                        </div>


                                        <!-- Modal -->
                                        <div class="modal fade " id="refunds" data-bs-backdrop="static"
                                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="refundsLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content boom-notice">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title  fw-bold" id="refundsLabel">Sin
                                                            Reembolsos
                                                        </h1>
                                                        <i type="button" class="bi bi-x-lg" data-bs-dismiss="modal"
                                                            aria-label="Close"></i>
                                                    </div>
                                                    <div class="modal-body ">
                                                        <p>
                                                            Usted es responsable de asegurarse de que leyó la descripción e
                                                            instrucciones del servicio a adquirir y asegura que el monto de
                                                            la
                                                            transacción ingresado o mostrado en su pantalla sea correcto
                                                            antes
                                                            de
                                                            confirmar la transacción. Una vez que se confirme la
                                                            transacción, se
                                                            considerará irrevocable y no podrá cancelar, detener o realizar
                                                            un
                                                            reembolso de esa transacción.
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a
                                                            href="{{ route('product.show', ['id' => $bundle->product->id]) }}">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Volver</button>
                                                        </a>

                                                        <button type="submit" class="btn btn-primary">Entendido</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endif

                        @if ($paymentMethod->method == 'Reserve')
                            <p class="fw-bold  text-center">Envía tu pago con Rpay al Siguiente usuario
                            </p>
                            <div class=" text-center">
                                <div class="row">

                                    <div class="col text-primary fw-bold" id="user">
                                        <span class="boom-color-lightgray">Usuario:</span> <br>
                                        <i class="bi bi-cash"></i> boomshop
                                        <div class="tooltip-x">
                                            <i onclick="myFunction('user','myTooltip-user')"
                                                onmouseout="outFunc('myTooltip-user')" class="bi bi-clipboard copy">
                                                <span class="tooltiptext" id="myTooltip-user">Copiar al
                                                    portapapeles</span>

                                            </i>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <hr>
                            <div class="text-center mt-4 mb-4">
                                <img src="{{ route('image.show', ['image' => $paymentMethod->image]) }}" class="w-50">
                            </div>



                            <form action="{{ route('order.store') }}" method="post" id="form">
                                @csrf
                                <input type="text" name="bundle_id" hidden value="{{ $bundle->id }}">


                                <input type="text" name="payment_method_id" hidden value="{{ $paymentMethod->id }}">
                                @if ($bundle->product->need_region_id)
                                    <input type="text" name="account_id" hidden value="{{ $account_id }}">
                                    <input type="text" name="region_id" hidden value="{{ $region_id }}">
                                @elseif ($bundle->product->need_access)
                                    <input type="email" name="email" hidden value="{{ $email }}">
                                    <input type="password" name="password" hidden value="{{ $password }}">
                                @else
                                    <input type="text" name="account_id" hidden value="{{ $account_id }}">
                                @endif
                                <label for="user_id" class="form-label">Nombre de Usuario de Reserve:</label>
                                <input type="text" name="reserve_user" class="form-control mb-4" required>
                                <label for="binance_alias" class="form-label">Numero de transacción:</label>
                                <input type="text" name="transaction_id" class="form-control mb-4" required>
                                <div class="row mb-4">
                                    <div class="col-8">
                                        <input id="code" name="code" class="form-control" type="text"
                                            placeholder="CODIGO DE DESCUENTO">
                                    </div>
                                    <div class="col-4">
                                        <button type="button" onclick="validateCode()" id="validate-btn"
                                            class="btn w-100 btn-secondary">
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
                                            value="{{ number_format(($bundle->price + $bundle->price * 0.01 - ($bundle->price + $bundle->price * 0.01) * ($bundle->discount / 100)) * $paymentMethod->valuation->value, 2) }}"
                                            required hidden>
                                    </div>
                                    <div class="col-12">
                                        <div class="row p-0">
                                            <div class="col-6 text-end p-0">
                                                <span class="">Sub total&nbsp;:&nbsp;</span>
                                            </div>
                                            <div class="col text-start p-0">
                                                @if ($bundle->discount != 0)
                                                    <span
                                                        class="text-muted text-decoration-line-through">{{ number_format($bundle->price * $paymentMethod->valuation->value, 2) }}&nbsp;USD</span>
                                                @endif
                                                {{ number_format(($bundle->price - $bundle->price * ($bundle->discount / 100)) * $paymentMethod->valuation->value, 2) }}&nbsp;USD
                                            </div>
                                        </div>
                                    </div>
                                    @if ($bundle->discount > 0)
                                        <div class="col-12 text-end mb-3 mt-1">
                                            <div class="row">
                                                <div class="col p-0">
                                                    <span class="">Monto Total&nbsp;:&nbsp;</span>
                                                </div>
                                                <div class="col p-0 text-start">
                                                    <span class="fs-6" id="amount-container">
                                                        <span class="fw-bold boom-color-yellow"
                                                            id="amount">{{ number_format(($bundle->price - $bundle->price * ($bundle->discount / 100)) * $paymentMethod->valuation->value, 2) }}</span>
                                                        <span class="fw-bold"> USD</span>
                                                    </span>

                                                    <br>

                                                    <span class="fs-6" id="code-discount" hidden>
                                                        <span class="fw-bold text-primary"
                                                            id="code-discount-amount"></span>
                                                        <span class="fw-bold"> USD</span>
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
                                                            id="amount">{{ number_format(($bundle->price - $bundle->price * ($bundle->discount / 100)) * $paymentMethod->valuation->value, 2) }}</span>
                                                        <span class="fw-bold"> USD</span>
                                                    </span>

                                                    <br>

                                                    <span class="fs-6" id="code-discount" hidden>
                                                        <span class="fw-bold text-primary"
                                                            id="code-discount-amount"></span>
                                                        <span class="fw-bold"> USD</span>
                                                    </span>
                                                </div>
                                            </div>



                                        </div>
                                    @endif




                                    <div class="text-center">

                                    </div>

                                    <!-- Button trigger modal -->
                                    <div class="text-center">
                                        <button type="button" class="btn btn-primary w-50" data-bs-toggle="modal"
                                            data-bs-target="#refunds">
                                            <span class="fw-bold btn-color">Pagar</span>
                                        </button>
                                    </div>


                                    <!-- Modal -->
                                    <div class="modal fade " id="refunds" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="refundsLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content boom-notice">
                                                <div class="modal-header">
                                                    <h1 class="modal-title  fw-bold" id="refundsLabel">Sin
                                                        Reembolsos
                                                    </h1>
                                                    <i type="button" class="bi bi-x-lg" data-bs-dismiss="modal"
                                                        aria-label="Close"></i>
                                                </div>
                                                <div class="modal-body ">
                                                    <p>
                                                        Usted es responsable de asegurarse de que leyó la descripción e
                                                        instrucciones del servicio a adquirir y asegura que el monto de
                                                        la
                                                        transacción ingresado o mostrado en su pantalla sea correcto
                                                        antes
                                                        de
                                                        confirmar la transacción. Una vez que se confirme la
                                                        transacción, se
                                                        considerará irrevocable y no podrá cancelar, detener o realizar
                                                        un
                                                        reembolso de esa transacción.
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="{{ route('product.show', ['id' => $bundle->product->id]) }}">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Volver</button>
                                                    </a>

                                                    <button type="submit" class="btn btn-primary">Entendido</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endif
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
        function copy(id, toltipD) {
            var copyText = document.getElementById(id).innerText;
            navigator.clipboard.writeText(copyText);

            var tooltip = document.getElementById(toltipD);
            tooltip.innerHTML = "Copiado: " + copyText;
        }

        function outFunc(toltipD) {
            var tooltip = document.getElementById(toltipD);
            tooltip.innerHTML = "Copiar al portapapeles";
        }
    </script>
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
@endsection
