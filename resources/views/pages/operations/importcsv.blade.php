@extends('layouts.app')
@section('content')
<div class="container" style="margin-top: 125px;">
    <div class="container w-50 shadow p-4" style="border-radius: 10px;">
			<form action="{{ url('operation-import-csv') }}" method="POST" class="form" enctype="multipart/form-data">
				@csrf
				<div class="my-3 row">
					<div class="col-lg-3">
						<label for="" class="form-label"> Importer vos écritures en csv </label>
					</div>
					<div class="col">
						<input type="file" name="csv" class="form-control" id="">
					</div>
				</div>
				<div class="my-3">
					<input type="submit" class="btn btn-primary" value="Importer les ecritures">
				</div>
			</form>
		</div>
	</div>
@endsection