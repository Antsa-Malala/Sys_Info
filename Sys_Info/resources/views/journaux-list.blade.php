<!-- resources/views/journaux-list.blade.php -->

<h1>Journaux</h1>

<ul>
    @foreach ($journaux as $journaux)
        <li>{{ $journaux->libelle}}</li>
    @endforeach
</ul>
