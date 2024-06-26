@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="text-center fw-bold">Usuarios</h2>
        <hr>
            <form action="" method="get">
                <input type="text" placeholder="ID" name="user_id" class="form-control-sm">
                <input type="submit" value="Buscar" class="btn btn-sm btn-primary boom-color-darkgray fw-bold">
            </form>
        <hr>
        <div class="table-responsive">
            <table class="table boom-table boom-bg-darkgray">
                <thead class="boom-table-header">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">NOMBRE</th>
                        <th scope="col">APELLIDO</th>
                        <th scope="col">NICK</th>
                        <th scope="col">EMAIL</th>
                        <th scope="col">ROL</th>
                        <th scope="col">OPCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->surname }}</td>
                            <td>{{ $user->nick }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @foreach ($user->roles as $role)
                                    {{ $role->name }}
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('user.editRole', ['id' => $user->id]) }}"><button type="button"
                                        class="btn btn-blue btn-sm">Editar</button></a>
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>

        {{ $users->links() }}

    </div>
@endsection
