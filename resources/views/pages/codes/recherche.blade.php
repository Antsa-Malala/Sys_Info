@extends("layouts.app")
@section('content')
<div class="container">
    <div class="container">
        <div class="container">
                <form id="formulaire_recherche" class="form" action="{{ url('/search_journal') }}" method="GET">
                    <div class="mb-3">
                        <input type="text" class="form-control" onkeyup="fetchData(this)" name="recherche" placeholder="Rechercher code journal">
                        <button type="submit" class="btn btn-primary">Rechercher</button>
                    </div>
                </form>

                <div id="resultats">
                </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/search_journal.js') }}"></script>
@endsection
