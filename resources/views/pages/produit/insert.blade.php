@extends('layouts.app')
@section('content')
<div class="container" style="margin-top: 125px;">
    <div class="container w-50 shadow p-4" style="border-radius: 10px;">
        <form action="/produit-insert" method="POST" id="form">
            @csrf
            <div class="my-3">
                <label for="nom_produit" class="form-label">Nom</label>
                <input type="text" name="nom_produit" class="form-control my-2" id="nom_produit" required>
            </div>
            <div class="my-3">
                <label for="volume" class="form-label">Volume</label>
                <input type="number" name="volume" class="form-control my-2" id="volume" 
                required data-parsley-type="number" min="1">
            </div>
            <div class="my-3">
                <label for="prix" class="form-label">Prix</label>
                <input type="text" name="prix" class="form-control my-2" id="prix" required>
            </div>
            <div class="mb-3">
                <input type="submit" value="Inserer" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>
@endsection