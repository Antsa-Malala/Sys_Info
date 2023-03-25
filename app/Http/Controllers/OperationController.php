<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ecriture;
use App\Models\Operation;
use App\Models\Journaux;
use App\Exceptions\InvalidNumberException;

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
        return view('pages.addoperation')->with($data);
    }

    public function store(Request $request){
        // Alaina daholo ny value rehetra
        $compte = $request->input('compte');
        $prefixs = $request->input('no');
        $pieces = $request->input('piece');
        try{
            $merges = Operation::merge($prefixs , $pieces);
            $isValid = Operation::isValid( $request->input('debit') , $request->input('credit') );
        }catch( InvalidNumberException $invalid ){
            return back()->withErrors($invalid->getMessage());
        }
        // Validation indray izao
        // Mila anontaniana hoe misy vide ve ilay nombre sa tsia
        // Raha sendra misy vide de alefa any
        // checks fotsiny izany
        // Inona no tokony anontaniako izany
        // Any anatin'ilay boucle izanny
        var_dump($isValid);
        return 0;
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
        DB::beginTransaction();
        try{
            while( $line = fgetcsv($file) ){
                $compte=trim($line[2]);
                $debit=trim($line[5]);
                $credit=trim($line[6]);
                $date=trim($line[0]);

                print_r($line.'<br>');
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
            DB::commit();
        }catch(Exception $e){
            DB::rollback();
        }
        fclose($file);
        return redirect('operation-list');
        // var_dump($csv);
    }

}
