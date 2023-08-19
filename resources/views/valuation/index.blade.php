@extends('layouts.app')

@section('content')
<div class="container p-4">
    <h2 class="text-center">Valuaciones</h2>
    <hr>
    <table class="table boom-table">
        <thead class="boom-table-header">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Valor</th>
                <th scope="col">Opcion</th>

            </tr>
        </thead>
        <tbody>
            @foreach($valuations as $valuation)
            <tr>
                <th scope="row">{{$valuation->id}}</th>
                <td>{{$valuation->name}}</td>
                <td>{{$valuation->value}}</td>
                <td><a href="{{route('valuation.edit',['id' => $valuation->id])}}"><button class="btn btn-blue btn-sm">Editar</button></a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
