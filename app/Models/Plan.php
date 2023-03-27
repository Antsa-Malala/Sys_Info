<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
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
        $result = DB::select("SELECT * FROM plan WHERE compte = ?", [$numeroCompte]);
        if (!empty($result)) {
            return $result[0];
        } else {
            throw new Exception('Aucun Résultat');
        }
    }
    public static function getById($id) {
        $result = DB::select("SELECT * FROM plan WHERE idplan = ?", [$numeroCompte]);
        if (!empty($result)) {
            return $result[0];
        } else {
            throw new Exception('Aucun Résultat');
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
        $numeroCompte = Plan::fillZero($numeroCompte);
        // var_dump($numeroCompte);
        $result = DB::insert("insert into plan values (default , ? , ? )", [$numeroCompte,$libelle]);
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
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }
    
}
?>