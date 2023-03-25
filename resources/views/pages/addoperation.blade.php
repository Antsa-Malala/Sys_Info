@extends('layouts.app')

@section('content')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	{{-- Inona no atao ato --}}
	{{-- Manao formulaire ampidirana écriture --}}
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
						<tr id="original">
							<td>
								<input type="date" class="form-control" value="{{ $ecriture->dateecriture }}" readonly>
							</td>
							<td>
								<div class="input-group"> 
									{{-- Select + Input --}}
									{{-- {{ csrf_field() }} --}}
									{{-- @csrf --}}
									<select name="no[]" id="" class="form-select col-1">
										@for( $i = 0 ; $i < count($journaux) ; $i++)
											<option value="{{ $journaux[$i]->code }}">
												{{ $journaux[$i]->code }}
											</option>
										@endfor
									</select>
									{{-- {{ csrf_field() }} --}}
									{{-- @csrf --}}
									<input type="text" class="form-control" name="piece[]" placeholder=".........">
									
								</div>
							</td>
							<td>
								{{-- @csrf --}}
									{{-- {{ csrf_field() }} --}}
								<input type="text" class="form-control" name="compte[]" placeholder="Numéro de compte">
							</td>
							<td>
								{{-- @csrf --}}
									{{-- {{ csrf_field() }} --}}
								<input type="text" name="fo-c[]" id="" class="form-control" placeholder="ex:  ROJO">
							</td>
							<td>
								{{-- @csrf --}}
									{{-- {{ csrf_field() }} --}}
								<input type="text" name="libelle" id="" class="form-control" value="{{ $ecriture->libelle }}" readonly>
								
							</td>
							<td>
								{{-- @csrf --}}
									{{-- {{ csrf_field() }} --}}
								<input type="number" name="debit[]" id="" value="0" class="form-control">
							</td>
							<td>
								{{-- @csrf --}}
									{{-- {{ csrf_field() }} --}}
								<input type="number" name="credit[]" id="" value="0" class="form-control">
							</td>
						</tr>
					</tbody>
				</table>
				<span onclick="clone()" class="my-3 btn btn-dark">
					Ajouter une ligne
				</span>
				{{-- <span onclick="remove()" class="my-3 btn btn-dark">
					remove
				</span> --}}
				<div class="my-3">
					<input type="submit" class="btn btn-primary" value="Enregistrer les opérations">
				</div>
			</form>
		</div>
	</div>
	<script src="{{ URL::asset('js/app.js') }}"></script>
	{{-- <script src="{{ URL::asset('js/operation.template.js') }}"></script> --}}
@endsection