@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="container">
			<div class="title">
				<h2 class="text-center text-decoration-underline">
					Ajouter une écriture
				</h2>
			</div>
			<form action="/testEP" method="post" class="form">
				{{-- Inona ny ato --}}
				{{-- Ato no asiana izay tiako --}}
				{{-- Voalohany ny id --}}
				{{-- Faharoa ny Libelle --}}
				{{-- Farany ny date --}}
				<div class="mb-3">
					@csrf
					<label for="" class="form-label">
						Libelle:
					</label>
					<input type="text" name="libelle" value="{{ old('libelle')}}" class="form-control" placeholder="ACHAT MARCHANDISE ROJO">
				</div>
				<div class="mb-3">
					@csrf
					<label for="" class="form-label">
						Date d'écriture:
					</label>
					<input type="date" name="date" value="{{ old('date') }}" id="" class="form-select">
				</div>
				<div class="mb-3">
					<input type="submit" class="btn btn-primary" value="Ajouter l'écriture">
				</div>
			</form>
		</div>
	</div>
@endsection