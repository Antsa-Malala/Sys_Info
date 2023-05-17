@extends('layouts.app')

@section('content')
<style>
    .table-container {
        display: flex;
        flex-wrap: nowrap;
        overflow-x: auto;
        margin: 20px;
    }

    table {
        min-width: 300px;
        max-width: 100%;
    }

    th:first-of-type,
    th:last-of-type {
        height: 50px;
    }

</style>
<div class="container">
    <div class="title row">
        <div class="title">
            <h2 class="text-center text-decoration-underline">
                Votre bilan
            </h2>
        </div>
    </div>
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                <th colspan="3">ACTIF</th>
                </tr>
                <tr>
                <th>Intitule</th>
                <th>Débit</th>
                <th>Crédit</th>
                </tr>
            </thead>    
            <tbody>
                <th colspan="3">ACTIFS COURANTS</th>

                @if (!empty($acs))
                    @foreach ($acs as $ac)
                    <tr>
                        <td>{{ $ac->libelle}}</td>
                        <td>{{ $ac->solde_debit}}</td>
                        <td>{{ $ac->solde_credit}}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <th>Total</th>
                        <td>{{ $sum_acs->solde_debit}}</td>
                        <td>{{ $sum_acs->solde_credit}}</td>
                    </tr>
                @endif

                <th colspan="3">ACTIFS NON COURANTS</th>

                @if (!empty($ancs))
                    @foreach ($ancs as $anc)
                    <tr>
                        <td>{{ $anc->libelle}}</td>
                        <td>{{ $anc->solde_debit}}</td>
                        <td>{{ $anc->solde_credit}}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <th>Total</th>
                        <td>{{ $sum_ancs->solde_debit}}</td>
                        <td>{{ $sum_ancs->solde_credit}}</td>
                    </tr>
                @endif
                    <tr>
                        <th>TOTAL ACTIFS</th>
                        <td>{{ $solde_actifs->solde_debit}}</td>
                        <td>{{ $solde_actifs->solde_credit}}</td>
                    </tr>
            </tbody>
        </table>
        <table  class="table">
            <thead>
                <tr>
                <th colspan="3">PASSIF</th>
                </tr>
                <tr>
                <th>Intitule</th>
                <th>Débit</th>
                <th>Crédit</th>
                </tr>
            </thead>
            <tbody>
                <th colspan="3">CAPITAUX PROPRES</th>

            @if (!empty($pcs))
                @foreach ($pcs as $pc)
                <tr >
                    <td >{{ $pc->libelle}}</td>
                    <td>{{ $pc->solde_debit}}</td>
                    <td>{{ $pc->solde_credit}}</td>
                </tr>
                @endforeach
                <tr >
                    <th>Total</th>
                    <td>{{ $sum_pcs->solde_debit}}</td>
                    <td>{{ $sum_pcs->solde_credit}}</td>
                </tr>
            @endif
            <th colspan="3">RESULTATS</th>
            <tr >
                <td>
                    Resultat
                </td>
                <td >
                    {{ $resultats-> resultats}}
                </td>
            </tr>


            <th colspan="3">PASSIFS NON COURANTS</th>

            @if (!empty($pncs))
                @foreach ($pncs as $pnc)
                <tr >
                    <td >{{ $pnc->libelle}}</td>
                    <td>{{ $pnc->solde_debit}}</td>
                    <td>{{ $pnc->solde_credit}}</td>
                </tr>
                @endforeach
                <tr >
                    <th>Total</th>
                    <td>{{ $sum_pncs->solde_debit}}</td>
                    <td>{{ $sum_pncs->solde_credit}}</td>
                </tr>
            @endif
                <tr >
                    <th >TOTAL PASSIFS</th>
                    <td>{{ $solde_passifs->solde_debit}}</td>
                    <td>{{ $solde_passifs->solde_credit}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection