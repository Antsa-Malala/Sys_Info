<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
class ProduitController extends Controller
{
    public function insert_form()
    {
        $data['title'] = 'Ajouter un produit';
        return view('pages.produit.insert')->with($data);
    }
    public function insert(Request $request)
    {

        $nom = trim($request->input('nom_produit'));
        $volume = $request->input('volume');
        $prix = $request->input('prix');
        Produit::insert($nom,$volume,$prix);
        $data['title'] = 'Ajouter un produit';
        return view('pages.produit.insert')->with($data);
    }
}
