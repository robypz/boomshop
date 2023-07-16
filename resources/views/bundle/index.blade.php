@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2>Paquetes</h2>
        <hr>
        <form action="{{ route('bundle.index') }}" method="GET" class="mb-4" id="search-bundle">
            <div class="row flex-row d-flex justify-content-center">
                <div class="col col-lg-6">
                    <div class="row">
                        <div class="col-1 align-baseline">
                            <label for="game_id" class="form-label">Juego </label>
                        </div>
                        <div class="col">
                            <select name="game_id" id="game_id" class="form-control">
                                <option value="">Todos</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <input type="submit" value="Buscar" class="btn btn-primary" id="btn-search-bundle">
                        </div>
                    </div>

                </div>


            </div>
        </form>

        <table class="table boom-table">
            <thead class="boom-table-header">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Categoría</th>
                    <th scope="col">Producto</th>
                    <th scope="col">Contenido</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Disponible</th>
                    <th scope="col">Descuento</th>
                    <th scope="col">Opción</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bundles as $bundle)
                    <tr>
                        <th scope="row">{{ $bundle->id }}</th>
                        <td>{{$bundle->product->category->category}}</td>
                        <td>{{ $bundle->product->name }}</td>
                        <td>{{ $bundle->content }}</td>
                        <td>{{ number_format($bundle->price, 2) }} $</td>
                        @if ($bundle->availability)
                            <td>Si</td>
                        @else
                            <td>No</td>
                        @endif

                        <td>{{ $bundle->discount }}%</td>
                        <td><a href="{{ route('bundle.edit', ['id' => $bundle->id]) }}"><button
                                    class="btn btn-warning">Editar</button></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
