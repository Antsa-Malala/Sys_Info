@extends('layouts.app')
@section('content')
	
	<div class="container">
		<div class="container">
			<div class="row title">
				<h3 class="title text-center text-decoration-underline">
					Listes de vos Plan Comptables
				</h3>
			</div>
			<div class="row my-3 p-4 shadow">
				<table class="table">
					<thead >
						<th class="text-center"> Compte Comptable </th>
						<th> Libelle </th>
					</thead>
					<tbody>
						@foreach( $plans as $plan )
							<tr>
								<td class="text-center">
									<a href="{{ url("/books/Show/".$plan->compte) }}" class="links">
										{{ $plan->compte }} 		
									</a> 
								</td>
								<td> {{ $plan->libelle }} </td>
							</tr>
						@endforeach
					</tbody>
				</table>

			</div>	
		</div>
	</div>

@endsection