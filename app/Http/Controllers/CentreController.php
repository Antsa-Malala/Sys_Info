<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Centre;
use App\Models\Charge;
class CentreController extends Controller
{
    public function __construct(){
        $this->limit = 7;    
    }
    public function insert_form()
    {
        $data['title'] = 'Ajouter un centre';
        return view('pages.centre.insert')->with($data);
    }
    public function insert(Request $request)
    {

        $nom = trim($request->input('nom_centre'));
        $idtype=$request->input('type_centre');
        Centre::insert($nom,$idtype);
        return redirect('centre-list');
    }
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
                Centre::insert( trim($line[0]) ,1);
            }
            DB::commit();
        }catch(Exception $e){
            DB::rollback();
        }
        fclose($file);
        return redirect('centre-list');
    }
    public function index( $page = 1 ){
        $data['title'] = 'Centre';
        $a = $page;
        $page = $this->limit * ($page - 1);
        $data['centre1'] = Centre::getAll();
        $data['centres'] = Centre::getAllLimited( $this->limit, $page  );
        $pages = ceil( count($data['centre1']) /  $this->limit );
        $data['current'] = $a;
        $data['pages'] = $pages;
        return view('pages.centre.index')->with($data); 
    }
    public function remove(string $idcentre){

        try{
            Centre::remove($idcentre);
            return redirect('centre-list');
        }catch(\Exception $e){
            return back()->withErrors($e->getMessage());
        }
    }
    public function modifier(string $id){
        $centre = Centre::getById($id);
        $data['centre'] = $centre;
        $data['title'] = "Modifier ".$centre->nomcentre;
        return view('pages.centre.update')->with($data);
    }
    public function update(Request $request){
        $a= trim($request->input('idcentre'));
        $b = trim($request->input('nomcentre'));
        try{
            Centre::modifier($a,$b);
            return redirect('centre-list');
        }catch(\Exception $e){
            return back()->withErrors($e->getMessage());
        }
    }

    public function modifier_pourcentage( $idProduit ) {
        if( !session()->has('charge') ){
            return redirect('home');
        }
        $data['title'] = 'Modifier le pourcentage';
        $data['centres'] = Centre::getAll();
        $charge = session('charge');
        // Alaina ilay efa ananan'ilay centre 
        $centers = Charge::getcentrebyproduit( $charge->compte , $idProduit );
        session([ "centers" => $centers , "produit" => $idProduit ]);
        return view('pages.centre.pourcentage_centre')->with($data);
    }


    public function insertAndUpdate( Request $request ){
        $products = $request->input('center');
        $pourcentages = $request->input('pourcentage');
        $prod = session('produit');
        $charge = session('charge')->compte;
        $produits = session()->get('Products');
        $len1 = count($products);
        $len2 = count($produits);

        session( [ 'ps' => $products , 'prs' => $pourcentages ] );
        DB::beginTransaction(); 
        try{
            $equilibred = Charge::isBalanced( $pourcentages );
            for( $i = 0 ; $i < $len1 ; $i++ ){
                // Bouclena daholo fotsiny ilay izy
                if( $i >= $len2 ){
                    Centre::InsertPourcentage( $charge , $products[$i] , $pourcentages[$i] , $prod );
                }else{
                    Centre::updatePourcentage( $charge , $products[$i] , $pourcentages[$i] , $prod );
                }
            }
            DB::commit();
            session()->forget('ps');
            session()->forget('prs');
            return redirect("percentage");
        }catch(DatabaseException $e){
            DB::rollback();
            return back()->withErrors($e->getMessage())->withInput();
        }catch(BalanceException $e){
            DB::rollback();
            // throw $e;
            return back()->withErrors($e->getMessage())->withInput();
        }catch(\Exception $e){
            DB::rollback();
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

}
