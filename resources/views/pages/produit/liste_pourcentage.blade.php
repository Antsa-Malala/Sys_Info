@extends('layouts.app')

@section('content')
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container mt-5">
        <h1>Liste de pourcentage</h1>
        <div class="row">
            @for($i = 0 ; $i < count($produits) ; $i++)
            <div class="mx-4 my-4 shadow rounded-2 p-4 col-md-3">
                <p class="text-center">{{ $produits[$i]->nomproduit }}: {{ $produits[$i]->pourcentage }} %</p>
                <ul class="list-group list-group">
                    @for($j = 0 ; $j < count($produits[$i]->centre) ; $j++)
                    <li class="list-group-item">{{ $produits[$i]->centre[$j]->nomcentre }}: {{ $produits[$i]->centre[$j]->pourcentage }} %</li>
                    @endfor    
                </ul>
                <a href="/update-percentage/{{ $produits[$i]->idproduit }}"><button class="mt-3 btn btn-primary">Ajout/Modifier</button></a>
            </div> 
            @endfor
        </div>
    </div>
@endsection