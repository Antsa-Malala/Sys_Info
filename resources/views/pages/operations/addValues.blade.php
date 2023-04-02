@extends('layouts.app')

@section('content')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<div class="container">
		<div class="container my-3 card card-body">
				<div class="title text-center ">
					<h2 class="text-decoration-underline">
						Ajouter des opérations pour : {{ $ecriture->libelle }}
					</h2>
				</div>
			<form action="testAdd" class="" method="POST">
				{{-- Bouclena amin'ny js amin'izay ito avy eo --}}
				<table class="table" id="opr">
					<thead>
						<th> Date </th>
						<th> N° Piece </th>
						<th> Compte </th>
						<th> Compte Tiers </th>
						<th> Libelle </th>
						<th> Debit </th>
						<th> Credit </th>
					</thead>
					<tbody  id="operations">
						{{ csrf_field() }}
						@for( $j = 0 ; $j < count(old('compte')) ; $j++ )
							<tr id="original">
								<td>
									<input type="date" class="form-control" name="dates[]" value="{{ $ecriture->dateecriture }}" readonly>
								</td>
								<td>
									<div class="input-group"> 
										<input type="text" name="ref[]" class="form-control" value="{{ $ecriture->createReference() }}" id="" readonly>
									</div>
								</td>
								<td>
									<select name="compte[]" class="form-select" id="">
										<option value=""> Choissez Un compte </option>
										@for( $i = 0 ; $i < count($comptes) ; $i++ )
											<option value="{{ $comptes[$i]->idplan }}" @if( strpos($comptes[$i]->idplan, old('compte')[$j] ) !== false ){
												{{ 'selected' }};
											} @endif> 
											{{ $comptes[$i]->compte." - ".$comptes[$i]->libelle }} </option>
										@endfor
									</select>
								</td>
								<td>
									<input type="text" name="fo-c[]"  id="" class="form-control" placeholder="ex:  ROJO">
								</td>
								<td>
									<input type="text" name="libelle[]" id="" class="form-control" value="{{ $ecriture->libelle }}" readonly>
								</td>
								<td>
									<input type="number" name="debit[]" id=""  class="form-control">
								</td>
								<td>
									<input type="number" name="credit[]" id=""  class="form-control">
								</td>
							</tr>
						@endfor	
					</tbody>
				</table>
				<span onclick="clone()" class="my-3 btn btn-dark">
					Ajouter une ligne
				</span>
				<div class="my-3">
					<input type="submit" class="btn btn-primary" value="Enregistrer les opérations">
				</div>
			</form>
		</div>
	</div>
	<script src="{{ URL::asset('js/app.js') }}"></script>
@endsection