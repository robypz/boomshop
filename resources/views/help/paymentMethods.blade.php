@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="help-title text-center mb-4"><i class="bi bi-credit-card"></i> Métodos de Pago</h1>
        <div class="help-text">
            <ul class="list-unstyled">
                <li class="help-item mb-4">
                    <h3><img src="{{asset('images/paymentMethods/16758822201670799988PAGO MOVIL BOOM.png')}}" alt="" srcset=""></h3>
                    <hr>
                </li>

                <li class="help-item  mb-4">
                    <h3><img src="{{asset('images/paymentMethods/1676659553632px-Binance_logo.svg.png')}}" alt="" srcset=""></h3>
                    <hr>
                </li>

                <li class="help-item mb-4">
                    <h3><img src="{{asset('images/paymentMethods/1677308404ZELLE PNG BOOM.png')}}" alt="" srcset=""></h3>

                    <hr>
                </li>
            </ul>

        </div>


    </div>
@endsection
