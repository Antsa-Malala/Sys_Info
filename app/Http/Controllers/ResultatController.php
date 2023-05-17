<?php

namespace App\Http\Controllers;
use App\Models\Cout;

class ResultatController extends Controller {

    public function index() {
        $data['title'] = 'Resultat';
        // Okey ato no angalana ny data rehetra apoitra aloha
        $produits = Cout::coutbyproduit();
        $centre = Cout::coutbycentre();
        // $pc = Cout::coutbycentrebyproduit();
        $data['produits'] = $produits;
        $data['centres'] = $centre;
        // $data['produits_centres'] = $pc;
        return view('pages.resultat.resultat')->with($data);
    }

}