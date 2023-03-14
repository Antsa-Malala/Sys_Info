<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddController extends Controller{

    public function show(Request $request){
        $request->validate([
            'name' => ['required' , 'max:250'],
            'localisation' => ['required'],
            'siege' => 'required',
            'quoi' => 'required',
            'creation' => ['required' , 'date'],
            'exo' => ['required' , 'date'],
            'numero' => 'required'
        ]);
        $data = array();
        $data = $this->getRequired($request , $data);
        $data = $this->getAdditional($request , $data);
        $data['title'] = 'Usine '.$data['name'];
        return view('pages.affiche')->with($data);
    }

    private function getAdditional( $request , $data ){
        $data['status'] = trim($request->file('status'));
        $data['fisc'] = trim($request->file('fisc'));
        $data['pdg'] = trim($request->input('pdg'));
        $data['logo'] = trim($request->file('logo'));
        return $data;
    }

    private function getRequired( $request , $data ){
        $data['name'] = trim($request->input('name'));
        $data['localisation'] = trim($request->input('localisation'));
        $data['siege'] = trim($request->input('siege'));
        $data['quoi'] = trim($request->input('quoi'));
        $data['creation'] = trim($request->input('creation'));
        $data['exo'] = trim($request->input('exo'));
        $data['numero'] = trim($request->input('numero'));
        return $data;
    }

}
