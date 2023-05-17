<?php

namespace App\Http\Controllers;
use App\Models\Cout;

class ResultatController extends Controller {

    public function index() {
        $data['title'] = 'Resultat';
        // Okey ato no angalana ny data rehetra apoitra aloha
        $produits = Cout::coutbyproduit();
        $centre = Cout::coutbycentre();
        $natures = Cout::coutbynature();
        $produitscentre=Cout::getproduitcentre();
        // $pc = Cout::coutbycentrebyproduit();
        $data['produits'] = $produits;
        $data['centres'] = $centre;
        $data['natures'] = $natures;
        $data['produits_centres'] = $produitscentre;
        // $data['produits_centres'] = $pc;
        return view('pages.resultat.resultat')->with($data);
    }

}