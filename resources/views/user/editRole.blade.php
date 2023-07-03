@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row flex-row d-flex justify-content-center">
            <div class="col-12 col-lg-6">
                <div class="card recharge-data">
                    <div class="card-header recharge-data-header">
                        <div class="row">
                            <div class="col-1">
                                <div class="fs-4 icon-bg">
                                    <i class="bi bi-person-up text-white fs-4"></i>
                                </div>

                            </div>
                            <div class="col-11 text-center">
                                <b class="text-white fs-4">Editar Rol</b>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-3">
                        <form action="{{ route('user.updateRole') }}" method="POST">
                            @csrf
                            <label class="form-label" for="id">ID</label>
                            <input class="form-control mb-3" type="number" name="id" id="" readonly
                                value="{{ $user->id }}">
                            <label class="form-label" for="name">Nombre</label>
                            <input class="form-control mb-3" type="text" name="name" id="" readonly
                                value="{{ $user->name }}">
                            <label class="form-label" for="surname">Apellido</label>
                            <input class="form-control mb-3" type="text" name="surname" id="" readonly
                                value="{{ $user->surname }}">
                            <label class="form-label" for="nick">Nick</label>
                            <input class="form-control mb-3" type="text" name="nick" id="" readonly
                                value="{{ $user->nick }}">
                            <label class="form-label" for="id">Correo</label>
                            <input class="form-control mb-3" type="email" name="email" id="" readonly
                                value="{{ $user->email }}">
                            <label class="form-label" for="role">Role</label>
                            <select name="role" id="" class="form-select mb-3">

                                @foreach ($user->roles as $role)
                                    <option value="{{ $role->name }}" selected>{{ $role->name }}</option>
                                @endforeach

                                @foreach ($roles as $role)
                                    <option value="{{ $role }}">{{ $role }}</option>
                                @endforeach
                            </select>
                            <div class="text-center">
                                <input type="submit" class="btn btn-warning" value="Actualizar">
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
