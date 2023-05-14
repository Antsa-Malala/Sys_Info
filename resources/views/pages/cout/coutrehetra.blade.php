
@foreach ($cout as $ct)
{{ $ct->id}}
{{ $ct->fixe}}
{{ $ct->variable}}
{{ $ct->idproduit}}
{{ $ct->idcentre}}
{{ $ct->date_operation}}
{{ $ct->idcharge}}
{{ $ct->montant}}

<p>-----------------------------------------</p>
@endforeach
{{$somme}}