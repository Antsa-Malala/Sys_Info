<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
 class Exchange extends Model{
    protected $table = 'exchange_rate';
    
    public static function getAll()
    {
        $exchange_rate = DB::select('SELECT * FROM exchange_rate');

        return $exchange_rate;
    }
    public static function getById($id) {
        $result = DB::select("SELECT * FROM exchange_rate WHERE idExchange = ?", [$id]);
        if (!empty($result)) {
            return $result[0];
        } else {
            return null;
        }
    }

    public static function insert($idone,$idtwo,$rate) {
        $result = DB::insert("INSERT INTO exchange_rate VALUES(default, ?, ?, ?)", [$idone,$idtwo,$rate]);
    }

    public static function remove($id)
    {
        $result = DB::delete("DELETE FROM exchange_rate WHERE idexchange = ?", [$id]);
    }

    public static function modif($id, $idone,$idtwo,$rate)
    {
        $result = DB::update("UPDATE exchange_rate SET idone = ?, idtwo = ?, rate = ? WHERE idexchange = ?", [$idone,$idtwo,$rate, $id]);
    }

    
}
?>