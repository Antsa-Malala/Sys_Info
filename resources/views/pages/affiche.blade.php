@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="card col-lg-6">
			<div class="card-body">
				<div class="row">
					<div class="col-lg-5">
						Nom : 
					</div>
					<div class="col-lg-5">
						{{ $name }}
					</div>
				</div>
				<div class="row">
					<div class="col-lg-5">
						Localisation : 
					</div>
					<div class="col-lg-5">
						{{ $localisation }}
					</div>
				</div>
				<div class="row">
					<div class="col-lg-5">
						Status : 
					</div>
					<div class="col-lg-5">
						{{ $status }}
					</div>
				</div>
				<div class="row">
					<div class="col-lg-5">
						Numéro Fiscale : 
					</div>
					<div class="col-lg-5">
						{{ $fisc }}
					</div>
				</div>
				<div class="row">
					<div class="col-lg-5">
						Nom du Fondateur : 
					</div>
					<div class="col-lg-5">
						{{ $pdg }}
					</div>
				</div>
				<div class="row">
					<div class="col-lg-5">
						Siège de la société : 
					</div>
					<div class="col-lg-5">
						{{ $siege }}
					</div>
				</div>
				<div class="row">
					<div class="col-lg-5">
						Déscription : 
					</div>
					<div class="col-lg-5">
						{{ $quoi }}
					</div>
				</div>
				<div class="row">
					<div class="col-lg-5">
						Crée le : 
					</div>
					<div class="col-lg-5">
						{{ $creation }}
					</div>
				</div>
				<div class="row">
					<div class="col-lg-5">
						Logo de la société : 
					</div>
					<div class="col-lg-5">
						{{ $logo }}
					</div>
				</div>
				<div class="row">
					<div class="col-lg-5">
						Date début d'exercice : 
					</div>
					<div class="col-lg-5">
						{{ $exo }}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
