@extends('layouts.app')

@section('content')
    <div class="container">
        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('images/banners/ffbanner1.png') }}" class="d-block w-100" alt="...">
                </div>

                <div class="carousel-item">
                    <img src="{{ asset('images/banners/gibanner.png') }}" class="d-block w-100" alt="...">
                </div>

            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    @auth
        @if ($favoriteProducts->modelKeys())
            <div class="container games-container">
                <h2>
                    <p class="display-4 ms-bold mt-5 mb-3">
                        Compras Recientes
                    </p>
                </h2>

                <!-- Cards Section-->
                <section>
                    <div class="container">
                        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 row-cols-xl-6 row-cols-xxl-6">
                            @foreach ($favoriteProducts as $Favoriteproduct)
                                @if ($Favoriteproduct->product->available)
                                    <div class="col mb-4">
                                        <a href="{{ route('product.show', ['id' => $Favoriteproduct->product->id]) }}">
                                            <div class="game">
                                                <div class="myimg-container img-container text-center">
                                                    @if ($Favoriteproduct->product->category->category == 'Tarjetas')
                                                        <img class="card-img-top mycard-img-top w-75"
                                                            src="{{ route('image.show', ['image' => $Favoriteproduct->product->image]) }}"
                                                            alt="Card image cap">
                                                    @else
                                                        <img class="card-img-top mycard-img-top"
                                                            src="{{ route('image.show', ['image' => $Favoriteproduct->product->image]) }}"
                                                            alt="Card image cap">
                                                    @endif

                                                </div>

                                                <div class="d-flex align-items-center justify-content-center game-name">
                                                    <div class="text-center">
                                                        {{ $Favoriteproduct->product->name }}
                                                    </div>
                                                </div>


                                            </div>

                                        </a>

                                    </div>
                                @endif
                            @endforeach


                        </div>
                    </div>
                    <!--  <i class="> <i class="bi bi-eye"></i></i>
                                                                                                                                                      <h3 class="">Ver mas Juegos</h3>-->
                </section>
            </div>
        @endif

    @endauth

    <div class="container">
        <h2>
            <p class="display-3 ms-bold mt-5 mb-3">
                Juegos Favoritos
            </p>
        </h2>


        <!-- Cards Section-->
        <section>
            <div class="container">
                <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 row-cols-xl-6 row-cols-xxl-6">
                    @foreach ($products as $product)
                        @if ($product->category->category == 'Recargas')
                            <div class="col mb-4">
                                <a href="{{ route('product.show', ['id' => $product->id]) }}">
                                    <div class="game">
                                        <div class="myimg-container img-container">
                                            <img class="card-img-top mycard-img-top"
                                                src="{{ route('image.show', ['image' => $product->image]) }}"
                                                alt="Card image cap">

                                        </div>

                                        <div class="d-flex align-items-center justify-content-center game-name">
                                            <div class="text-center">
                                                {{ $product->name }}
                                            </div>
                                        </div>


                                    </div>

                                </a>

                            </div>
                        @endif
                    @endforeach


                </div>
                @if ($products->links())
                <div class="text-center">
                    <a href="{{route('product.catalog')}}" class="btn btn-primary">Ver mas</a>
                </div>
                @endif

            </div>
            <!--  <i class="> <i class="bi bi-eye"></i></i>
                                                                                                      <h3 class="">Ver mas Juegos</h3>-->
        </section>
    </div>

    <section class="advantage">
        <div class="container">

            <div class="row-col-12">
                <div class="col-12">
                    <p class="display-3 ms-bold">
                        Gift Cards
                    </p>
                </div>
                <div class="col">
                    <p class="fs-5">ELEVA TU ENTRETENIMIENTO AL MÁXIMO CON LAS TARJETAS DE
                        REGALOS QUE TENEMOS PARA TI.</p>
                </div>
            </div>

            <div class="row row-cols-2 row-cols-sm-2 row-cols-md-6 mt-5 mb-3 ">

                @foreach ($gifcards as $gifcard)
                    <div class="col mb-3 text-center">
                        <a class="boom-color-lightgray" href="{{ route('product.show', ['id' => $gifcard->id]) }}">
                            <img class="gift-card" style="width: 100%;"
                                src="{{ route('image.show', ['image' => $gifcard->image]) }}" alt="">
                            <br>

                            <caption>
                                <p class=" fs-6  fw-bold mt-2">{{ $gifcard->name }}</p>
                            </caption>
                        </a>

                    </div>
                @endforeach

                <div class="col mb-3 text-center">
                    <img class="gift-card" style="width: 100%;"
                        src="{{ asset('images/gifCard/APPLE GIFT CARD (US).png') }}" alt="">
                    <br>

                    <caption>
                        <p class=" fs-6  fw-bold mt-2">Google Play (US)</p>
                    </caption>
                </div>
                <div class="col mb-3 text-center">
                    <img class="gift-card" style="width: 100%;" src="{{ asset('images/gifCard/NETFLIX (US).png') }}"
                        alt="">
                    <br>

                    <caption>
                        <p class="fs-6  fw-bold mt-2">Netflix (US)</p>
                    </caption>
                </div>
                <div class="col mb-3 text-center">
                    <img class="gift-card" style="width: 100%;" src="{{ asset('images/gifCard/GOOGLE PLAY (US).png') }}"
                        alt="">
                    <br>
                    <caption>
                        <p class=" fs-6  fw-bold mt-2">Apple Gift Card (US)</p>
                    </caption>
                </div>
                <div class="col mb-3 text-center">
                    <img class="gift-card" style="width: 100%;"
                        src="{{ asset('images/gifCard/PLAYSTATION NETWORK CARD (US).png') }}" alt="">
                    <br>
                    <caption>
                        <p class=" fs-6  fw-bold mt-2">PlayStation Network Card (US)</p>
                    </caption>
                </div>
                <div class="col mb-3 text-center">
                    <img class="gift-card" style="width: 100%;" src="{{ asset('images/gifCard/STEAM (USD).png') }}"
                        alt="">
                    <br>
                    <caption>
                        <p class="fs-6  fw-bold mt-2">Steam Wallet (USD)</p>
                    </caption>
                </div>
            </div>

        </div>
    </section>

    <div class="recharge-data">
        <div class="container p-4">
            <div class="row row-cols-1 row-cols-lg-2">
                <div class="col text-center p-3">
                    <h2 class="text-primary"><i class="bi bi-star-fill"></i> <i class="bi bi-star-fill"> </i><i
                            class="bi bi-star-fill"> </i><i class="bi bi-star-fill"> </i><i class="bi bi-star-fill"></i>
                    </h2>
                    <h3 class="fs-4 boom-color-lightgray ">Entérate de todo lo que opinan nuestros clientes, haciendo click
                        <a class="text-decoration-underline" href="https://www.instagram.com/p/Ch5ThNPPK1v/"
                            target="blank">AQUI</a>
                    </h3>

                </div>
                <div class="col d-flex align-items-center justify-content-center">
                    <div class="row text-center recharge-data p-3 rounded">
                        <div class="col p-1 d-flex aling-items-center">
                            <div><img src="{{ asset('images/paymentMethods/16758822201670799988PAGO MOVIL BOOM.png') }}"
                                    alt="" style="max-width: 100px"></div>
                        </div>
                        <div class="col p-1 d-flex aling-items-center">
                            <div>
                                <img src="{{ asset('images/paymentMethods/1676659553632px-Binance_logo.svg.png') }}"
                                    alt="" style="max-width: 100px">
                            </div>
                        </div>
                        <div class="col p-1 d-flex aling-items-center">
                            <div>
                                <img src="{{ asset('images/paymentMethods/1677308404ZELLE PNG BOOM.png') }}"
                                    alt="" style="max-width: 100px">
                            </div>

                        </div>
                        <div class="col p-1 d-flex aling-items-center">
                            <div>
                                <img src="{{ asset('images/paymentMethods/1681202258reserve_white.png') }}"
                                    alt="" style="max-width: 100px">
                            </div>

                        </div>


                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
