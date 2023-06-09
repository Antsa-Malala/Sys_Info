@extends('layouts.app')
@section('content')
<div class="container" style="margin-top: 125px;">
    <div class="container w-50 shadow p-4" style="border-radius: 10px;">
        <form action="/plan-insert" method="POST" id="form">
            @csrf
            <div class="my-3">
                <label for="numerocompte" class="form-label">Numero de compte</label>
                <input type="text" name="compte" class="form-control my-2" id="numerocompte" 
                required data-parsley-type="number" maxlength="5" min="1">
                <span class="form-text">
                    Attention : Le numéro de compte entrer sera transformer en 5 chiffres rempli par des 0 ( ex : 101 -> 10100 )
                </span>

            </div>
            <div class="my-3">
                <label for="libelle" class="form-label">Libelle</label>
                <input type="text" name="libelle" class="form-control my-2" id="libelle" required>
            </div>
            <div class="mb-3">
                <input type="submit" value="Inserer" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>
@endsection