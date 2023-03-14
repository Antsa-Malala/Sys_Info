<!-- resources/views/ tiers-list.blade.php -->

<h1>Tiers</h1>

<ul>
    @foreach ($tiers as $tiers)
        <li>{{ $tiers->libelle }}</li>
    @endforeach
</ul>
