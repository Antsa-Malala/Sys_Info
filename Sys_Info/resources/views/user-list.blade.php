<!-- resources/views/ user-list.blade.php -->

<h1>Users</h1>

<ul>
    @foreach ($users as $user)
        <li>{{ $user->username }}</li>
    @endforeach
</ul>
