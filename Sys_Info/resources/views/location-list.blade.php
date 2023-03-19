<!-- resources/views/location-list.blade.php -->

<h1>Locations</h1>

<ul>
    @foreach ($locations as $location)
        <li>{{ $location->localisation}}</li>
    @endforeach
</ul>
