<?php

namespace App\Http\Controllers;

use App\Models\Tiers;
use Illuminate\Http\Request;

class TiersController extends Controller
{
    public function getAll()
    {
        $tiers = Tiers::getAll();

        return view('tiers-list', [
            'tiers' => $tiers
        ]);
    }
    public function getById($id)
    {
        $tiers = Tiers::getById($id);

        return view('tiers-By-Id', [
            'tiers' => $tiers
        ]);
    }
    
    public function insert($idCompte, $numero, $libelle)
    {
        Tiers::insert($idCompte, $numero, $libelle);
        $tiers = Tiers::getAll();

        return view('tiers-list', [
            'tiers' => $tiers
        ]);
    }

    public function delete($id)
    {
        Tiers::remove($id);
        $tiers = Tiers::getAll();

        return view('tiers-list', [
            'tiers' => $tiers
        ]);
    }
    public function update($id,$idCompte, $numero, $libelle)
    {
        Tiers::modif($id,$idCompte, $numero, $libelle);
        $tiers = Tiers::getAll();

        return view('tiers-list', [
            'tiers' => $tiers
        ]);
    }


}
