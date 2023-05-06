@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="container">
			<div class="title">
            	<h2 class="text-center">
                	Liste de vos Centres
            	</h2>
        	</div>
		</div>
    <div class="mt-4">
        <a href="{{ url('centre_form') }}" class="btn btn-success me-3">Ajouter</a>
        <div class="shadow pt-4 mt-4" style="border-radius: 15px">
            <table class="table">
                <tr>
                    <th width="500" class="text-center">Nom du produit</th>
                    <th></th>
                    <th></th>
                </tr>
                @foreach ($centres as $centre)
                <tr>
                    <td class="text-center">{{ $centre->nomcentre}}</td>
                    <td><a href="{{ url('/centre-delete/'.$centre->idcentre) }}   "><img style="width: 25px;" src="{{ URL::asset('assets/img/delete.svg') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"></a></td>
                    <td><a href="{{ url('/centre-modifier/'.$centre->idcentre) }}" btn><img style="width: 25px;" src="{{ URL::asset('assets/img/update.svg') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Update"></a></td>
                </tr>
                @endforeach
            </table>
        </div>
        <nav class="d-flex justify-content-center mt-4">
            <ul class="pagination pagination-lg" id="pagination">
            </ul>
        </nav>
    </div>
    
    
	</div>	
    <script>
        makePagination( {{ $current }} , {{ $pages }} , 5 , "{{ url("centre-list") }}" , "#pagination");
    </script>
@endsection