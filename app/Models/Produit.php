<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\DatabaseException;
class Produit extends Model{
    protected $table = 'produit';

    //insertion produit
    public static function insert($nom,$volume,$prix) {
        if( empty($nom) ) throw new \Exception("Le nom du produit ne peut etre vide");
        if( empty($volume) ) throw new \Exception("Le volume ne peut etre vide");
        if( empty($prix) ) throw new \Exception("Le prix ne peut etre vide");
        try{
            $result = DB::insert("INSERT INTO produit(nomProduit,volume,prix) VALUES(?,?,?)", [$nom,$volume,$prix]);
        }catch(\Illuminate\Database\QueryException $e){
            throw new DatabaseException("Insertion produit echouee",$e);
        }
    }
    //delete produit
    public static function remove($id){
        $result = DB::delete("DELETE FROM produit WHERE idproduit = ?", [$id]);
    }
    //update produit
    public static function modifier($idproduit,$nom,$volume,$prix)
    {
        if( empty($idproduit) ) throw new \Exception("L'id du produit est indefini'");
        if( empty($nom) ) throw new \Exception("Le nom du produit ne peut etre vide");
        if( empty($volume) ) throw new \Exception("Le volume ne peut etre vide");
        if( empty($prix) ) throw new \Exception("Le prix ne peut etre vide");
        try{
            $result = DB::update("UPDATE produit SET nomproduit = ?,volume= ?, prix = ? WHERE idproduit = ?", [$nom,$volume,$prix, $idproduit]);
        }catch(\Illuminate\Database\QueryException $e){
            throw new DatabaseException("Modification produit echouee",$e);
        }
    }

    //liste de tous les produits
    public static function getAll(){
        $journaux = DB::select('SELECT * FROM produit');
        return $journaux;
    }
    //prendre produit par id 
    public static function getById($id) {
        $result = DB::select("SELECT * FROM produit WHERE idproduit = ?", [$id]);
        if (!empty($result)) {
            return $result[0];
        } else {
            return null;
        }
    }
    //liste produits avec limit pagination 
    public static function getAllLimited( $limit , $begin ){
        $produit = DB::select('SELECT * FROM produit LIMIT ? OFFSET ?' , [$limit , $begin]);
        return $produit;
    }

    public static function getProduitWithPourcentageCentre() {
        $produit = array();
        $results = Produit::getAll();
        for ($i = 0; $i < count($results); $i++) {
            $centres = Centre::getAll();
            for ($j = 0; $j < count($centres); $j++) {
                $centres[$i]->pourcentage = 100;
            }
            $results[$i]->centres = $centres;
        }
        return $results;
    }

    public static function getproduitcentrebycharge($idcharge)
    {
        $pourcentageproduit=array();
        $produitbycharge=Charge::getproduitbycharge($idcharge);
        for ($i = 0; $i < count($produitbycharge); $i++) {
            $product=$produitbycharge[$i];
            $centre=Charge::getcentrebyproduit($idcharge,$produitbycharge[$i]->idproduit);
            $product->centre=$centre;
            array_push($pourcentageproduit,$product);
        }
        return $pourcentageproduit;
    }
    
    public static function getproduitpresent($idcharge)
    {
        $produit = DB::select('SELECT * FROM produit_present where idcharge =  ?' , [$idcharge]);
        return $produit;
    }
}