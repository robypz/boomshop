@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="text-center">Metodos de Pago</h2>
        <hr>
        <div class="table-responsive">
            <table class="table boom-table">
                <thead class="boom-table-header">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Metodo</th>
                        <th scope="col">Valuación</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Disponible</th>
                        <th scope="col">Opciones</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($paymentMethods as $paymentMethod)
                        <tr class="align-middle">
                            <th scope="row">{{ $paymentMethod->id }}</th>
                            <td>{{ $paymentMethod->method }}</td>
                            <td>{{ $paymentMethod->valuation->name }}</td>
                            <td><img src="{{ route('image.show', ['image' => $paymentMethod->image]) }}" alt="Error al cargar imagen"  width="240px">
                            </td>
                            <td>@if ($paymentMethod->available)
                                Si
                            @else
                                No
                            @endif</td>
                            <td><a href="{{ route('paymentMethod.edit', ['id' => $paymentMethod->id]) }}"><button
                                        class="btn btn-blue btn-sm">Editar</button></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
