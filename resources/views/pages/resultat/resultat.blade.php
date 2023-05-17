@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="mx-4 rounded-2 p-4 col-md-3">
                <h3>Cout de revient par produit</h3>
                <ul class="list-group list-group">

                    @foreach( $produits as $produit )
                        <li class="list-group-item">
                            {{ $produit->nomproduit }} : {{ $produit->montant }} Ariary
                        </li>
                        {{-- <li class="list-group-item">P2 : 150000 Ariary</li> --}}
                    @endforeach
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

                    @foreach( $centres as $centre )
                        <li class="list-group-item">
                            {{ $centre->nomcentre }} : {{ $centre->montant }} Ariary
                        </li>
                        {{-- <li class="list-group-item">P2 : 150000 Ariary</li> --}}
                    @endforeach
                </ul>
            </div>  
        </div>


        <div class="row">
            <h3 class="text-center mt-5">Cout de revient par produit et par centre</h3>
            {{-- @foreach( $produits_centres as $pc )
                <div class="mx-4 my-4 shadow rounded-2 p-4 col-md-3">
                    <p class="text-center">{{$pc->nomProduit}}</p>
                    <ul class="list-group list-group">
                        <li class="list-group-item">Administration: 2000 Ariary</li> 
                        <li class="list-group-item">Usine: 5000 Ariary</li>
                        <li class="list-group-item">Plantation: 2000 Ariary</li>     
                    </ul>
                </div>
            @endforeach --}}
        </div>

        <div class="row">
            <h3 class="text-center mt-5">Cout par nature et par centre</h3>
            <div class="mx-4 my-4 shadow rounded-2 p-4 col-md-3">
                <p class="text-center">Variable</p>
                <ul class="list-group list-group">
                    @foreach( $natures['variable'] as $variable )
                        <li class="list-group-item">
                          Charge {{ $variable->idcharge }} : {{$variable->montant}} Ariary
                        </li> 
                    @endforeach
                    <li class="list-group-item my-3 text-white bg-dark ">
                        Total = {{ $natures['sommevariable'] }}
                    </li>
                </ul>
            </div>
            <div class="mx-4 my-4 shadow rounded-2 p-4 col-md-3">
                <p class="text-center">Fixe</p>
                <ul class="list-group list-group">
                    @foreach( $natures['fixe'] as $variable )
                        <li class="list-group-item">
                          Charge {{ $variable->idcharge }} : {{$variable->montant}} Ariary
                        </li> 
                    @endforeach
                    <li class="list-group-item my-3 text-white bg-dark ">
                        Total = {{ $natures['sommefixe'] }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection