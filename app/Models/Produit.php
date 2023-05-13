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

        if( empty($volume) || $volume < 0 || !is_numeric( $volume ) ) {
            throw new \Exception("Le volume doit etre un Nombre valide : ".$volume);
        }
        if( empty($prix)  || $prix < 0 || !is_numeric($prix) ) {
            throw new \Exception("Le prix ne peut etre vide : ".!isValidNumber($prix) );
        }
        try{

            $result = DB::insert("INSERT INTO produit( nomProduit , volume , prix ) VALUES( ? , ? , ? )", [$nom,$volume,$prix]);
        
        }catch(\Illuminate\Database\QueryException $e){
            throw new DatabaseException("Insertion produit echouee " , $e);
        }
    }
    //delete produit
    public static function remove($id){
        // if( empty($id) ){
        //     throw new InvalidDataException( "" );
        // }
        try{
            $result = DB::delete("DELETE FROM produit WHERE idproduit = ?", [$id]);
        }catch(\Illuminate\Database\QueryException $e){
            throw new DatabaseException( "Suppression du Produit échouée" , $e);
        }
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

    public static function getProduitWithPourcentageCentre( $idcharge ) {
        $produit = array();
        $results = Charge::getproduitbycharge( $idcharge );
        // mahazo tableaux de résults
        // Isaky ny résults dia tokony manana centre
        for ($i = 0; $i < count($results); $i++) {
            $centres = Centre::getAll();
            // for ($j = 0; $j < count($centres); $j++) {
            //     $centres[$i]->pourcentage = 100;
            // }
            $results[$i]->centres = $centres;
        }
        return $results;
    }

    public static function updatePourcentage( $idcharge , $idproduit , $pourcentage ){
        if( empty($idcharge) || strpos($idcharge, '6') !== 0 ) throw new InvalidDataException(" Veuillez entrer une charge Valide ");
        if ( empty($idproduit) ) throw new InvalidDataException(" Verifier votre produit ");
        if( !is_numeric($pourcentage) || $pourcentage < 0 ) throw new InvalidDataException("Vous ne pouvez pas entrer un pourcentage négatif");
        try{
            $result = DB::insert("UPDATE pourcentage_produit set idproduit = ? , idcharge = ? , pourcentage = ? where idproduit = ? and idcharge = ?", [$idproduit, $idcharge, $pourcentage, $idproduit , $idcharge]);
        }catch(\Illuminate\Database\QueryException $e){
            throw new DatabaseException("Erreur lors de la modification du pourcentage." , $e );
        }
    }

    public static function InsertPourcentage( $idcharge , $idproduit , $pourcentage ){
        if( empty($idcharge) || strpos($idcharge, '6') !== 0 ) throw new InvalidDataException(" Veuillez entrer une charge Valide ");
        if ( empty($idproduit) ) throw new InvalidDataException(" Verifier votre produit ");
        if( !is_numeric($pourcentage) || $pourcentage < 0 ) throw new InvalidDataException("Vous ne pouvez pas entrer un pourcentage négatif");
        try{
            $result = DB::update("INSERT INTO pourcentage_produit(idproduit , idcharge , pourcentage) values (?,?,?)", [$idproduit,$idcharge,$pourcentage]);
        }catch(\Illuminate\Database\QueryException $e){
            throw new DatabaseException("Erreur lors de l'insertion du pourcentage." , $e );
        }
    }

    public static function getproduitcentrebycharge($idcharge)
    {
        $pourcentageproduit = array();
        $produitbycharge = Charge::getproduitbycharge($idcharge);
        for ($i = 0; $i < count($produitbycharge); $i++) {
            $product = $produitbycharge[$i];
            $centre = Charge::getcentrebyproduit( $idcharge, $produitbycharge[$i]->idproduit);
            $product->centre = $centre;
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