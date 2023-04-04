@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="container">
			<div class="container">
				<div class="title">
					<h2 class="text-center text-decoration-underline">
						Consulter votre journal
					</h2>
				</div>
				<div class="col-lg-6 text-center">
					<table class="table table-hover">
						<thead>
							<th> Code Journal </th>
							<th> Libelle Journal </th>
						</thead>
						<tbody>
							@for($i = 0 ; $i < count($journaux) ; $i++)
									<tr>
										<td>
											<a href="{{ url('journaux-By-Code/'.$journaux[$i]->code) }}" class="text-decoration-none">
												{{ $journaux[$i]->code }}				
											</a>
										</td>
										<td>
											{{ $journaux[$i]->libelle }}				
										</td>
									</tr>
							@endfor
						</tbody>
					</table>
				</div>	
			</div>
		</div>
	</div>
@endsection