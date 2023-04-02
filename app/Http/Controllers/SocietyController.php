<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Society;
use App\Models\Location;
class SocietyController extends Controller
{
    public function create(){
        $data['title'] = 'create Society';
        return view('pages.index' , $data);
    }
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
        $d = 'uploads';
        // Inserena ny exercice amin'izao
        // Izany no atao ato

        // $exerice = new Exercice();
        try{
            if( $society->save() ){
                // ENREGISTRER ANATY BASE ILAY IZY
                // SAUVENA AMIN'IZAY ILAY SARY Request::hasSessionStore()
                $s = Society::orderBy('idsociety' , 'desc')->first();
                $request->file('fisc-image')->move( $d , $s->getFiscImage() );
                $request->file('logo')->move( $d , $s->getLogo() );
                $request->file('status')->move( $d , $s->getStatus() );
                $data['title'] = 'Usine '.$data['name'];
                $data['idsociety'] = $s->idsociety;
                $location = Location::insert($s->idsociety , $data['localisation'] , true); 
                $location2 = Location::insert($idsociety = $s->idsociety , $localisation = $data['siege'] , false);
                // if( $location->save() && $location2->save() ){
                return redirect('/')->with($data);
                // }
            }
        }catch(Exception $e){
            DB::rollback();
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

    public function show(){
        $id = 2;
        $data['society'] = Society::find($id);
        $data['title'] = " Society :  " . $data['society']->getNom(); 
        $data['locations'] = Location::where('idsociety' , $id);
        return view('pages.society.profile')->with($data); 
    }
    public function home() {
        $data['title'] = 'Home Page';
        return view('pages.home')->with($data);
    }
}
