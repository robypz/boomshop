@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="text-center">Códigos</h2>
        <hr>
        <table class="table boom-table">
            <thead class="boom-table-header">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">CÓDIGO</th>
                    <th scope="col">VALOR</th>
                    <th scope="col">VÁLIDO PARA</th>
                    <th scope="col">FECHA DE CADUCIDAD</th>
                    <th scope="col">OPCIONES</th>
                </tr>
            </thead>
            <tbody>
                @if ($codes)
                    @foreach ($codes as $code)
                        <tr>
                            <th scope="row">{{ $code->id }}</th>
                            <td>{{ $code->code }}</td>
                            <td>{{ $code->value }}%</td>
                            <td>
                                <ul>
                                    @foreach ($code->valid_for as $product)
                                        <li>{{$product}}</li>
                                    @endforeach
                                </ul>

                            </td>
                            <td>{{ $code->expiration_date }}</td>
                            <td>
                                <a href=""><button type="button"
                                        class="btn btn-blue btn-sm">Editar</button></a>
                            </td>
                        </tr>
                    @endforeach
                @endif



            </tbody>
        </table>

    </div>
@endsection
