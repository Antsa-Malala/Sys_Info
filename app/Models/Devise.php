<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
 class Devise extends Model{
    protected $table = 'devise';
    
    public static function getAll()
    {
        $devise = DB::select('SELECT * FROM devise');

        return $devise;
    }
    public static function getById($id) {
        $result = DB::select("SELECT * FROM devise WHERE idDevise = ?", [$id]);
        if (!empty($result)) {
            return $result[0];
        } else {
            return null;
        }
    }

    public static function insert($nom) {
        $result = DB::insert("INSERT INTO devise(nom) VALUES(?)", [$nom]);
    }

    public static function remove($id)
    {
        $result = DB::delete("DELETE FROM devise WHERE idDevise = ?", [$id]);
    }

    public static function modif($id, $nom)
    {
        $result = DB::update("UPDATE devise SET nom = ? WHERE idDevise = ?", [$nom, $id]);
    }
    
}
?>