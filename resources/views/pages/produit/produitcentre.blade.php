
@foreach ($pourcentage as $produit)
idproduit{{ $produit->idproduit}}
nomproduit{{ $produit->nomproduit}}
prix{{ $produit->prix}}
volume{{ $produit->volume}}
pourcentage{{ $produit->pourcentage}}
@for($i=0;$i<count($produit->centre);$i++)
    idcentre{{$produit->centre[$i]->idcentre}}
    nomcentre{{$produit->centre[$i]->nomcentre}}
    pourcentage_centre{{$produit->centre[$i]->pourcentage}}
@endfor
<p>-------------------------------------</p>
@endforeach