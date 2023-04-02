<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
 class Plan extends Model{
    protected $table = 'plan';
    
    public static function getAll()
    {
        $plan = DB::select('SELECT * FROM plan');

        return $plan;
    }
    public static function getBynumero($numeroCompte) {
        $result = DB::select("SELECT * FROM plan WHERE numerocompte = ?", [$numeroCompte]);
        if (!empty($result)) {
            return $result[0];
        } else {
            return null;
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
        $result = DB::insert("INSERT INTO plan VALUES(?,?)", [$numeroCompte,$libelle]);
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
    
}
?>