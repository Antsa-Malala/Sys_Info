@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="container">
			<div class="container">
				<div class="title">
					<h2 class="text-center">
						Consulter votre journal
					</h2>
				</div>
				<div class="mt-4">
					<a href="{{ url('/plan-insertion') }}" class="btn btn-success me-3">Ajouter</a>
					<div class="shadow pt-4 mt-4" style="border-radius: 15px">
						<table class="table">
							<tr>
								<th class="text-center"> Code Journal </th>
								<th class="text-center"> Libelle Journal </th>
								<th> </th>
								<th> </th>
							</tr>
							@for($i = 0 ; $i < count($journaux) ; $i++)
									<tr>
										<td class="text-center">
											<a href="{{ url('journaux-By-Code/'.$journaux[$i]->code) }}" class="text-decoration-none">
												{{ $journaux[$i]->code }}				
											</a>
										</td>
										<td class="text-center">
											{{ $journaux[$i]->libelle }}				
										</td>
									</tr>
							@endfor
						</table>
					</div>
					<nav class="d-flex justify-content-center mt-4">
						<ul class="pagination pagination-lg" id="pagination">
						  
					</nav>
				</div>
			</div>
		</div>
	</div>
	<script>
		makePagination( {{ $current }} , {{ $pages }} , 5 , "{{ url("journal/") }}" , "#pagination" );
	</script>
@endsection