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
                                    src="{{ route('image.show', ['image' => $product->image]) }}">
                            @else
                                <img
                                    class="game-card-image mt-3 mb-2 w-75 product-description-image"src="{{ route('image.show', ['image' => $product->image]) }}">
                            @endif

                        </p>

                        <p class="mt-5 mb-5 fs-5 ">
                        <p class="fs-2 text-center"><b>
                                <!-- {{ $product->name }}<b>-->

                        </p>
                        <p class="text-justify fw-normal">
                            <!--{{ $product->description }}-->
                        </p>


                        @if ($product->name == 'Call Of Duty Mobile (Venezuela)')
                            <p class="fs-2 text-center"><b>CALL OF DUTY: MOBILE<b><br>
                                        (Venezuela)
                            </p>

                            <p class="text-center fw-normal">
                                Juega diferentes formas de juego como el clásico modo multijugador o el modo Battle
                                Royale.
                                Además de eso, puedes personalizar tus armas y llevar a tu equipo a la victoria con los
                                gráficos más destacados. ¡Podrás disfrutar de emocionantes momentos con tus amigos!

                            </p>

                            <p class="text-center fw-bold">Este servicio de recarga SÓLO se aplica a los jugadores de
                                CODM en Venezuela.</p>

                            <p class="text-justify fw-normal">Las compras del Pase de Batalla son válidas para cuentas
                                que actualmente no tienen una
                                suscripción de Pase de Batalla existente. Verifica el estado de tu suscripción iniciando
                                sesión en tu cuenta en el juego.
                            </p>



                            <b>Para saber tu ID de Jugador debes ir a:<b>
                                    <ul class="list-unstyled">
                                        <li class="fw-normal">→ Lobby del Juego</li>
                                        <li class="fw-normal">→ Configuración</li>
                                        <li class="fw-normal">→ Legal y Privacidad</li>
                                        <li class="fw-normal">→ Copia tu Player ID de 6-7 Dígitos.</li>
                                    </ul>

                                    <span class="mb-2 mt-2 d-block">Asegúrese de ingresar su ID de Jugador
                                        correctamente.</span>

                                    <p>¿Cómo saber si puedo recargar mi cuenta por ID desde Venezuela?</p>
                                    <p> - Tu Pase de Batalla debe costar 360 CP (Imagen de referencia).</p>
                                    <p class="text-center">
                                        <img src="{{ asset('images/cod/COD MOBILE ID REF.jpeg') }}" alt=""
                                            srcset="" class="w-50">
                                    </p>

                                    <p>- Tu cuenta de Call of Duty debe ser creada únicamente en <b>VENEZUELA<b>.</p>
                        @endif

                        @if ($product->name == 'Free Fire')
                        <div class="product-description">
                            <p class="fs-2 text-center"><b>FREE FIRE<b><br>

                            </p>

                            <p class="text-center fw-normal">
                                Es un shooter para móviles multijugador de supervivencia del género Battle Royale en el
                                que te enfrentas a otros 49 jugadores.
                                <br>
                                Disfrutarás diferentes modos de juegos para compartir con tus amistades o el mundo.

                            </p>
                        </div>

                        @endif

                        @if ($product->name == 'Genshin Impact')
                            <p class="fs-2 text-center"><b>GENSHIN IMPACT<b><br>

                            </p>

                            <p class="text-center fw-normal">
                                Genshin Impact es un RPG gratuito de mundo abierto en el que podremos explorar un mundo
                                vasto lleno de mazmorras, secretos y aventuras que vivir. Con una descripción tan vaga,
                                uno no puede llegar a entender qué es lo que lo hace destacar frente a los otros tantos
                                RPGs ya existentes.
                            </p>

                            <p class="fw-normal">Es seguro y fácil. Simplemente ingrese su ID de usuario de Genshin
                                Impact y Servidor,
                                seleccione los artículos que desea comprar, complete el pago y listo, al confirmar su
                                pago su recarga llegará directamente su cuenta.
                            </p>

                            <p class="fw-normal">
                                <b>Bendición Lunar</b><br>

                                Por cada compra de Bendición Lunar, obtendrás 300 Cristales Génesis y una Bendición
                                Lunar que durará 30 días.
                                Mientras dure su efecto, podrás iniciar sesión para recibir 90 Protogemas diarias.
                            </p>

                            <p>
                                <b>Importante:</b>
                            <ul class="list-unstyled fw-normal">
                                <li class="mb-2 ms-4"> <b>1)</b> La duración de la Bendición Lunar solo se puede
                                    extender si su duración restante
                                    es
                                    menor o igual a 180 días.
                                </li>

                                <li class="mb-2 ms-4">
                                    <b>2)</b> No puedes comprar una bendición adicional si la duración restante aún
                                    excede los
                                    180
                                    días. Si debido a circunstancias excepcionales compras repetidamente una Bendición
                                    Lunar, su duración no se extenderá, y se te reembolsará 330 Cristales génesis
                                    directamente.
                                </li>

                                <li class="mb-2 ms-4">
                                    <b>3)</b> No se reembolsará ninguna Protogema que no se haya obtenido mediante
                                    inicio de
                                    sesión
                                    durante la duración de la bendición.
                                </li>

                                <li class="mb-2 ms-4">
                                    <b>4)</b>
                                    Las cuentas con un Rango de Aventura inferior a 5 no pueden ver temporalmente el
                                    número de días restantes de su Bono mensual.
                                </li>
                            </ul>




                            </p>
                        @endif

                        @if ($product->name == 'Mobile Legends Bang Bang')
                            <p class="text-center fw-bold fs-2">MOBILE LEGENDS BANG BANG</p>

                            <p class="text-center">Mobile Legends: Bang Bang, el juego MOBA destacado para móviles del
                                mundo. </p>

                            <p class="text-center">¡Tu teléfono ansía la batalla! Participa en batallas 5v5 en tiempo real y
                                contra oponentes
                                reales.
                            </p>

                            <p class="text-center">
                                El objetivo principal del juego es llevar a tu ejército por los diferentes carriles,
                                mientras se destruye cada torre que se cruce y que impida realizar el recorrido
                                correspondiente hasta la base de nuestro interés. De igual manera, es necesario considerar
                                que solo se pueden ejercer ataques a las torretas cuando tu equipo esté lo suficientemente
                                cercano a ellas, porque en el caso contrario tú pasarás a ser el objetivo de todos los
                                ataques y adicionalmente podrías dañar tus niveles y estatus, así como también tu ranking
                                dentro de la partida y el site de Mobile Legends.
                            </p>
                        @endif

                        @if ($product->name == 'PUBG Mobile')
                            <P class="text-center fs-2 fw-bold">
                                PUBG MOBILE
                            </P>

                            <p class="fw-normal text-center">
                                <b>PUBG MOBILE</b> es un juego móvil de battle royale. Prepara tus armas de fuego, responde
                                al
                                llamado de la batalla en <b>PUBG MOBILE</b> y dispara a discreción. <b>PUBG MOBILE</b> tiene
                                muchos mapas
                                y mecánicas de juego que te brindan una emocionante experiencia de supervivencia.
                            </p>

                            <p class="fw-normal text-center">
                                Juega con amigos y personas reales de todo el mundo.
                            </p>
                        @endif

                        @if ($product->name == 'Call Of Duty Mobile (Global)')
                            <P class="text-center fs-2 fw-bold">
                                CALL OF DUTY MOBILE <br> (GLOBAL)
                            </P>

                            <p class="fw-normal text-center">
                                Juega diferentes formas de juego como el clásico modo multijugador o el modo Battle Royale.
                            </p>

                            <p class="fw-bold text-center">
                                Este servicio de recarga está disponible a jugadores de CODM en todo el mundo.
                            </p>

                            <p class="fw-normal">
                                Nuestro sistema le permite tener la seguridad y garantía que necesita para poder realizar su
                                recarga de forma interna, utilizando el método oficial “Activision” (ingreso mediante la
                                plataforma de Call Of Duty) ingresando su correo y contraseña.
                            </p>

                            <p class="fw-normal">
                                <b>Sistema de Seguridad:</b> Al recargar su cuenta con éxito, el sistema “BOOM” eliminará
                                automáticamente los datos ingresados por el usuario.
                            </p>

                            <p class="fw-normal">
                                <b>IMPORTANTE:</b> Para una seguridad extra, recomendamos actualizar su clave de acceso una
                                vez obtenida la recarga.
                            </p>

                            <p>
                                <b>¿No tengo vinculada mi cuenta con Activision?</b> <br>

                                <a href="">→ Ver Tutorial de Vinculación</a> <br>


                                Asegúrese de ingresar sus datos correctamente.
                            </p>
                        @endif



                    </div>
                </div>
            </div>
            <form method="POST" action="{{ route('payment.create') }}">
                @csrf
                <input type="number" hidden name="game_id" value="{{ $product->id }}">
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

                                        @if ($product->need_region_id)
                                            <div class="row mb-3 mt-3">
                                                <label for="account_id" class="col-5 col-sm-3 col-form-label text-md-end">ID
                                                    de
                                                    Cuenta</label>
                                                <div class="mb-3 col-10 col-sm-8">
                                                    <input id="account_id" type="text"
                                                        class="form-control @error('account_id') is-invalid @enderror"
                                                        name="account_id" value="{{ old('account_id') }}" required
                                                        autocomplete="account_id" autofocus>

                                                    @error('account_id')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <i class="col-1 bi bi-question-circle fs-4 mt-2 text-start"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModal">

                                                </i>

                                            </div>
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
                                            @elseif ($product->name == 'Mobile Legends Bang Bang')
                                                <div class="row mb-3">
                                                    <label for="region_id"
                                                        class="col-sm-3 col-form-label text-start text-sm-end">Zone
                                                        ID</label>
                                                    <div class="col-10 col-sm-8">
                                                        <input id="region_id" type="number"
                                                            class="form-control @error('region_id') is-invalid @enderror"
                                                            name="region_id" value="{{ old('region_id') }}" placeholder="4 Dígitos" required
                                                            autocomplete="region_id" autofocus>
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
                                        @else
                                            <div class="row mb-3 mt-3">
                                                <label for="account_id"
                                                    class="col-10 col-md-4 form-label text-md-end fw-bold text-start">ID
                                                    de
                                                    Cuenta</label>
                                                <div class="col-sm-6 col-10">
                                                    <input id="account_id" type="text"
                                                        class="form-control @error('account_id') is-invalid @enderror"
                                                        name="account_id" value="{{ old('account_id') }}" required
                                                        autocomplete="account_id" autofocus>

                                                    @error('account_id')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <i class=" bi bi-question-circle mt-2 col-2"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModal"></i>
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
                                        @endif
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
                                        <div class="payment-button position-relative">
                                            <input class="" type="radio" hidden name="payment_method_id"
                                                id="payment-{{ $paymentMethod->id }}" class="payment"
                                                value="{{ $paymentMethod->id }}" required>

                                            <label class="d-flex align-items-center justify-content-center text-center p-2"
                                                style="width: 100%" for="payment-{{ $paymentMethod->id }}">
                                                <img class=""
                                                    src="{{ route('image.show', ['image' => $paymentMethod->image]) }}"
                                                    alt="" width="80%" srcset="">
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
                               <span class="text-primary ms-bold">$</span><span id="sub-total" class="text-primary ms-bold">0.0</span> USD
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


        $('.pack').click(function () {
            var id = this.id;
            console.log(id);
            var price = parseInt(document.getElementById(this.id+'-price').textContent);
            if (price<10) {
                var zelle = document.getElementById('payment-4');
                zelle.disabled = true;

            }
            if(price>=10){
                var zelle = document.getElementById('payment-4');
                zelle.disabled = false;
            }

           var subtotal = document.getElementById(this.id+'-price').textContent;
           console.log(subtotal);

           document.getElementById('sub-total').innerHTML = subtotal;

        });

        $('#payment-4').click(function () {
            var packs = $('.pack');
            packs.each(function(){
        	    var price_p = parseInt(document.getElementById(this.id+'-price').textContent);
                console.log(price_p);
                if ( price_p<10) {
                    var pack = document.getElementById(this.id);
                    pack.disabled = true;
                    console.log(pack);
                }
                if(price_p>=10){
                    var pack = document.getElementById(this.id);
                    pack.disabled = false;
                }
        	});
        });

        $('#payment-1').click(function () {
            var packs = $('.pack');
            packs.each(function(){
                this.disabled = false;
        	});
        });

        $('#payment-2').click(function () {
            var packs = $('.pack');
            packs.each(function(){
                this.disabled = false;
        	});
        });

        $('#payment-3').click(function () {
            var packs = $('.pack');
            packs.each(function(){
                this.disabled = false;
        	});
        });

    </script>
@endsection
