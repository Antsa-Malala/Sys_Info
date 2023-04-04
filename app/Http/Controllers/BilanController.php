<?php

namespace App\Http\Controllers;
use App\Models\Bilan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BilanController extends Controller
{
    public function getBilan()
    {
        $capitaux_propres = Bilan::getCP();
        $sum_capitaux_propres=Bilan::getSumCP();
        $passifs_courants=Bilan::getPC();
        $sum_passifs_courants=Bilan::getSumPC();
        $passifs_non_courants=Bilan::getPNC();
        $sum_passifs_non_courants=Bilan::getSumPNC();
        $actifs_courants=Bilan::getAC();
        $sum_actifs_courants=Bilan::getSumAC();
        $actifs_non_courants=Bilan::getANC();
        $sum_actifs_non_courants=Bilan::getSumANC();
        $solde_actifs=Bilan::getSoldeActifs();
        $solde_passifs=Bilan::getSoldePassifs();


        return view('pages.bilan.bilan-list', [
            'cps' => $capitaux_propres,
            'sum_cps' => $sum_capitaux_propres,
            'pcs' => $passifs_courants,
            'sum_pcs' => $sum_passifs_courants,
            'pncs' => $passifs_non_courants,
            'sum_pncs' => $sum_passifs_non_courants,
            'acs' => $actifs_courants,
            'sum_acs' => $sum_actifs_courants,
            'ancs' => $actifs_non_courants,
            'sum_ancs' => $sum_actifs_non_courants,
            'solde_actifs'=>$solde_actifs,
            'solde_passifs'=>$solde_passifs,
            'title'=>"Bilan"
        ]);
    }
}
