@extends('layouts.app')
@section('content')
<div class="container">
    <div class="container">
        <div class="title">
            <h3 class="text-center text-decoration-underline">
                Modifier {{$title}}
            </h3>
        </div>
        <form action="/produit-update" method="POST" id="form">
            @csrf
            <input type="hidden" name="idproduit" value="{{$produit->idproduit}}">
            <div class="my-3">
                <label class="form-label" for="nomproduit">Nom du produit</label>
                <input class="form-control" type="text" name="nomproduit" value="{{ $produit->nomproduit }}" id="nomproduit" data-parsley-required="true">
            </div>
            <div class="my-3">
                <label class="form-label" for="volume">Volume</label>
                <input class="form-control" type="number" name="volume" value="{{ $produit->volume }}" id="volume" data-parsley-required="true">
            </div>
            <div class="my-3">
                <label class="form-label" for="prix">Prix</label>
                <input class="form-control" type="text" name="prix" value="{{ $produit->prix }}" id="prix" data-parsley-required="true">
            </div>
            <div class="mb-3">
                <input type="submit" value="Modifier" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>

@endsection