<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
 class User extends Model{
    protected $table = 'users';
    
    public static function getAll()
    {
        $user = DB::select('SELECT * FROM users');

        return $user;
    }
    public static function getById($id) {
        $result = DB::select("SELECT * FROM users WHERE idUser = ?", [$id]);
        if (!empty($result)) {
            return $result[0];
        } else {
            return null;
        }
    }

    public static function insert($idSociety, $username, $password) {
        $result = DB::insert("INSERT INTO users VALUES(default, ?, ?, ?)", [$idSociety, $username, $password]);
    }

    public static function remove($id)
    {
        $result = DB::delete("DELETE FROM users WHERE idUser = ?", [$id]);
    }

    public static function modif($id, $idSociety, $username, $password)
    {
        $result = DB::update("UPDATE users SET idSociety = ?, username = ?, password = ? WHERE idUser = ?", [$idSociety, $username, $password, $id]);
    }

    
}
?>