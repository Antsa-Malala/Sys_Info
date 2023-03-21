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
    public static function getBylibelle($libelle) {
        $result = DB::select("SELECT * FROM journaux WHERE libelle = ?", [$libelle]);
        if (!empty($result)) {
            return $result[0];
        } else {
            return null;
        }
    }

    public static function insert($code,$libelle) {
        $result = DB::insert("INSERT INTO journaux VALUES(?,?)", [$code,$libelle]);
    }

    public static function removecode($code)
    {
        $result = DB::delete("DELETE FROM journaux WHERE code = ?", [$code]);
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
    
}
?>