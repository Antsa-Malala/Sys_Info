@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="container shadow">
			<div class="row p-3">
				<div class="title">
					<h4 class="text-center text-decoration-underline">
						Grand Livre du compte : {{ $compte->libelle }}
					</h4>
				</div>
			</div>
			<div class="row my-3 p-4">
				<table class="table shadow">
					<thead>
						<th> Code Journal </th>
						<th> Date </th>
						<th> Reference Piece </th>
						<th> Libelle </th>
						<th> Debit </th>
						<th> Credit </th>
					</thead>
					<tbody>
						@foreach( $operations as $operation )
							<tr>
								<td>{{ $operation->code }}</td>
								<td>{{ $operation->dateecriture }}</td>
								<td>{{ $operation->numpiece }}</td>
								<td>{{ $operation->libelle }}</td>
								<td class="text-end">{{ $operation->debit }}</td>
								<td class="text-end">{{ $operation->credit }}</td>
							</tr>		
						@endforeach
					</tbody>
				</table>
				@if( count($operations) == 0 )
				<div class="nothing row">
					<div class="nothin">
						<h4 class="text-center">
							Aucune Opération pour ce plan Comptable
						</h4>
					</div>
				</div>
				@endif
			</div>
		</div>
	</div>
@endsection