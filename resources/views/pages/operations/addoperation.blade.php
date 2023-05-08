@extends('layouts.app')

@section('content')
	{{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

	{{-- Inona no atao ato --}}
	{{-- Manao formulaire ampidirana écriture --}}
	<div class="container">
		<div class="container shadow p-3 my-3 card card-body">
				<div class="title text-center ">
					<h2>
						Ajouter des opérations pour : {{ $ecriture->libelle }}
					</h2>
				</div>
			<form id="form">
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
						@csrf
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
								{{-- Asiako input avy eto de alaiko ny select eo akaikiny --}}
								<select name="compte[]" onchange="validate(this)" class="form-select">
									<option value=""> Choissez Un compte </option>
									@for( $i = 0 ; $i < count($comptes) ; $i++ )
										<option value="{{ $comptes[$i]->compte }}"> 
										{{ $comptes[$i]->compte." - ".$comptes[$i]->libelle }} </option>
									@endfor
								</select>
								<div class="row d-none">
									<div class="row mt-2">
										<div class="col-md-6">
											<input type="number" placeholder="Variable" name="variable[]" class="form-control" required>
										</div>
										<div class="col-md-6">
											<input type="number" placeholder="Fixe" name="fixe[]" class="form-control" required>
										</div>
									</div>
									<div class="row mt-2">
										<div class="col-md-6">
											<input type="radio" placeholder="Variable" name="nature" class="form-check-input">
											Incorporel
										</div>
										<div class="col-md-6">
											<input type="radio" placeholder="Fixe" name="nature" class="form-check-input">
											Non Incorporel
										</div>
									</div>
									
								</div>
							</td>
							<td>
								{{-- <input type="text" name="fo-c[]"  id="" class="form-control" placeholder="ex:  ROJO"> --}}
								<select name="fo-c[]" class="form-select" id="">
									<option value=""> Choissez Un compte Tiers </option>
									@for( $i = 0 ; $i < count($tiers) ; $i++ )
										<option value="{{ $tiers[$i]->numero }}"> 
										{{ $tiers[$i]->numero." - ".$tiers[$i]->libelle }} </option>
									@endfor
								</select>
							</td>
							<td>
								{{-- @csrf --}}
									{{-- {{ csrf_field() }} --}}
								<input type="text" name="libelle[]" id="" class="form-control" value="{{ $ecriture->libelle }}" readonly>
								
							</td>
							<td>
								{{-- @csrf --}}
									{{-- {{ csrf_field() }} --}}
								<input type="number" name="debit[]" id=""  class="form-control">
								{{-- <input type="number" name="debit[]" id=""  value="{{ old('debit[]') }}" class="form-control"> --}}
							</td>
							<td>
								{{-- @csrf --}}
									{{-- {{ csrf_field() }} --}}
								<input type="number" name="credit[]" id=""  class="form-control">
								{{-- <input type="number" name="credit[]" id="" value="{{ old('credit[]') }}"  class="form-control"> --}}
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
					<button type="button" onclick="submitForm()"  class="btn btn-primary"> Enregistrer les opérations </button>
					<a href="{{ url('operation-csv') }}" class="btn btn-primary"> Importer un fichier CSV </a>
				</div>
			</form>
		</div>
	</div>
	<script src="{{ URL::asset('js/app.js') }}"></script>
	<script src="{{ URL::asset('js/Operations.js') }}"></script>
	
	{{-- <script src="{{ URL::asset('js/operation.template.js') }}"></script> --}}
@endsection