@extends('layouts.app')

@section('content')
<div class="password-confirm py-5 ">

            <div class="card recharge-data">
                <div class="card-header recharge-data-header fs-5 fw-bold text-center">{{ __('Confirm Password') }}</div>

                <div class="card-body">
                    <div class="text-center fw-bold">
                        {{ __('Please confirm your password before continuing.') }}
                    </div>


                    <form method="POST" action="{{ route('password.confirmPassword') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ __($message) }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Confirm Password') }}
                                </button>


                            </div>
                            <div class="col-12 text-center">
                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
</div>
<script type="module">
    $(document).ready(function() {
        var height = $(window).height();
        $('.password-confirm').css('min-height', height-70);;
    });
</script>
@endsection
