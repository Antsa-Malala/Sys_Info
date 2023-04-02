<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
 class Location extends Model{
    protected $table = 'location';
    
    public static function getAll()
    {
        $location = DB::select('SELECT * FROM location');

        return $location;
    }
    public static function getById($id) {
        $result = DB::select("SELECT * FROM location WHERE idlocation = ?", [$id]);
        if (!empty($result)) {
            return $result[0];
        } else {
            return null;
        }
    }

    public static function insert($idSociety,$localisation,$primaire) {
        $result = DB::insert("INSERT INTO location VALUES(default, ?, ?, ?)", [$idSociety,$localisation,$primaire]);
    }

    public static function remove($id)
    {
        $result = DB::delete("DELETE FROM location WHERE idlocation = ?", [$id]);
    }

    public static function modif($id, $idSociety,$localisation,$primaire)
    {
        $result = DB::update("UPDATE location SET idSociety = ?, localisation = ?, primaire = ? WHERE idlocation = ?", [$idSociety,$localisation,$primaire, $id]);
    }

    
}
?>