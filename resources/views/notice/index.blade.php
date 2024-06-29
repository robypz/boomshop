@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="text-center fw-bold mb-3">Avisos</h2>
        <div class="d-flex align-items-center justify-content-end mb-3">
            <a href="{{ route('notice.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Crear</a>
        </div>
        @if (session('success'))
            <div class="alert alert-primary alert-dismissible fade show mb-5" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <hr>
        <div class="my-3">
            @if (session('danger'))
                <div class="alert alert-danger">
                    {{ session('danger') }}
                </div>
            @endif
        </div>
        <div class="table-responsive">
            <table class="table boom-table">
                <thead class="boom-table-header">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Título</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Posición</th>
                        <th scope="col">Actividad</th>
                        <th scope="col">Opciónes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($notices as $notice)
                        <tr>
                            <th scope="row">{{ $notice->id }}</th>
                            <td>{{ $notice->title }}</td>
                            <td><img src="{{ asset($notice->image_path) }}" alt="" srcset="" type="button"
                                    class="notice-image rounded-3" data-bs-toggle="modal"
                                    data-bs-target="#image-modal-{{ $notice->id }}">

                                <!-- Modal -->
                                <div class="modal fade" id="image-modal-{{ $notice->id }}" tabindex="-1"
                                    aria-labelledby="image-modal-{{ $notice->id }}-Label" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content recharge-data">
                                            <div class="modal-header text-white">
                                                <h1 class="modal-title fs-5" id="image-modal-{{ $notice->id }}Label">
                                                    {{ $notice->title }}</h1>
                                                <i type="button" class="bi bi-x-lg text-white" data-bs-dismiss="modal"
                                                    aria-label="Close"></i>
                                            </div>
                                            <div class="modal-body">
                                                <img src="{{ asset($notice->image_path) }}" alt="" srcset=""
                                                    class="w-100">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-blue"
                                                    data-bs-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $notice->position }}</td>
                            <td>
                                @if ($notice->active)
                                    <span class="badge rounded-pill text-bg-success">Activado</span>
                                @else
                                    <span class="badge rounded-pill text-bg-warning">Desactivado</span>
                                @endif
                            </td>
                            <td><a href="{{ route('notice.edit', $notice) }}"><button
                                        class="btn btn-blue btn-sm">Editar</button></a>
                                <a href="{{ route('notice.destroy', $notice) }}"><button
                                        class="btn btn-danger btn-sm">Eliminar</button></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $notices->links() }}


    </div>
@endsection
