<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Society;
class SocietyController extends Controller
{
    public function store(Request $request){
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
        $society = new Society($data);

        if( $society->save() ){
            $s = $society::latest()->first();
            $data['title'] = 'Usine '.$data['name'];
            $data['idsociety'] = $s->id;
            var_dump($data);
            // return redirect('/');
        }
    }

    private function getAdditional( $request , $data ){
        $data['status'] = $request->file('status')->getClientOriginalName();
        $data['nif'] = trim($request->input('fisc'));
        $data['nif-image'] = $request->file('fisc-image')->getClientOriginalName();
        $data['fondateur'] = trim($request->input('pdg'));
        $data['logo'] = $request->file('logo')->getClientOriginalName();
        $data['telecopie'] = trim($request->input('telecopie'));
        return $data;
    }

    private function getRequired( $request , $data ){
        $data['name'] = trim($request->input('name'));
        $data['localisation'] = trim($request->input('localisation'));
        $data['siege'] = trim($request->input('siege'));
        $data['description'] = trim($request->input('quoi'));
        $data['creation'] = trim($request->input('creation'));
        $data['date_exercice'] = trim($request->input('exo'));
        $data['telephone'] = trim($request->input('numero'));
        return $data;
    }
}
