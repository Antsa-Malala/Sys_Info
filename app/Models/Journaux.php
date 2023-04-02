<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
 class Journaux extends Model{
    
    protected $table = 'journaux';
    
    public static function getAll(){
        $journaux = DB::select('SELECT * FROM journaux');
        return $journaux;
    }
    public static function getBycode($code) {
        $result = DB::select("SELECT * FROM journaux WHERE code = ?", [$code]);
        if (!empty($result)) {
            return $result[0];
        } else {
            return null;
        }
    }

    public static function getById($id){
        $result = DB::select("SELECT * FROM journaux WHERE idcode = ?", [$id]);
        if (!empty($result)) {
            return $result[0];
        } 
        throw new \Exception("Code non répértorié");
    }
    public static function getBylibelle($libelle) {
        $result = DB::select("SELECT * FROM journaux WHERE libelle = ?", [$libelle]);
        if (!empty($result)) {
            return $result[0];
        } else {
            return null;
        }
    }

    public static function insert($code,$libelle) {
        if( empty($code) ) throw new \Exception("Le code ne peut etre vide");
        if( empty($libelle) ) throw new \Exception("Le libelle ne peut etre vide");
        // if( strlen($code) > 2 ) throw new \Exception("Le code ne peut contenie");
        $result = DB::insert("INSERT INTO journaux VALUES(default , ?,?)", [$code,$libelle]);
    }

    public static function removecode($code)
    {
        $result = DB::delete("DELETE FROM journaux WHERE code = ?", [$code]);
    }

    public static function remove($id){
        $result = DB::delete("DELETE FROM journaux WHERE idcode = ?", [$id]);
    }

    public static function removelibelle($libelle)
    {
        $result = DB::delete("DELETE FROM journaux WHERE libelle = ?", [$libelle]);
    }

    public static function modiflibelle($code, $libelle)
    {
        $result = DB::update("UPDATE journaux SET libelle = ? WHERE code = ?", [$libelle, $code]);
    }
    public static function modifcode( $code,$libelle)
    {
        $result = DB::update("UPDATE journaux SET code = ? WHERE libelle = ?", [$code,$libelle]);
    }

    public static function modif($id , $code,$libelle){
        $result = DB::update("UPDATE journaux SET code = ? ,libelle = ? where idcode = ?", [$code,$libelle , $id]);
    }

    
}
?>