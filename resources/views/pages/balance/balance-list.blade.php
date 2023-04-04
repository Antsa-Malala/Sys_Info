@extends('layouts.app')

@section('content')
<div class="container">
<div class="title row">
        <div class="title">
            <h2 class="text-center text-decoration-underline">
                Votre balance
            </h2>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
            <th rowspan="2">Numéro</th>
            <th rowspan="2">Intitule</th>
            <th colspan="2">Mouvement</th>
            <th colspan="2">Solde</th>
            </tr>
            <tr>
            <th>Débit</th>
            <th>Crédit</th>
            <th>Débit</th>
            <th>Crédit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($balances as $balance)
            <tr >
              <td>
                  <a href="{{ url('grand_livre/'.$balance->compte) }}" class="text-decoration-none">
                    {{ $balance->compte}}</td>
                  </a>
                <td >{{ $balance->intitule}}</td>
                <td>{{ $balance->debit}}</td>
                <td>{{ $balance->credit}}</td>
                <td>{{ $balance->solde_debit}}</td>
                <td>{{ $balance->solde_credit}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection