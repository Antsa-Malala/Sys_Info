<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function getAll()
    {
        $plans = Plan::getAll();

        return view('plan-list', [
            'plans' => $plans
        ]);
    }
    public function getBynumero($numero)
    {
        $plan = Plan::getBynumero($numero);

        return view('plan-specific', [
            'plan' => $plan
        ]);
    }
    public function getBylibelle($libelle)
    {
        $plan = Plan::getBylibelle($libelle);

        return view('plan-specific', [
            'plan' => $plan
        ]);
    }
    
    public function insert($numeroCompte,$libelle)
    {
        Plan::insert($numeroCompte,$libelle);
        $plans = Plan::getAll();

        return view('plan-list', [
            'plans' => $plans
        ]);
    }

    public function deletenumero($numero)
    {
        Plan::removenumero($numero);
        $plans = Plan::getAll();

        return view('plan-list', [
            'plans' => $plans
        ]);
    }
    public function deletelibelle($libelle)
    {
        Plan::removelibelle($libelle);
        $plans = Plan::getAll();

        return view('plan-list', [
            'plans' => $plans
        ]);
    }
    public function updatenumero($numeroCompte,$libelle)
    {
        Plan::modifnumero($numeroCompte,$libelle);
        $plans = Plan::getAll();

        return view('plan-list', [
            'plans' => $plans
        ]);
    }
    public function updatelibelle($numeroCompte,$libelle)
    {
        Plan::modiflibelle($numeroCompte,$libelle);
        $plans = Plan::getAll();

        return view('plan-list', [
            'plans' => $plans
        ]);
    }


}
