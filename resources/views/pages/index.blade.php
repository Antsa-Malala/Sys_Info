@extends('layouts.app')

@section('content')
	<div class="container card py-3 my-3">
		<h2 class="text-center text-decoration-underline">
			Remplissez le formulaire
		</h2>
		<div class="container my-3 mx-auto w-75">
			<div class="row card p-3">
				<form action="/add" method="POST" enctype="multipart/form-data">
					<div class="mb-3 form-inline row">
						<div class="col-lg-3">
							<label for="" class="form-label"> Nom de la société : </label>
						</div>
						<div class="col-lg-6">
							@csrf
							<input type="text" class="form-control" name="name">
						</div>
					</div>
					<div class="mb-3 row">
						<div class="col-lg-3">
							<label for="" class="form-label"> Localisation de la société </label>
						</div>
						<div class="col-lg-6">
							@csrf
							<input type="text" class="form-control" name="localisation">
						</div>
					</div>
					<div class="mb-3 row">
						<div class="col-lg-3">
							<label for="" class="form-label"> Status (scan upload) </label>
						</div>
						<div class="col-lg-9 d-flex">
							@csrf
							{{-- <div class="col-lg-3">
								<input type="text" class="form-control" onfocus="hide(this)" name="status">
							</div> --}}
							{{-- <div class="col-2">
							</div> --}}
							<div class="col-lg-5">
								{{-- <span class="mx-3">
									|
								</span> --}}
								<input type="file" class="form-control " name="status" id="">
							</div>
							{{-- Ampiana sary eto --}}
						</div>
					</div>
					<div class="mb-3 row">
						<div class="col-lg-3">
							<label for="" class="form-label"> Numéro fiscale et image carte fiscale </label>
						</div>
						<div class="col-lg-9 d-flex">
							@csrf
							<div class="col-lg-3">
								<input type="text" class="form-control"  name="fisc" placeholder="999 999 999">
							</div>
							<div class="col-lg-5 offset-1">
								<input type="file" class="form-control form-control-file "  name="fisc" id="">
							</div>
						</div>
					</div>
					<div class="mb-3 row">
						<div class="col-lg-3">
							<label for="" class="form-label"> Nom du fondateur </label>
						</div>
						<div class="col-lg-6">
							@csrf
							<input type="text" name="pdg" class="form-control">
						</div>
					</div>
					<div class="mb-3 row">
						<div class="col-lg-3">
							<label for="" class="form-label"> Siège d'Exploitation de la société : </label>
						</div>
						<div class="col-lg-6">
							@csrf
							<input type="text" name="siege" class="form-control">
						</div>
					</div>
					<div class="mb-3 row">
						<div class="col-lg-3">
							<label for="" class="form-label"> Déscription de la société </label>
						</div>
						<div class="col-lg-6">
							@csrf
							<input type="text" name="quoi" class="form-control">
						</div>
					</div>
					<div class="mb-3 row">
						<div class="col-lg-3">
							<label for="" class="form-label"> Date création de la société </label>
						</div>
						<div class="col-lg-6">
							@csrf
							<input type="date" name="creation" class="form-control">
						</div>
					</div>
					<div class="mb-3 row">
						<div class="col-lg-3">
							<label for="" class="form-label"> Logo de la société </label>
						</div>
						<div class="col-lg-6">
							@csrf
							<input type="file" name="logo" value="aucun" class="form-control  form-control-file">
						</div>
					</div>
					<div class="mb-3 row">
						<div class="col-lg-3">
							<label for="" class="form-label"> Date début exercice </label>
						</div>
						<div class="col-lg-6">
							@csrf
							<input type="date" name="exo" class="form-control">
						</div>
					</div>
					<div class="mb-3 row">
						<div class="col-lg-3">
							<label for="" class="form-label"> Téléphone </label>
						</div>
						<div class="col-lg-6">
							@csrf
							<input type="text" placeholder="Numéro" name="numero" class="form-control">
						</div>

					</div>
					<div class="mb-3 row">
						<div class="col-lg-3">
							<label for="" class="form-label"> Télécopie </label>
						</div>
						<div class="col-lg-6">	
							@csrf
							<input type="text" placeholder="Télécopie" name="telecopie" class="form-control">
						</div>
						
					</div>
					<div class="mb-3 text-center">
							@csrf
						<input type="submit" value="Enregistrer la société" class="btn btn-dark p-3">
					</div>
				</form>
			</div>
		</div>
	</div>
	<script src="{{ URL::asset('js/app.js') }}"></script>
@endsection('content')