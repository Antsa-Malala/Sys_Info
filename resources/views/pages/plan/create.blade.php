@extends('layouts.app')
@section('content')
<div class="container">
    <div class="container">
        <form action="/plan-insert" method="POST">
            @csrf
            <div class="my-3">
                <label for="numerocompte">Numero de compte</label>
                <input type="text" name="compte" id="numerocompte">
            </div>
            <div class="my-3">
                <label for="libelle">Libelle</label>
                <input type="text" name="libelle" id="libelle">
            </div>
            <div class="mb-3">
                <input type="submit" value="Inserer" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>
@endsection