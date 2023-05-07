<?php

namespace App\Http\Controllers;

use App\Models\Charge;
use Illuminate\Http\Request;
use App\Models\Produit;
class ProduitController extends Controller
{
    public function __construct(){
        $this->limit = 7;    
    }
    public function insert_form()
    {
        $data['title'] = 'Ajouter un produit';
        return view('pages.produit.insert')->with($data);
    }
    public function insert(Request $request)
    {

        $nom = trim($request->input('nom_produit'));
        $volume = $request->input('volume');
        $prix = $request->input('prix');
        Produit::insert($nom,$volume,$prix);
        return redirect('produit-list');
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
    public function getproduitbycharge($idcharge)
    {
        $result=Charge::getproduitbycharge($idcharge);
        $data['charges'] = $result;
        return view('pages.charge.produit')->with($data);
    }

    public function liste_pourcentage_produit() {
        $data['title'] = 'Pourcentage';
        $data['produits'] = Produit::getProduitWithPourcentageCentre();
        return view('pages.produit.liste_pourcentage')->with($data);
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
}
