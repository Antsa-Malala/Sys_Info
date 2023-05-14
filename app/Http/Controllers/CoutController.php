<?php

namespace App\Http\Controllers;

use App\Models\Charge;
use App\Models\Cout;
use Illuminate\Http\Request;
use App\Models\Produit;
class CoutController extends Controller
{
    public function insertion_cout_produit($idcharge,$montant,$variable,$fixe,$date_operation)
    {
        Cout::insert_cout_produit($idcharge,$montant,$variable,$fixe,$date_operation);
        $data['cout'] = Cout::getcoutfixe($idcharge);
        $data['somme']=Cout::getsommecoutvariable($idcharge);
        return view('pages.cout.coutrehetra')->with($data);
    }
}
