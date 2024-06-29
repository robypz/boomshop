@extends('layouts.app')

@section('content')
    <div class="container">
        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('assets/images/banners/ffbanner1.png') }}" class="d-block w-100" alt="...">
                </div>

                <div class="carousel-item">
                    <img src="{{ asset('assets/images/banners/gibanner.png') }}" class="d-block w-100" alt="...">
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
                                                            src="{{ asset($Favoriteproduct->product->image) }}"
                                                            alt="Card image cap">
                                                    @else
                                                        <img class="card-img-top mycard-img-top"
                                                            src="{{ asset($Favoriteproduct->product->image) }}"
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
                <!-- Mobile -->
                <div class="d-block d-md-none">
                    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 row-cols-xl-6 row-cols-xxl-6">
                        @foreach ($products as $product)
                            <div class="col mb-4">
                                <a href="{{ route('product.show', ['id' => $product->id]) }}">
                                    <div class="game">
                                        <div class="myimg-container img-container">
                                            <img class="card-img-top mycard-img-top" src="{{ asset($product->image) }}"
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
                            @if ($loop->index == 5)
                            @break
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Desktop -->
            <div class="d-none d-md-block">
                <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 row-cols-xl-6 row-cols-xxl-6">
                    @foreach ($products as $product)
                        <div class="col mb-4">
                            <a href="{{ route('product.show', ['id' => $product->id]) }}">
                                <div class="game">
                                    <div class="myimg-container img-container">
                                        <img class="card-img-top mycard-img-top" src="{{ asset($product->image) }}"
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
                    @endforeach
                </div>

            </div>
            @if (count($products) >= 12)
                <div class="text-center">
                    <a href="{{ route('product.catalog') }}" class="btn btn-primary">Ver mas</a>
                </div>
            @endif
        </div>
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

        <div class="d-none d-md-block">
            <div class="row row-cols-2 row-cols-sm-2 row-cols-md-6 mt-5 mb-3">

                @foreach ($gifcards as $gifcard)
                    <div class="col mb-3 text-center">
                        <a class="boom-color-lightgray" href="{{ route('product.show', ['id' => $gifcard->id]) }}">
                            <img class="gift-card rounded-3" style="width: 100%;" src="{{ asset($gifcard->image) }}"
                                alt="">
                            <br>

                            <caption>
                                <p class=" fs-6  fw-bold mt-2">{{ $gifcard->name }}</p>
                            </caption>
                        </a>

                    </div>
                @endforeach
            </div>
        </div>

        <div class="d-blok d-md-none">
            <div class="row row-cols-2 row-cols-sm-2 row-cols-md-6 mt-5 mb-3">

                @foreach ($gifcards as $gifcard)
                    <div class="col mb-3 text-center">
                        <a class="boom-color-lightgray" href="{{ route('product.show', ['id' => $gifcard->id]) }}">
                            <img class="gift-card rounded-3" style="width: 100%;" src="{{ asset($gifcard->image) }}"
                                alt="">
                            <br>

                            <caption>
                                <p class=" fs-6  fw-bold mt-2">{{ $gifcard->name }}</p>
                            </caption>
                        </a>

                    </div>
                    @if ($loop->index == 5)
                    @break
                @endif
            @endforeach
        </div>
    </div>



    @if (count($gifcards) >= 12)
        <div class="text-center">
            <a href="{{ route('product.catalog') }}" class="btn btn-primary">Ver mas</a>
        </div>
    @endif

</div>
</section>


<div class="recharge-data mt-3">
<div class="container p-4">
    <div class="row row-cols-1 row-cols-lg-2">
        <div class="col text-center p-3">
            <h2 class="text-primary"><i class="bi bi-star-fill"></i> <i class="bi bi-star-fill"> </i><i
                    class="bi bi-star-fill"> </i><i class="bi bi-star-fill"> </i><i class="bi bi-star-fill"></i>
            </h2>
            <h3 class="fs-4 boom-color-lightgray ">Entérate de todo lo que opinan nuestros clientes, haciendo
                click
                <a class="text-decoration-underline" href="https://www.instagram.com/p/Ch5ThNPPK1v/"
                    target="blank">AQUI</a>
            </h3>

        </div>
        <div class="col d-flex align-items-center justify-content-center">
            <img class="w-100" src="{{ asset('assets/images/ICONOS PARA BARRA BOOM.png') }}" alt=""
                srcset="">
        </div>
    </div>
</div>
</div>
@if ($notices->count() > 0)
<div class="modal" tabindex="1" id="notices">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content recharge-data">
            <div class="modal-header recharge-data-header">
                <h5 class="modal-title boom-color-darkgray"></h5>
                <i type="button" class="bi bi-x-lg boom-color-darkgrayfs-4" data-bs-dismiss="modal"
                    aria-label="Close"></i>
            </div>
            <div class="modal-body recahrge-data-body">
                <div id="notices-carousel" class="carousel slide" data-bs-ride="notices-carousel">
                    <div class="carousel-inner">
                        @foreach ($notices as $notice)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <img src="{{ asset($notice->image_path) }}" class="d-block w-100 notice-content"
                                    alt="...">
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#notices-carousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#notices-carousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon text-primary" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-blue" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
