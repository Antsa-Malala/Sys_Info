<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
 class Tiers extends Model{
    protected $table = 'tiers';
    
    public static function getAll()
    {
        $tiers = DB::select('SELECT * FROM tiers');

        return $tiers;
    }
    public static function getById($id) {
        $result = DB::select("SELECT * FROM tiers WHERE idTiers = ?", [$id]);
        if (!empty($result)) {
            return $result[0];
        } else {
            return null;
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

    
}
?>