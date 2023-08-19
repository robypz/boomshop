@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">

            <div class="col-md-8">
                <div class="card recharge-data">
                    <div class="card-header recharge-data-header">
                        <div class="row">
                            <div class="col-1">
                                <div class="fs-4 icon-bg">
                                    <i class="bi bi-database-add boom-color-lightgray fs-4"></i>
                                </div>

                            </div>
                            <div class="col-10 text-center">
                                <b class=" fs-4">Agregar Producto</b>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="category" class="col-md-4 col-form-label text-md-end">Categoría</label>

                                <div class="col-md-6">
                                    <select class="form-select  @error('category') is-invalid @enderror"
                                        value="{{ old('category') }}" name="category" aria-label="Default select example"
                                        required autocomplete="category" autofocus>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category }}</option>
                                        @endforeach
                                    </select>

                                    @error('category')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="description"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Descripción') }}</label>

                                <div class="col-md-6">
                                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description"
                                        value="{{ old('description') }}" required autocomplete="name" autofocus></textarea>

                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="image"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Imagen') }}</label>

                                <div class="col-md-6">
                                    <input id="image" type="file"
                                        class="form-control @error('image') is-invalid @enderror" name="image"
                                        value="{{ old('image') }}" required autocomplete="name" autofocus>

                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="need_region_id" class="col-md-4 col-form-label text-md-end">Requiere ID de
                                    Servidor,Zona</label>

                                <div class="col-md-6">
                                    <select class="form-select  @error('need_region_id') is-invalid @enderror"
                                        value="{{ old('need_region_id') }}" name="need_region_id"
                                        aria-label="Default select example" required autocomplete="need_region_id"
                                        autofocus>
                                        <option selected>Seleccione</option>
                                        <option value="0">No</option>
                                        <option value="1">Si</option>
                                    </select>

                                    @error('need_region_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="need_access"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Necesita acceso') }}</label>

                                <div class="col-md-6">
                                    <select class="form-select  @error('need_access') is-invalid @enderror"
                                        value="{{ old('need_access') }}" name="need_access"
                                        aria-label="Default select example" required autocomplete="need_access" autofocus>
                                        <option selected>Seleccione</option>
                                        <option value="0">No</option>
                                        <option value="1">Si</option>
                                    </select>

                                    @error('need_access')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="need_access"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Campo personalizable') }}</label>

                                <div class="col-md-6">
                                    <input type="text" name="customizable_field" class="form-control" placeholder="Nombre, Correo, ID" required>

                                    @error('customizable_field')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="gif"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Ubicación del ID') }}</label>

                                <div class="col-md-6">
                                    <input id="gif" type="file"
                                        class="form-control @error('gif') is-invalid @enderror" name="gif"
                                        value="{{ old('gif') }}" required autocomplete="gif" autofocus>

                                    @error('gif')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Guardar') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
