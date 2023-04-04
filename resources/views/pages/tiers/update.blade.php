@extends('layouts.app')
@section('content')
<div class="container" style="margin-top: 125px;">
    <div class="container w-50 shadow p-4" style="border-radius: 10px;">
        <form action="/tiers-update" method="POST" id="form">
            @csrf
            <input type="hidden" name="idplan"  value="{{ $compte->idtiers }}">
            <div class="my-3">
                <label for="compte" class="form-label">Numero de compte</label>
                <input type="text" name="compte" class="form-control" id="compte" value="{{ $compte->numero }}" data-parsley-required="true">
            </div>
            <div class="my-3">
                <label class="form-label" for="libelle">Libelle </label>
                <input type="text" class="form-control" name="libelle" id="libelle" value="{{ $compte->libelle }}" data-parsley-required="true">
            </div>
            <div class="mb-3">
                <input type="submit" value="Modifier" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>
@endsection