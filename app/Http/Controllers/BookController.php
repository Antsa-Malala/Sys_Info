<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;

class BookController extends Controller{
    public function Index(){
        $plans = Plan::getAll();
        $data['plans'] = $plans;
        $data['title'] = "Consulter le Grand Livre";
        // Inona ny manaraka
        // Azo ny plans de 
        return view('pages.livre.index')->with($data);
    }

    public function Show( $compte ){
        try{
            $c = Plan::getBynumero($compte);
            $operations = Plan::getAllOperations($compte);
            $data['title'] = " Grand Livre du compte ".$compte;
            $data['operations'] = $operations;
            $data['compte'] = $c;
            return view('pages.livre.show')->with($data);
        }catch(\Exception $e){
            throw $e;
        }
    }
}
