@extends('layouts.app')
@section('content')
	<div class="container my-3">
		
		<div class="container card card-body col-lg-7">
			<div class="title">
				<h4 class="text-center">
					Importer votre fichier CSV 
				</h4>
			</div>
			<form action="plan-insertion-csv-import" method="POST" class="form" enctype="multipart/form-data" id="form">
				@csrf
				<div class="my-3 row mx-3">
					<div class="col-lg-3">
						<label for="" class="form-label">Importer un Fichier CSV</label>
					</div>
					<div class="col-lg-8">
						<input type="file" name="csv" class="form-control" required>
					</div>
				</div>
				<div class="my-3 text-center">
					<a href="plan-list" class="btn btn-primary">
						Retourner
					</a>
					<input type="submit" class="btn btn-success" value="Importer">
				</div>
			</form>
		</div>
	</div>
@endsection