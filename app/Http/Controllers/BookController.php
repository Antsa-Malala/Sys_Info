<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;

class BookController extends Controller{
    public function __construct(){
        $this->limit = 7;
    }
    public function Index( $page = 1 ){
        $p = $page;
        $page = $this->limit*($page-1);
        $plan = Plan::getAll();
        $pages = count($plan)/$this->limit;
        $pages = ceil($pages);
        $plans = Plan::getAllLimited($this->limit,$page);
        $data['plans'] = $plans;
        $data['title'] = "Consulter le Grand Livre";
        $data['pages'] = $pages;
        $data['current'] = $p;
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
