@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="d-flex align-items-center justify-content-center">
            <div class="card recharge-data">
                <div class="card-header recharge-data-header text-center">
                    Agrega un nuevo avatar
                </div>
                <div class="card-body">
                    <form action="{{route('avatar.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <label for="avatar" class="form-label">Avatar</label>
                        <input type="file" class="form-control" name="avatar">
                        <div class="text-center my-3">
                            <input type="submit" value="Guardar" class="btn btn-primary">
                        </div>

                    </form>
                </div>
            </div>


        </div>
    </div>
@endsection
