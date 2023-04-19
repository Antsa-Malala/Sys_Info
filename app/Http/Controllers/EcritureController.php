<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exercice;
use App\Models\Ecriture;
use App\Models\Journaux;
use App\Exceptions\OutRangeEcriture;

class EcritureController extends Controller{

    public function __construct(){
        $this->limit = 7;
    }
    public function create(){
        $data['title'] = "Entrer des ecritures";
        $data['journaux'] = Journaux::getAll();
        return view('pages.ecriture.addEcriture')->with($data);
    }

    public function index( $index = 1 ){
        $data['title'] = 'Afficher le journal';
        // $data['month'] = Ecriture::getMonth();
        $a = $index;
        $allCode = Journaux::getAll();
        $index = $this->limit * ($index - 1);
        $limited = Journaux::getAllLimited( $this->limit , $index );
        $pages = ceil( count($allCode) / $this->limit );
        $data['journaux'] = $limited;
        $data['current'] = $a;
        $data['pages'] = $pages;
        return view('pages.journal.index')->with($data);
    }

    public function show($code){
        $data['title'] = ' Journal du code '.$code;
        // Alaina daholo ny code Journaux rehetra  $data['code'] = $code;
        try{
            $journaux = Journaux::getByCode($code);
            // var_dump($journaux);
        }catch(\Exception $e){
            throw $e;
        }
        // return  
    }
    
    public function store(Request $request){

        // Get libelle
        $libelle = $request->input('libelle');
        // Get date
        $date = $request->input('date');
        $code = $request->input('code');
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
