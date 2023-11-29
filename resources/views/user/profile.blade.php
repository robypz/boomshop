@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row row-cols-1 row-cols-md-2">
            <div class="col mb-3">
                <div class="card recharge-data h-100">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4 ">
                                <div class="row mb-2">

                                    <div
                                        class="col boom-color-yellow fw-bold d-flex align-items-center justify-content-center">
                                        @if (is_null($user->avatar))
                                            <a href="{{ route('user.editAvatar') }}">
                                                <figure class="figure position-relative avatar">
                                                    <img class="rounded "
                                                        src="{{ asset('images/avatars/R.4736402c763d8cd003b22408c95e4776.jpg') }}"
                                                        width="150px" alt="" srcset="">
                                                    <figcaption
                                                        class="figure-caption text-center boom-color-lightgray fs-5">
                                                        {{ $user->nick }}</figcaption>
                                                    <span
                                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill  edit-avatar">
                                                        <i class="bi bi-pencil-fill fs-5"></i>
                                                        <span class="visually-hidden">unread messages</span>
                                                    </span>
                                                </figure>
                                            </a>
                                        @else
                                            <a href="{{ route('user.editAvatar') }}">
                                                <figure class="figure position-relative avatar">
                                                    <img class="rounded " src="{{ asset($user->avatar->avatar) }}"
                                                        width="150px" alt="" srcset="">
                                                    <figcaption
                                                        class="figure-caption text-center boom-color-lightgray fs-5 mt-3">
                                                        {{ $user->nick }}</figcaption>
                                                    <span
                                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill  edit-avatar">
                                                        <i class="bi bi-pencil-fill fs-5"></i>
                                                        <span class="visually-hidden">unread messages</span>
                                                    </span>
                                                </figure>
                                            </a>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row mb-2">
                                    <div class="col">
                                        Nombre: <span class="fw-bold">{{ $user->name }} {{ $user->surname }}</span>
                                    </div>

                                </div>
                                <div class="row mb-2">
                                    <div class="col">
                                        Correo: <span class="fw-bold">{{ $user->email }}</span><i
                                            class="bi bi-shield-fill-check text-success ms-3"></i>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col">
                                        Miembro desde: <span class="fw-bold">{{ $user->created_at->diffForHumans() }}</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col mb-3">
                <div class="card recharge-data h-100">
                    <div class="card-body">
                        <div class="row ">
                            <div class="col fs-3 text-center mb-3 boom-color-yellow fw-bold">
                                Ordenes
                            </div>
                        </div>

                        <div class="row">
                            <div class="col text-center ">
                                <span class="fw-bold">{{ count($user->orders) }}</span>

                                <br>
                                <hr class="mx-3">
                                <span>Totales</span>

                            </div>
                            <div class="col text-center">
                                <span class="fw-bold">{{ $pendingOrders }}</span>

                                <br>
                                <hr class="mx-3">
                                <span>Pendientes</span>

                            </div>
                            <div class="col text-center">
                                <span class="fw-bold">{{ $successOrders }}</span>

                                <br>
                                <hr class="mx-3">
                                <span>
                                    Exitosas
                                </span>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col mb-3">
                <div class="card recharge-data h-100">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div
                                class="col fs-3 text-center boom-color-yellow fw-bold d-dlex justify-content-center align-items-center">
                                Seguridad <i class="bi bi-shield-lock-fill fs-6"></i>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col password-reset d-flex align-items-center">
                                <div class="text-end">
                                    Contraseña: <span class="fw-bold">********</span>
                                </div>

                            </div>
                            <div class="col-5 text-start">
                                <a href="{{ route('user.changePasswordRequest') }}"><button type="button"
                                        class="btn btn-blue">Cambiar</button></a>


                            </div>

                        </div>
                        <div class="mt-3">
                            @if (session('password'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Contraseña actualizada con exito
                                </div>
                            @endif

                        </div>

                    </div>

                </div>
            </div>
            @if ($favoriteBundles->modelKeys())
                <div class="col mb-3">
                    <div class="card recharge-data h-100">
                        <div class="card-body">
                            <div class="row ">
                                <div class="col fs-3 text-center mb-3 boom-color-yellow fw-bold">
                                    Compras recientes
                                </div>
                            </div>

                            <div class="row row-cols-2 row-cols-xxl-4">
                                @foreach ($favoriteBundles as $favoriteBundle)
                                    @if ($favoriteBundle->product->available)
                                        <div class="col mb-3">
                                            <a href="{{ route('product.show', ['id' => $favoriteBundle->product->id]) }}">
                                                <div class="game">
                                                    <div class="myimg-container img-container text-center">
                                                        @if ($favoriteBundle->product->category->category == 'Tarjetas')
                                                            <img class="card-img-top mycard-img-top w-75"
                                                                src="{{ asset($favoriteBundle->product->image) }}"
                                                                alt="Card image cap">
                                                        @else
                                                            <img class="card-img-top mycard-img-top"
                                                                src="{{ asset($favoriteBundle->product->image) }}"
                                                                alt="Card image cap">
                                                        @endif


                                                    </div>

                                                    <div class="d-flex align-items-center justify-content-center game-name">
                                                        <div class="text-center">
                                                            {{ $favoriteBundle->product->name }}
                                                        </div>
                                                    </div>


                                                </div>

                                            </a>

                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
