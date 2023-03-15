@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="container">
			<div class="container card">
				<div class="card-body">
					<div class="row headings">
						<div class="col-4">
							<img src="" alt="" class="logo img-fluid">
						</div>
					</div>
					<div class="row society">
						<div class="row">
							<div class="col-lg-3">
								Name
							</div>
							<div class="col-lg-5">
								{{ $society->getNom() }}
							</div>
							
						</div>
						<div class="row">
							<div class="col-lg-3">
								Crée le :
							</div>
							<div class="col-lg-5">
								{{ $society->getCreation() }}
							</div>
							
						</div>
						<div class="row">
							<div class="col-lg-3">
								Numéro d'identification fiscale :
							</div>
							<div class="col-lg-5">
								{{ $society->getFisc() }}
							</div>
						</div>
						<div class="row">
							<div class="col-lg-3">
								Image de carte fiscale :
							</div>
							<div class="col-lg-5">
								{{ $society->getFiscImage() }}
							</div>
						</div>
						<div class="row">
							<div class="col-lg-3">
								Status de la société :
							</div>
							<div class="col-lg-5">
								{{ $society->getStatus() }}
							</div>
						</div>
						<div class="row">
							<div class="col-lg-3">
								Fondateur de la société :
							</div>
							<div class="col-lg-5">
								{{ $society->getFondateur() }}
							</div>
						</div>
						<div class="row">
							<div class="col-lg-3">
								Date début d'exercice :
							</div>
							<div class="col-lg-5">
								{{ $society->getDateExercice() }}
							</div>
						</div>
						<div class="row d-flex">
							<div class="col-lg-5">
								<div class="col-lg-3">
									Numéro de Téléphone :
								</div>
								<div class="col-lg-5">
									{{ $society->getTelephonie() }}
								</div>
							</div>
							<div class="col-lg-5">
								<div class="col-lg-3">
									Numéro de Télécopie :
								</div>
								<div class="col-lg-5">
									{{ $society->getTelephonie() }}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
