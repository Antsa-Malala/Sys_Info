<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche Tiers</title>
</head>
<body>

<form id="formulaire_recherche" action="{{ url('/search_tiers') }}" method="GET">
    <input type="text" name="recherche" placeholder="Rechercher tiers">
    <button type="submit">Rechercher</button>
</form>

<div id="resultats"></div>


<script src="{{ asset('js/search_tiers.js') }}"></script>
</body>
</html>