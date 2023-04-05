@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="container">
			<div class="title">
            	<h2 class="text-center">
                	Liste de vos Codes journaux
            	</h2>
        	</div>
		</div>
    <div class="mt-4">
        <a href="{{ url('journaux-insertion') }}" class="btn btn-success me-3">Ajouter</a>
        <div class="shadow pt-4 mt-4" style="border-radius: 15px">
            <table class="table">
                <tr>
                    <th width="500" class="text-center">Numero de compte</th>
                    <th>Libelle</th>
                    <th></th>
                    <th></th>
                </tr>
                @foreach ($codes as $plan)
                <tr>
                    <td class="text-center">{{ $plan->code}}</td>
                    <td>{{ $plan->libelle}}</td>
                    <td><a href="{{ url('/journaux-delete/'.$plan->idcode) }}   "><img style="width: 25px;" src="{{ URL::asset('assets/img/delete.svg') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"></a></td>
                    <td><a href="{{ url('/journaux-update_journaux/'.$plan->idcode) }}" btn><img style="width: 25px;" src="{{ URL::asset('assets/img/update.svg') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Update"></a></td>
                </tr>
                @endforeach
            </table>
        </div>
        <nav class="d-flex justify-content-center mt-4">
            <ul class="pagination pagination-lg">
              <li class="page-item active" aria-current="page">
                <span class="page-link">1</span>
              </li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
            </ul>
        </nav>
    </div>
    
    
	</div>	
    <script src="{{ asset('js/search_journal.js') }}"></script>
@endsection