<?php

namespace App\Http\Controllers;

use App\Models\Charge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Produit;
use App\Models\Plan;
use App\Exceptions\BalanceException;
use App\Exceptions\DatabaseException;

class ProduitController extends Controller
{
    public function __construct(){
        $this->limit = 7;    
    }

    public function addPercent( $idCharge = 0 ){
        try{
            $data['title'] = 'Ajouter Pourcentage';
            $data['produits'] = Produit::getAll();
            $data['charge'] = Plan::getBynumero($idCharge);
            $data['Products'] = Charge::getproduitbycharge($idCharge);  
            session( [ 'Products' => $data['Products'] , 'charge' => $data['charge'] ]  );
            // session( [  ] );
            return View( 'pages.produit.ajout_pourcentage' )->with($data);
        }catch( \Exception $e ){
            throw $e;
        }
    }


    public function ajout() {
        $data['title'] = 'Ajouter Produit';
        return View( 'pages.produit.ajout_produit' )->with($data);
    }


    public function insert_form()
    {
        $data['title'] = 'Ajouter un produit';
        return view('pages.produit.insert')->with($data);
    }
    public function Store(Request $request)
    {
        $name = trim($request->input('nom_produit'));
        $volume = trim($request->input('volume'));
        $prix = trim($request->input('prix'));
        try{
            Produit::insert($name , $volume , $prix);
            return redirect('produit-list');
        }catch( DatabaseException $database ){
            throw $database;
        }catch( \Exception $e ){
            throw $e;
        }
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
                Produit::insert( trim($line[0]) , trim($line[1]), trim($line[2]) );
            }
            DB::commit();
        }catch(Exception $e){
            DB::rollback();
        }
        fclose($file);
        return redirect('produit-list');
    }
    public function index( $page = 1 ){
        $data['title'] = 'Produit';
        $a = $page;
        $page = $this->limit * ($page - 1);
        $data['produit1'] = Produit::getAll();
        $data['produits'] = Produit::getAllLimited( $this->limit, $page  );
        $pages = ceil( count($data['produit1']) /  $this->limit );
        $data['current'] = $a;
        $data['pages'] = $pages;
        return view('pages.produit.index')->with($data); 
    }
    public function remove(string $idproduit){
        try{
            Produit::remove($idproduit);
            return redirect('produit-list');
        }catch(\Exception $e){
            return back()->withErrors($e->getMessage());
        }
    }

    public function modifier(string $id){
        $produit = Produit::getById($id);
        $data['produit'] = $produit;
        $data['title'] = "Modifier ".$produit->nomproduit;
        return view('pages.produit.update')->with($data);
    }
    public function update(Request $request){
        $a= trim($request->input('idproduit'));
        $b = trim($request->input('nomproduit'));
        $c = trim($request->input('volume'));
        $d = trim($request->input('prix'));
        try{
            Produit::modifier($a,$b,$c,$d);
            return redirect('produit-list');
        }catch(\Exception $e){
            return back()->withErrors($e->getMessage());
        }
    }
    public function getproduitbycharge( ){
        $charge = session('charge');
        $result=Charge::getproduitbycharge($charge->compte);
        $data['charges'] = $result;
        // Azoko ny charge
        // Azoko ny produit par charge
        // De alaiko amin'izay ny centre par produit par charge
        return view('pages.charge.produit')->with($data);
    }

    public function liste_pourcentage_produit(){
        $data['title'] = 'Pourcentage';
        if( !session()->has('charge') ){
            redirect('home');
        }
        $charge = session('charge');
        $data['produits'] = Produit::getproduitcentrebycharge( $charge->compte ); // Par centre
        return view('pages.produit.liste_pourcentage')->with($data);
    }

    public function insertAndUpdate( Request $request ){
        $products = $request->input('produit');
        $pourcentages = $request->input('pourcentage');
        $charge = $request->input('charge');
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
                    Produit::InsertPourcentage( $charge , $products[$i] , $pourcentages[$i] );
                }else{
                    Produit::updatePourcentage( $charge , $products[$i] , $pourcentages[$i] );
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

    public static function insertpourcentageproduit($idproduit,$idcharge,$pourcentage)
    {
        $idcharge=Charge::fillZero($idcharge);
        Charge::insertpourcentageproduit($idproduit,$idcharge,$pourcentage);
        return redirect('produit-by-charge/'.$idcharge);
    }
    public static function updatepourcentageproduit($idproduit,$idcharge,$pourcentage)
    {
        $idcharge=Charge::fillZero($idcharge);
        Charge::updatepourcentageproduit($idproduit,$idcharge,$pourcentage);
        return redirect('produit-by-charge/'.$idcharge);
    }
    public static function insertpourcentagecentre($idproduit,$idcharge,$idcentre,$pourcentage)
    {
        $idcharge=Charge::fillZero($idcharge);
        Charge::insertpourcentagecentre($idproduit,$idcharge,$idcentre,$pourcentage);
        return redirect('produit-by-charge/'.$idcharge);
    }
    public static function updatepourcentagecentre($idproduit,$idcharge,$idcentre,$pourcentage)
    {
        $idcharge=Charge::fillZero($idcharge);
        Charge::updatepourcentagecentre($idproduit,$idcharge,$idcentre,$pourcentage);
        return redirect('produit-by-charge/'.$idcharge);
    }
    public function getcentrebyproduit($idcharge,$idproduit)
    {
        $result=Charge::getcentrebyproduit($idcharge,$idproduit);
        $data['charges'] = $result;
        return view('pages.charge.centre')->with($data);
    }
    public function getproduitcentre($idcharge,$idproduit)
    {
        $result=Charge::getproduitcentre($idcharge,$idproduit);
        $data['charges'] = $result;
        return view('pages.charge.centreproduit')->with($data);
    }
    public function getproduitpresent($idcharge)
    {
        $idcharge=Charge::fillZero($idcharge);
        $result=Produit::getproduitpresent($idcharge);
        $data['produits'] = $result;
        return view('pages.produit.produitpresent')->with($data);
    }
    
    public function getproduitcentrebycharge($idcharge)
    {
        $pourcentage=Produit::getproduitcentrebycharge($idcharge);
        $data['pourcentage'] = $pourcentage;
        return view('pages.produit.produitcentre')->with($data);
    }
}
