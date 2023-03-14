<?php

namespace App\Http\Controllers;

use App\Models\Journaux;
use Illuminate\Http\Request;

class JournauxController extends Controller
{
    public function getAll()
    {
        $journaux = Journaux::getAll();

        return view('journaux-list', [
            'journaux' => $journaux
        ]);
    }
    public function getBycode($code)
    {
        $journaux = Journaux::getBycode($code);

        return view('journaux-specific', [
            'journaux' => $journaux
        ]);
    }
    public function getBylibelle($libelle)
    {
        $journaux = Journaux::getBylibelle($libelle);

        return view('journaux-specific', [
            'journaux' => $journaux
        ]);
    }
    
    public function insert($code,$libelle)
    {
        Journaux::insert($code,$libelle);
        $journaux = Journaux::getAll();

        return view('journaux-list', [
            'journaux' => $journaux
        ]);
    }

    public function deletecode($code)
    {
        Journaux::removecode($code);
        $journaux = Journaux::getAll();

        return view('journaux-list', [
            'journaux' => $journaux
        ]);
    }
    public function deletelibelle($libelle)
    {
        Journaux::removelibelle($libelle);
        $journaux = Journaux::getAll();

        return view('journaux-list', [
            'journaux' => $journaux
        ]);
    }
    public function updatecode($code,$libelle)
    {
        Journaux::modifcode($code,$libelle);
        $journaux = Journaux::getAll();

        return view('journaux-list', [
            'journaux' => $journaux
        ]);
    }
    public function updatelibelle($code,$libelle)
    {
        Journaux::modiflibelle($code,$libelle);
        $journaux = Journaux::getAll();

        return view('journaux-list', [
            'journaux' => $journaux
        ]);
    }


}
