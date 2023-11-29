@extends('layouts.app')

@section('content')
    <div class="container py-4">

        <div class="row row-cols-1 row-cols-lg-2 row-cols-md-1">

            <div class="col mb-2">
                <div class="card mb-3 game-card game-description h-100">
                    <div class="card-header recharge-data-header">
                        <div class="row">
                            <div class="col-1">
                                <div class="icon-bg fs-4">
                                    <i class="bi bi-controller boom-color-lightgray"></i>
                                </div>

                            </div>
                            <div class="col text-center">
                                <b class="fs-4">{{ $product->name }}</b>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="text-center">

                            @if ($product->category->category == 'Tarjetas')
                                <img class="game-card-image mt-3 mb-2 w-50 product-description-image"
                                    src="{{ asset($product->image) }}">
                            @else
                                <img class="game-card-image mt-3 mb-2 w-75 product-description-image"
                                    src="{{ asset($product->image) }}">
                            @endif

                        </p>

                        <p class="mt-5 mb-5 fs-5 ">
                        <p class="fs-2 text-center"><b>
                                <!-- {{ $product->name }}<b>-->

                        </p>
                        <p class="text-justify fw-normal">
                            <div class="product-information">
                                <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
                                    data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
                                    Información
                                </button>
                                <div class="collapse" id="dashboard-collapse">
                                    @php
                                        echo $product->description
                                    @endphp
                                </div>
                            </div>

                            <div class="product-description">
                                @php
                                echo $product->description
                            @endphp
                            </div>
                        </p>

                    </div>
                </div>
            </div>
            <form method="POST" action="{{ route('payment.create') }}">
                @csrf
                @if ($product->category->category == 'Recargas' && $product->need_access == false)
                    <div class="col">
                        <div class="row row-cols-1">


                            <div class="col">
                                <div class="card recharge-data mb-3">
                                    <div class="card-header recharge-data-header">
                                        <div class="row">
                                            <div class="col-1">
                                                <div class="fs-4 icon-bg">
                                                    <i class="bi bi-person-badge boom-color-lightgray  fs-4"></i>
                                                </div>

                                            </div>
                                            <div class="col text-center">
                                                <b class="fs-4">Información de Cuenta</b>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-2">

                                        <div class="row mb-3 mt-3">
                                            <label for="account_id"
                                                class="col-10 col-md-4 form-label text-md-end fw-bold text-start">ID
                                                de
                                                Cuenta</label>
                                            <div class="col-sm-6 col-10">
                                                <input id="account_id" type="text"
                                                    class="form-control @error('account_id') is-invalid @enderror"
                                                    name="account_id" value="{{ old('account_id') }}"
                                                    placeholder="{{ $product->customizable_field }}" required
                                                    autocomplete="account_id" autofocus>

                                                @error('account_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <i class=" bi bi-question-circle mt-2 col-2" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal"></i>
                                        </div>

                                        <div class="row mb-3">
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content recharge-data">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                                {{ $product->name }} ID</h1>
                                                            <i type="button" class="bi bi-x-lg text-primary"
                                                                data-bs-dismiss="modal" aria-label="Close"></i>
                                                        </div>
                                                        <div class="modal-body">
                                                            <img src="{{ route('image.show', ['image' => $product->gif]) }}"
                                                                alt="" width="100%">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @if ($product->need_region_id)
                                            @if ($product->name == 'Genshin Impact')
                                                <div class="row mb-3 mt-3">
                                                    <label for="region_id"
                                                        class="col-12 col-md-3 col-form-label text-md-end text-start">ID de
                                                        Servidor</label>
                                                    <div class="col-md-8 col-10">
                                                        <select name="region_id" id="region_id" class="form-select col-6">
                                                            <option value="America">America</option>
                                                            <option value="Europe">Europe</option>
                                                            <option value="Asia">Asia</option>
                                                            <option value="TW,HK,MO">TW,HK,MO</option>
                                                        </select>

                                                        @error('region_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            @elseif ($product->name == 'Mobile Legends')
                                                <div class="row mb-3">
                                                    <label for="region_id"
                                                        class="col-sm-4 col-form-label text-start text-sm-end">Zone
                                                        ID</label>
                                                    <div class="col-10 col-sm-6">
                                                        <input id="region_id" type="number"
                                                            class="form-control @error('region_id') is-invalid @enderror"
                                                            name="region_id" value="{{ old('region_id') }}"
                                                            placeholder="4 Dígitos" required autocomplete="region_id"
                                                            autofocus>
                                                        @error('region_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            @else
                                                <div class="row row-cols-1 mb-3 mt-3">
                                                    <label for="region_id" class="col-md-4 col-form-label text-md-end">ID
                                                        de
                                                        Servidor</label>
                                                    <div class="col-md-6">
                                                        <input id="region_id" type="text"
                                                            class="form-control @error('region_id') is-invalid @enderror"
                                                            name="region_id" value="{{ old('region_id') }}" required
                                                            autocomplete="region_id" autofocus>

                                                        @error('account_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif ($product->category->category == 'Recargas' && $product->need_access == true)
                    <div class="col">
                        <div class="row row-cols-1">


                            <div class="col">
                                <div class="card recharge-data mb-3">
                                    <div class="card-header recharge-data-header">
                                        <div class="row">
                                            <div class="col-1">
                                                <div class="fs-4 icon-bg">
                                                    <i class="bi bi-person-badge boom-color-lightgray  fs-4"></i>
                                                </div>

                                            </div>
                                            <div class="col text-center">
                                                <b class="fs-4">Información de Cuenta</b>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-2">
                                        <div class="row mb-3">
                                            <div
                                                class="col-12 col-md-4 d-flex align-items-center justify-content-start justify-content-md-end">
                                                <label for="phone" class="">Teléfono</label>
                                            </div>
                                            <div class="col-12 col-md-8 d-flex">
                                                <link rel="stylesheet"
                                                    href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css">
                                                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                                <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput.min.js"></script>

                                                <input id="phone" type="tel" name="phone"
                                                    class="form-control">

                                                <script>
                                                    var input = document.querySelector("#phone");
                                                    const iti = window.intlTelInput(input, {
                                                        // Opciones del plugin
                                                        initialCountry: "auto",
                                                        geoIpLookup: function(callback) {
                                                            $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
                                                                var countryCode = (resp && resp.country) ? resp.country : "";
                                                                callback(countryCode);
                                                            });
                                                        },
                                                        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/utils.js"
                                                    });
                                                    input.addEventListener("countrychange", function() {
                                                        var data = iti.getSelectedCountryData();
                                                        input.value = "+" + data.dialCode;
                                                    });
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="col">
                    <div class="card recharge-data mb-3">
                        <div class="card-header recharge-data-header">
                            <div class="row">
                                <div class="col-1">
                                    <div class="fs-4 icon-bg">
                                        <i class="bi bi-box boom-color-lightgray "></i>
                                    </div>

                                </div>
                                <div class="col text-center">
                                    <b class=" fs-4">Paquetes</b>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-2 row-cols-xl-3">
                                @foreach ($bundles as $bundle)
                                    @if ($bundle->availability)
                                        <div class="col p-3 d-flex align-items-center justify-content-center">
                                            <div class="button p-2 position-relative w-100">
                                                <input type="radio" id="pack-{{ $bundle->id }}" name="bundle_id"
                                                    class="pack input" value="{{ $bundle->id }}" hidden required>
                                                <label class="d-flex align-items-center justify-content-center label p-2"
                                                    for="pack-{{ $bundle->id }}"><span class="text-center fw-bold"
                                                        id>{{ $bundle->content }}
                                                    </span>
                                                    <span hidden id="pack-{{ $bundle->id }}-price">{{ $bundle->price }}
                                                </label>
                                                <span
                                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary check">
                                                    <i class="bi bi-check boom-color-darkgray"></i>
                                                </span>
                                            </div>
                                            @error('bundle_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                        </div>


                    </div>
                </div>



                <div class="col">
                    <div class="card recharge-data">
                        <div class="card-header recharge-data-header mb-3">
                            <div class="row">
                                <div class="col-1">
                                    <div class="fs-4 icon-bg">
                                        <i class="bi bi-credit-card boom-color-lightgray"></i>
                                    </div>

                                </div>
                                <div class="col text-center">
                                    <b class="fs-4">Métodos de Pago</b>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row row-cols-2">

                                @foreach ($paymentMethods as $paymentMethod)
                                    @if ($paymentMethod->available)
                                        <div class="col p-3 d-flex align-items-center justify-content-center">
                                            <div class="payment-button position-relative w-100">
                                                <input class="" type="radio" hidden name="payment_method_id"
                                                    id="payment-{{ $paymentMethod->id }}" class="payment"
                                                    value="{{ $paymentMethod->id }}" required>

                                                <label
                                                    class="d-flex align-items-center justify-content-center text-center p-2"
                                                    for="payment-{{ $paymentMethod->id }}">
                                                    <img class="" src="{{ asset('disk/' . $paymentMethod->image) }}"
                                                        alt="" width="70%" srcset="">
                                                </label>
                                                <span
                                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary check">
                                                    <i class="bi bi-check boom-color-darkgray"></i>
                                                </span>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            <div class="sub-total text-center fs-5">
                                <span class="text-primary ms-bold">$</span><span id="sub-total"
                                    class="text-primary ms-bold">0.0</span> USD
                            </div>
                            <div class="row mb-5 mt-3 ">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-primary w-50">
                                        <span class="fw-bold btn-color">Comprar</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </form>

        </div>

    </div>
    </div>

    </div>

    <script type="module">
        $('input:radio').change(function() {

            $('input:radio[name=' + this.name + ']').parent().removeClass(
                'selected'); //remove class "selected" from all radio button with respective name
            $(this).parent().addClass('selected'); //add "selected" class only to the checked radio button
        });


        $('.pack').click(function() {
            var id = this.id;
            console.log(id);
            var price = parseInt(document.getElementById(this.id + '-price').textContent);
            if (price < 10) {
                var zelle = document.getElementById('payment-4');
                zelle.disabled = true;

            }
            if (price >= 10) {
                var zelle = document.getElementById('payment-4');
                zelle.disabled = false;
            }

            var subtotal = document.getElementById(this.id + '-price').textContent;
            console.log(subtotal);

            document.getElementById('sub-total').innerHTML = subtotal;

        });

        $('#payment-4').click(function() {
            var packs = $('.pack');
            packs.each(function() {
                var price_p = parseInt(document.getElementById(this.id + '-price').textContent);
                console.log(price_p);
                if (price_p < 10) {
                    var pack = document.getElementById(this.id);
                    pack.disabled = true;
                    console.log(pack);
                }
                if (price_p >= 10) {
                    var pack = document.getElementById(this.id);
                    pack.disabled = false;
                }
            });
        });

        $('#payment-1').click(function() {
            var packs = $('.pack');
            packs.each(function() {
                this.disabled = false;
            });
        });

        $('#payment-2').click(function() {
            var packs = $('.pack');
            packs.each(function() {
                this.disabled = false;
            });
        });

        $('#payment-3').click(function() {
            var packs = $('.pack');
            packs.each(function() {
                this.disabled = false;
            });
        });
    </script>
@endsection
