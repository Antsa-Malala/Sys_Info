@extends('layouts.app')
@section('content')
	
	<div class="container">
		<div class="container">
			<div class="row title">
				<h3 class="title text-center text-decoration-underline">
					Listes de vos Plan Comptables
				</h3>
			</div>
			<div class="row my-3 p-4 shadow">
				<table class="table">
					<thead >
						<th class="text-center"> Compte Comptable </th>
						<th> Libelle </th>
					</thead>
					<tbody>
						@foreach( $plans as $plan )
							<tr>
								<td class="text-center">
									<a href="{{ url("/books/Show/".$plan->compte) }}" class="links">
										{{ $plan->compte }} 		
									</a> 
								</td>
								<td> {{ $plan->libelle }} </td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<nav class="d-flex justify-content-center mt-4">
            <ul class="pagination pagination-lg">
                @for( $i = 1 ; $i <= $pages ; $i++ )
                    @if( $i == $current )
                        <li class="page-item active" aria-current="page">
                    @else
                        <li class="page-item">
                    @endif
                            <a class="page-link"  href="{{ url("books/".$i) }}">{{ $i }}</a>
                    </li>
                @endfor
              {{-- <li class="page-item active" aria-current="page">
                <span class="page-link">1</span>
              </li>
              <li class="page-item"><a class="page-link" href="#">3</a></li> --}}
            </ul>
        </nav>	
		</div>
	</div>

@endsection