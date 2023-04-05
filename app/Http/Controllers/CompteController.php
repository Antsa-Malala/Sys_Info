<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

use App\Models\Compte;
use App\Models\Plan;
use App\Exceptions\DatabaseException;

class CompteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $limit;

    public function __construct(){
        $this->limit = 10;
    }

    public function index(){
        // return view an'ilay affichage compte tiers
        // Asaina ny view an'ilay izy
        $data['plans'] = Plan::getAll();
        $pagination = ceil(count($data['plans'])/$this->limit);
        // Azo ilay pagination
        $data['title'] = "Liste des Plans Comptables";
        $data['pages'] = $pagination;
        return view('pages.plan.plan')->with($data); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        // return a view for the form creation
        $data['title'] = 'Create an account';
        return view('pages.plan.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // $compte = new Compte(  , trim($request->input('libelle')) );
        $numero = trim($request->input('compte'));
        $libelle = trim($request->input('libelle'));
        try{
            Plan::insert( $numero , $libelle );
            return redirect('plan-list');
        }catch(DatabaseException $e){
            return back()->withErrors($e->getMessage())->withInput();
        }catch(Exception $e){
            return back()->withErrors("Veuillez Verifier les données que vous avez entrés");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        //
        $compte = Compte::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Antsoina ato ilay modele
        $compte = Plan::getBynumero($id);
        $data['compte'] = $compte;
        $data['title'] = "Modifier le compte numéro ".$compte->compte;
        return view('pages.plan.update_plan')->with($data);
        // Azoko ny $compte de alefa any
        // var_dump($compte);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request){
        //
        $id = trim($request->input('idplan'));
        $compte = trim($request->input('compte'));
        $libelle = trim($request->input('libelle'));

        // $row = Plan::getById($id); // azo ny row
        try{
            Plan::updates( $compte , $libelle , $id);
            $data['title'] = "Liste Plan Comptables";
            return redirect('plan-list');
        }catch( DatabaseException $e ){
            return back()->withErrors($e->getMessage())->withInput();
        }catch(Exception $e){
            return back()->withErrors('Veuillez verifier les données que vous avez entrées ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id){
        //

        $row = Plan::find($id);
        if( $row->delete() ){
            return redirect('plan-list');
        }
    }

    public function import(){
       $data['title'] = "Importer un fichier csv"; 
       return view('pages.plan.import')->with($data);
    }

    // Import a csv file
    public function importCSV(Request $request){
        $csv = $request->file('csv');
        $extension = $csv->extension();
        if( strcmp($extension , "csv") != 0 && strcmp($extension, "xls") !=0 ){
            // throw new \Exception("Veuillez importer un fichier csv");
            return back()->withErrors("Veuillez importer un fichier csv");
        }
        // echo $csv->getPathName();
        $file = fopen($csv->getPathName() , 'r');
        fgetcsv($file);
        DB::beginTransaction();
        try{
            while( $line = fgetcsv($file) ){
                //var_dump($line);
                Plan::insert( trim($line[0]) , trim($line[1]) );
            }
            DB::commit();
        }catch(Exception $e){
            DB::rollback();
        }
        fclose($file);
        return redirect('plan-list');
        // var_dump($csv);
    }
    
    public function search(Request $request)
    {
        $recherche = $request->input('recherche');
        $recherche = strtoupper($recherche);

        $plan = Plan::where('compte', 'LIKE', "%$recherche%")
        ->orWhere('libelle', 'LIKE', "%$recherche%")
        ->get();
        return response()->json($plan);
    }

    public function recherche()
    {
        return view('pages.plan.recherche');
    }
}
