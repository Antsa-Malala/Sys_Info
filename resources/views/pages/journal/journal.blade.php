@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="container">
			<div class="title">
				<h3 class="text-center text-decoration-underline">
					Toutes les Opérations du Journal {{ $journal->code }}
				</h3>
			</div>
			<div class="row">
				<div class="actions">
					<a href="{{ url('testE') }}" class="btn btn-success">
						Ajouter une Ecriture
					</a>
				</div>
			</div>
			<div class="row operations p-3 my-3 shadow-sm">
				<table class="table shadow">
					<thead>
						<th> Date </th>
						<th> Reference Piece </th>
						<th> Plan Comptable </th>
						<th> Compte Tiers </th>
						<th> Libelle </th>
						<th> Debit </th>
						<th> Credit </th>
					</thead>
					<tbody>
					@foreach( $journaux as $journal )
						<tr class="tr">
							<td> {{ $journal->dateecriture }} </td>
							<td> {{ $journal->numpiece }} </td>
							<td> {{ $journal->compte }} - {{ $journal->comptes }} </td>
							<td> {{ $journal->tiers }} </td>
							<td> {{ $journal->ecriture }} </td>
							<td> {{ $journal->debit }} </td>
							<td> {{ $journal->credit }} </td>
						</tr>
					@endforeach
					</tbody>
				</table>
					@if( count($journaux) == 0 )
						<div class="row ">
							<h4 class="error text-center">
									Aucune ecriture a afficher
								
							</h4>
						</div>
					@endif
			</div>
		</div>
	</div>
	{{-- Apoitra daholo ny opération rehetra --}}
@endsection