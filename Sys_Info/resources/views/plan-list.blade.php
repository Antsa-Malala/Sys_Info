<!-- resources/views/plan-list.blade.php -->

<h1>Plans</h1>

<ul>
    @foreach ($plans as $plan)
        <li>{{ $plan->libelle}}</li>
    @endforeach
</ul>
