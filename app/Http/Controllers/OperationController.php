<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ecriture;
use App\Models\Operation;
use App\Models\Journaux;
use App\Exceptions\InvalidNumberException;

class OperationController extends Controller{
    
    public function create(){
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

}
