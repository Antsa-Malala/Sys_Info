@extends('layouts.app')

@section('content')
	<div class="container" style="margin-top: 125px;">
		<div class="container w-50 shadow p-4" style="border-radius: 10px;">
			<div class="title">
				<h2 class="text-center">
					Ajouter une écriture
				</h2>
			</div>
			<form action="/testEP" method="post" class="form" id="form">
				@csrf
				<div class="mb-3">
					<label for="" class="form-label">
						Libelle:
					</label>
					<input type="text" name="libelle" value="{{ old('libelle')}}" class="form-control" data-parsley-required="true">
				</div>
				<div class="mb-3">
					{{-- @csrf --}}
					<label for="" class="form-label">
						Date d'écriture:
					</label>
					<input type="date" name="date" value="{{ old('date') }}" id="" class="form-select">
				</div>
				<div class="my-3">
					<label for="" class="form-label">
						Choississez Un code journal
					</label>
					<select name="code" id="" class="form-select">
						@for($i = 0 ; $i < count($journaux) ; $i++)
							<option value="{{ $journaux[$i]->idcode }}"> {{ $journaux[$i]->code }} </option>
						@endfor
					</select>
				</div>
				<div class="mb-3">
					<input type="submit" class="btn btn-primary" value="Ajouter l'écriture">
				</div>
			</form>
		</div>
	</div>
@endsection