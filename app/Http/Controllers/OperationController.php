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
use App\Exceptions\BalanceException;
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
        $variables = $request->input('variable');
        $fixes = $request->input('fixe');
        $natures = $request->input('nature');
        $ref = $currentEcriture->createReference();
        $operations = array();
        
        $vfIndex = 0;
        
        try {
            for($i = 0 ; $i < count($references) ; $i++) {
                $operation = new Operation( $currentEcriture->idecriture , 
                                            $references[$i] , 
                                            $comptes[$i] ,$tiers[$i], $libelle[$i],
                                            $debits[$i] , $credits[$i]);
                // Maintenant azoko ilay variable sy fixe
                // Inona izao no ataoko
                // Je demande zany hoe charge ve sa tsia
                if( $operation->isCharge() ){
                    $operation->setVariable($variables[$vfIndex]);
                    $operation->setFixe($fixes[$vfIndex]);
                    $operation->setType($natures[$vfIndex]);
                    $vfIndex++;
                }
                $operation->isBalanced();
                $operation->validate( trim($ref) , trim($lib) );
                $operation->isValidDate($date[$i] , $currentEcriture->dateecriture);
                $operations[] = $operation; 
            }
            $isEquilibre = $currentEcriture->isValidEcriture($operations);
            DB::beginTransaction();
            for ($i = 0 ; $i < count($operations) ; $i++ ) {
                $operations[$i]->save();
            }
            DB::commit();
        } catch(\Exception $e) {
            DB::rollback();
            return response()->json( array('error'=>$e->getMessage()) , 500 );
        }
        return response()->json(array('link'=>route('plans')) , 200);
    }


    public function import(){
        $data['title'] = "Importer un fichier csv";
        return view('pages.operations.importcsv')->with($data);
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
        $ref = $ecriture->createReference();
        $lib = $ecriture->libelle;
        $id = $ecriture->idecriture;
        DB::beginTransaction();
        try{
            while( $line = fgetcsv($file) ){
                try{
                    $date = trim($line[0]);
                    $compte=trim($line[2]);
                    $tiers=trim($line[3]);
                    $debit=trim($line[6]);
                    $credit=trim($line[7]);
                    $operation = new Operation( $id , $ref , $compte, $tiers, $lib, $debit, $credit);
                    $operation->validate(trim($ref) , trim($lib));
                    $operation->isValidDate( $date , $ecriture->dateecriture );
                    $operation->save();
                }catch(InvalidDataException | PlanException $e){
                    throw $e;
                }catch(\Exception $e){
                    throw $e;
                }
            }
            DB::commit();
        }catch(InvalidDataException | PlanException $e){
            DB::rollback();
            // throw $e;
            return back()->withError($e->getMessage());
        }catch(\Exception $e){
            throw $e;
        }
        fclose($file);
        return redirect('journal');
        // var_dump($csv);
    }

}
