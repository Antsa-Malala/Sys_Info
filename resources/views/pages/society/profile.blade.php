{{-- Inona ny ato  --}}
{{-- Information an'ilay société --}}
@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="container card card-body shadow my-2 py-3">
			<div class="title">
				<a href="plan-list" class="btn btn-dark"> Retour </a>
				<h3 class="text-center text-decoration-underline">
					Votre Profil :
				</h3>
			</div>
			<div class="row">
				<div class="col-lg-5">
					<h3 class="text-center text-decoration-underline"> Logo de la société </h3>
					<img src="{{ URL::asset('uploads/'.$society->getLogo()) }}" class="img-fluid" alt="">
						<div class="row my-3 text-center">
							{{-- <a href="download/{{ $society->getLogo() }}" class="btn btn-primary">
								Telecharger le logo
							</a --}}>
						</div>
				</div>
				
				<div class="card offset-1 col-lg-6">
					<div class="row my-3">
						<div class="col-lg-4"> Nom : </div>
						<div class="col-lg-6"> {{ $society->getNom() }} </div>
					</div>
					<div class="row my-3">
						<div class="col-lg-4"> Crée le : </div>
						<div class="col-lg-6"> {{ $society->getCreation() }} </div>
					</div>

					<div class="row my-3">
						<div class="col-lg-4"> Agé de : </div>
						<div class="col-lg-6"> {{ $society->getAge() }} an(s) </div>
					</div>

					<div class="row my-3">
						<div class="col-lg-4"> Description : </div>
						<div class="col-lg-6"> {{ $society->getDescription() }} </div>
					</div>

					<div class="row my-3">
						<div class="col-lg-4"> Par : </div>
						<div class="col-lg-6"> {{ $society->getFondateur() }} </div>
					</div>
					<div class=" my-3">
						<div class="col-lg-5"> Identification Fiscale : </div>
						<div class="row card card-body">
							<div class="row">
								{{-- Image ana carte fiscale --}}
								<div class="col-lg-6">
									Numéro Fiscale : {{ $society->getNif() }}
								</div>
								<div class="col-lg-6">
									Pièce Justificative : 
									{{ $society->getFiscImage() }}
									<a href="download/{{ $society->getFiscImage() }}" class="badge bg-danger mx-2 p-2">
										Download
									</a>
								</div>
								
							</div>
						</div>
					</div>
					
					<div class="row my-3">
						<div class="col-lg-4"> Status de la  société : </div>
						<div class="col-lg-6"> {{ $society->getStatus() }} 
							<a href="download/{{ $society->getStatus() }}" class="badge bg-danger mx-2 p-2">
								Download
							</a> 
						</div>
					</div>

					<div class="row my-3">
						<div class="col-lg-4"> Numéro de Télécopie : </div>
						<div class="col-lg-6"> {{ $society->getTelecopie() }} </div>
					</div>
					<div class="row my-3">
						<div class="col-lg-4"> Numéro de Téléphone : </div>
						<div class="col-lg-6"> {{ $society->getTelephonie() }} </div>
					</div>
					
				</div>
				
			</div>
		</div>
	</div>
@endsection