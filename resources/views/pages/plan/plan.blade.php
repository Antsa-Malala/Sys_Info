@extends('layouts.app')

@section('content')
<div class="container">
    <div class="title row">
        <div class="title">
            <h2 class="text-center ">
                Liste de vos Plans Comptables
            </h2>
        </div>
    </div>
    <a href="{{ url('/plan-insertion') }}" class="btn btn-primary">
        Ajouter
    </a>
    <a href="{{ url('/plan-insertion-csv') }}" class="btn btn-primary">
        Importer Un fichier CSV
    </a>
    <table class="table">
        <tr>
        <th>Numero de compte</th>
        <th>Libelle</th>
        </tr>
        @foreach ($plans as $plan)
        <tr>
            <td>{{ $plan->compte}}</td>
            <td>{{ $plan->libelle}}</td>
            <td><a href="{{ url('/plan-delete/'.$plan->idplan) }}" class="btn btn-danger">Supprimer</a></td>
            <td><a class="btn btn-primary px-3" href="{{ url('/plan-update_plan/'.$plan->compte) }}" btn>Modifier</a></td>

        </tr>
        @endforeach
    </table>
    
    
</div>
<script src="{{ asset('js/search_journal.js') }}"></script>
@endsection