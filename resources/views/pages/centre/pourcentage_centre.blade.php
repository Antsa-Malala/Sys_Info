@extends('layouts.app')

@section('content')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<div class="container" style="margin-top: 125px;">
        <div class="container w-50 shadow p-4" style="border-radius: 10px;">
            <form action="/insert-update" method="POST" id="form">
                @csrf
                <div class="my-3">
                    <h4 class="text-center mb-4">Pourcentage de centre de "{{ session('charge')->libelle }}" </h4>
                    <div class="row ms-3">
                    	<table class="table">
                    		<thead>
                    			<th> Nom du centre </th>
                    			<th> Pourcentage </th>
                    		</thead>
                    		<tbody id="original">
                    			@if( session()->has('centers') )
                    				@foreach( session('centers') as $center )
                    					<tr>
                    						<td>
                    							<select name="center[]" class="form-select">
													{{-- Boucler les produits --}}
													@for( $i = 0 ; $i < count($centres) ; $i++ )
														@if( $center->idcentre == $centres[$i]->idcentre )
															<option selected value="{{ $centres[$i]->idcentre }}">
																{{ $centres[$i]->nomcentre }}
															</option>
														@else
															<option value="{{ $centres[$i]->idcentre }}">
																{{ $centres[$i]->nomcentre }}
															</option>
														@endif
													@endfor
												</select>
                    						</td>
                    						<td>
                    							<input type="text" class="form-control" name="pourcentage[]" value="{{ $center->pourcentage }}" id="">
                    						</td>
                    					</tr>
                    				@endforeach
                    			@elseif( session()->has('centers') )
                    				@foreach( $centers as $center )
                    					<tr>
                    						<td>
                    							<select name="center[]" class="form-select">
													{{-- Boucler les produits --}}
													@for( $i = 0 ; $i < count($centres) ; $i++ )
														@if( $center->idcentre == $centres[$i]->idcentre )
															<option selected value="{{ $centres[$i]->idcentre }}">
																{{ $centres[$i]->nomcentre }}
															</option>
														@else
															<option value="{{ $centres[$i]->idcentre }}">
																{{ $centres[$i]->nomcentre }}
															</option>
														@endif
													@endfor
												</select>
                    						</td>
                    						<td>
                    							<input type="text" class="form-control" name="pourcentage[]" value="{{ $center->pourcentage }}" id="">
                    						</td>
                    					</tr>
                    				@endforeach
                    			@endif
                    		</tbody>
                    	</table>
                    </div>
					<div class="row ms-3" id="original">
						<div class="col-md-5">
							<select name="" id="center" class="form-select">
								{{-- Boucler les produits --}}
								@for( $i = 0 ; $i < count($centres) ; $i++ )
									<option value="{{ $centres[$i]->idcentre }}">{{ $centres[$i]->nomcentre }}</option>
								@endfor
							</select>
						</div>
						<div class="col-md-4">
							<input type="number" name="" id="pourcent" class="form-control" max="100" min="0">
						</div>
						<div class="col-md-3">
							<span onclick="cloneCenter()" class="btn btn-dark">
								+
							</span>
						</div>
					</div>
                </div>
				<div class="mb-3 ms-4">
					<input type="submit" value="Valider" class="btn btn-success">
                </div>
            </form>
			<div class="mb-3 ms-4">
				<a href="/centre_form"><button class="btn btn-primary">Ajouter de centre produit</button></a>
			</div>
        </div>
    </div>
	<script src="{{ URL::asset('js/app.js') }}"></script>
	<script src="{{ URL::asset('js/Percentage.js') }}"></script>
@endsection