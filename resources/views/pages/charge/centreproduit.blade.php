
@foreach ($charges as $charge)
{{ $charge->idproduit}}
{{ $charge->nomproduit}}
{{ $charge->prix}}
{{ $charge->volume}}
{{ $charge->idcentre}}
{{ $charge->nomcentre}}
{{ $charge->idcharge}}
{{ $charge->pourcentage_produit}}
{{ $charge->pourcentage_centre}}
<p>-------------------------------------</p>
@endforeach