@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="window d-flex align-items-center justify-content-center">
            <div class="card recharge-data">
                <div class="card-header recharge-data-header text-center">
                    <h5><strong>Nueva Contraseña</strong></h5>
                </div>

                <div class="card-body text-black">
                    <form method="POST" action="{{ route('user.passwordChange') }}">
                        @csrf

                        <div class="row mb-3 row-cols-1">
                            <label for="password" class="col mb-1 boom-color-lightgray">Nueva contraseña</label>

                            <div class="col">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 row-cols-1">
                            <label for="password-confirm" class="col mb-1 boom-color-lightgray">Confirmar contraseña</label>

                            <div class="col">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3 text-center">
                            <div class="">
                                <button type="submit" class="btn btn-primary col-6">
                                    <span class="btn-color fw-bold">Cambiar Contraseña</span>
                                </button>


                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
