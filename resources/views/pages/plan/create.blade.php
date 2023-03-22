@extends('layouts.app')
@section('content')
<div class="container">
    <div class="container">
        <form action="/plan-insert" method="POST">
            @csrf
            <div class="my-3">
                <label for="numerocompte" class="form-label">Numero de compte</label>
                <input type="text" name="compte" class="form-control" id="numerocompte">
            </div>
            <div class="my-3">
                <label for="libelle" class="form-label">Libelle</label>
                <input type="text" name="libelle" class="form-control" id="libelle">
            </div>
            <div class="mb-3">
                <input type="submit" value="Inserer" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>
@endsection