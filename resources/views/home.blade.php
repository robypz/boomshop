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

    <div class="container games-container">
        <h2>
            <p class="title mt-5 mb-3">
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
            </div>
            <!--  <i class="> <i class="bi bi-eye"></i></i>
                                                      <h3 class="">Ver mas Juegos</h3>-->
        </section>
    </div>

    <section class="advantage">
        <div class="container">

            <div class="row-col-12">
                <div class="col-12">
                    <h2 class="title">
                        Gift Cards
                    </h2>
                </div>
                <div class="col">
                    <p class="fs-3">ELEVA TU ENTRETENIMIENTO AL MÁXIMO CON LAS TARJETAS DE
                        REGALOS QUE TENEMOS PARA TI.</p>
                </div>
            </div>

            <div class="row row-cols-2 row-cols-sm-2 row-cols-md-6 mt-5 mb-3 ">

                @foreach ($products as $product)
                    @if ($product->category->category == 'Tarjetas')
                        <div class="col mb-3 text-center">
                            <a class="boom-color-lightgray" href="{{ route('product.show', ['id' => $product->id]) }}">
                                <img class="gift-card" style="width: 100%;"
                                    src="{{ route('image.show', ['image' => $product->image]) }}" alt="">
                                <br>

                                <caption>
                                    <p class=" fs-6  fw-bold mt-2">{{ $product->name }}</p>
                                </caption>
                            </a>

                        </div>
                    @endif
                @endforeach

                <div class="col mb-3 text-center">
                    <img class="gift-card" style="width: 100%;" src="{{ asset('images/gifCard/APPLE GIFT CARD (US).png') }}"
                        alt="">
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

        </div>
    </section>
@endsection
