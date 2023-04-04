<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\PlanException;

class Tiers extends Model{
    protected $table = 'tiers';
    
    public static function getAll(){
        $tiers = DB::select('SELECT * FROM tiers');
        return $tiers;
    }

    public static function getAllLimited( $limit , $page ){
        $tiers = DB::select('SELECT * FROM tiers order by idtiers asc LIMIT ? offset ?' , [$limit, $page]);
        return $tiers;
    }

    public static function getById($id) {
        try{
            $result = DB::select("SELECT * FROM tiers WHERE idtiers = ?", [$id]);
            return $result[0];
        }catch( \Illuminate\Database\QueryException | \Exception $e ){
            throw new PlanException($e->getMessage());
        }
    }

    public static function getByLibelle($id) {
        $sql = "select * from tiers where libelle like '%s%s%s'";
        $sql = sprintf($sql , '%' , $id , '%');
        try{
            $result = DB::select($sql);
            return $result[0];
        }catch( \Illuminate\Database\QueryException | \Exception $e ){
            throw new PlanException($e->getMessage());
        }

    }

    public static function getByNumero($id) {
        try{
            $result = DB::select("SELECT * FROM tiers WHERE numero = ? ", ["'".$id."'"]);
            return $result[0];
        }catch( \Illuminate\Database\QueryException | \Exception $e ){
            throw new PlanException($e->getMessage());
            // throw new PlanException(sprintf("SELECT * FROM tiers WHERE numero = '%'" , $id));
        }

    }

    public static function insert( $numero, $libelle) {
        if( empty($numero) ){
            throw new \Exception("Le numéro ne doit pas etre vide");
        }
        if( empty($libelle) ){
            throw new \Exception("Le libelle ne doit pas etre vide");
        }
        $result = DB::insert("INSERT INTO tiers VALUES(default, ?, ?)", [$numero, $libelle]);
    }

    public static function remove($id)
    {
        $result = DB::delete("DELETE FROM tiers WHERE idTiers = ?", [$id]);
    }

    public static function modif($id, $numero, $libelle){
        if( empty($numero) ){
            throw new \Exception("Le numéro ne doit pas etre vide");
        }
        if( empty($libelle) ){
            throw new \Exception("Le libelle ne doit pas etre vide");
        }
        $result = DB::update("UPDATE tiers SET  numero = ?, libelle = ? WHERE idTiers = ?", [$numero, $libelle, $id]);
    }
 
    public static function exist( $id ){
        try{
            $byId = Tiers::getById(trim($id));
            // Mahazo compte aho avy eto
            return $byId->numero;
        }catch( PlanException $e ){
            try{
                $byNumero = Tiers::getBynumero(trim($id));
                return $byNumero->numero;
            }catch(PlanException $e){
                try{
                    $byLibelle = Tiers::getBylibelle( $id );
                    return $byLibelle->numero;
                }catch(PlanException $e){
                    throw new PlanException("Veuillez entrer un compte tiers existant : ".trim($id));
                }
                // throw $e;
            }

        }
    }

    
}
?>