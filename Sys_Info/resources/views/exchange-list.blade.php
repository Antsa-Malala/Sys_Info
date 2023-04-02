<!-- resources/views/exchange-list.blade.php -->

<h1>Exchanges</h1>

<ul>
    @foreach ($exchanges as $exchange)
        <li>{{ $exchange->rate }}</li>
    @endforeach
</ul>
