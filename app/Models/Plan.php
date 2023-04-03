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
        $plan = DB::select('SELECT * FROM plan order by compte LIMIT 10');

        return $plan;
    }
    public static function getBynumero($numeroCompte) {
        if(empty($numeroCompte)) throw new \Exception("Le numéro de compte est invalide");
        $a = 0;
        try{
            $result = DB::select("SELECT * FROM plan WHERE compte = ? ", [$numeroCompte]);
            // $a = $result;
            // ob_start();
            // var_dump($result);
            return $result[0];
        }catch( \Illuminate\Database\QueryException | \Exception $e ){
            // $out = ob_get_clean();
            // throw new \Exception(sprintf("SELECT * FROM plan WHERE compte = '%s'" , '%' , $numeroCompte , '%'));
            throw new \Exception('Aucun Résultat');
            // throw new \Exception($out);
        }
    }
    public static function getById($id) {
        try{
            $result = DB::select("SELECT * FROM plan WHERE idplan = ? ", [$id]);
            return $result[0];
        }catch(\Illuminate\Database\QueryException | \Exception $query){
            throw new \Exception('Aucun Résultat');
        }
    }

    public static function getBylibelle($libelle) {
        // $sql = sprintf("SELECT * FROM plan WHERE libelle like '%s%s%s'" , '%' , $libelle , '%');
        try {
            $result = DB::select("SELECT * FROM plan WHERE libelle like ?", ['%'.$libelle.'%']);
            // ob_start();
            // var_dump($result);
            // $result = DB::select($sql);
            return $result[0];
        }catch( \Illuminate\Database\QueryException | \Exception $e ){
            // $out = ob_get_clean();
            // throw new \Exception($out);
            throw new \Exception("Aucun Résultat");
            // throw new \Exception($e);
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
        $a = 0;
        try{
            $byId = Plan::getById($id);
            $a = $byId;
            return $byId->compte;
        }catch( \Exception $e ){
            try{
                $byNumero = Plan::getBynumero($id);
                $a = $byNumero;
                return $byNumero->compte;
            }catch(\Exception $e){
                try{
                    $byLibelle = Plan::getBylibelle(trim($id));
                    $a = $byLibelle;
                    return $byLibelle->compte;
                }catch(\Exception $e){
                    // throw new PlanException( $e->getMessage() );
                    throw new PlanException("Le compte que vous avez entrée n'existe pas :".$id);
                }
            }
        }
    }
    
}
?>