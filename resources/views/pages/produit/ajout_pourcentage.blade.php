@extends('layouts.app')

@section('content')
	{{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
	<div class="container" style="margin-top: 125px;">
        <div class="container w-50 shadow p-4" style="border-radius: 10px;">
        	
            <form method="POST" id="form">
                @csrf
                <div class="my-3">
                    <h4 class="text-center mb-4">Pourcentage de produit de "Nom de charge"</h4>

                    <div class="row mb-3 ms-3">
                    	<table class="table">
                    		<thead>
                    			<th> Nom du produit </th>
                    			<th> Pourcentage </th>
                    		</thead>
                    		<tbody id="original">
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
							<input type="number" id = "pourcent" name="" placeholder="Pourcentage" class="form-control" max="100" min="0" required>
						</div>
						<div class="col-md-3">
							<span onclick="cloneProduct()" class="btn btn-dark">
								+
							</span>
						</div>
					</div>
                </div>
				<div class="mb-3 ms-4">
					<button type="button" onclick="submitForm()" class="btn btn-success"> Valider </button>
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