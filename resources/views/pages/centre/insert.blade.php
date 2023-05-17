@extends('layouts.app')
@section('content')
<div class="container" style="margin-top: 125px;">
    <div class="container w-50 shadow p-4" style="border-radius: 10px;">
        <h2>Ajout de nouveau centre</h2>
        <form action="/centre-insert" method="POST" id="form">
            @csrf
            <div class="my-3">
                <label for="nom_centre" class="form-label">Nom</label>
                <input type="text" name="nom_centre" class="form-control my-2" id="nom_centre" required>
            </div>
            <div class="row mt-2">
                <div class="col-md-6">
                    <input type="radio" value="1" name="type_centre" class="form-check-input">
                    Centre operationnel
                </div>
                <div class="col-md-6">
                    <input type="radio" value="2" name="type_centre" class="form-check-input">
                    Centre de structure
                </div>
            </div>
            <div class="mb-3">
                <input type="submit" value="Inserer" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>
@endsection