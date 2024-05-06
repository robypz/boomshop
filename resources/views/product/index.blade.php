@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <table class="table boom-table">
            <thead class="boom-table-header">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Disponible</th>
                    <th scope="col">Opción</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <th class="align-middle" scope="row">{{ $product->id }}</th>
                        <td class="align-middle">{{ $product->name }}</td>
                        <td class="align-middle"><img src="{{ asset($product->image) }}" alt="" width="64px"
                                class="rounded-3"></td>
                        @if ($product->available)
                            <td class="align-middle">Si</td>
                        @else
                            <td class="align-middle">No</td>
                        @endif
                        <td class="align-middle"><a href="{{ route('product.edit', ['id' => $product->id]) }}"><button
                                    class="btn btn-blue">Editar</button></a>
                            <a href="{{ route('bundle.destroy', ['id' => $product->id]) }}"><button
                                    class="btn btn-danger btn-sm">Eliminar</button></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-center">
            {{ $products->links() }}
        </div>
    </div>
@endsection
