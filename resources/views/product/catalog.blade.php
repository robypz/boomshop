@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="fs-2 text-center ms-bold">Catálogo</h2>

        <div>
            <p class="d-inline-flex gap-1">
                <button class="btn btn-blue" data-bs-toggle="collapse" href="#collapseExample" role="button"
                    aria-expanded="false" aria-controls="collapseExample"><i class="bi bi-filter"></i> Filtrar</button>
            </p>
            <div class="collapse justify-content-center" id="collapseExample">
                <form action="{{ route('product.catalog') }}" method="get" class="d-block">
                    <div class="row">
                        <div class="col-12 col-sm-2 col-lg-1 col-xxl-1 p-1 text-start text-md-end text-xxl-end mb-3">
                            <label for="name" class="form-label-sm ms-2 fw-bold">Nombre</label>
                        </div>
                        <div class="col-12 col-sm-10 col-lg-4  col-xxl-4 mb-3">
                            <input type="text" name="name" id="name" class="form-control-sm w-100">
                        </div>
                        <div class="col-12 col-sm-2 col-lg-1 col-xxl-1  col-xxl-1 p-1 text-start text-md-end fw-bold mb-3">
                            <label for="category" class="form-label-sm ms-2">Categoria</label>
                        </div>
                        <div class="col-8 col-sm-7 col-lg-4 col-xxl-4 mb-3">
                            <select name="category" id="category" class="form-select-sm w-100">
                                <option value="">Todos</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4 col-sm-3 col-lg-2 col-xxl-2 text-center text-xxl-center mb-3">
                            <input type="submit" value="Buscar" class="btn btn-primary btn-sm w-75">
                        </div>
                    </div>
                </form>
                <hr>
            </div>
        </div>

        <div class="catalog">
            <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 row-cols-xl-6 row-cols-xxl-6">
                @foreach ($products as $product)
                    @if ($product->available)
                        <div class="col mb-3">
                            <a href="{{ route('product.show', ['id' => $product->id]) }}">
                                <div class="game">
                                    <div class="myimg-container img-container text-center">
                                        @if ($product->category->category == 'Tarjetas')
                                            <img class="card-img-top mycard-img-top w-75"
                                                src="{{ asset($product->image) }}"
                                                alt="Card image cap">
                                        @else
                                            <img class="card-img-top mycard-img-top"
                                                src="{{ asset($product->image) }}"
                                                alt="Card image cap">
                                        @endif


                                    </div>

                                    <div class="d-flex align-items-center justify-content-center game-name">
                                        <div class="text-center">
                                            {{ $product->name }}
                                        </div>
                                    </div>


                                </div>

                            </a>

                        </div>
                    @endif
                @endforeach


            </div>
            {{$products->links()}}
        </div>
    </div>
@endsection
