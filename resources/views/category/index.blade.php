@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="text-center">Categorías</h2>
        <div class="my-3">
            <div class="row">
                <div class="col text-end">
                    <a href="{{ route('category.create') }}">
                        <button class="btn btn-primary">Agregar</button>
                    </a>
                </div>
            </div>
        </div>
        <hr>

        <table class="table boom-table">
            <thead class="boom-table-header">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Categoía</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <th scope="row">{{ $category->id }}</th>
                        <td>{{ $category->category }}</td>

                        <td>
                            <a href="{{ route('category.edit', ['id' => $category->id]) }}">
                                <button class="btn btn-secondary">Editar</button>
                            </a>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
