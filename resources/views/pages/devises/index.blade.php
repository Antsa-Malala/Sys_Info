@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="container">
			<div class="title">
            	<h2 class="text-center text-decoration-underline">
                	Vos devises de tenu de compte 
            	</h2>
        	</div>
		</div>
		<a href="{{ url('journaux-insertion') }}" class="btn btn-primary">
        Ajouter
        </a>
    {{-- <a href="{{ url('/') }}" class="btn btn-primary">
        Importer Un fichier CSV
    </a> --}}
    <table class="table">
        <thead>
            <th> Numero de compte </th>
            <th> Libelle </th>
        </thead>
        @foreach ($codes as $plan)
        <tr>
            <td>{{ $plan->code}}</td>
            <td>{{ $plan->libelle}}</td>
            <td><a href="{{ url('/journaux-delete/'.$plan->idcode) }}" class="btn btn-danger">Supprimer</a></td>
            <td><a class="btn btn-primary px-3" href="{{ url('/journaux-update_journaux/'.$plan->idcode) }}" btn>Modifier</a></td>

        </tr>
        @endforeach
    </table>
    
    
	</div>	
@endsection