@extends('layouts.app')
@section('content')
<div class="container">
    <div class="container">
        <form action="/tiers-update" method="POST">
            @csrf
            <input type="hidden" name="idplan"  value="{{ $compte->idtiers }}">
            <div class="my-3">
                <label for="compte" class="form-label">Numero de compte</label>
                <input type="text" name="compte" class="form-control" id="compte" value="{{ $compte->numero }}">
            </div>
            <div class="my-3">
                <label class="form-label" for="libelle">Libelle </label>
                <input type="text" class="form-control" name="libelle" id="libelle" value="{{ $compte->libelle }}">
                
            </div>
            <div class="mb-3">
                <input type="submit" value="Modifier" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>
@endsection