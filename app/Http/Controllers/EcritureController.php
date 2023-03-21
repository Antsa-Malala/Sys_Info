<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exercice;
use App\Models\Ecriture;
use App\Exceptions\OutRangeEcriture;

class EcritureController extends Controller{
    
    public function store(Request $request){

        // Get libelle
        $libelle = $request->input('libelle');
        // Get date
        $date = $request->input('date');
        // Get Current Exercice
        $currentExercice = Exercice::getCurrentExercice();

        try{
            // var_dump($date);
            $ecriture = new Ecriture( $date , $libelle , $currentExercice );
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
