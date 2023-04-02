@extends('layouts.app')
@section('content')
<div class="container">
    <div class="container">
        <div class="title">
            <h3 class="text-center text-decoration-underline">
                Ajouter un Code journaux
            </h3>
        </div>
        <form action="/journaux-insert" method="POST" id="form">
            @csrf
            <div class="my-3">
                <label class="form-label" for="numerocompte"> Code journaux </label>
                <input class="form-control my-2" type="text" name="code" id="numerocompte" data-parsley-required="true">
            </div>
            <div class="my-3">
                <label class="form-label" for="libelle">Libelle</label>
                <input class="form-control my-2" type="text" name="libelle" id="libelle" data-parsley-required="true">
            </div>
            <div class="mb-3">
                <input type="submit" value="Inserer" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>

@endsection