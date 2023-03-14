<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TiersController extends Controller
{
    // Inona no atao ato
    // Mila manao crud ato
    public function index(){
        return 1;
    }

    public function delete(string $id){
        return 2;
    }

    public function update( string $id , Request $request ){
        return 3;
    }

    public function create( Request $request ){
        return 4;
    }

    public function get(string $id){
        return 5;
    }
}
