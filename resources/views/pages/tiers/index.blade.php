@extends('layouts.app')
@section('content')
	<div class="container">
    <div class="title row">
        <div class="title">
            <h2 class="text-center text-decoration-underline">
                Liste de vos Comptes Tiers
            </h2>
        </div>
    </div>
    <a href="{{ url('/tiers-insertion') }}" class="btn btn-primary">
        Ajouter
    </a>
    {{-- <a href="{{ url('/') }}" class="btn btn-primary">
        Importer Un fichier CSV
    </a> --}}
    <table class="table">
        <tr>
        <th>Numero de compte</th>
        <th>Libelle</th>
        </tr>
        @foreach ($plans as $plan)
        <tr>
            <td>{{ $plan->numero}}</td>
            <td>{{ $plan->libelle}}</td>
            <td><a href="{{ url('/tiers-delete/'.$plan->idtiers) }}" class="btn btn-danger">Supprimer</a></td>
            <td><a class="btn btn-primary px-3" href="{{ url('/tiers-update_tiers/'.$plan->idtiers) }}" btn>Modifier</a></td>

        </tr>
        @endforeach
    </table>
    
    
</div>
@endsection