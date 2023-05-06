@extends('layouts.app')
@section('content')
<div class="container" style="margin-top: 125px;">
    <div class="container w-50 shadow p-4" style="border-radius: 10px;">
        <form action="/centre-insert" method="POST" id="form">
            @csrf
            <div class="my-3">
                <label for="nom_centre" class="form-label">Nom</label>
                <input type="text" name="nom_centre" class="form-control my-2" id="nom_centre">
            </div>
            <div class="mb-3">
                <input type="submit" value="Inserer" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>
@endsection