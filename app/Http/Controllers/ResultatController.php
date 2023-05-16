<?php

namespace App\Http\Controllers;

class ResultatController extends Controller {

    public function index() {
        $data['title'] = 'Resultat';
        return view('pages.resultat.resultat')->with($data);
    }

}