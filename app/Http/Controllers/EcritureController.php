<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exercice;
use App\Models\Ecriture;
use App\Models\Journaux;
use App\Exceptions\OutRangeEcriture;

class EcritureController extends Controller{

    public function create(){
        $data['title'] = "Entrer des ecritures";
        $data['journaux'] = Journaux::getAll();
        return view('pages.addEcriture')->with($data);
    }

    public function index(){
        $data['title'] = 'Afficher le jornal';
        // $data['month'] = Ecriture::getMonth();
        $allCode = Journaux::getAll();
        $data['journaux'] = $allCode;

        return view('pages.journal.index')->with($data);
    }

    public function show($code){
        $data['title'] = ' Journal du code '.$code;
        $data['code'] = $code;

        // return  
        // Alaina daholo ny code Journaux rehetra
    }
    
    public function store(Request $request){

        // Get libelle
        $libelle = $request->input('libelle');
        // Get date
        $date = $request->input('date');
        $code = $request->input('code');
        // Get Current Exercice
        $currentExercice = Exercice::getCurrentExercice();

        try{
            // var_dump($date);
            $ecriture = new Ecriture( $date , $libelle , $currentExercice , $code );
            if( $ecriture->save() ){
                $inserted = Ecriture::getLast();
                try{
                    // var_dump($inserted);
                    session()->put('ecriture' , $inserted);
                    return redirect()->route('operation');
                }catch(\Exception $e){
                    $ecriture->delete();
                }
            }
        }catch(OutRangeEcriture  $e){
            // report($e);
            return back()->withErrors($e->getMessage())->withInput();
        }catch(\Exception $e){
            return back()->withErrors($e->getMessage())->withInput();
        }
    }
}
