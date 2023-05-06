@extends('layouts.app')

@section('content')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<div class="container" style="margin-top: 125px;">
        <div class="container w-50 shadow p-4" style="border-radius: 10px;">
            <form action="" method="POST" id="form">
                @csrf
                <div class="my-3">
                    <h3 class="text-center mb-4">Nouveau Produit</h3>
                    <input type="text" name="produit" class="form-control my-2" id="numerocompte" required>
                </div>
                <div class="mb-3">
                    <input type="submit" value="Ajouter" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
@endsection