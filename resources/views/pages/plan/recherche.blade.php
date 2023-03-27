<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche plan comptable</title>
</head>
<body>

<form id="formulaire_recherche" action="{{ url('/search_compte') }}" method="GET">
    <input type="text" name="recherche" placeholder="Rechercher plan comptable">
    <button type="submit">Rechercher</button>
</form>

<div id="resultats"></div>


<script src="{{ asset('js/search_compte.js') }}"></script>
</body>
</html>