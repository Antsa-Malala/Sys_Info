<!-- resources/views/devise-list.blade.php -->

<h1>Devises</h1>

<ul>
    @foreach ($devises as $devise)
        <li>{{ $devise->nom }}</li>
    @endforeach
</ul>
