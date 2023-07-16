@extends('layouts.app')

@section('content')
    <div class="container py-5 min-vh-100">

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
                        <h5 class="fw-bold text-center fs-5 text-primary mb-3">Datos del Pedido</h5>
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
                        <h5 class="fw-bold text-center fs-5 text-primary mb-3">Datos de Pago</h5>
                        @if ($paymentMethod->method == 'Pago Móvil')
                            <p class="fw-bold text-center">Paga el monto total de tu orden mostrado en Bs. en la siguiente
                                cuenta.
                            </p>
                            <div class="lh-sm container">
                                <div class="row">
                                    <div class="col">
                                        Banco: <br> <span class="text-primary fw-bold"> Banesco</span>
                                    </div>
                                    <div class="col col-lg-4 col-6">
                                        Cedula de Identidad:
                                        <span class="text-primary fw-bold" id="ci">6189959</span>


                                        <div class="tooltip-x">
                                            <i onclick="myFunction('ci','myTooltip-ci')"
                                                onmouseout="outFunc('myTooltip-ci')" class="bi bi-clipboard copy">
                                                <span class="tooltiptext" id="myTooltip-ci">Copiar al
                                                    portapapeles</span>

                                            </i>
                                        </div>

                                    </div>
                                    <div class="col">
                                        Codigo: <br> <span class="text-primary fw-bold" id="bank">0134 </span>
                                        <div class="tooltip-x ">
                                            <i onclick="myFunction('bank','myTooltip-bank')"
                                                onmouseout="outFunc('myTooltip-bank')" class="bi bi-clipboard copy">
                                                <span class="tooltiptext" id="myTooltip-bank">Copiar al
                                                    portapapeles</span>

                                            </i>
                                        </div>
                                    </div>



                                    <div class="col col-xxl-4">
                                        Teléfono: <br>
                                        <span class=" text-primary fw-bold" id="tlf">04120328247</span>


                                        <div class="tooltip-x ">
                                            <i onclick="myFunction('tlf','myTooltip-tlf')"
                                                onmouseout="outFunc('myTooltip-tlf')" class="bi bi-clipboard copy">
                                                <span class="tooltiptext" id="myTooltip-tlf">Copiar al
                                                    portapapeles</span>

                                            </i>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <hr>
                            <div class="">
                                <div class="container mt-4 mb-2 text-center">
                                    <img src="{{ route('image.show', ['image' => $paymentMethod->image]) }}" class="w-25">
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
                                    <label for="bank" class="form-label ">Banco</label>
                                    <select name="bank" required class="form-select mb-4">
                                        <option value="" selected></option>
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
                                    <label for="phone" class="form-label ">Teléfono</label>
                                    <input class="form-control mb-4" type="tel" name="phone" required>
                                    <label for="transaction_id" class="form-label">Número Referencia</label>
                                    <input class="form-control mb-4" type="number" placeholder="" name="transaction_id"
                                        required>
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
                                            <input type="number" name="amount" step="0.01"
                                                class="form-control mb-4"
                                                value="{{ ($bundle->price - $bundle->price * ($bundle->discount / 100)) * $paymentMethod->valuation->value }}"
                                                required hidden>
                                        </div>
                                        @if ($bundle->discount > 0)
                                            <div class="col-12 text-end mb-3 mt-3">
                                                <span class="">MONTO TOTAL A PAGAR</span><br>
                                                <span class="text-decoration-line-through text-muted">
                                                    {{ $bundle->price * $paymentMethod->valuation->value }}
                                                    VES</span> <br>
                                                <span class="fs-5" id="amount-container">
                                                    <span class="fw-bold"
                                                        id="amount">{{ ($bundle->price - $bundle->price * ($bundle->discount / 100)) * $paymentMethod->valuation->value }}</span>
                                                    <span class="fw-bold"> VES</span>
                                                </span>
                                                <br>
                                                <br>
                                                <span class="fs-5" id="code-discount" hidden>
                                                    <span class="fw-bold" id="code-discount-amount"></span>
                                                    <span class="fw-bold"> VES</span>
                                                </span>

                                            </div>
                                        @else
                                            <div class="col-12 text-end mb-3 mt-3">
                                                <span class="">MONTO TOTAL A PAGAR: </span><br>
                                                <span class="fs-5" id="amount-container">
                                                    <span class="fw-bold"
                                                        id="amount">{{ ($bundle->price - $bundle->price * ($bundle->discount / 100)) * $paymentMethod->valuation->value }}</span>
                                                    <span class="fw-bold"> VES</span>
                                                </span>

                                                <br>

                                                <span class="fs-5" id="code-discount" hidden>
                                                    <span class="fw-bold" id="code-discount-amount"></span>
                                                    <span class="fw-bold"> VES</span>
                                                </span>

                                            </div>
                                        @endif

                                    </div>

                                    <!-- Button trigger modal -->
                                    <div class="text-center">
                                        <button type="button" class="btn btn-primary w-50" data-bs-toggle="modal"
                                            data-bs-target="#refunds">
                                            <span class="fw-bold btn-color fs-6">Pagar</span>
                                        </button>
                                    </div>


                                    <!-- Modal -->
                                    <div class="modal fade " id="refunds" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="refundsLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content boom-notice">
                                                <div class="modal-header">
                                                    <h1 class="modal-title  fw-bold text-primary text-center"
                                                        id="refundsLabel">
                                                        Sin Reembolsos
                                                    </h1>
                                                    <i type="button" class="bi bi-x-lg text-primary"
                                                        data-bs-dismiss="modal" aria-label="Close"></i>
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

                                                    <button type="submit" class="btn btn-primary">Entendido</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        @endif

                        @if ($paymentMethod->method == 'Zelle')
                            <p class="  fw-bold text-center">Envía tu pago completo a la siguiente dirección de
                                Zelle</p>


                            <div class="row">
                                <div class="col-12 col-sm-3">Correo: </div>
                                <div class="col-11 col-sm-8 col-lg-8 col-xxl-8 col-xl-8 text-primary fw-bold"
                                    id="correo">
                                    pagos@isboomshop.com
                                </div>
                                <div class="col-1 text-start">

                                    <div class="tooltip-x">
                                        <i onclick="myFunction('correo','myTooltip-correo')"
                                            onmouseout="outFunc('myTooltip-correo')" class="bi bi-clipboard copy">
                                            <span class="tooltiptext" id="myTooltip-correo">Copy to
                                                clipboard</span>

                                        </i>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-sm-3 ">Nombre: </div>
                                <div class="col-11 col-sm-8 col-lg-8 col-lg-6 col-xxl-8 col-xl-8 text-start text-primary fw-bold"
                                    id="nombre">
                                    Olvin De Barros
                                </div>
                                <div class="col-1 text-start">

                                    <div class="tooltip-x">
                                        <i onclick="myFunction('nombre','myTooltip-nombre')"
                                            onmouseout="outFunc('myTooltip-nombre')" class="bi bi-clipboard copy">
                                            <span class="tooltiptext" id="myTooltip-nombre">Copy to
                                                clipboard</span>

                                        </i>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="container mt-4 mb-2 text-center">
                                <img src="{{ route('image.show', ['image' => $paymentMethod->image]) }}" class="w-25">
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

                                <label for="name" class="form-label ">Nombre de quien envía (como se muestra en la
                                    cuenta):</label>
                                <input type="text" name="name" required class="form-control mb-4">
                                <label for="amount" class="form-label ">Código de confirmación</label>

                                <input type="number" name="confirmation_code" class="form-control mb-4" required>
                                <label for="confirmation_code" hidden class="form-label">Monto</label>
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
                                            value="{{ ($bundle->price - $bundle->price * ($bundle->discount / 100)) * $paymentMethod->valuation->value }}"
                                            required hidden>
                                    </div>
                                    @if ($bundle->discount > 0)
                                        <div class="col-12 text-end mb-3 mt-3">
                                            <span class="">MONTO TOTAL A PAGAR</span><br>
                                            <span class="text-decoration-line-through text-muted">
                                                {{ $bundle->price * $paymentMethod->valuation->value }}
                                                USD</span> <br>
                                            <span class="fs-5" id="amount-container">
                                                <span class="fw-bold"
                                                    id="amount">{{ ($bundle->price - $bundle->price * ($bundle->discount / 100)) * $paymentMethod->valuation->value }}</span>
                                                <span class="fw-bold"> USD</span>
                                            </span>
                                            <br>
                                            <br>
                                            <span class="fs-5" id="code-discount" hidden>
                                                <span class="fw-bold" id="code-discount-amount"></span>
                                                <span class="fw-bold"> USD</span>
                                            </span>

                                        </div>
                                    @else
                                        <div class="col-12 text-end mb-3 mt-3">
                                            <span class="">MONTO TOTAL A PAGAR: </span><br>
                                            <span class="fs-5" id="amount-container">
                                                <span class="fw-bold"
                                                    id="amount">{{ ($bundle->price - $bundle->price * ($bundle->discount / 100)) * $paymentMethod->valuation->value }}</span>
                                                <span class="fw-bold"> USD</span>
                                            </span>

                                            <br>

                                            <span class="fs-5" id="code-discount" hidden>
                                                <span class="fw-bold" id="code-discount-amount"></span>
                                                <span class="fw-bold"> USD</span>
                                            </span>

                                        </div>
                                    @endif
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
                                            <div class="modal-content recharge-data">
                                                <div class="modal-header">
                                                    <h1 class="modal-title  fw-bold" id="refundsLabel">Sin Reembolsos
                                                    </h1>
                                                    <i type="button" class="bi bi-x-lg" data-bs-dismiss="modal"
                                                        aria-label="Close"></i>
                                                </div>
                                                <div class="modal-body ">
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
                                <p class="text-center fw-bold">Envía tu pago completo unicamente en “USDT” a la
                                    siguiente dirección de Binance Pay
                                </p>


                                <div class="row lh-sm">
                                    <div class="col-6">
                                        Correo:<span class="text-primary fw-bold mb-3" id="correo">
                                            pagos@isboomshop.com
                                        </span>
                                        <span class="text-start">

                                            <div class="tooltip-x">
                                                <i onclick="myFunction('correo','myTooltip-correo')"
                                                    onmouseout="outFunc('myTooltip-correo')" class="bi bi-clipboard copy">
                                                    <span class="tooltiptext" id="myTooltip-correo">Copy to
                                                        clipboard</span>

                                                </i>
                                            </div>
                                        </span>
                                    </div>

                                    <div class="col-6">Nombre: <span class="text-start text-primary fw-bold "
                                            id="nombre">
                                            BOOMSHOP
                                        </span>
                                        <span class="text-start">

                                            <div class="tooltip-x">
                                                <i onclick="myFunction('nombre','myTooltip-nombre')"
                                                    onmouseout="outFunc('myTooltip-nombre')" class="bi bi-clipboard copy">
                                                    <span class="tooltiptext" id="myTooltip-nombre">Copy to
                                                        clipboard</span>

                                                </i>
                                            </div>
                                        </span>
                                    </div>


                                </div>



                                <hr>
                                <div class="text-center mt-4">
                                    <img src="{{ route('image.show', ['image' => $paymentMethod->image]) }}"
                                        class="w-25">
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

                                    <label for="user_id" class="form-label ">ID de Usuario:</label>
                                    <input type="text" name="user_id" class="form-control mb-4" required>
                                    <label for="binance_alias" class="form-label ">Alias de Binance:</label>
                                    <input type="text" name="binance_alias" class="form-control mb-4" required>
                                    <label for="order_id" class="form-label">ID de Orden</label>
                                    <input type="number" name="order_id" class="form-control mb-4" required>
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
                                            <input type="number" name="amount" step="0.01"
                                                class="form-control mb-4"
                                                value="{{ ($bundle->price - $bundle->price * ($bundle->discount / 100)) * $paymentMethod->valuation->value }}"
                                                required hidden>
                                        </div>
                                        @if ($bundle->discount > 0)
                                            <div class="col-12 text-end mb-3 mt-3">
                                                <span class="">MONTO TOTAL A PAGAR</span><br>
                                                <span class="text-decoration-line-through text-muted">
                                                    {{ $bundle->price * $paymentMethod->valuation->value }}
                                                    USD</span> <br>
                                                <span class="fs-5" id="amount-container">
                                                    <span class="fw-bold"
                                                        id="amount">{{ ($bundle->price - $bundle->price * ($bundle->discount / 100)) * $paymentMethod->valuation->value }}</span>
                                                    <span class="fw-bold"> USDT</span>
                                                </span>
                                                <br>
                                                <br>
                                                <span class="fs-5" id="code-discount" hidden>
                                                    <span class="fw-bold" id="code-discount-amount"></span>
                                                    <span class="fw-bold"> USDT</span>
                                                </span>

                                            </div>
                                        @else
                                            <div class="col-12 text-end mb-3 mt-3">
                                                <span class="">MONTO TOTAL A PAGAR: </span><br>
                                                <span class="fs-5" id="amount-container">
                                                    <span class="fw-bold"
                                                        id="amount">{{ ($bundle->price - $bundle->price * ($bundle->discount / 100)) * $paymentMethod->valuation->value }}</span>
                                                    <span class="fw-bold"> USDT</span>
                                                </span>

                                                <br>

                                                <span class="fs-5" id="code-discount" hidden>
                                                    <span class="fw-bold" id="code-discount-amount"></span>
                                                    <span class="fw-bold"> USDT</span>
                                                </span>

                                            </div>
                                        @endif
                                        <p type="button" data-bs-toggle="modal" class="text-center mt-2"
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
                                </form>
                            </div>
                        @endif

                        @if ($paymentMethod->method == 'Reserve')
                            <p class="fw-bold  text-center">Envía tu pago con Rpay al Siguiente usuario
                            </p>
                            <div class="row flex-row d-flex justify-content-center">
                                <div class="col-xxl-6 col-xl-10 col-lg-8 col-md-8 col-sm-10 col-12">
                                    <div class="row">
                                        <div class="col-4 col-sm-3 col-xxl-4">Usuario: </div>
                                        <div class="col-6 col-sm-8 col-lg-8 col-lg-6 col-xxl-7 col-xl-8  text-primary fw-bold"
                                            id="user"><i class="bi bi-cash"></i> boomshop
                                        </div>
                                        <div class="col-1 text-start">

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
                            </div>
                            <hr>
                            <div class="text-center mt-4 mb-4">
                                <img src="{{ route('image.show', ['image' => $paymentMethod->image]) }}" class="w-25">
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
                                            value="{{ ($bundle->price - $bundle->price * ($bundle->discount / 100)) * $paymentMethod->valuation->value }}"
                                            required hidden>
                                    </div>
                                    @if ($bundle->discount > 0)
                                        <div class="col-12 text-end mb-3 mt-3">
                                            <span class="">MONTO TOTAL A PAGAR</span><br>
                                            <span class="text-decoration-line-through text-muted">
                                                {{ $bundle->price * $paymentMethod->valuation->value }}
                                                USD</span> <br>
                                            <span class="fs-5" id="amount-container">
                                                <span class="fw-bold"
                                                    id="amount">{{ ($bundle->price - $bundle->price * ($bundle->discount / 100)) * $paymentMethod->valuation->value }}</span>
                                                <span class="fw-bold"> USD</span>
                                            </span>
                                            <br>
                                            <br>
                                            <span class="fs-5" id="code-discount" hidden>
                                                <span class="fw-bold" id="code-discount-amount"></span>
                                                <span class="fw-bold"> USD</span>
                                            </span>

                                        </div>
                                    @else
                                        <div class="col-12 text-end mb-3 mt-3">
                                            <span class="">MONTO TOTAL A PAGAR: </span><br>
                                            <span class="fs-5" id="amount-container">
                                                <span class="fw-bold"
                                                    id="amount">{{ ($bundle->price - $bundle->price * ($bundle->discount / 100)) * $paymentMethod->valuation->value }}</span>
                                                <span class="fw-bold"> USD</span>
                                            </span>

                                            <br>

                                            <span class="fs-5" id="code-discount" hidden>
                                                <span class="fw-bold" id="code-discount-amount"></span>
                                                <span class="fw-bold"> USD</span>
                                            </span>

                                        </div>
                                    @endif
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
                                            <div class="modal-content recharge-data">
                                                <div class="modal-header">
                                                    <h1 class="modal-title  fw-bold" id="refundsLabel">Sin Reembolsos
                                                    </h1>
                                                    <i type="button" class="bi bi-x-lg" data-bs-dismiss="modal"
                                                        aria-label="Close"></i>
                                                </div>
                                                <div class="modal-body ">
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
                </div>
            </div>
        </div>
    </div>
    <script>
        function myFunction(id, toltipD) {
            var copyText = document.getElementById(id).innerText;
            navigator.clipboard.writeText(copyText);

            var tooltip = document.getElementById(toltipD);
            tooltip.innerHTML = "Copiado: " + copyText;
        }

        function outFunc(toltipD) {
            var tooltip = document.getElementById(toltipD);
            tooltip.innerHTML = "Copiar al portapapeles";
        }

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
@endsection
