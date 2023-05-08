<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produit;
use App\Exceptions\DatabaseException;
// use App\Exceptions\DatabaseException;
class ProductController extends Controller
{
    public function index(){
        $data['title'] = 'Ajouter Pourcentage';
        $data['produits'] = Produit::getAll();
        return View( 'pages.produit.ajout_pourcentage' )->with($data);
    }



    public function ajout() {
        $data['title'] = 'Ajouter Produit';
        return View( 'pages.produit.ajout_produit' )->with($data);
    }

    public function Store(Request $request){
        $name = trim($request->input('nom_produit'));
        $volume = trim($request->input('volume'));
        $prix = trim($request->input('prix'));
        try{
            Produit::insert($name , $volume , $prix);
            redirect('produit-list');
        }catch( DatabaseException $database ){
            throw $database;
        }catch( \Exception $e ){
            throw $e;
        }
    }
}
