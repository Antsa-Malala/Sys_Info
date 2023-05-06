@extends('layouts.app')

@section('content')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<div class="container" style="margin-top: 125px;">
        <div class="container w-50 shadow p-4" style="border-radius: 10px;">
            <form action="" method="POST" id="form">
                @csrf
                <div class="my-3">
                    <h4 class="text-center mb-4">Pourcentage de produit de "Nom de charge"</h4>
					<div class="row ms-3" id="original">
						<div class="col-md-5">
							<select name="produit" id="" class="form-select">
								<option value="">Produit 1</option>
								<option value="">Produit 2</option>
								<option value="">Produit 3</option>
								<option value="">Produit 4</option>
								<option value="">Produit 5</option>
							</select>
						</div>
						<div class="col-md-4">
							<input type="number" name="pourcentage" class="form-control" max="100" min="0" required>
						</div>
						<div class="col-md-3">
							<span onclick="clone()" class="btn btn-dark">
								+
							</span>
						</div>
					</div>
                </div>
                <div class="mb-3 ms-4">
                    <input type="submit" value="Ajouter de nouveau produit" class="btn btn-primary">
                </div>
				<div class="mb-3 ms-4">
                    <input type="submit" value="Valider" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
	<script src="{{ URL::asset('js/app.js') }}"></script>
@endsection