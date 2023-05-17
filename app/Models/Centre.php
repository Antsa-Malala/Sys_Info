<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\DatabaseException;
class Centre extends Model{
    protected $table = 'centre';

    //insertion centre
    public static function insert($nom,$idtype) {
        if( empty($nom) ) throw new \Exception("Le nom du centre ne peut etre vide");
        try{
            $result = DB::insert("INSERT INTO centre(nomcentre,id_type_centre) VALUES(?,?)", [$nom,$idtype]);
        }catch(\Illuminate\Database\QueryException $e){
            throw new DatabaseException("Insertion centre echouee",$e);
        }
    } 
    //delete centre
    public static function remove($id){
        $result = DB::delete("DELETE FROM centre WHERE idcentre = ?", [$id]);
    } 
    //liste centre avec limit pagination 
    public static function getAllLimited( $limit , $begin ){
        $centre = DB::select('SELECT * FROM centre LIMIT ? OFFSET ?' , [$limit , $begin]);
        return $centre;
    }

    //update centre
    public static function modifier($idcentre, $nomcentre)
    {
        if( empty($nomcentre) ) throw new \Exception("Le nom du centre ne peut etre vide");
        try{
            $result = DB::update("UPDATE centre SET nomcentre = ? WHERE idcentre = ?", [$nomcentre, $idcentre]);
        }catch(\Illuminate\Database\QueryException $e){
            throw new DatabaseException("Modification centre echouee",$e);
        }
    }

    //liste tous les centres 
    public static function getAll(){
        $journaux = DB::select('SELECT * FROM centre');
        return $journaux;
    }
    
    //maka centre par id
    public static function getById($id) {
        $result = DB::select("SELECT * FROM centre WHERE idcentre = ?", [$id]);
        if (!empty($result)) {
            return $result[0];
        } else {
            return null;
        }
    }


    public static function updatePourcentage( $idcharge , $idcentre , $pourcentage , $idproduit){
        if( empty($idcharge) || strpos($idcharge, '6') !== 0 ) throw new InvalidDataException(" Veuillez entrer une charge Valide ");
        if ( empty($idproduit) ) throw new InvalidDataException(" Verifier votre produit ");
        if( !is_numeric($pourcentage) || $pourcentage < 0 ) throw new InvalidDataException("Vous ne pouvez pas entrer un pourcentage négatif");
        try{
            $result = DB::insert("UPDATE pourcentage_centre set idcentre = ?, idproduit = ? , idcharge = ? , pourcentage = ? where idcentre = ? and idcharge = ? and idproduit = ?", [$idcentre, $idproduit ,$idcharge, $pourcentage, $idcentre , $idcharge ,$idproduit]);
        }catch(\Illuminate\Database\QueryException $e){
            throw new DatabaseException("Erreur lors de la modification du pourcentage." , $e );
        }
    }

    public static function InsertPourcentage( $idcharge , $idcentre , $pourcentage , $idproduit ){
        if( empty($idcharge) || strpos($idcharge, '6') !== 0 ) throw new InvalidDataException(" Veuillez entrer une charge Valide ");
        if ( empty($idcentre) ) throw new InvalidDataException(" Verifier votre produit ");
        if( !is_numeric($pourcentage) || $pourcentage < 0 ) throw new InvalidDataException("Vous ne pouvez pas entrer un pourcentage négatif");
        try{
            $result = DB::update("INSERT INTO pourcentage_centre(idproduit, idcentre , idcharge , pourcentage) values (?, ?, ?, ?)", [$idproduit, $idcentre, $idcharge, $pourcentage]);
        }catch(\Illuminate\Database\QueryException $e){
            throw new DatabaseException("Erreur lors de l'insertion du pourcentage." , $e );
        }
    }

    public function getAllCentreByProduitByCharge( $idProduit , $idCharge ){
        
    }
}