@extends('layouts.app')
@section('content')
<div class="container">
    <div class="container">
        <div class="title">
            <h3 class="text-center text-decoration-underline">
                Modifier {{ $code->code }}
            </h3>
        </div>
        <form action="/journaux-update" method="POST">
            @csrf
            <input type="hidden" name="idcode" value="{{$code->idcode}}">
            <div class="my-3">
                <label class="form-label" for="numerocompte">Code journaux</label>
                <input class="form-control" type="text" name="code" value="{{ $code->code }}" id="numerocompte">
            </div>
            <div class="my-3">
                <label class="form-label" for="libelle">Libelle</label>
                <input class="form-control" type="text" name="libelle" id="libelle" value="{{ $code->libelle }}">
            </div>
            <div class="mb-3">
                <input type="submit" value="Inserer" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>

@endsection