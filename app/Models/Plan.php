<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\InvalidNumberException;
use App\Exceptions\DatabaseException;
use App\Exceptions\PlanException;

class Plan extends Model{
    protected $table = 'plan';
    protected $primaryKey = 'idplan';
    
    public static function getAll()
    {
        $plan = DB::select('SELECT * FROM plan order by compte');

        return $plan;
    }
    public static function getBynumero($numeroCompte) {
        if(empty($numeroCompte)) throw new \Exception("Le numéro de compte est invalide");
        $result = DB::select("SELECT * FROM plan WHERE compte = ?", [$numeroCompte]);
        if (!empty($result)) {
            return $result[0];
        } else {
            throw new \Exception('Aucun Résultat');
        }
    }
    public static function getById($id) {
        try{
            $result = DB::select("SELECT * FROM plan WHERE idplan = ? ", ["'".$id."'"]);
            return $result[0];
        }catch(\Illuminate\Database\QueryException | \Exception $query){
            throw new \Exception('Aucun Résultat');
        }
    }

    public static function getBylibelle($libelle) {
        $result = DB::select("SELECT * FROM plan WHERE libelle = ?", [$libelle]);
        if (!empty($result)) {
            return $result[0];
        } else {
            return null;
        }
    }

    public static function insert($numeroCompte,$libelle) {
        if( empty($numeroCompte) ) throw new \Exception("Le numero de compte ne peut etre nulle , égale a 0");
        if( strlen($numeroCompte) > 5 ) throw new \Exception("Le numero de compte ne peut contenir que 5 caracteres");
        if( empty($libelle) ) throw new \Exception(" Le libelle ne peut etre null ");
        try{
            $number = $numeroCompte;
            $numeroCompte = Plan::fillZero($numeroCompte);
            $result = DB::insert("insert into plan values (default , ? , ? )", [$numeroCompte,$libelle]);
        }catch( \Illuminate\Database\QueryException $e ){
            throw new DatabaseException( " Operation Failed for account ". $number ." -> " . $numeroCompte . ": " , $e->getMessage() );
        }
    }

    private static function fillZero($numero){
        $var = 0;
        $total = strlen($numero);
        $t = (string) $numero;
        for( $i = $total + 1 ; $i <= 5 ; $i++ ){
            $t = $t.'0';
        }
        return $t;
    }


    public static function removenumero($numeroCompte)
    {
        $result = DB::delete("DELETE FROM plan WHERE numeroCompte = ?", [$numeroCompte]);
    }
    public static function removelibelle($libelle)
    {
        $result = DB::delete("DELETE FROM plan WHERE libelle = ?", [$libelle]);
    }

    public static function modiflibelle($numeroCompte, $libelle)
    {
        $result = DB::update("UPDATE plan SET libelle = ? WHERE numeroCompte = ?", [$libelle, $numeroCompte]);
    }
    public static function modifnumero( $numeroCompte,$libelle)
    {
        $result = DB::update("UPDATE plan SET numeroCompte = ? WHERE libelle = ?", [ $numeroCompte,$libelle]);
    }

    public static function updates( $numeroCompte , $libelle , $id ){
        if( empty($numeroCompte) ) throw new \Exception("Le numero de compte ne peut etre nulle , égale a 0");
        if( strlen($numeroCompte) > 5 ) throw new \Exception("Le numero de compte ne peut contenir que 5 caracteres");
        if( empty($libelle) ) throw new \Exception(" Le libelle ne peut etre null ");
        try{
            $numeroCompte = Plan::fillZero($numeroCompte);
            $result = DB::update("UPDATE plan SET compte = ? , libelle = ? where idplan = ? ", [ $numeroCompte,$libelle , $id]);
        }catch(\Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public static function exist( $id ){
        try{
            $byId = Plan::getById($id);
            return true;
        }catch( \Exception $e ){
            try{
                $byNumero = Plan::getBynumero($id);
                return true;
            }catch(\Exception $e){
                throw new PlanException("Le compte que vous avez entrée n'existe pas");
            }
        }
    }
    
}
?>