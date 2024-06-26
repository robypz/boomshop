<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="BOOM es una página que ofrece servicios de recargas para videojuegos y streaming.">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('assets/images/LOGO COMPLETO TRANSP.png') }}">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>

    <div class="loading-body">
        <div class="ticker">
            <div class="nub c"></div>
            <div class="tick c"></div>
            <div class="tick c"></div>
            <div class="tick c"></div>
        </div>
    </div>

    <div id="app">

        <nav class="navbar mynavbar">
            <div class="container">
                <a class="navbar-brand p-0 m-0" href="{{ route('home') }}">
                    <img src="{{ asset('assets/images/LOGO COMPLETO TRANSP.png') }}" alt="..." height="55" />
                </a>

                <a class="menu-options mymenu-options" href="{{ route('home') }}">Inicio</a>
                <a class="menu-options mymenu-options" href="{{ route('help') }}">Nosotros</a>
                <a class="menu-options mymenu-options" href="{{ route('news') }}">Novedades</a>
                <a class="menu-options mymenu-options" href="{{ route('help.transactionsAndPayments') }}">Ayuda</a>

                <div class="row">@auth
                        @hasanyrole('super-admin|admin|operator')
                            <div class="col text-end">

                                @livewire('notification-component')

                            </div>
                        @endhasanyrole
                    @endauth

                    <div class="col">
                        <button class="mynavar-toggler navbar-toggler" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
                            <i class="bi bi-list fs-4"></i>
                        </button>
                    </div>
                </div>





            </div>

            <!-- offcanvas-->
            <div class="myoffcanvas-body sidebar offcanvas offcanvas-end" tabindex="-1" id="offcanvasDarkNavbar"
                aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">

                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>

                <div class="offcanvas-body">

                    @guest
                        <ul class="navbar-nav d-flex align-items-center justify-content-center flex-grow-1 pe-3 h-100">
                            <div>
                                <li class="nav-item">
                                    <div class="container text-center">
                                        <div class="row">
                                            <div class="col-12">
                                                <img src="{{ asset('assets/images/iphone.png') }}" width="60%" />
                                            </div>
                                            <p class="lite-text">
                                                Sea el primero en ser informado acerca de increibles
                                                promociones y descuentos
                                            </p>
                                        </div>

                                        <div class="row">
                                            @if (Route::has('register'))
                                                <div class="col-6 p-1">
                                                    <a class="nav-link text-primary" href="{{ route('register') }}">
                                                        <button type="button"
                                                            class="btn btn-blue w-100 rounded-pill fw-bold">
                                                            <small>Registrarse</small>
                                                        </button>
                                                    </a>

                                                </div>
                                            @endif


                                            @if (Route::has('login'))
                                                <div class="col-6 p-1">

                                                    <a class="nav-link text-primary" href="{{ route('login') }}"> <button
                                                            type="button"
                                                            class="btn btn-primary rounded-pill fw-bold w-100">
                                                            <small>Iniciar Sesion</small>
                                                        </button></a>

                                                </div>
                                            @endif


                                        </div>
                                    </div>
                                </li>
                            </div>

                        </ul>
                    @else
                        <ul class="navbar-nav ms-auto d-flex  justify-content-center flex-grow-1 pe-3 h-100">
                            <li class="nav-item mb-3">
                                <a id="" class="nav-item fs-4" href="{{ route('user.profile') }}"
                                    aria-current="page">
                                    <div class="row">
                                        @if (Auth::user()->avatar)
                                            <div class="col-1">
                                                <img class="rounded" src="{{ asset(Auth::user()->avatar->avatar) }}"
                                                    alt="" srcset="" width="32px">
                                            </div>
                                        @else
                                            <div class="col-1">
                                                <img class="rounded"
                                                    src="{{ asset('assets/images/avatars/R.4736402c763d8cd003b22408c95e4776.jpg') }}"
                                                    alt="" srcset="" width="32px">
                                            </div>
                                        @endif

                                        <div class="col">
                                            <span class="ms-2 fw-bold">{{ Auth::user()->nick }}</span>
                                        </div>
                                    </div>

                                </a>


                            </li>
                            <li class="nav-item">
                                <a class="fs-4 nav-item" aria-current="page" href="{{ route('home') }}"><i
                                        class="bi bi-house me-2 "></i>Inicio</a>
                            </li>
                            <li class="nav-item">
                                <a class="fs-4 nav-item" aria-current="page" href="{{ route('user.orders') }}"><i
                                        class="bi bi-cart-check me-2 "></i>Historial de Compras</a>
                            </li>
                            <li class="nav-item">
                                <a class="fs-4 nav-item" aria-current="page" href="{{ route('user.giftCards') }}"><i
                                        class="bi bi-collection me-2 "></i>Tarjetas</a>
                            </li>

                            <li class="nav-item mt-3 text-center">

                                <a class="btn btn-blue rounded-pill fw-bold boom-color-darkgray fs-5 w-75"
                                    href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    <i class="bi bi-door-closed me-2 "></i>{{ __('Cerrar sesión') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>

                            </li>
                            <hr>
                            @hasanyrole('super-admin|admin|operator')
                                <li class="nav-item dropdown mb-2 ">
                                    <a class="dropdown-toggle fs-4 nav-item" href="#" role="link"
                                        data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-wallet2 me-2 "></i>
                                        Ordenes
                                    </a>
                                    <ul class="dropdown-menu user-dropdown">
                                        @hasanyrole('super-admin|admin')
                                            <li><a class="dropdown-item text-primary user-dropdown-item"
                                                    href="{{ route('order.index') }}"><i class="bi bi-clock-history me-1">
                                                    </i>Historial</a></li>
                                        @endhasanyrole
                                        <li><a class="dropdown-item text-primary user-dropdown-item"
                                                href="{{ route('order.pending') }}"><i
                                                    class="bi bi-clipboard2 me-1"></i>Ordenes Pendientes</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item text-primary user-dropdown-item"
                                                href="{{ route('user.ordersInProcess') }}"><i
                                                    class="bi bi-arrow-down-up me-1"></i>Ordenes en Proceso</a>
                                        </li>
                                    </ul>
                                </li>
                            @endhasanyrole
                            @hasanyrole('super-admin')
                                <li class="nav-item dropdown mb-2 ">
                                    <a class="dropdown-toggle nav-item fs-4" href="#" role="link"
                                        data-bs-toggle="dropdown" aria-expanded="false"><i
                                            class="bi bi-controller me-2 "></i>
                                        Productos
                                    </a>
                                    <ul class="dropdown-menu user-dropdown">
                                        <li><a class="dropdown-item text-primary user-dropdown-item"
                                                href="{{ route('product.index') }}"><i class="bi bi-list me-1"></i>Ver
                                                Todos</a>
                                        </li>
                                        <li><a class="dropdown-item text-primary user-dropdown-item"
                                                href="{{ route('product.create') }}"><i
                                                    class="bi bi-plus me-1"></i>Agregar</a>
                                        </li>
                                        <li><a class="dropdown-item text-primary user-dropdown-item"
                                                href="{{ route('category.index') }}"><i
                                                    class="bi bi-card-list me-1"></i></i>Categorías</a>
                                        </li>
                                    </ul>
                                </li>
                            @endhasanyrole
                            @hasanyrole('super-admin|admin')
                                <li class="nav-item dropdown mb-2 ">
                                    <a class="dropdown-toggle fs-4 nav-item" href="#" role="link"
                                        data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-box me-2 "></i>
                                        Paquetes
                                    </a>
                                    <ul class="dropdown-menu user-dropdown">
                                        <li><a class="dropdown-item text-primary user-dropdown-item"
                                                href="{{ route('bundle.index') }}"><i class="bi bi-list-columns me-1"></i>Ver
                                                Todos</a></li>
                                        <li>
                                            <a class="dropdown-item text-primary user-dropdown-item"
                                                href="{{ route('bundle.create') }}"><i class="bi bi-plus me-1"></i>
                                                Agregar
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endhasanyrole
                            @hasanyrole('super-admin')
                                <li class="nav-item dropdown mb-2 ">
                                    <a class="dropdown-toggle fs-4 nav-item" href="#" role="link"
                                        data-bs-toggle="dropdown" aria-expanded="false"><i
                                            class="bi bi-credit-card me-2 "></i>
                                        Métodos de Pago
                                    </a>
                                    <ul class="dropdown-menu user-dropdown">
                                        <li><a class="dropdown-item text-primary user-dropdown-item"
                                                href="{{ route('paymentMethod.index') }}"><i
                                                    class="bi bi-list-columns me-1"></i>Ver Todos</a></li>
                                        <li>
                                            <a class="dropdown-item text-primary user-dropdown-item"
                                                href="{{ route('paymentMethod.create') }}"><i class="bi bi-plus me-1"></i>
                                                Agregar
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endhasanyrole
                            @hasanyrole('super-admin')
                                <li class="nav-item dropdown mb-2 ">
                                    <a class="dropdown-toggle fs-4 nav-item" href="#" role="link"
                                        data-bs-toggle="dropdown" aria-expanded="false"><i
                                            class="bi bi-person-vcard me-2 "></i>
                                        Usuarios
                                    </a>
                                    <ul class="dropdown-menu user-dropdown">
                                        <li><a class="dropdown-item text-primary user-dropdown-item"
                                                href="{{ route('user.index') }}"><i class="bi bi-list-columns me-1"></i>Ver
                                                Todos</a></li>
                                    </ul>
                                </li>
                            @endhasanyrole
                            @hasanyrole('super-admin|admin')
                                <li class="nav-item dropdown mb-2 ">
                                    <a class="dropdown-toggle fs-4 nav-item" href="#" role="link"
                                        data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-cash-coin me-2 "></i>
                                        Valuaciones
                                    </a>
                                    <ul class="dropdown-menu user-dropdown">
                                        <li><a class="dropdown-item text-primary user-dropdown-item"
                                                href="{{ route('valuation.index') }}"><i
                                                    class="bi bi-list-columns me-1"></i>Ver
                                                Todas</a></li>
                                        <li>
                                            <a class="dropdown-item text-primary user-dropdown-item"
                                                href="{{ route('valuation.create') }}"><i class="bi bi-plus me-1"></i>
                                                Agregar
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endhasanyrole

                            @hasanyrole('super-admin|admin')
                                <li class="nav-item dropdown mb-2 ">
                                    <a class="dropdown-toggle fs-4 nav-item" href="#" role="link"
                                        data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-ticket me-2 "></i>
                                        Codigos de Promoción
                                    </a>
                                    <ul class="dropdown-menu user-dropdown">
                                        <li><a class="dropdown-item text-primary user-dropdown-item"
                                                href="{{ route('code.index') }}"><i class="bi bi-list me-1"></i>Ver
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item text-primary user-dropdown-item"
                                                href="{{ route('code.create') }}"><i class="bi bi-plus me-1"></i>
                                                Agregar
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endhasanyrole

                            @hasanyrole('super-admin|admin')
                                <li class="nav-item dropdown mb-2 ">
                                    <a class="dropdown-toggle fs-4 nav-item" href="#" role="link"
                                        data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-wallet2 me-2 "></i>
                                        Avatares
                                    </a>
                                    <ul class="dropdown-menu user-dropdown">
                                        @hasanyrole('super-admin|admin')
                                            <li><a class="dropdown-item text-primary user-dropdown-item"
                                                    href="{{ route('avatar.index') }}"><i class="bi bi-list me-1"></i>Ver
                                                    Todos</a></li>
                                        @endhasanyrole
                                        <li><a class="dropdown-item text-primary user-dropdown-item"
                                                href="{{ route('avatar.create') }}"><i
                                                    class="bi bi-clipboard2 me-1"></i>Agregar</a></li>
                                    </ul>
                                </li>

                                <li class="nav-item dropdown mb-2 ">
                                    <a class="dropdown-toggle fs-4 nav-item" href="#" role="link"
                                        data-bs-toggle="dropdown" aria-expanded="false"><i
                                            class="bi bi-info-circle me-2"></i></i>
                                        Avisos
                                    </a>
                                    <ul class="dropdown-menu user-dropdown">
                                        <li><a class="dropdown-item text-primary user-dropdown-item"
                                                href="{{ route('notice.index') }}"><i class="bi bi-list me-1"></i>Ver
                                                todos</a></li>

                                        <li><a class="dropdown-item text-primary user-dropdown-item"
                                                href="{{ route('notice.create') }}"><i
                                                    class="bi bi-plus me-1"></i></i>Agregar</a></li>
                                    </ul>
                                </li>
                            @endhasanyrole

                        </ul>

                    @endguest


                </div>

                <!-- OFF Canva body1-->
            </div>
            <!-- end offcanvas-->
        </nav>

        <main>
            @yield('content')
        </main>

        <div class="footer">

            <div class="container">
                <footer class="row row-cols-1 row-cols-sm-1 row-cols-md-5 py-5">
                    <div class="col mb-3 text-center">
                        <a href="#" class="mb-3 link-dark text-decoration-none text-center">
                            <img src="{{ asset('assets/images/LOGO COMPLETO TRANSP.png') }}" alt=""
                                srcset="" width="200px">
                            <span class="text-primary footer-text-logo d-block">BOOMSHOP</span>
                        </a>
                        <p class="text-primary">&copy; 2023</p>
                    </div>



                    <div class="col mb-3 ">
                        <h5 class="footer-title">Ubicación</h5>
                        <ul class="nav flex-column">
                            @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <li class="nav-item mb-2 ">
                                    <div class="row">
                                        <div class="col-1">
                                            @if ($properties['native'] == 'Venezuela')
                                                <img class="d-flex"
                                                    src="{{ asset('assets/images/locations/Flag_of_Venezuela.svg.png') }}"
                                                    alt="" srcset="" width="25px">
                                            @endif
                                        </div>

                                        <div class="col">

                                            <a class="nav-link p-0 text-muted ms-2" rel="alternate"
                                                hreflang="{{ $localeCode }}"
                                                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                                {{ $properties['native'] }}
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="col mb-3 ">
                        <h5 class="footer-title">Ayuda</h5>
                        <ul class="nav flex-column">
                            <li class="nav-item mb-2  "><a href="{{ route('help.boom') }}"
                                    class="nav-link p-0 text-muted">BOOM</a></li>
                            <li class="nav-item mb-2  "><a href="{{ route('help.transactionsAndPayments') }}"
                                    class="nav-link p-0 text-muted">Transacciones y Pagos</a></li>
                            <li class="nav-item mb-2  "><a href="{{ route('help.termsAndConditions') }}"
                                    class="nav-link p-0 text-muted">Términos y Condiciones</a></li>
                        </ul>
                    </div>

                    <div class="col mb-3 d-flex justify-content-xxl-end justify-content-start">
                        <div>
                            <h5 class="footer-title">Redes Sociales</h5>
                            <ul class="nav flex-column">
                                <li class="nav-item mb-2 "><a href="https://www.instagram.com/boomshopve/"
                                        target="_blank" class="nav-link p-0 text-muted"><i
                                            class="bi bi-instagram me-2  text-primary"></i>
                                        BOOMSHOPVE</a></li>
                                <li class="nav-item mb-2 "><a href="https://www.facebook.com/boomshopve"
                                        target="_blank" class="nav-link p-0 text-muted"><i
                                            class="bi bi-facebook text-primary me-2 "></i>
                                        BOOMSHOPVE</a>
                                </li>
                                <li class="nav-item mb-2 "><a href="" target="_blank"
                                        class="nav-link p-0 text-muted"><i
                                            class="bi bi-whatsapp text-primary me-2 "></i>
                                        SOPORTE</a>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <div class="col mb-3">
                        <div class="w-100 d-flex justify-content-end">
                            <img src="{{ asset('assets/images/Mascota Boomer transparente bordeless.png') }}"
                                alt="" srcset="" style="height: 225px">
                        </div>
                    </div>
                </footer>
            </div>


        </div>
    </div>


    @auth

        @hasanyrole('super-admin|admin|operator')
            @livewireScripts
            @auth
                <script type="module">
                    let sound = new Audio('{{ asset('sounds/mixkit-tile-game-reveal-960.wav') }}');
                    Echo.private('App.Models.User.' + {{ auth()->user()->id }})
                        .notification((notification) => {
                            Livewire.emit('notification');
                            sound.play();
                        });
                </script>
            @endauth
        @endhasanyrole
    @endauth

    <script type="module">
        var t = $('.tick')
        var n = $('.nub')
        var d = 80

        function anim() {
            t.each(function(i) {
                //just edit this to be cool
                var x = Math.sin(Date.now() / 900 + i / 1.3) * d;
                var y = Math.cos(-Date.now() / 900 + i) * d;
                //-----------------------
                this.style.transform = 'translate(' + x + 'px,' + y + 'px)';
            })

            window.requestAnimationFrame(anim);
        };
        anim();

        //


        var height = $(window).height();

        $('main').css('min-height', height - 70);
        $('.loading-body').css('height', height);
        window.onload = (function() {
            $('.loading-body').css('display', 'none');
            $('#app').css('display', 'block');
        });
    </script>

    <script>
        (function(a, m, o, c, r, m) {
            a[m] = {
                id: "1015413",
                hash: "ebf4828af7a3f846f5c8031338632042bd7e07cd239dd248cfa26173c1d389c0",
                locale: "es",
                setMeta: function(p) {
                    this.params = (this.params || []).concat([p])
                }
            };
            a[o] = a[o] || function() {
                (a[o].q = a[o].q || []).push(arguments)
            };
            var d = a.document,
                s = d.createElement('script');
            s.async = true;
            s.id = m + '_script';
            s.src = 'https://gso.kommo.com/js/button.js';
            d.head && d.head.appendChild(s)
        }(window, 0, 'crmPlugin', 0, 0, 'crm_plugin'));
    </script>

</body>

</html>
