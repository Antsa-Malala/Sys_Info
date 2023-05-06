<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $data['title'] = 'Ajouter Pourcentage';
        return View( 'pages.produit.ajout_pourcentage' )->with($data);
    }

    public function ajout() {
        $data['title'] = 'Ajouter Produit';
        return View( 'pages.produit.ajout_produit' )->with($data);
    }
}
