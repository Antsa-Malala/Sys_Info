@extends('layouts.app')

@section('content')
<div class="container">
    <div class="title row">
        <div class="title">
            <h2 class="text-center ">
                Liste de vos Plans Comptables
            </h2>
        </div>
    </div>
    <div class="mt-4">
        <div class="mb-4 mx-auto w-50">
            <form id="formulaire_recherche" class="form" action="{{ url('/search_compte') }}" method="GET">
                <div class="mb-3 d-flex">   
                    <input type="text" class="form-control" name="recherche" placeholder="Rechercher un compte par libelle">
                    <button type="submit" class="ms-4 btn btn-primary">Rechercher</button>
                </div>
            </form>
        </div>
        <a href="{{ url('/plan-insertion') }}" class="btn btn-success me-3">Ajouter</a>
        <a href="{{ url('/plan-insertion-csv') }}" class="btn btn-primary">Importer Un fichier CSV</a>
        <div class="shadow pt-4 mt-4" style="border-radius: 15px">
            <table class="table">
                <thead>
                    <tr>
                        <th width="300px" class="text-center">Numero de compte</th>
                        <th width="500px" class="text-center">Libelle</th>
                        <th> </th>
                        <th> </th>
                    </tr>
                    
                </thead>
                <tbody data-aos="fade">
                    @foreach ($plans as $plan)
                    <trs>
                        <td class="text-center">{{ $plan->compte}}</td>
                        <td class="text-start">{{ $plan->libelle}}</td>
                        <td><a href="{{ url('/plan-delete/'.$plan->idplan) }}"><img style="width: 25px;" src="{{ URL::asset('assets/img/delete.svg') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"></a></td>
                        <td><a href="{{ url('/plan-update_plan/'.$plan->compte) }}" btn><img style="width: 25px;" src="{{ URL::asset('assets/img/update.svg') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Update"></a></td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
        <nav class="d-flex justify-content-center mt-4">
            <ul class="pagination pagination-lg" id="pagination">
                {{-- @for( $i = 1 ; $i <= $pages ; $i++ )
                    @if( $i == $current )
                        <li class="page-item active" aria-current="page">
                    @else
                        <li class="page-item">
                    @endif
                            <a class="page-link"  href="{{ url("plan-list/".$i) }}">{{ $i }}</a>
                    </li>
                @endfor --}}

                
            </ul>
        </nav>
    </div>
    
    
</div>
<script>
    console.log( "{{ url("plan-list") }}" );
    makePagination( {{ $current }} , {{ $pages }} , 5, "{{ url("plan-list/") }}" , "ul#pagination" );
</script>
@endsection