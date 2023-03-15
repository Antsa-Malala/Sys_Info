<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Society;
use App\Models\Location;
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
            $s = Society::orderBy('idsociety' , 'desc')->first();
            $data['title'] = 'Usine '.$data['name'];
            $data['idsociety'] = $s->idsociety;
            $location = new Location($s->idsociety , $data['localisation'] , true); 
            $location2 = new Location($idsociety = $s->idsociety , $localisation = $data['siege'] );

            if( $location->save() && $location2->save() ){
                return redirect('/')->with($data);
            }
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

    public function seeProfile(){
        $id = 1;
        $society = Society::find($id);
        // Azoko ilay société
        $locations = Location::where('idsociety' , $id); 
    }
}
