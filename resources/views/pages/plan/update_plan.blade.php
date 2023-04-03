@extends('layouts.app')
@section('content')
<div class="container">
    <div class="container">
        <form action="/plan-update" method="POST" id="form">
            @csrf
            <input type="hidden" name="idplan"  value="{{ $compte->idplan }}">
            <div class="my-3">
                <label for="compte" class="form-label">Numero de compte</label>
                <input type="text" name="compte" class="form-control my-2" id="compte" value="{{ $compte->compte }}"
                required data-parsley-type="number" maxlength="5" min="1">
            </div>
            <div class="my-3">
                <label class="form-label" for="libelle">Libelle </label>
                <input type="text" class="form-control my-2" name="libelle" id="libelle" value="{{ $compte->libelle }}" required>
                
            </div>
            <div class="mb-3">
                <input type="submit" value="Modifier" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>
@endsection