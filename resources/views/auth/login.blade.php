@extends('layouts.blank')

@section('content')
    <div class="login">

        <div class="card recharge-data">
            <div class="card-header recharge-data-header text-center">
                <h3><strong>Iniciar Sesión</strong></h3>
            </div>

            <div class="card-body text-black">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="row mb-3 row-cols-1">
                        <label for="email" class="col col-form-label boom-color-lightgray"><strong>Correo
                                electronico</strong></label>

                        <div class="col">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3 row-cols-1">
                        <label for="password" class="col col-form-label boom-color-lightgray"><strong>Contraseña</strong></label>

                        <div class="col">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        @if (Route::has('password.request'))
                            <div class="col text-end">
                                <a class="btn btn-link text-decoration-none" href="{{ route('password.request') }}">
                                    ¿Olvidaste tu contraseña?
                                </a>
                            </div>
                        @endif
                    </div>

                    <div class="row mb-3">
                        <div class="col-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label  text-primary" for="remember">
                                    Recuerdame
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3 text-center">
                        <div class="">
                            <button type="submit" class="btn btn-primary col-6">
                                <span class="btn-color fw-bold">Iniciar</span>
                            </button>


                        </div>
                    </div>


                </form>
            </div>

            <div class="card-footer text-center">
                <a href="{{ route('register') }}" class="btn btn-link text-decoration-none">¿No tienes una cuenta?</a>
              </div>
        </div>

    </div>
    <script type="module">
        $(document).ready(function() {

            var height = $(window).height();

            $('.login').height(height);
        });
    </script>
@endsection
