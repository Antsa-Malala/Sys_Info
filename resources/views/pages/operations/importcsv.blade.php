@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="container">
			<form action="" class="form" enctype="multipart/form-data">
				@csrf
				<div class="my-3">
					<label for="" class="form-label"> Importer vos écritures en csv </label>
					<input type="file" name="csv" class="form-control-file" id="">
				</div>
				<div class="my-3">
					<input type="submit" class="btn btn-primary" value="Importer les ecritures">
				</div>
			</form>
		</div>
	</div>
@endsection