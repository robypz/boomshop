@extends('layouts.app')

@section('content')
    <div class="help-bg">
        <div class="container py-5">
            <div class="row row-cols-1 row-cols-lg-3">
                <div class="col mb-3 hide-mobile">
                    <h1 class="msrt-regular display-3">QUIENES SOMOS<span class="text-primary">.</span></h1>
                </div>
                <div class="col mb-3">
                    <section class="mt-5">
                        <article>
                            <h1 class="text-center msrt-regular fs-3">BOOM SHOP</h1>
                            <p class="px-5 text-center">Somos proveedores de servicios de recargas para videojuegos y
                                plataformas de streaming, con
                                ubicación principal en venezuela.</p>
                        </article>
                        <footer class="text-center">
                            <button class="boom-btn msrt-regular p-2">TIENDA</button>

                            <a href="{{ route('news') }}" class="text-white msrt-regular"><button
                                    class="boom-btn-secondary p-2">NOVEDADES</button></a>

                        </footer>
                    </section>
                </div>
                <div class="col text-center mb-3 hide-mobile">
                    <img src="{{ asset('images/Mascota Boomer transparente.png') }}" alt="" width="225">
                </div>
            </div>
        </div>

        <div class="boom-bg-darkgray shadow box d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col d-flex justify-content-center ">
                        <div class="d-inline-flex boom-statics msrt-regular">
                            <span class="text-primary">+</span>20
                        </div>
                        <div class="d-inline-flex align-items-center ms-1">
                            <div>
                                SERVICIOS <br>
                                <span class="msrt-regular">DIFERENTES</span>
                            </div>

                        </div>
                    </div>
                    <div class="col d-flex justify-content-center">
                        <div class="d-inline-flex boom-statics boom-statics msrt-regular">
                            <span class="text-primary">+</span>10.000
                        </div>
                        <div class="d-inline-flex align-items-center ms-1">
                            <div>
                                CLIENTES <br>
                                <span class="msrt-regular">SATISFECHOS</span>
                            </div>


                        </div>
                    </div>
                    <div class="col d-flex justify-content-center hide-mobile">
                        <div class="d-inline-flex boom-statics msrt-regular">
                            <span class="text-primary">+</span>20.000
                        </div>
                        <div class="d-inline-flex align-items-center ms-1">
                            <div>
                                RECARGAS <br>
                                <span class="msrt-regular">CON ÉXITO</span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-5">
            <div class="container">
                <div class="row">
                    <div class="col msrt-regular display-3 hide-mobile">NUESTRO <span class="text-primary">EQUIPO.</span> </div>
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <section>
                                    <h1 class="msrt-regular text-center fs-3">Misión</h1>
                                    <p class="text-center">Ofrecer el mejor servicio de recargas y compras online en
                                        Venezuela y el mundo, dando
                                        paso a un experiencia única en materia de tecnología.</p>
                                </section>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <section>
                                    <h1 class="msrt-regular text-center fs-3">Visión</h1>
                                    <p class="text-center">Ser una empresa lider en compras y recargas virtuales y fisicas,
                                        con servicios
                                        tecnologicos de alto impacto e innovadora a nivel nacional e internacional, con una
                                        seguridad y calidad particular.</p>
                                </section>
                            </div>
                        </div>
                    </div>
                    <div class="col msrt-regular display-3 text-center hide-mobile">
                        <div class="mb-3">
                            REDES<span class="text-primary">.</span>
                        </div>

                        <div class="text-center d-inline-flex align-items-center justify-content-center mt-5 mb-0">
                            <a href="https://www.instagram.com/boomshopve/" target="_blank"
                                class="nav-link p-0 text-muted fs-3 mx-2"><i
                                    class="bi bi-instagram   text-primary fs-3"></i></a>
                            <a href="https://www.facebook.com/boomshopve" target="_blank"
                                class="nav-link p-0 text-muted fs-3 mx-2"><i class="bi bi-facebook text-primary  "></i></a>
                            <a href="" target="_blank" class="nav-link p-0 text-muted fs-3 mx-2"><i
                                    class="bi bi-whatsapp text-primary  "></i></a>
                        </div>
                        <div class="stars d-flex mt-3 justify-content-center">
                            <i class="bi bi-star-fill text-primary fs-4 me-1"></i>
                            <i class="bi bi-star-fill text-primary fs-4 me-1"></i>
                            <i class="bi bi-star-fill text-primary fs-4 me-1"></i>
                            <i class="bi bi-star-fill text-primary fs-4 me-1"></i>
                            <i class="bi bi-star-fill text-primary fs-4 me-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="container mt-5">
                <div class="row">
                    <div class="col text-center hide-mobile">
                        <h1 class="display-3 msrt-regular mb-4">Descubre<span class="text-primary">.</span></h1>
                        <button class="boom-btn msrt-regular">CATÁLOGO</button>
                    </div>
                    <div class="col">
                        <section>
                            <div class="row">
                                <div class="col mb-3">
                                    <article class="border h-100 p-3">
                                        <h1 class="fs-5 msrt-regular text-center"> <span class="text-primary">¿</span>POR
                                            QUE
                                            USAR <span class="text-primary">BOOM SHOP?</span></h1>
                                        <p class="text-center"> BOOM SHOP es la única página de recargas en Venezuela que
                                            otorga la seguridad y garantía a los clientes al momento de adquirir los
                                            diferentes servicios que ofrece.</p>
                                    </article>
                                </div>
                                <div class="col">
                                    <article class="border h-100 p-3">
                                        <h1 class="fs-5 msrt-regular text-center"><span class="text-primary">¿</span>MI
                                            PEDIDO
                                            ESTA <span class="text-primary">GARANTIZADO?</span></h1>
                                        <p class="text-center">Los usuarios pueden realizar seguimiento de su pedido desde
                                            que realiza la compra
                                            hasta que recibe de manera exitosa, gracias el historial de transacciones que se
                                            encuentra en el perfil de cada cliente.</p>
                                    </article>
                                </div>
                            </div>
                        </section>

                    </div>
                    <div class="col text-center hide-mobile">
                        <h1 class="display-3 msrt-regular mb-4">Explora<span class="text-primary">.</span></h1>
                        <button class="boom-btn msrt-regular">MI HISTORIAL</button>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="container mt-5 text-center">
                <iframe width="100%" height="480" src="https://www.youtube.com/embed/xPGa4fxFq94?si=jRQNfRyOMnxymahY"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen></iframe>
            </div>
        </div>

    </div>
@endsection
