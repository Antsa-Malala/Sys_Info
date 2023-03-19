<!-- resources/views/society-list.blade.php -->

<h1>Societies</h1>

<ul>
    @foreach ($societies as $society)
        <li>{{ $society->nom }}</li>
    @endforeach
</ul>
