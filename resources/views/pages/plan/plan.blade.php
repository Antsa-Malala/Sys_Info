@extends('layouts.app')

@section('content')
<div class="container">
    <div class="title row">
        <div class="title">
            <h2 class="text-center text-decoration-underline">
                Liste de vos Plans Comptables
            </h2>
        </div>
    </div>
    <div class="action row my-3">
        <div class="col-lg-3">
            <form action="" class="form">
                <form id="formulaire_recherche" class="form" action="{{ url('/search_journal') }}" method="GET">
                    <div class="mb-3 d-flex">
                        <input type="text" class="form-control" onkeyup="fetchData(this)" name="recherche" placeholder="Rechercher code journal">
                        <button type="submit" class="btn btn-primary">Rechercher</button>
                    </div>
                </form>
            </form>
        </div>
        <div class="buttons col-lg-3">
            <a href="{{ url('/plan-insertion') }}" class="btn btn-primary">
                Ajouter
            </a>
            <a href="{{ url('/plan-insertion-csv') }}" class="btn btn-primary">
                Importer Un fichier CSV
            </a>
            
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
            <th>Numero de compte</th>
            <th>Libelle</th>
            </tr>
        </thead>
        <tbody class="main-result">
            @foreach ($plans as $plan)
                <tr>
                    <td>{{ $plan->compte}}</td>
                    <td>{{ $plan->libelle}}</td>
                    <td><a class="btn btn-primary px-3" href="{{ url('/plan-update_plan/'.$plan->compte) }}" btn>Modifier</a></td>
                    <td><a href="{{ url('/plan-delete/'.$plan->idplan) }}" class="btn btn-danger">Supprimer</a></td>

                </tr>
            @endforeach
        </tbody>
        <tbody class="search-result" id="resultats">
            {{-- Okey azoko ilay eto de tokony mamerina row ilay izy fa tsy mamerina  --}}
        </tbody>
    </table>

    {{-- Ampiana hoe recherche aloha eto ambony --}}
    
    
</div>
<script src="{{ asset('js/search_journal.js') }}"></script>
@endsection