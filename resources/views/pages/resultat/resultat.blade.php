@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="mx-4 rounded-2 p-4 col-md-3">
                <h3>Cout de revient par produit</h3>
                <ul class="list-group list-group">
                    <li class="list-group-item">P1 : 100000 Ariary</li>
                    <li class="list-group-item">P2 : 150000 Ariary</li>
                </ul>
            </div>


            <div class="mx-4 rounded-2 p-4 col-md-3">
                <h3>Seuil de rentabilite</h3>
                <ul class="list-group list-group">
                    <li class="list-group-item">Administration: 2000 Ariary</li> 
                    <li class="list-group-item">Usine: 5000 Ariary</li>
                    <li class="list-group-item">Plantation: 2000 Ariary</li>
                </ul>
            </div>


            <div class="mx-4 rounded-2 p-4 col-md-3">
                <h3>Cout par centre</h3>
                <ul class="list-group list-group">
                    <li class="list-group-item">Administration: 2000 Ariary</li> 
                    <li class="list-group-item">Usine: 5000 Ariary</li>
                    <li class="list-group-item">Plantation: 2000 Ariary</li>
                </ul>
            </div>  
        </div>


        <div class="row">
            <h3 class="text-center mt-5">Cout de revient par produit et par centre</h3>
            <div class="mx-4 my-4 shadow rounded-2 p-4 col-md-3">
                <p class="text-center">P1</p>
                <ul class="list-group list-group">
                    <li class="list-group-item">Administration: 2000 Ariary</li> 
                    <li class="list-group-item">Usine: 5000 Ariary</li>
                    <li class="list-group-item">Plantation: 2000 Ariary</li>     
                </ul>
            </div>
            <div class="mx-4 my-4 shadow rounded-2 p-4 col-md-3">
                <p class="text-center">P2</p>
                <ul class="list-group list-group">
                    <li class="list-group-item">Administration: 2000 Ariary</li> 
                    <li class="list-group-item">Usine: 5000 Ariary</li>
                    <li class="list-group-item">Plantation: 2000 Ariary</li>     
                </ul>
            </div>
        </div>

        <div class="row">
            <h3 class="text-center mt-5">Cout par nature et par centre</h3>
            <div class="mx-4 my-4 shadow rounded-2 p-4 col-md-3">
                <p class="text-center">Variable</p>
                <ul class="list-group list-group">
                    <li class="list-group-item">Administration: 2000 Ariary</li> 
                    <li class="list-group-item">Usine: 5000 Ariary</li>
                    <li class="list-group-item">Plantation: 2000 Ariary</li>     
                </ul>
            </div>
            <div class="mx-4 my-4 shadow rounded-2 p-4 col-md-3">
                <p class="text-center">Fixe</p>
                <ul class="list-group list-group">
                    <li class="list-group-item">Administration: 2000 Ariary</li> 
                    <li class="list-group-item">Usine: 5000 Ariary</li>
                    <li class="list-group-item">Plantation: 2000 Ariary</li>     
                </ul>
            </div>
        </div>
    </div>
@endsection