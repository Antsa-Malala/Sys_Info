@extends('layouts.app')

@section('content')
	{{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
	<div class="container" style="margin-top: 125px;">
        <div class="container w-50 shadow p-4" style="border-radius: 10px;">
        	
            <form action="/produit-modif" method="POST"  id="form">
                @csrf

                <input type="hidden" name="charge" value="<?php echo $charge->compte ?>">
                <div class="my-3">
                    <h4 class="text-center mb-4">Pourcentage de produit de "{{ $charge->libelle }}" </h4>

                    <div class="row mb-3 ms-3">
                    	<table class="table">
                    		<thead>
                    			<th> Nom du produit </th>
                    			<th> Pourcentage </th>
                    		</thead>
                    		<tbody id="original">

                    			{{-- Ato tokony conditionnena kely fotsiny --}}
                    			@if( session()->has('ps') && session()->has('prs') )
                    				@for( $i = 0 ; $i < count(session('ps')) ; $i++ )
                    				<tr>
                    					<td>
	                    					<select name="produit[]" class="form-select">
											{{-- Boucler les produits --}}
												@for( $j = 0 ; $j < count($produits) ; $j++ )
													@if( $produits[$j]->idproduit ==  session('ps')[$i] )
														<option value="{{ $produits[$j]->idproduit }}" selected>
															{{ $produits[$j]->nomproduit }}
														</option>
													@else
														<option value="{{ $produits[$j]->idproduit }}">
															{{ $produits[$j]->nomproduit }}
														</option>
													@endif

												@endfor
											</select>				
                    					</td>
                    					<td>
                							<input type="number" value="{{ session('prs')[$i] }}" name="pourcentage[]" placeholder="Pourcentage" class="form-control" max="100" min="0" required>
	
                    					</td>
                    					
                    				</tr>
                    				@endfor

                    			@elseif( session()->has('Products') )
                    				@for( $i = 0 ; $i < count(session('Products')) ; $i++ )
                    					<tr>
                    						
	                    					<td>
		                    					<select name="produit[]" class="form-select">
												{{-- Boucler les produits --}}
													@for( $j = 0 ; $j < count($produits) ; $j++ )
														@if( $produits[$j]->idproduit ==  session('Products')[$i]->idproduit )
															<option value="{{ $produits[$j]->idproduit }}" selected>
																{{ $produits[$j]->nomproduit }}
															</option>
														@else
															<option value="{{ $produits[$j]->idproduit }}">
																{{ $produits[$j]->nomproduit }}
															</option>
														@endif

													@endfor
												</select>				
	                    					</td>
	                    					<td>
	                							<input type="number" value="{{ session('Products')[$i]->pourcentage }}" name="pourcentage[]" placeholder="Pourcentage" class="form-control" max="100" min="0" required>
		
	                    					</td>
                    					</tr>
                    				@endfor
                    			@endif

                    		</tbody>
                    	</table>	
                    </div>

					<div class="row ms-3" id="original">
						<div class="col-md-5">
							<select name="" id="products" class="form-select">
								{{-- Boucler les produits --}}
								@for( $i = 0 ; $i < count($produits) ; $i++ )
									<option value="{{ $produits[$i]->idproduit }}">{{ $produits[$i]->nomproduit }}</option>
								@endfor
							</select>
						</div>
						<div class="col-md-4">
							<input type="number" id = "pourcent" name="" placeholder="Pourcentage" class="form-control" max="100" min="0">
						</div>
						<div class="col-md-3">
							<span onclick="cloneProduct()" class="btn btn-dark">
								+
							</span>
						</div>
					</div>
                </div>
				<div class="mb-3 ms-4">
					<button type="submit" class="btn btn-success"> Valider </button>
					{{-- <button type="button" onclick="submitForm()" class="btn btn-success"> Valider </button> --}}
                </div>
            </form>
			<div class="mb-3 ms-4">
				<a href="/produit_form"><button class="btn btn-primary">Ajouter de nouveau produit</button></a>
			</div>
        </div>
    </div>
	<script src="{{ URL::asset('js/ajax.js') }}"></script>
	<script src="{{ URL::asset('js/Percentage.js') }}"></script>
@endsection