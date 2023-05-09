
@foreach ($produits as $produit)
{{ $produit->idproduit}}
{{ $produit->nomproduit}}
{{ $produit->prix}}
{{ $produit->volume}}
{{ $produit->idcharge}}
<p>-------------------------------------</p>
@endforeach