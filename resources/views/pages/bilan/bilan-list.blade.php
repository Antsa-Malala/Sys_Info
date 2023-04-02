<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bilan</title>
    <link rel="stylesheet" href="{{URL::asset('/assets/css/style.css')}}">
    <style>
        th, td {
          border: 1px solid black;
          padding:10px;
        }
        tr {
          border: 1px solid black;
        }
        table{
            margin:20px;
            float:left;
        }
      </style>
</head>
<body>
    <table style="border-collapse: collapse">
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
                <tr >
                    <td >{{ $ac->libelle}}</td>
                    <td>{{ $ac->solde_debit}}</td>
                    <td>{{ $ac->solde_credit}}</td>
                </tr>
                @endforeach
                <tr >
                    <th>Total</th>
                    <td>{{ $sum_acs->solde_debit}}</td>
                    <td>{{ $sum_acs->solde_credit}}</td>
                </tr>
            @endif

            <th colspan="3">ACTIFS NON COURANTS</th>

            @if (!empty($ancs))
                @foreach ($ancs as $anc)
                <tr >
                    <td >{{ $anc->libelle}}</td>
                    <td>{{ $anc->solde_debit}}</td>
                    <td>{{ $anc->solde_credit}}</td>
                </tr>
                @endforeach
                <tr >
                    <th>Total</th>
                    <td>{{ $sum_ancs->solde_debit}}</td>
                    <td>{{ $sum_ancs->solde_credit}}</td>
                </tr>
            @endif
                <tr >
                    <th >TOTAL ACTIFS</th>
                    <td>{{ $solde_actifs->solde_debit}}</td>
                    <td>{{ $solde_actifs->solde_credit}}</td>
                </tr>
        </tbody>
    </table>
    <table style="border-collapse: collapse">
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

            @if (!empty($cps))
                @foreach ($cps as $cp)
                <tr >
                    <td >{{ $cp->libelle}}</td>
                    <td>{{ $cp->solde_debit}}</td>
                    <td>{{ $cp->solde_credit}}</td>
                </tr>
                @endforeach
                <tr >
                    <th>Total</th>
                    <td>{{ $sum_cps->solde_debit}}</td>
                    <td>{{ $sum_cps->solde_credit}}</td>
                </tr>
            @endif

            <th colspan="3">PASSIFS COURANTS</th>

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


</body>
</html>