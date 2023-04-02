@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="container">
			<div class="title">
            	<h2 class="text-center text-decoration-underline">
                	Liste de vos Codes journaux
            	</h2>
        	</div>
		</div>
        <div class="row my-3">
            <div class="search col-lg-3">
                <form id="formulaire_recherche" class="form" action="{{ url('/search_journal') }}" method="GET">
                    <div class="mb-3 d-flex">
                        <input type="text" class="form-control" onkeyup="fetchData(this)" name="recherche" placeholder="Rechercher code journal">
                        <button type="submit" class="btn btn-primary">Rechercher</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-3">
        		<a href="{{ url('journaux-insertion') }}" class="btn btn-primary">
                    Ajouter
                </a>
            </div>
        </div>
    <table class="table table-responsive-xl border p-3">
        <thead>
            <th>Numero de compte</th>
            <th>Libelle</th>
            <th class="text-center">Actions</th>
            <th></th>
        </thead>
        <tbody class="main-result">
            @foreach ($codes as $plan)
            <tr>
                <td>{{ $plan->code}}</td>
                <td>{{ $plan->libelle}}</td>
                <td><a class="btn btn-primary px-3" href="{{ url('/journaux-update_journaux/'.$plan->idcode) }}" btn>Modifier</a></td>
                <td><a href="{{ url('/journaux-delete/'.$plan->idcode) }}" class="btn btn-danger">Supprimer</a></td>

            </tr>
            @endforeach
        </tbody>
        <tbody class="search-result" id="resultats">
            
        </tbody>
    </table>
    
    
	</div>	
    <script src="{{ asset('js/search_journal.js') }}"></script>
@endsection