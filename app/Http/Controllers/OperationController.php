<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ecriture;
use App\Models\Operation;
use App\Models\Journaux;
use App\Models\Plan;
use App\Models\Tiers;
use App\Exceptions\InvalidNumberException;
use App\Exceptions\PlanException;
use App\Exceptions\InvalidDataException;
use App\Exceptions\InvalidEcritureException;
use Illuminate\Support\Facades\DB;

class OperationController extends Controller{
    
    public function create(){
        if( !session()->has('ecriture') ){
            return redirect('/testE');
        }
        $ecriture = session()->get('ecriture'); // get The ecriture of just insered
        $data['title'] = 'Live formulary'; // give a title for the page
        $data['ecriture'] = $ecriture; // give the ecriture to the array of data
        $prefix = Journaux::getAll();
        $data['journaux'] = $prefix;
        $data['comptes'] = Plan::getAll();
        // Alaina daholo ny compte Tiers rehetra
        $data['tiers'] = Tiers::getAll();

        return view('pages.operations.addoperation')->with($data);
    }

    public function store(Request $request){
        $references = $request->input('ref');
        $currentEcriture = session()->get('ecriture');
        $date = $request->input('dates');
        $comptes = $request->input('compte');
        $tiers = $request->input('fo-c');
        $libelle = $request->input('libelle');
        $debits = $request->input('debit');
        $credits = $request->input('credit');
        $lib = $currentEcriture->libelle;
        $ref = $currentEcriture->createReference();
        $operations = array();
        for( $i = 0 ; $i < count($references) ; $i++ ){
            try{
                $operation = new Operation( $currentEcriture->idecriture , 
                                            $references[$i] , 
                                            $comptes[$i] ,$tiers[$i], $libelle[$i],
                                            $debits[$i] , $credits[$i]);
                $operation->validate( trim($ref) , trim($lib) );
                $operation->isValidDate($date[$i] , $currentEcriture->dateecriture);
                $operations[] = $operation; 
            }catch( InvalidDataException $data ){
                return response()->json( array('error'=>$data->getMessage()) , 500 );
            }catch( PlanException $plan ){
                return response()->json( array('error'=>$plan->getMessage()) , 500 );
            }
        }
        try{
            $isEquilibre = $currentEcriture->isValidEcriture($operations);
            DB::beginTransaction();
            try{
                for ($i = 0 ; $i < count($operations) ; $i++ ) {
                    $operations[$i]->save();
                }
                DB::commit();
            }catch(\Exception $e){
                DB::rollback();
                return response()->json( array('error'=>$e->getMessage()) , 500 );
                // return back()->withErrors($e->getMessage());
            }
        }catch( InvalidEcritureException $e ){
            // return back()->withErrors($e->getMessage())->withInput();
            return response()->json( array('error'=>$e->getMessage()) , 500 );
            // throw $e;
        }
        return response()->json(array('link'=>route('plans')) , 200);
    }



    // Import a csv file
    public function importCSV(Request $request){
        $csv = $request->file('csv');
        $extension = $csv->extension();
        if( strcmp($extension , "csv") != 0 && strcmp($extension, "xls") !=0 ){
            return back()->withErrors("Veuillez importer un fichier csv");
        }
        $file = fopen($csv->getPathName() , 'r');
        fgetcsv($file);
        $ecriture = session()->get("ecriture");
        // Azo ny ecriture
        // Inona no ilain'ny operation iray
        // DB::beginTransaction();
        try{
            while( $line = fgetcsv($file) ){
                $compte=trim($line[2]);
                $tiers=trim($line[3]);
                $debit=trim($line[6]);
                $credit=trim($line[7]);
                //max id exercice
                // $idexercice=Exercice::maxid();
                //insertion ecriture
                // Ecriture::insert($date,$idexercice);
                //id du dernier ecriture 
                // $idmaxecriture=Ecriture::maxid($date);

                // if(is_numeric($debit)&&is_numeric($credit)&&floatval($debit)>=0&&floatval($credit)>=0&&is_numeric($compte)&&intval($credit)>0)
                // {
                //     //insertion operation
                //     Operation::insert($idmaxecriture,trim($line[1]),$compte,trim($line[3]),trim($line[4]),floatval($debit),floatval($credit));
                // }
                // else{
                //     return back()->withErrors("Valeur invalide dans votre fichier csv");
                // }
            }
            // DB::commit();
        }catch(Exception $e){
            // DB::rollback();
        }
        fclose($file);
        return redirect('operation-list');
        // var_dump($csv);
    }

}
