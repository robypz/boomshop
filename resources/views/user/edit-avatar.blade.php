@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex align-items-center justify-content-center">
            <div class="card recharge-data">
                <div class="card-header recharge-data-header text-center">
                    <h5>Elige un avatar</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.setAvatar') }}" method="post">
                        @csrf
                        <div class="row my-3 row-cols-6">
                            @foreach ($avatars as $avatar)
                                <div class="col rounded p-1">
                                    <input type="radio" name="avatar" id="a-{{ $avatar->id }}"
                                        value="{{ $avatar->id }}" hidden>
                                    <label for="a-{{ $avatar->id }}">
                                        <img class="rounded" src="{{ asset($avatar->avatar) }}" alt=""
                                            width="100%">
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div class="text-center mb-3">
                            <input type="submit" value="Guardar" class="btn btn-primary">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <script type="module">
        $('input:radio').change(function() {

            $('input:radio[name=' + this.name + ']').parent().removeClass(
                'selected'); //remove class "selected" from all radio button with respective name
            $(this).parent().addClass('selected'); //add "selected" class only to the checked radio button
        });
    </script>
@endsection
