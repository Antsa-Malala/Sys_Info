<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
 class Society extends Model{
    protected $table = 'society';
    
    public static function getAll()
    {
        $society = DB::select('SELECT * FROM society');

        return $society;
    }
    public static function getById($id) {
        $result = DB::select("SELECT * FROM society WHERE idSociety = ?", [$id]);
        if (!empty($result)) {
            return $result[0];
        } else {
            return null;
        }
    }

    public static function insert($nom,$creation,$fondateur,$nif,$logo,$date_exercice,$status,$telecopie,$telephone) {
        $result = DB::insert("INSERT INTO society VALUES(default,?,?,?,?,?,?,?,?,?)", [$nom,$creation,$fondateur,$nif,$logo,$date_exercice,$status,$telecopie,$telephone]);
    }

    public static function remove($id)
    {
        $result = DB::delete("DELETE FROM society WHERE idSociety = ?", [$id]);
    }

    public static function modif($id, $nom,$creation,$fondateur,$nif,$logo,$date_exercice,$status,$telecopie,$telephone)
    {
        $result = DB::update("UPDATE society SET nom = ?, creation= ?, fondateur= ?,nif= ?,logo= ?,date_exercice= ?,status= ?,telecopie= ?,telephone= ? WHERE idSociety = ?", [$nom,$creation,$fondateur,$nif,$logo,$date_exercice,$status,$telecopie,$telephone, $id]);
    }
    
}
?>