@extends('layouts.blank')

@section('content')
    <div class="register">
        <div class="card recharge-data">
            <div class="card-header recharge-data-header text-center">
                <h3 class="fw-bold">Registro de Usuario</h3>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="row mb-3 row-cols-1">
                        <label for="name" class="col mb-1 boom-color-lightgray fw-bold">Nombre</label>

                        <div class="col">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3 row-cols-1">
                        <label for="surname" class="col mb-1 boom-color-lightgray fw-bold">Apellido</label>

                        <div class="col">
                            <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror"
                                name="surname" value="{{ old('surname') }}" required autocomplete="surname" autofocus>

                            @error('surname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3 row-cols-1">
                        <label for="nick" class="col mb-1 boom-color-lightgray fw-bold">Nombre de
                            Usuario</label>

                        <div class="col">
                            <input id="nick" type="text" class="form-control @error('nick') is-invalid @enderror"
                                name="nick" value="{{ old('nick') }}" required autocomplete="nick" autofocus>

                            @error('nick')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3 row-cols-1">
                        <label for="email" class="col mb-1 boom-color-lightgray fw-bold">Correo
                            Electrónico</label>

                        <div class="col">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3 row-cols-2">
                        <label for="password" class="col mb-1 boom-color-lightgray fw-bold">Contraseña</label>

                        <div class="col-11">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-1 d-flex align-items-center justify-content-center show-hide-password">
                            <span class="fs-4"><i class="bi bi-eye" onclick="showPassword()" id="show-hide-password"></i></span>
                        </div>
                        <script>
                            function showPassword() {
                                var btn = document.getElementById("show-hide-password");
                                var tipo = document.getElementById("password");
                                if (tipo.type == "password") {
                                    tipo.type = "text";
                                    btn.classList.remove('bi-eye');
                                    btn.classList.add('bi-eye-slash');
                                } else {
                                    tipo.type = "password";
                                    btn.classList.remove('bi-eye-slash');
                                    btn.classList.add('bi-eye');
                                }
                            }
                        </script>
                    </div>

                    <div class="row mb-3 row-cols-1">
                        <label for="password-confirm" class="col mb-1 boom-color-lightgray fw-bold">Confirmar
                            Contraseña</label>

                        <div class="col">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                required autocomplete="new-password">
                        </div>
                    </div>
                    <div class="row mb-3 row-cols-1 text-end">
                        <a class="text-decoration-underline text-primary fw-bold" href="{{ route('login') }}">Ya tienes
                            cuenta?</a>
                    </div>

                    <div class="row mb-3 row-cols-1">
                        <div class="col text-center">
                            <button type="submit" class="btn btn-primary">
                                <span class="fw-bold btn-color">Registrar</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>




    <script type="module">
        $(document).ready(function() {

            var height = $(window).height();

            $('.register').height(height);
        });
    </script>
@endsection
