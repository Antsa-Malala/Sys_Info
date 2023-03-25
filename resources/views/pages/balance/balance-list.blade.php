<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balance</title>
    <link rel="stylesheet" href="{{URL::asset('/assets/css/style.css')}}">
    <style>
        th, td {
          border: 1px solid black;
          padding:10px;
        }
        tr {
          border: 1px solid black;
        }
      </style>
</head>
<body>
<table style="border-collapse: collapse">
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
            <td >{{ $balance->compte}}</td>
            <td >{{ $balance->intitule}}</td>
            <td>{{ $balance->debit}}</td>
            <td>{{ $balance->credit}}</td>
            <td>{{ $balance->solde_debit}}</td>
            <td>{{ $balance->solde_credit}}</td>
        </tr>
        @endforeach
    </tbody>
</table>


</body>
</html>