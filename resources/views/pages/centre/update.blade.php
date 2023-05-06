@extends('layouts.app')
@section('content')
<div class="container">
    <div class="container">
        <div class="title">
            <h3 class="text-center text-decoration-underline">
                Modifier Centre
            </h3>
        </div>
        <form action="/centre-update" method="POST" id="form">
            @csrf
            <input type="hidden" name="idcentre" value="{{$centre->idcentre}}">
            <div class="my-3">
                <label class="form-label" for="nomcentre">Nom du centre</label>
                <input class="form-control" type="text" name="nomcentre" value="{{ $centre->nomcentre }}" id="nomcentre" data-parsley-required="true">
            </div>
            <div class="mb-3">
                <input type="submit" value="Modifier" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>

@endsection