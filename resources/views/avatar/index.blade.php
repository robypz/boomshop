@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h3 class="text-center">Avatares</h3>
        <hr>
        <div class="table-responsive">
            <table class="table boom-table">
                <thead class="boom-table-header">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Avatar</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($avatars as $avatar)
                        <tr>
                            <th class="align-middle" scope="row">{{$avatar->id}}</th>
                            <td class="align-middle"><img src="{{asset($avatar->avatar)}}" alt="" srcset="" width="64px"></td>
                            <td class="align-middle"><a href="{{route('avatar.destroy',['id'=>$avatar->id])}}"><button class="btn btn-danger">Eliminar</button></a></td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
